<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanPdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        cek_nologin();
        // cek_admin();
        // cek_admin2();
        // cek_admin3();
        $this->load->library('pdf');
        // $this->load->library('fpdf_autowraptable');
        // $this->load->model('M_Laporan');
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
        $pdf->Cell(190,7,'BIAS HRIS',0,1,'C');
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
            if($data->absen_status == "2"){
                $pdf->Cell(27,6,'Terlambat',1,1); 
            }else {
                $pdf->Cell(27,6,'',1,1);
            }

        }       
        $pdf->Output();
    }

    public function absenRange()
    {
        $id=decrypt_url($this->uri->segment(3));
        $name="Atas nama : ".decrypt_url($this->uri->segment(4));
        $awal=decrypt_url($this->uri->segment(5));
        $akhir=decrypt_url($this->uri->segment(6));
        $img = base_url('assets/images/logobmg.png');

        
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // Header Page
        // Image 
        $pdf->Image($img,30,10,25);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'BIAS HRIS',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'LAPORAN ABSENSI KARYAWAN',0,1,'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,7,'Periode '.date("d M Y",strtotime($awal)).' - '.date("d M Y",strtotime($akhir)),0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        //  Content Page>> Header Table
         // set left margin
        $pdf->SetLeftMargin('30');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,7,$name,0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'NO',1,0);
        $pdf->Cell(25,6,'HARI',1,0);
        $pdf->Cell(30,6,'TGL',1,0);
        $pdf->Cell(27,6,'JAM MASUK',1,0);
        $pdf->Cell(27,6,'JAM KELUAR',1,0);
        $pdf->Cell(27,6,'KETERANGAN',1,1);
        //  Content Page >> Body Table
        $pdf->SetFont('Arial','',10);
        $this->db->select('*');
        $this->db->from('tb_absensi');
        $this->db->where('id_kar',$id);
        $this->db->where('tgl >=',$awal);
		$this->db->where('tgl <=',$akhir);
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
            if($data->absen_status == "2"){
                $pdf->Cell(27,6,'Terlambat',1,1); 
            }else {
                $pdf->Cell(27,6,'',1,1);
            }

        }       
        $pdf->Output();
    }

    // Kontrak All
    public function kontrakAll()
    {
        $img = base_url('assets/images/logobmg.png');        

        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // Header Page
        // Image 
        $pdf->Image($img,30,10,25);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'BIAS HRIS',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'LAPORAN KONTRAK KARYAWAN',0,1,'C');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(190,7,'KONTRAK KARYAWAN SELURUH BISNIS UNIT',0,1,'C');
        
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        // Content Page >> Header Table
         // set left margin
        $pdf->SetLeftMargin('10');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'NO',1,0,'C');
        $pdf->Cell(20,6,'NIP',1,0,'C');
        $pdf->Cell(35,6,'Nama',1,0,'C');
        $pdf->Cell(25,6,'Awal',1,0,'C');
        $pdf->Cell(25,6,'Akhir',1,0,'C');
        $pdf->Cell(15,6,'SBU',1,0,'C');
        $pdf->Cell(27,6,'Jabatan',1,0,'C');
        $pdf->Cell(27,6,'Durasi',1,1,'C');
        //  Content Page >> Body Table
        $pdf->SetFont('Arial','',10);
        $this->db->select('*');
        $this->db->from('tb_kontrak');
        $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
        $this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
        $this->db->where('tb_kontrak.status','Y');  
        $this->db->where('tb_kontrak.kontrak !=','P');  
		$this->db->where('tb_karyawan.id_kar !=','1');  
        $this->db->order_by('id_kon','DESC');
        $kontrak =  $this->db->get()->result();
        $no=1;

        foreach($kontrak as $data){
            $pdf->Cell(10,6,$no++,1,0);
            $pdf->Cell(20,6,$data->nip,1,0);
            $pdf->Cell(35,6,$data->fullname,1,0);
            $pdf->Cell(25,6,date("d M y",strtotime($data->start)),1,0);
            $pdf->Cell(25,6,date("d M y",strtotime($data->end)),1,0);
            $pdf->Cell(15,6,$data->kode,1,0);
            if($data->nama_jab == "GENERAL MANAGER"){
                $pdf->Cell(27,6,"GM/KADIV",1,0);
            }else{
                $pdf->Cell(27,6,$data->nama_jab,1,0);
            }
            $pdf->Cell(27,6,$data->durasi.' bulan',1,1);
            
        }
        // // Position at 1.5 cm from bottom
        // $pdf->SetY(26);
        // // Footer
        // $pdf->SetFont('Arial','I',8);
        // // // Page number
        // $pdf->Cell(0,10,'Page '.$pdf->PageNo().'/{nb}',0,0,'R');
        
        $pdf->Output();
    }

    // Kontrak Filtered
    public function kontrakFiltered()
    {
        $sbu = decrypt_url($this->uri->segment(3));
        $jab = decrypt_url($this->uri->segment(4));
        $awal = decrypt_url($this->uri->segment(5));
        $akhir = decrypt_url($this->uri->segment(6));

        $img = base_url('assets/images/logobmg.png');        

        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // Header Page
        // Image 
        $pdf->Image($img,30,10,25);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'BIAS HRIS',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'LAPORAN KONTRAK KARYAWAN',0,1,'C');
        $pdf->SetFont('Arial','B',9);
        if($sbu == "EMPTY"){
            $pdf->Cell(190,7,'KONTRAK KARYAWAN SELURUH BISNIS UNIT',0,1,'C');
        }else {
            $pdf->Cell(190,7,'KONTRAK KARYAWAN BISNIS UNIT '.$sbu,0,1,'C');
        }

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->Cell(190,7,'Periode  '.date("d M Y",strtotime($awal)).' - '.date("d M Y",strtotime($akhir)),0,1,'J');
        // Content Page >> Header Table
         // set left margin
        $pdf->SetLeftMargin('10');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'NO',1,0,'C');
        $pdf->Cell(20,6,'NIP',1,0,'C');
        $pdf->Cell(35,6,'Nama',1,0,'C');
        $pdf->Cell(25,6,'Awal',1,0,'C');
        $pdf->Cell(25,6,'Akhir',1,0,'C');
        $pdf->Cell(15,6,'SBU',1,0,'C');
        $pdf->Cell(27,6,'Jabatan',1,0,'C');
        $pdf->Cell(27,6,'Durasi',1,1,'C');
        //  Content Page >> Body Table
        $pdf->SetFont('Arial','',10);
        if(($sbu == "EMPTY")&& ($jab == "EMPTY")){
            $this->db->select('*');
            $this->db->from('tb_kontrak');
            $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
            $this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
            $this->db->where('tb_kontrak.status','Y');  
            $this->db->where('tb_kontrak.kontrak !=','P');  
            $this->db->where('tb_karyawan.id_kar !=','1'); 
			$this->db->where('tb_kontrak.start >=',$awal);
			$this->db->where('tb_kontrak.start <=',$akhir); 
            $this->db->order_by('id_kon','DESC');
            $kontrak =  $this->db->get()->result();
        }else if($sbu == "EMPTY"){
            $this->db->select('*');
            $this->db->from('tb_kontrak');
            $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
            $this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
            $this->db->where('tb_kontrak.status','Y');  
            $this->db->where('tb_kontrak.kontrak !=','P');  
            $this->db->where('tb_karyawan.id_kar !=','1'); 
            $this->db->like('tb_karyawan.id_jab',$jab);
            $this->db->where('tb_kontrak.start >=',$awal);
			$this->db->where('tb_kontrak.start <=',$akhir);
            $this->db->order_by('id_kon','DESC');
            $kontrak =  $this->db->get()->result();
        }else if($jab == "EMPTY"){
            $this->db->select('*');
            $this->db->from('tb_kontrak');
            $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
            $this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
            $this->db->where('tb_kontrak.status','Y');  
            $this->db->where('tb_kontrak.kontrak !=','P');  
            $this->db->where('tb_karyawan.id_kar !=','1'); 
            $this->db->like('tb_karyawan.kode',$sbu);
            $this->db->where('tb_kontrak.start >=',$awal);
			$this->db->where('tb_kontrak.start <=',$akhir);
            $this->db->order_by('id_kon','DESC');
            $kontrak =  $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from('tb_kontrak');
            $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
            $this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
            $this->db->where('tb_kontrak.status','Y');  
            $this->db->where('tb_kontrak.kontrak !=','P');  
            $this->db->where('tb_karyawan.id_kar !=','1');
            $this->db->like('tb_karyawan.kode',$sbu);
            $this->db->like('tb_karyawan.id_jab',$jab);
            $this->db->where('tb_kontrak.start >=',$awal);
            $this->db->where('tb_kontrak.start <=',$akhir);   
            $this->db->order_by('id_kon','DESC');
            $kontrak =  $this->db->get()->result();
        }        
        $no=1;

        foreach($kontrak as $data){
            $pdf->Cell(10,6,$no++,1,0);
            $pdf->Cell(20,6,$data->nip,1,0);
            $pdf->Cell(35,6,$data->fullname,1,0);
            $pdf->Cell(25,6,date("d M y",strtotime($data->start)),1,0);
            $pdf->Cell(25,6,date("d M y",strtotime($data->end)),1,0);
            $pdf->Cell(15,6,$data->kode,1,0);
            if($data->nama_jab == "GENERAL MANAGER"){
                $pdf->Cell(27,6,"GM/KADIV",1,0);
            }else{
                $pdf->Cell(27,6,$data->nama_jab,1,0);
            }
            $pdf->Cell(27,6,$data->durasi.' bulan',1,1);
            
        }
        $pdf->Output();

    }

    
    // Detail Pengajuan Cuti
    public function detailCuti()
    {
        $id = decrypt_url($this->uri->segment(3));
        $noform = decrypt_url($this->uri->segment(4));
        // $id = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->from('tb_cuti_karyawan');
        $this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_cuti_karyawan.id_kar','INNER');
        $this->db->join('tb_cuti_aproval','tb_cuti_aproval.noform=tb_cuti_karyawan.noform','INNER');
        $this->db->where('tb_cuti_karyawan.id_cukar',$id);
        $datacuti = $this->db->get()->result();

        // Data table jatah cuti
        $this->db->select('*');
        $this->db->from('tb_cuti_jatah');
        $this->db->join('tb_cuti_karyawan','tb_cuti_karyawan.nip=tb_cuti_jatah.nip','INNER');
        $this->db->where('tb_cuti_karyawan.id_cukar',$id);
        $this->db->where('tb_cuti_jatah.c_status',"A");
        $dtjatah = $this->db->get()->result();

        // Data table Aproval cuti
        $this->db->select('*');
        $this->db->from('tb_cuti_aproval');
        $this->db->join('tb_cuti_karyawan','tb_cuti_karyawan.noform=tb_cuti_aproval.noform','INNER');
        $this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_cuti_karyawan.id_kar','INNER');
        $this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','INNER');
        $dataapv = $this->db->get()->result();


        $img = base_url('assets/images/logobmg.png');   
        $alamat = "Komp. Sentosa Purnama Jaya Blok B No. 9 - 11";
        $alamat2 = "Batu Ampar - Batam." ;

        $batal = base_url('assets/images/lb_cnl.png');
        $pending = base_url('assets/images/lb_pnd.png');
        $tolak = base_url('assets/images/lb_rjc.png');
        $setuju = base_url('assets/images/lb_apv.png');

        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // Header Page
        // Image 
        $pdf->Image($img,30,10,25);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,7,'Bias Mandiri Group',0,1,'R');
        $pdf->Cell(190,7,$alamat,0,1,'R');
        $pdf->Cell(190,7,$alamat2,0,1,'R');

        $pdf->SetLineWidth(1);
        $pdf->Line(15,36,200,36);

        
        $pdf->SetFont('Arial','',10);
        
        
        foreach($datacuti as $data){
            $pdf->SetTitle('Form Cuti '.$data->noform);
        // WATERMARK STATUS
            if($data->stat_cukar == "MENUNGGU"){
                // $pdf->SetFont('Arial','B',50);
                // $pdf->SetTextColor(255,204,153);
                $pdf->Image($pending,50,70,100);
            }else if($data->stat_cukar == "DISETUJUI"){
                // $pdf->SetFont('Arial','B',50);
                // $pdf->SetTextColor(204,255,204);
                // $pdf->RotatedText(75,150,'MENUNGGU',45);
                $pdf->Image($setuju,50,70,100);
            }else if($data->stat_cukar == "DITOLAK"){
                $pdf->Image($tolak,50,70,100);
            }else{
                $pdf->Image($batal,50,70,100);
            };
        // JUDUL FORM & No PEngajuan
            $pdf->Cell(10,7,'',0,1);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(190,7,'FORMULIR CUTI',0,1,'C');
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(190,7,'No. Pengajuan : '.$data->noform,0,1,'C');
        // Detail USER DAN TGL PENGAJUAN
            if($data->tipe_cukar == "TAHUNAN"){                
                $pdf->SetFont('Arial','',12);
                $pdf->Cell(15,7,'',60,2);
                // Isi Form
                $pdf->SetLeftMargin(15);
                // Aturan : lebar, tinggi, Isi, Border, spasi
                $pdf->Cell(30,4,'Nama Lengkap ',0,0);
                // $pdf->SetRightMargin(100);
                $pdf->Cell(5,4,' :',0,0);
                $pdf->Cell(70,4,$data->fullname,0,0);
                $pdf->Cell(50,4,'Awal Cuti ',0,0);
                $pdf->Cell(5,4,' :',0,0);
                $pdf->Cell(30,4,date("d-M-Y",strtotime($data->awal_cukar)),0,1);
                // Line Kedua
                $pdf->Cell(30,7,'NIP',0,0);
                $pdf->Cell(5,7,' :',0,0);
                $pdf->Cell(70,7,$data->nip,0,0);
                $pdf->Cell(50,7,'Akhir Cuti ',0,0);
                $pdf->Cell(5,7,' :',0,0);
                $pdf->Cell(30,7,date("d-M-Y",strtotime($data->akhir_cukar)),0,1);
                // Line Ketiga
                $pdf->Cell(30,4,'SBU',0,0);
                $pdf->Cell(5,4,' :',0,0);
                $pdf->Cell(70,4,$data->kode,0,0);
                $pdf->Cell(50,4,'Total Hari  ',0,0);
                $pdf->Cell(5,4,' :',0,0);
                $pdf->Cell(30,4,$data->totalhr_cukar.' Hari',0,1);
                // Line Ke empat
                $pdf->Cell(30,7,'Tgl Diajukan',0,0);
                $pdf->Cell(5,7,' :',0,0);
                $pdf->Cell(70,7,date("d-M-Y",strtotime($data->tglform)),0,0);
                $pdf->Cell(50,7,'Sisa Cuti ',0,0);
                $pdf->Cell(5,7,' :',0,0);
                foreach($dtjatah as $data2){
                    $pdf->Cell(30,7,$data2->sisa_cuti.' Hari',0,1);
                }
            }else{
                $pdf->SetFont('Arial','',12);
                $pdf->Cell(15,7,'',60,2);
                // Isi Form
                $pdf->SetLeftMargin(15);
                // Aturan : lebar, tinggi, Isi, Border, spasi
                $pdf->Cell(30,4,'Nama Lengkap ',0,0);
                // $pdf->SetRightMargin(100);
                $pdf->Cell(5,4,' :',0,0);
                $pdf->Cell(70,4,$data->fullname,0,0);
                $pdf->Cell(50,4,'Awal Cuti ',0,0);
                $pdf->Cell(5,4,' :',0,0);
                $pdf->Cell(30,4,date("d-M-Y",strtotime($data->awal_cukar)),0,1);
                // Line Kedua
                $pdf->Cell(30,7,'NIP',0,0);
                $pdf->Cell(5,7,' :',0,0);
                $pdf->Cell(70,7,$data->nip,0,0);
                $pdf->Cell(50,7,'Akhir Cuti ',0,0);
                $pdf->Cell(5,7,' :',0,0);
                $pdf->Cell(30,7,date("d-M-Y",strtotime($data->akhir_cukar)),0,1);
                // Line Ketiga
                $pdf->Cell(30,4,'SBU',0,0);
                $pdf->Cell(5,4,' :',0,0);
                $pdf->Cell(70,4,$data->kode,0,0);
                $pdf->Cell(50,4,'Total Hari  ',0,0);
                $pdf->Cell(5,4,' :',0,0);
                $pdf->Cell(30,4,$data->totalhr_cukar.' Hari',0,1);
                // Line Ke empat
                $pdf->Cell(30,7,'Tgl Diajukan',0,0);
                $pdf->Cell(5,7,' :',0,0);
                $pdf->Cell(70,7,date("d-M-Y",strtotime($data->tglform)),0,1);
            }

        // Table Keterangan Cuti
            $pdf->Cell(190,7,'',0,1,'J');
            $pdf->Cell(190,7,'Keterangan Cuti :',0,1,'J');
            $pdf->SetFillColor(158, 156, 156);
            $pdf->SetLineWidth(.3);
            // $pdf->SetFillColor(15,36,200,36);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(150,7,'Keperluan',1,0,'C',1);
            $pdf->Cell(35,7,'Status',1,1,'C',1);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(150,7,$data->ket_cukar,1,0,'J');
            $pdf->Cell(35,7,$data->stat_cukar,1,1,'C');

        // APPROVAL
            $pdf->SetLeftMargin(15);
            $pdf->Cell(190,7,'',0,1,'J');
            $pdf->SetFont('Arial','',12);
            // LEFT SIDE line 1
            $pdf->Cell(100,7,'Approval Atasan',0,0,'J');
            // RIGHT SIDE Line 1
            $pdf->Cell(85,7,'Approval HRD',0,1,'J');
            // LEFT SIDE line 2
            $pdf->Cell(30,7,'Nama',0,0,'J');
            $pdf->Cell(5,7,' :',0,0,'J');
            $pdf->Cell(65,7,$data->apv1,0,0,'J');
            // RIGHT SIDE line 2
            $pdf->Cell(30,7,'Nama',0,0,'J');
            $pdf->Cell(5,7,' :',0,0,'J');
            $pdf->Cell(50,7,$data->apv2,0,1,'J');
            // LEFT SIDE line 3
            $pdf->Cell(30,7,'Jabatan',0,0,'J');
            $pdf->Cell(5,7,' :',0,0,'J');
            $pdf->Cell(65,7,$data->jab_apv1,0,0,'J');
            // RIGHT SIDE line 3
            $pdf->Cell(30,7,'Jabatan',0,0,'J');
            $pdf->Cell(5,7,' :',0,0,'J');
            $pdf->Cell(50,7, $data->jab_apv2,0,1,'J');
            // LEFT SIDE line 4
            $pdf->Cell(30,7,'Tanggal',0,0,'J');
            $pdf->Cell(5,7,' :',0,0,'J');
            $pdf->Cell(65,7,date("d-M-Y",strtotime($data->tgl_apv1)),0,0,'J');
            // RIGHT SIDE line 3
            $pdf->Cell(30,7,'Tanggal',0,0,'J');
            $pdf->Cell(5,7,' :',0,0,'J');
            $pdf->Cell(50,7, date("d-M-Y",strtotime($data->tgl_apv2)) ,0,1,'J');
            
            
            // Footer
            $pdf->Cell(180,7,'',0,1,'J');
            $pdf->Cell(180,7,'',0,1,'J');
            $pdf->SetFont('Arial','I',9);
            $pdf->Cell(185,5,'Catatan : ',1,1,'J');
            $pdf->Cell(185,5,'* Surat ini hanya berlaku apabila sudah disetujui oleh HRD.',1,1,'J');
            $pdf->SetFillColor(255, 255, 255);
            $pdf->MultiCell(185,5,'* Hak Cuti tahunan gugur secara otomatis apabila dalam waktu 6 bulan setelah timbulnya hak cuti tidak dilaksanakan bukan karena alasan yang disebabkan perusanaan.',1,1,'J');
            $pdf->Cell(185,5,'* Sisa cuti setelah dikurangi cuti bersama.',1,1,'J');
            $pdf->Cell(185,5,'* Sisa hak cuti tidak dapat diganti dengan uang.',1,1,'J');
            $pdf->Cell(185,5,'* Rincian cuti khusus :',1,1,'J');
            $pdf->Cell(185,5,'   1. Karyawan wanita selama 1,5 bulan sebelum melahirkan dan 1,5 bulan setelahnya.',1,1,'J');
            $pdf->Cell(185,5,'   2. Karyawan menikah selama 3 hari.',1,1,'J');
            $pdf->Cell(185,5,'   3. Istri sah karyawan melahirkan atau keguguran selama 2 hari.',1,1,'J');
            $pdf->Cell(185,5,'   4. Kematian suami, istri, anak, orang tua atau mertua selama 2 hari.',1,1,'J');
            $pdf->Cell(185,5,'   5. Perkawinan anak karyawan selama 2 hari.',1,1,'J');
            $pdf->Cell(185,5,'   6. Khitanan anak, pembaptisan anak selama 1 hari.',1,1,'J');
            $pdf->Cell(185,5,'   7. Perjalanan ibadah selama waktu yang diperlukan, namun tidak lebih dari 40 hari kerja.',1,1,'J');
            $pdf->Cell(185,5,'   8. Memenuhi kewajiban negara.',1,1,'J');          

            $pdf->Output();
        }
    }

