<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Panggil library phpspreadsheet
require FCPATH . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// ./ End Panggil library phpspreadsheet


class LaporanXls extends CI_Controller{

    function __construct(){
        parent::__construct();
        cek_nologin();
        cek_admin2();
        cek_admin3();
        $this->load->model('M_Hrd');
    }

#=============== HALAMAN LAPORAN ABSENSI =======================
    // getLaporan Absen Bulan Berjalan
    public function absenBulanAktif()
    {
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
        $key = gmdate("Y-m", time()+60*60*7); //like Tahun-Bulan berjalan
        // Panggil function view yang ada di M_Hrd untuk menampilkan semua data siswanya    
        $dtAbsen = $this->M_Hrd->getAbsenBulan($key);
        // Create New Spreadsheet
        $spreadsheet = new Spreadsheet();
    
        // Settingan properties document
        $spreadsheet->getProperties()->setCreator('BiasHRIS')
                ->setLastModifiedBy('BiasHRIS')                 
                ->setTitle("Absen Bulan Aktif")                 
                ->setSubject("Absen Karyawan Bulan Berjalan")                 
                ->setDescription("Laporan Absen Karyawan Bulan Berjalan")                 
                ->setKeywords("Absen Bulan Aktif");

        // Add Data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1','Laporan Absen Karyawan Bulan Berjalan');// Set kolom A1 dengan tulisan "Laporan Absen Karyawan Bulan Berjalan"    
            $spreadsheet->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai H1    
            $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1    
            $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2','Periode '.$periode);// Set kolom A1 dengan tulisan "Laporan Absen Karyawan Bulan Berjalan"    
        $spreadsheet->getActiveSheet()->mergeCells('A2:H2'); // Set Merge Cell pada kolom A1 sampai H1    
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1    
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1

        // Buat header tabel nya pada baris ke 3    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', "NO"); // Set kolom A3 dengan tulisan "NO"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B4', "NIP"); // Set kolom B3 dengan tulisan "NIP"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C4', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D4', "TANGGAL"); // Set kolom D3 dengan tulisan "STATUS"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E4', "MASUK"); // Set kolom E3 dengan tulisan "PKWT"
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F4', "PULANG"); // Set kolom E3 dengan tulisan "Awal"
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G4', "STATUS"); // Set kolom E3 dengan tulisan "Akhir"
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('H4', "LAMBAT"); // Set kolom E3 dengan tulisan "Akhir"
        
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1    
        $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4    
        foreach($dtAbsen as $data){ // Lakukan looping pada variabel siswa      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nip']);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nickname']);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$numrow, date('d M Y', strtotime($data['tgl'])));      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['jam_masuk']);           
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['jam_pulang']);    
            if($data['absen_status'] == "2") {$ket="Terlambat";}
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $ket);    
            if($data['absen_status'] == "2") {
                $jmIn = date_create($data['jam_masuk']);//jam realtime karyawan masuk
                $jmDef = date_create('8:00:00'); //defualt jam masuk
                $jmFdy = date_create('07:30:00'); //default jam masuk hari jumat
                if($data['hari']=="Friday"){
                    $beda = date_diff($jmIn,$jmFdy);
                }else {
                    $beda = date_diff($jmIn,$jmDef);
                }
            }
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $beda->h.' jam, '. $beda->i.' menit');       
            // echo $beda->h,'jam, '. $beda->i.'menit';

            $no++; // Tambah 1 setiap kali looping      
            $numrow++; // Tambah 1 setiap kali looping    
        }

        // Set width kolom    
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A    
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B    
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C    
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D    
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom G
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom H

        // Set judul file excel nya    
        $spreadsheet->getActiveSheet(0)->setTitle("Laporan Absen Bulan Berjalan");    
        $spreadsheet->setActiveSheetIndex(0);

        // Proses file excel    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
        header('Content-Disposition: attachment; filename="Laporan Absen Karyawan Bulan Berjalan.xlsx"'); // Set nama file excel nya    
        header('Cache-Control: max-age=0');

        $write =IOFactory::createWriter($spreadsheet, 'Xlsx');    
        $write->save('php://output');

        exit;
    }
# /. =============== HALAMAN LAPORAN ABSENSI =======================

