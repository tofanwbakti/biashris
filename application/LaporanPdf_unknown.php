<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanPdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }


    public function absen()
    {
        $id=decrypt_url($this->uri->segment(3));
        $name="Atas nama : ".decrypt_url($this->uri->segment(4));
        $img = base_url('assets/images/logobmg.png');
        
        $pdf = new FPDF('P','mm','A4');

        // membuat halaman baru
        $pdf->AddPage();
        // Image 
        $pdf->Image($img,30,10,25);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'BIAS MANDIRI GROUP',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'LAPORAN ABSENSI KARYAWAN',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
         // set left margin
        $pdf->SetLeftMargin('30');
        $pdf->Cell(190,7,$name,0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'NO',1,0);
        $pdf->Cell(25,6,'HARI',1,0);
        $pdf->Cell(30,6,'TGL',1,0);
        $pdf->Cell(27,6,'JAM MASUK',1,0);
        $pdf->Cell(27,6,'JAM KELUAR',1,0);
        $pdf->Cell(27,6,'KETERANGAN',1,1);

        $pdf->SetFont('Arial','',10);
        $this->db->select('*');
        $this->db->from('tb_absensi');
        $this->db->where('id_kar',$id);
        $absen = $this->db->get()->result();
        $no = 1;
        foreach($absen as $data){
            $pdf->Cell(10,6,$no++,1,0);
            if($data->hari == "Monday"){
                $pdf->Cell(25,6,"Senin",1,0);
            }else if($data->hari == "Tuesday"){
                $pdf->Cell(25,6,"Selasa",1,0);
            }else if($data->hari == "Wednesday"){
                $pdf->Cell(25,6,"Rabu",1,0);
            }else if($data->hari == "Thursday"){
                $pdf->Cell(25,6,"Kamis",1,0);
            }else if($data->hari == "Friday"){
                $pdf->Cell(25,6,"Jumat",1,0);
            }else if($data->hari == "Saturday"){
                $pdf->Cell(25,6,"Sabtu",1,0);
            }else if($data->hari == "Sunday"){
                $pdf->Cell(25,6,"Minggu",1,0);
            }            
            $pdf->Cell(30,6,date("d M Y",strtotime($data->tgl)),1,0);
            $pdf->Cell(27,6,$data->jam_masuk,1,0); 
            $pdf->Cell(27,6,$data->jam_pulang,1,0);
            if($data->status == "2"){
                $pdf->Cell(27,6,'Terlambat',1,1); 
            }else {
                $pdf->Cell(27,6,'',1,1);
            }

        }
        

        $pdf->Output();
    }

}