/* halaman kontrak karyawan atau manajemen kontrak */
    // Laporan EOC Kontrak
    public function laporanEockontrak()
    {
        // $dataeoc = $this->M_Laporan->getEocKontrak();
        $this->db->select('*');
        $this->db->from('tb_kontrak');
        $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
        $this->db->where('tb_kontrak.end <=',"CURDATE() + INTERVAL 30 DAY",false);                            
        $this->db->where('tb_karyawan.id_jab !=','J000');  
        $this->db->where('tb_karyawan.stat_kar !=','T');  
        $this->db->where('tb_kontrak.status !=','N');  
        $this->db->order_by('tb_kontrak.end','ASC');
        $dataeoc = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('P');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */    
        
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('BiasHRIS | Daftar EOC Expire');

        // JUDUL FORM & No PEngajuan
        // $pdf->Cell(10,7,'',0,1);
        // $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'Daftar EOC Kurang dari 30 Hari',0,1,'C');
        // Table
        // Header Table
        $pdf->SetLeftMargin('15');
        $pdf->Cell(190,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(10,8,'No',1,0,'C',1);
        $pdf->Cell(35,8,'NIP',1,0,'C',1);
        $pdf->Cell(60,8,'Nama',1,0,'C',1);
        $pdf->Cell(35,8,'PKWT',1,0,'C',1);
        $pdf->Cell(45,8,'Tanggal EOC',1,1,'C',1);
        $no = 1;
        $pdf->SetFont('Arial','',12);
        foreach($dataeoc as $data){
            $pdf->Cell(10,7,$no++,1,0,'C');
            $pdf->Cell(35,7,$data->nip,1,0,'C');
            $pdf->Cell(60,7,$data->fullname,1,0,'C');
            $pdf->Cell(35,7,$data->periodepkwt,1,0,'C');
            $pdf->Cell(45,7,date('d-m-Y',strtotime($data->end)),1,1,'C');
        
        }


        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

    // Laporan Kontrak Karyawan
    public function laporanKontrak()
    {
        // Tarik Database
        
        $this->db->select('*');
        $this->db->from('tb_kontrak');
        $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
        $this->db->where('tb_kontrak.status','Y');                            
        $this->db->where('tb_karyawan.id_jab !=','J000');   
        $this->db->order_by('tb_karyawan.fullname',"ASC");            
        $datakon =  $this->db->get()->result();


        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('P');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('BiasHRIS | Daftar Kontrak Karyawan');

        // JUDUL FORM & No PEngajuan
        // $pdf->Cell(10,7,'',0,1);
        // $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'Daftar Kontrak Karyawan',0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(190,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(10,8,'No',1,0,'C',1);
        $pdf->Cell(25,8,'NIP',1,0,'C',1);        
        $pdf->Cell(55,8,'Nama',1,0,'C',1);
        $pdf->Cell(10,8,'Sts',1,0,'C',1);
        $pdf->Cell(15,8,'PKWT',1,0,'C',1);
        $pdf->Cell(30,8,'Awal',1,0,'C',1);
        $pdf->Cell(30,8,'Akhir',1,0,'C',1);
        $pdf->Cell(15,8,'Bulan',1,1,'C',1);
        $no = 1;
        foreach ($datakon as $data){

            $pdf->Cell(10,7,$no++,1,0,'C');
            $pdf->Cell(25,7,$data->nip,1,0,'C');
            $pdf->Cell(55,7,$data->fullname,1,0,'C');
            // $pdf->Row(55,7,$data->fullname,1,0,'C');
            $pdf->Cell(10,7,$data->stat_kar,1,0,'C');
            $pdf->Cell(15,7,$data->periodepkwt,1,0,'C');
            $pdf->Cell(30,7,date('d-m-Y',strtotime($data->start)),1,0,'C');
            if($data->end == "0000-00-00"){
                $pdf->Cell(30,7,'-',1,0,'C');
            }else{
                $pdf->Cell(30,7,date('d-m-Y',strtotime($data->end)),1,0,'C');
            }
            if($data->durasi == "Null"){
                $pdf->Cell(15,7,'',1,1,'C');
            }else{
                $pdf->Cell(15,7,$data->durasi,1,1,'C');
            }
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
            $pdf->AliasNbPages();
            $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

    // Laporan Hadir Hari ini
    public function laporanHadirSkrg()
    {
        // Tarik Database
        $today = gmdate("Y-m-d", time()+60*60*7);
        $this->db->select('*');
        $this->db->from('tb_absensi');
        $this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
        $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
        $this->db->where('tb_absensi.tgl',$today);
        $this->db->where('tb_karyawan.id_jab !=',"J000");
        $this->db->order_by('id_absen','DESC');
        $datahdr = $this->db->get()->result();


        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('P');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('BiasHRIS | Daftar Hadir ' . date('d M Y',strtotime($today)));

        // JUDUL FORM & No PEngajuan
        // $pdf->Cell(10,7,'',0,1);
        // $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'Daftar Kehadiran Hari Ini',0,1,'C');
        $pdf->Cell(190,7,'Tgl. '.date("d M Y", strtotime($today)),0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('20');
        $pdf->Cell(190,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(15,8,'No',1,0,'C',1);
        $pdf->Cell(30,8,'NIP',1,0,'C',1);        
        $pdf->Cell(55,8,'Nama',1,0,'C',1);
        $pdf->Cell(30,8,'Masuk',1,0,'C',1);
        $pdf->Cell(40,8,'Ip Address',1,1,'C',1);
        $no = 1;
        foreach ($datahdr as $data){

            $pdf->Cell(15,7,$no++,1,0,'C');
            $pdf->Cell(30,7,$data->nip,1,0,'C');
            $pdf->Cell(55,7,$data->fullname,1,0,'C');
            // $pdf->Row(55,7,$data->fullname,1,0,'C');
            $pdf->Cell(30,7,$data->jam_masuk,1,0,'C');
            $pdf->Cell(40,7,$data->ipaddress,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
            $pdf->AliasNbPages();
            $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

    // Laporan Terlambat Hari ini
    public function laporanLambatSkrg()
    {
        // Tarik Database
        $today = gmdate("Y-m-d", time()+60*60*7);
        $this->db->select('*');
        $this->db->from('tb_absensi');
        $this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
        $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
        $this->db->where('tb_absensi.tgl',$today);
        $this->db->where('tb_absensi.absen_status',"2");
        $this->db->where('tb_karyawan.id_jab !=',"J000");
        $this->db->order_by('id_absen','DESC');
        $datahdr = $this->db->get()->result();


        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('P');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('BiasHRIS | Daftar Lambat Masuk ' . date('d M Y',strtotime($today)));

        // JUDUL FORM & No PEngajuan
        // $pdf->Cell(10,7,'',0,1);
        // $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'Daftar Keterlambatan Hari Ini',0,1,'C');
        $pdf->Cell(190,7,'Tgl. '.date("d M Y", strtotime($today)),0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(190,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(10,8,'No',1,0,'C',1);
        $pdf->Cell(25,8,'NIP',1,0,'C',1);        
        $pdf->Cell(55,8,'Nama',1,0,'C',1);
        $pdf->Cell(25,8,'Masuk',1,0,'C',1);
        $pdf->Cell(35,8,'Terlambat',1,0,'C',1);
        $pdf->Cell(40,8,'Ip Address',1,1,'C',1);
        $no = 1;
        foreach ($datahdr as $data){
            $jmIn = date_create($data->jam_masuk);//jam realtime karyawan masuk
            $jmDef = date_create('8:00:00'); //defualt jam masuk
            $jmFdy = date_create('07:30:00'); //default jam masuk hari jumat
            if($data->hari =="Friday"){
                $beda = date_diff($jmIn,$jmFdy);
            }else {
                $beda = date_diff($jmIn,$jmDef);}
            // echo $beda->h,'jam, '. $beda->i.'menit';

            $pdf->Cell(10,7,$no++,1,0,'C');
            $pdf->Cell(25,7,$data->nip,1,0,'C');
            $pdf->Cell(55,7,$data->fullname,1,0,'C');
            $pdf->Cell(25,7,$data->jam_masuk,1,0,'C');
            $pdf->Cell(35,7,$beda->h.'jam, '. $beda->i.'menit',1,0,'C');
            $pdf->Cell(40,7,$data->ipaddress,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
            $pdf->AliasNbPages();
            $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

    // Laporan Terlambat Hari ini
    public function laporanBulanAktif()
    {
        // Tarik Database
        $key = gmdate("Y-m", time()+60*60*7); //like Tahun-Bulan berjalan
        $this->db->select('*');
        $this->db->from('tb_absensi');
        $this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
        $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
        $this->db->like('tb_absensi.tgl',$key);
        $this->db->order_by('tb_absensi.id_absen',"DESC");
        $dtabsen =  $this->db->get()->result();

        $bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $bln = array(
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'Mei',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Ags',
            '09' => 'Sep',
            '10' => 'Okt',
            '11' => 'Nov',
            '12' => 'Des',
        );

        $periode = $bulan[date('m')]." ".date('Y');

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('P');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('BiasHRIS | Daftar Hadir Bulan' . $periode);

        // JUDUL FORM & No PEngajuan
        // $pdf->Cell(10,7,'',0,1);
        // $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'Daftar Kehadiran Karyawan',0,1,'C');
        $pdf->Cell(190,7,'Periode Bulan '.$periode,0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(190,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(10,8,'No',1,0,'C',1);
        $pdf->Cell(25,8,'NIP',1,0,'C',1);        
        $pdf->Cell(30,8,'Nama',1,0,'C',1);
        $pdf->Cell(30,8,'Tgl',1,0,'C',1);        
        $pdf->Cell(25,8,'Masuk',1,0,'C',1);
        $pdf->Cell(25,8,'Pulang',1,0,'C',1);
        $pdf->Cell(40,8,'Status',1,1,'C',1);
        $no = 1;
        foreach ($dtabsen as $data){
            $jmIn = date_create($data->jam_masuk);//jam realtime karyawan masuk
            $jmDef = date_create('8:00:00'); //defualt jam masuk
            $jmFdy = date_create('07:30:00'); //default jam masuk hari jumat
            if($data->hari =="Friday"){
                $beda = date_diff($jmIn,$jmFdy);
            }else {
                $beda = date_diff($jmIn,$jmDef);}
            // echo $beda->h,'jam, '. $beda->i.'menit';

            $pdf->Cell(10,7,$no++,1,0,'C');
            $pdf->Cell(25,7,$data->nip,1,0,'C');
            $pdf->Cell(30,7,$data->nickname,1,0,'C');
            $pdf->Cell(30,7,date("d M Y",strtotime($data->tgl)),1,0,'C');
            $pdf->Cell(25,7,$data->jam_masuk,1,0,'C');
            $pdf->Cell(25,7,$data->jam_pulang,1,0,'C');
            if($data->absen_status == "2"){ $stt = "Terlambat";}
            $pdf->Cell(40,7,$stt,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
            $pdf->AliasNbPages();
            $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }


}