# ================= HALAMAN KONTRAK KARYAWAN =======================
    // Perintah untuk export data 
    // Kontrak Karyawan ke excell
    public function excelKontrak()
    {
        // Panggil function view yang ada di M_Hrd untuk menampilkan semua data siswanya    
        $dtKontrak = $this->M_Hrd->excelKontrak();
        // Create New Spreadsheet
        $spreadsheet = new Spreadsheet();
    
        // Settingan properties document
        $spreadsheet->getProperties()->setCreator('BiasHRIS')
                ->setLastModifiedBy('BiasHRIS')                 
                ->setTitle("Data Kontrak")                 
                ->setSubject("Kontrak Karyawan")                 
                ->setDescription("Laporan Kontrak Karyawan")                 
                ->setKeywords("Kontrak Karyawan");

        // Add Data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1','Laporan Kontrak Karyawan');// Set kolom A1 dengan tulisan "Laporan Kontrak Karyawan"    
        $spreadsheet->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai H1    
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1    
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1

        // Buat header tabel nya pada baris ke 3    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B3', "NIP"); // Set kolom B3 dengan tulisan "NIP"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D3', "STATUS"); // Set kolom D3 dengan tulisan "STATUS"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E3', "PKWT"); // Set kolom E3 dengan tulisan "PKWT"
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F3', "Awal"); // Set kolom E3 dengan tulisan "Awal"
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G3', "Akhir"); // Set kolom E3 dengan tulisan "Akhir"
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('H3', "Bulan"); // Set kolom E3 dengan tulisan "Bulan"
        
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1    
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4    
        foreach($dtKontrak as $data){ // Lakukan looping pada variabel siswa      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nip);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->fullname);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->stat_kar);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->periodepkwt);           
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$numrow, date('d-M-Y', strtotime($data->start)) );           
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$numrow, date('d-M-Y', strtotime($data->end)));           
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->durasi);           
            $no++; // Tambah 1 setiap kali looping      
            $numrow++; // Tambah 1 setiap kali looping    
        }

        // Set width kolom    
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A    
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B    
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C    
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D    
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom G
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom H

        // Set judul file excel nya    
        $spreadsheet->getActiveSheet(0)->setTitle("Laporan Kontrak Karyawan");    
        $spreadsheet->setActiveSheetIndex(0);

        // Proses file excel    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
        header('Content-Disposition: attachment; filename="Laporan Kontrak Karyawan.xlsx"'); // Set nama file excel nya    
        header('Cache-Control: max-age=0');

        $write =IOFactory::createWriter($spreadsheet, 'Xlsx');    
        $write->save('php://output');

        exit;
    }

    // Kontrak EOC Karyawan ke excell 
    public function excelKontrakEoc()
    {
        // Panggil function view yang ada di M_Hrd untuk menampilkan semua data siswanya    
        $dtKontrakEOC = $this->M_Hrd->excelKontrakEOC();
        // Create New Spreadsheet
        $spreadsheet = new Spreadsheet();
    
        // Settingan properties document
        $spreadsheet->getProperties()->setCreator('BiasHRIS')
                ->setLastModifiedBy('BiasHRIS')                 
                ->setTitle("Data Kontrak")                 
                ->setSubject("Kontrak Karyawan")                 
                ->setDescription("Laporan Kontrak Karyawan Kurang 60 Hari")                 
                ->setKeywords("Kontrak Karyawan");

        // Add Data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1','Laporan Kontrak Karyawan Kurang 60 Hari');// Set kolom A1 dengan tulisan "Laporan Kontrak Karyawan"    
        $spreadsheet->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai H1    
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1    
        $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1

        // Buat header tabel nya pada baris ke 3    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('B3', "NIP"); // Set kolom B3 dengan tulisan "NIP"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D3', "STATUS"); // Set kolom D3 dengan tulisan "STATUS"    
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E3', "PKWT"); // Set kolom E3 dengan tulisan "PKWT"
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F3', "Awal"); // Set kolom E3 dengan tulisan "Awal"
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G3', "Akhir"); // Set kolom E3 dengan tulisan "Akhir"
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('H3', "Bulan"); // Set kolom E3 dengan tulisan "Bulan"
        
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1    
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4    
        foreach($dtKontrakEOC as $data){ // Lakukan looping pada variabel siswa      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nip);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->fullname);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->stat_kar);      
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->periodepkwt);           
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$numrow, date('d-M-Y', strtotime($data->start)) );           
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$numrow, date('d-M-Y', strtotime($data->end)));           
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->durasi);           
            $no++; // Tambah 1 setiap kali looping      
            $numrow++; // Tambah 1 setiap kali looping    
        }

        // Set width kolom    
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A    
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B    
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C    
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D    
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom G
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom H

        // Set judul file excel nya    
        $spreadsheet->getActiveSheet(0)->setTitle("Laporan Kontrak Kurang 60 Hari");    
        $spreadsheet->setActiveSheetIndex(0);

        // Proses file excel    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
        header('Content-Disposition: attachment; filename="Laporan Kontrak Karyawan.xlsx"'); // Set nama file excel nya    
        header('Cache-Control: max-age=0');

        $write =IOFactory::createWriter($spreadsheet, 'Xlsx');    
        $write->save('php://output');

        exit;
    }
# /. ================= HALAMAN KONTRAK KARYAWAN =======================


#  ================= HALAMAN ABSENSI KARYAWAN =======================
    public function absenRange()
    {
        $id=decrypt_url($this->uri->segment(3));
        $name="Atas nama : ".decrypt_url($this->uri->segment(4));
        $awal=decrypt_url($this->uri->segment(5));
        $akhir=decrypt_url($this->uri->segment(6));
        $periode = "Periode : ".date('d M Y',strtotime($awal))." - ".date('d M Y',strtotime($akhir));

        echo $id, '/', $name, '/' , $awal, '/' , $akhir;

        #Get Data from Database
        // $dtAbsen = $this->M_Hrd->excelAbsenKar($id,$awal,$akhir);

        // #Create new doc spreadsheet
        // $spreadsheet = new Spreadsheet();

        // #Setup Document Properties 
        // $spreadsheet->getProperties()->setCreator('BiasHRIS')
        //         ->setLastModifiedBy('BiasHRIS')                 
        //         ->setTitle("Laporan Absen ")                 
        //         ->setSubject("Laporan Absensi Karyawan")                 
        //         ->setDescription("Laporan Absensi Karyawan ".$name)                 
        //         ->setKeywords("Absensi Karyawan");

        // #Write Data on worksheet
        // $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue('A1','Laporan Absensi Karyawan'); // Title header
        // $spreadsheet->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1    
        // $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1    
        // $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1

        // $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue('A2',$name); // Title header
        // $spreadsheet->getActiveSheet()->mergeCells('A2:C2'); // Set Merge Cell pada kolom A2 sampai C2   
        // $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A2    
        // $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A2

        // $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue('E2',$periode); // Title header
        // $spreadsheet->getActiveSheet()->mergeCells('D2:F2'); // Set Merge Cell pada kolom D2 sampai F2   
        // $spreadsheet->getActiveSheet()->getStyle('D2')->getFont()->setBold(TRUE); // Set bold kolom D2    
        // $spreadsheet->getActiveSheet()->getStyle('D2')->getFont()->setSize(12); // Set font size 15 untuk kolom D2

        // #Table Header
        // $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', "NO"); // Set kolom A4 dengan tulisan "NO"    
        // $spreadsheet->setActiveSheetIndex(0)->setCellValue('B4', "HARI"); // Set kolom B4 dengan tulisan "NIP"    
        // $spreadsheet->setActiveSheetIndex(0)->setCellValue('C4', "TANGGAL"); // Set kolom C4 dengan tulisan "NAMA"   
        // $spreadsheet->setActiveSheetIndex(0)->setCellValue('D4', "MASUK"); // Set kolom D4 dengan tulisan "PKWT"
        // $spreadsheet->setActiveSheetIndex(0)->setCellValue('E4', "PULANG"); // Set kolom E4 dengan tulisan "Awal"
        // $spreadsheet->setActiveSheetIndex(0)->setCellValue('F4', "STATUS"); // Set kolom F4 dengan tulisan "Akhir"

        // $no = 1; // mulai penomoran table
        // $numrow = 5; // tulis mulai cell ke 5 / row ke 5
        // foreach($dtAbsen as $data){
        //     $spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);      
        //     $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['hari']);      
        //     $spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$numrow, date('d M Y', strtotime($data['tgl'])));      
        //     $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['jam_masuk']);           
        //     $spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['jam_pulang']); 
        //     if($data['absen_status'] == "2") {$ket="Terlambat";}
        //     $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $ket); 
        // }

        // #Looping
        // $no++; // Tambah 1 setiap kali looping      
        // $numrow++; // Tambah 1 setiap kali looping  
    }

#  /. ================= HALAMAN ABSENSI KARYAWAN =======================
}