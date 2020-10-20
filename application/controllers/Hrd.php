<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Panggil library phpspreadsheet
// require APPPATH .'third_party/vendor/autoload.php';
// include_once APPPATH . 'phpoffice\vendor\autoload.php';
require FCPATH . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// ./ End Panggil library phpspreadsheet

class Hrd extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      cek_nologin();
      // cek_admin();
      cek_admin2();
      cek_admin3();
      $this->load->model('M_Hrd');
      // $this->output->enable_profiler(TRUE);
      
   }

   
   public function index()
   {  
      $data ['judul'] = "BiasHRIS | Dashboard HRD";
      $data ['chart1'] = $this->M_Hrd->getChart1();
      $this->template->load('template','hrd/dashboard',$data); //dashboard khusus HRD  
   }

// LINE Modul USER
// ============================
// Tampil user
   public function user()
   {
      $data ['judul'] = "BiasHRIS | Daftar User";
      $data ['rowuser'] = $this->M_Hrd->getuser();
      $data ['rowakses'] = $this->M_Hrd->getEmailUser();
      $this->template->load('template','hrd/user', $data);
   } 

//    tambah User
   public function tambahuser()
   {
      $email = $_POST['InputEmail'];
      $pwd = $_POST['Password1'];
      $lvl = $_POST['level'];

      $data = array (
      'email' => $email,
      'password' => md5($pwd),
      'id_lvl' => $lvl
      );
      $cek = $this->db->query("SELECT * FROM tb_userakses WHERE email='$email'");
      if($cek->num_rows() != 0){
         $this->session->set_flashdata('flash_error','Ditambahkan');
         redirect('Hrd/user');
      }else{
         $query = $this->M_Hrd->tambahuser('tb_userakses',$data); 
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect ('Hrd/user');
      }      
   }

//  Update user
   public function updateuser()
   {
      $uid = $_POST['idakses1'];
      $uemail = $_POST['Email2'];
      $ulvl = $_POST['Level'];

      $data=array(
         'email' => $uemail,
         'id_lvl' => $ulvl
      );
      $where=array(
         'id_uakses' => $uid
      );

      $this->M_Hrd->userupdate($where, $data,'tb_userakses');
      $this->session->set_flashdata('flash','Diubah');
      redirect ('Hrd/user');
   }
// Ganti Password user
   public function gantipass()
   {
      $uid = $_POST['idakses2'];
      $pass2 = $_POST['Password2'];

      $data=array(
         'password' => md5($pass2)
         
      );
      $where=array(
         'id_uakses' => $uid
      );

      $this->M_Hrd->updatepass($where, $data,'tb_userakses');
      $this->session->set_flashdata('flash','Diubah');
      redirect ('Hrd/user');

   }

//  Hapus User
   public function hapususer($id)
   {
      $id = decrypt_url($id);
      $where = array('id_uakses' => $id);
      $this->M_Hrd->deluser($where,'tb_userakses');
      $this->session->set_flashdata('flash','Dihapus');
      redirect ('Hrd/user');
      // redirect('hrd/user');
      // if ($this->db->affected_rows()){
      // echo "<script>. swal('Good job!', 'You clicked the button!', 'success'); </script>";
      // redirect ('Hrd/user');
      // } else{
      //    echo swal ( "Oops" ,  "Something went wrong!" ,  "error" );
      //    redirect ('Hrd/user');
      // }
   }
// ================= Halaman Karyawan ==================
   //Load Halaman Karyawan
   public function karyawan()
   {     
      $data = array(
         'judul' => 'BiasHRIS | Karyawan',
         'rowkar' => $this->M_Hrd->getKar(), //get data table Karyawan
         'rowkareoc' => $this->M_Hrd->getKarEoc(), //get data table Karyawan EOC
         'rowjab' => $this->M_Hrd->getJab(), //get data table Jabatan
         'rowsbu' => $this->M_Hrd->getSbu(), //get data table SBU
         'rownip' => $this->M_Hrd->getNip(),
         'rowgrup'=> $this->M_Hrd->getGrup(), // get data Grup SBU
         'rowedu'=> $this->M_Hrd->getedu() // get data Edukasi tb_edukasi
         // 'rowagm' => $this->M_Hrd->getAgm()
         
      );
      $this->template->load('template','hrd/karyawan',$data);
   } 

   // tambah Data Karyawan pada Halaman Karyawan
   public function addKar()
   {
      $fullname = $this->input->post('fullname');
      $nickname = $this->input->post('nickname');
      $emailku = $this->input->post('emailku');
      $telpon = $this->input->post('telpon');
      $genre = $this->input->post('genre');
      $status = $this->input->post('status');
      $keluarga = $this->input->post('keluarga');
      $pendidikan = $this->input->post('pendidikan');
      $agama = $this->input->post('agama');
      $tempat = $this->input->post('tempat');
      $tgllahir = $this->input->post('tgllahir');
      $tgllhr = date('Y-m-d', strtotime($tgllahir));
      $negara = $this->input->post('negara');
      $alamat = $this->input->post('alamat');
      $lejab = $this->input->post('level');
      $dejab = $this->input->post('dejab');
      $grup = $this->input->post('grup');
      $sbu = $this->input->post('sbu');
      $subunit = $this->input->post('subunit');
      $statkar = $this->input->post('statkar');
      $dept = $this->input->post('departemen',TRUE);

      // Field tb_kontrak
      $nip = $this->input->post('nip');
      $durasi = $this->input->post('selisih');
      $tgl1 = $this->input->post('tglmulai');
      $tglmulai = date('Y-m-d',strtotime($tgl1));
      $tgl2 = $this->input->post('tglakhir');
      $tglakhir = date('Y-m-d',strtotime($tgl2));
      $urutan = $this->input->post('urutan');


      $config['upload_path']     = './uploads/image/'; //path folder
      $config['allowed_types']   = 'jpeg|jpg|png'; //type yang dapat diakses bisa anda sesuaikan
      $config['file_name']       = $nickname.'_'.$nip;
      $config['max_size']        = 1024; // 1Mb
      $config['overwrite']        = TRUE;

      $this->load->library('upload');
		$this->upload->initialize($config);
      if(!empty($_FILES['filefoto']['name']))
      { 
         if ($this->upload->do_upload('filefoto'))
         {
            $gbr = $this->upload->data();
            $gambar=$gbr['file_name']; //Mengambil file name dari gambar yang diupload

            // Data untuk table Karyawan (tb_karyawan)
            $data = array (
               'fullname' => $fullname,
               'nickname' => $nickname,
               'email'    => $emailku,
               'genre'    => $genre,
               'alamat'   => $alamat,
               'telp'     => $telpon,
               'martial'  => $status,
               'stat_kel' => $keluarga,
               'tempat'   => $tempat,
               'tgllahir' => $tgllhr,
               'pendidikan'=> $pendidikan,
               'agama'    => $agama,
               'negara'   => $negara,
               'stat_kar' => "K",
               'join_date'=> $tglmulai,
               'id_jab'   => $lejab,
               'def_jab'  => $dejab,
               'id_grup'  => $grup,
               'kode'     => $sbu,
               'sub_unt'  => $subunit,
               'id_dept'  => $dept,
               'foto'     => $gambar,
            );
            //data2 disimpan untuk tabel kontrak
            $data2 = array(
               'periodepkwt' => "I",
               'durasi'      => $durasi,
               'nip'         => $nip,
               'kontrak'     => "N",
               'start'       => $tglmulai,
               'end'         => $tglakhir,
               'urutan'      => $urutan,
               'status'      => "Y",
               'email'       => $emailku
            );
            //data3 disimpan untuk tabel history kontrak
            $data3 = array(
               'nip'       => $nip,
               'tipe'      => "N",
               'pkwt'      => 'I',
               'awal'      => $tglmulai,
               'akhir'     => $tglakhir,
               'durasi'    => $durasi
            );
            // data4 disimpan untuk tabel history jabatan
            $data4 = array(
               'nip'       => $nip,
               'jab'       => $lejab,
               'def_jab'   => $dejab,
               'sbu'       => $sbu,
               'sub'       => $subunit,
               'id_dept'   => $dept,
               'tgl'       => $tglmulai
            );

            // Data 5 untuk simpan jatah cuti
            $data5 = array(
               'nip'       => $nip,
               'ttl_cuti'  => "12",
               'c_pribadi' => "",
               'c_bersama' => "",
               'sisa_cuti' => "12",
               'per_awal'  => "",
               'per_akhir' => "",
               'cuti_thn'  => "",
               'c_status'    => "",

            );
            $this->M_Hrd->addKontrak('tb_kontrak',$data2); // MEnyimpan data  kontrak
            $this->M_Hrd->addHisKontrak('tb_hist_kontrak',$data3); // MEnyimpan data history kontrak
            $this->M_Hrd->addHisKepeg('tb_hist_kepegawaian',$data4); // Tambah data history kepegawaian (Jabatan, detail jabatan, SBU dan SUb Unit )
            $this->M_Hrd->addKar('tb_karyawan',$data); // MEnyimpan data karyawan
            $this->M_Hrd->addCuti('tb_cuti_jatah',$data5); //Otomatis menambahkan Jatah Cuti ke table jatah cuti
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect ('Hrd/karyawan');
         }else{
            $error =  $this->upload->display_errors();
            echo print_r($error);
         }
      }else {
         echo "<script>
            alert ('Tidak ada file di upload');
            window.location='".site_url('Hrd/karyawan')."';
            </script>";
      }
   }

   // Cek Email Duplikat
   public function cekDbEmail()
   {
      $email = $this->input->post('email');
      if($email != '' ){
         $cek = $this->db->query("SELECT * FROM tb_karyawan WHERE email='$email'");
         if($cek->num_rows() > 0){
            echo "<span class='text-danger'>  Email sudah dipakai ! <i class='icon fa fa-ban pull-left' style='margin-top:3px'></i></span>";
         }else{
            echo "<span class='text-success'> Email tersedia! <i class='icon fa fa-check pull-left' style='margin-top:3px'></i></span>";
         }
      }else{
         echo "<span class='text-danger'> Email tidak boleh kosong! <i class='icon fa fa-ban pull-left' style='margin-top:3px'></i></span>";
      }
   }

   // Cek Nickname Duplikasi
   public function cekNickName()
   {
      $nickname = $this->input->post('nickname');
      $cek = $this->db->query("SELECT * FROM tb_karyawan WHERE nickname='$nickname'");
         if($cek->num_rows() > 0){
            echo "<span class='text-danger'>  Nickname sudah dipakai ! <i class='icon fa fa-ban pull-left' style='margin-top:3px'></i></span>";
         }else{
            echo "<span class='text-success'> Nickname tersedia! <i class='icon fa fa-check pull-left' style='margin-top:3px'></i></span>";
         }
   }
   
// ====================== ./ Halaman Karyawan =============

// ===================== Halaman Info/Detail Karyawan ==============

   // Load Halaman Detail Karyawan / Info Karyawan
   public function infoKar($id)
   {
      $id = decrypt_url($id); 
      $data = array(
         'judul' => 'BiasHRIS | Detail Karyawan',
         'rowkar' => $this->M_Hrd->getInfoKar($id), //get data table Karyawan
         'rowkon' => $this->M_Hrd->getKon($id), //get data table kotrak
         'rowhiskon' => $this->M_Hrd->getHistKon($id), //Get Data History Kontrak tabel tb_hist_kontrak
         'rowhispeg' => $this->M_Hrd->getHistPeg($id), //Get Data History Kepegawaian (Jabatan, sbu, dll) tabel tb_hist_kepegawaian
         'rowdok' => $this->M_Aproject->getDocKar($id), //get data DOkumen Karyawan darii table dockar
         'rowjab' => $this->M_Hrd->getJab(), //get data table Jabatan 
         'rowsbu' => $this->M_Hrd->getSbu(), //get data table SBU
         'rowgrup'=> $this->M_Hrd->getGrup(), // get data Grup SBU
         'rowedu'=> $this->M_Hrd->getedu() // get data Edukasi tb_edukasi
      );
      $this->template->load('template','hrd/infokar',$data);
   }

   // edit data karyawan pada halaman Info Karyawan - modal editKar
   public function updateKar($id)
   {
      $id = decrypt_url($id);

      $fullname = $this->input->post('fullname');
      $nickname = $this->input->post('nickname'); //hidden
      $idpri = $this->input->post('idpri'); //hidden
      $alamat = $this->input->post('alamat');
      $telp = $this->input->post('telp');
      $agama = $this->input->post('agama');
      $tempat = $this->input->post('tempat');
      $tgllahir = $this->input->post('tgllahir');
      $tgllhr = date('Y-m-d', strtotime($tgllahir));
      $genre = $this->input->post('genre');
      $status = $this->input->post('status');
      $keluarga = $this->input->post('keluarga');
      $pendidikan = $this->input->post('pendidikan');
      $negara = $this->input->post('negara');

      $config['upload_path']     = './uploads/image/'; //path folder
      $config['allowed_types']   = 'jpeg|jpg|png'; //type yang dapat diakses bisa anda sesuaikan
      $config['file_name']       = $nickname.'_'.$idpri;
      $config['max_size']        = 1024;
      $config['overwrite']       = TRUE;

      $this->load->library('upload');
      $this->upload->initialize($config);
      // jika foto tidak kosong (ada perubahan foto)
      if(!empty($_FILES['filefoto']['name'])){
         if($this->upload->do_upload('filefoto')){
            $gbr = $this->upload->data();
            $gambar = $gbr['file_name'];
            $data = array(
               'fullname' => $fullname,
               'genre'    => $genre,
               'alamat'   => $alamat,
               'telp'     => $telp,
               'martial'  => $status,
               'stat_kel' => $keluarga,
               'tempat'   => $tempat,
               'tgllahir' => $tgllhr,
               'pendidikan'=> $pendidikan,
               'agama'    => $agama,
               'negara'   => $negara,
               'foto'     => $gambar,
            );
            $this->M_Hrd->updateKar($id,$data,'tb_karyawan');
            $this->session->set_flashdata('flash','Diubah');
            redirect('Hrd/infoKar/'.encrypt_url($id));
         }else{
            $error =  $this->upload->display_errors();
            echo print_r($error);
         }
      }else{ 
         // jika foto kosong (tidak ada perubahan foto)
         $data = array(
            'fullname' => $fullname,
            'genre'    => $genre,
            'alamat'   => $alamat,
            'telp'     => $telp,
            'martial'  => $status,
            'stat_kel' => $keluarga,
            'tempat'   => $tempat,
            'tgllahir' => $tgllhr,
            'pendidikan'=> $pendidikan,
            'agama'    => $agama,
            'negara'   => $negara,
         );
         $this->M_Hrd->updateKar($id,$data,'tb_karyawan');
         $this->session->set_flashdata('flash','Diubah');
         redirect('Hrd/infoKar/'.encrypt_url($id));
      }
   }

   // edit data Karyawan (TAB Kepegawaian) pada halaman Info Karyawan - modal editPeg
   public function updatePeg($id)
   {
      $id = decrypt_url($id);
      $today = gmdate("Y-m-d", time()+60*60*7);
      $nip = $this->input->post('nip');
      $level = $this->input->post('level');
      $dejab = $this->input->post('dejab');
      $grup = $this->input->post('grup');
      $sbu = $this->input->post('sbu');
      $subunit = $this->input->post('subUnit');
      $departemen = $this->input->post('departemen');

      $data = array(
         'id_jab' => $level,
         'def_jab' => $dejab,
         'id_grup' => $grup,
         'kode' => $sbu,
         'sub_unt' => $subunit,
         'id_dept' => $departemen
      );

      $data2 = array(
         'nip' => $nip,
         'jab' => $level,
         'def_jab' => $dejab,
         'sbu' => $sbu,
         'sub' => $subunit,
         'id_dept' => $departemen,
         'tgl' => $today
      );

      // echo $departemen, $subunit;

      $this->M_Hrd->updatePeg($id,$data,'tb_karyawan');
      $this->M_Hrd->addHistPeg('tb_hist_kepegawaian',$data2); // Tambah data history kepegawaian (Jabatan, detail jabatan, SBU dan SUb Unit )
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/infoKar/'.encrypt_url($id));

   }

   // edit data Kontrak (TAB Kotrak Kerja) pada halaman Info Karyawan - modal editKon
   // Versi 1 proses dari halaman INfo Karyawan
   public function updateKon($email)
   {
      $email = decrypt_url($email);
      $id = $this->input->post('idpri');
      $pkwt = $this->input->post('pkwt');
      $nip = $this->input->post('nip');
      $statpkwt = $this->input->post('statpkwt');
      $selisih = $this->input->post('selisih');
      $tgl1 = $this->input->post('tglmulai');
      $tglmulai = date('Y-m-d',strtotime($tgl1));
      $tgl2 = $this->input->post('tglakhir');
      $tglakhir = date('Y-m-d',strtotime($tgl2));

      $data = array (
         'periodepkwt' => $pkwt,
         'durasi' => $selisih,
         'kontrak' => $statpkwt,
         'start' => $tglmulai,
         'end' => $tglakhir,
      );

      $data2 = array (
         'nip' => $nip,
         'tipe' => "R",
         'pkwt' => "II",
         'awal' => $tglmulai,
         'akhir' => $tglakhir,
         'durasi' => $selisih
      );

      $this->M_Hrd->updateKon($email,$data,'tb_kontrak');
      $this->M_Hrd->addHisKontrak('tb_hist_kontrak',$data2);; // menyimpan history perubahan kontrak
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/infoKar/'.encrypt_url($id));

   }

   // Tambah data Dokumen pribadi (Halaman Info Karyawan)
   public function addPegDoc()
   {
      $id = $this->input->post('idkar') ;
      $no = $this->input->post('nodoc') ;
      $nama = $this->input->post('namadoc') ;
      $tipe = $this->input->post('jenisdoc');
      $lampiran = $this->input->post('lampiran');
      $tgl = gmdate("Y-m-d", time()+60*60*7);
      // $up_tgl = date('Y-m-d',strtotime($tgl));

      $config ['upload_path']    = './uploads/documents/';
      $config['allowed_types']   = 'pdf'; // hanya file PDF
      // $config['allowed_types']   = 'pdf|jpg|jpeg|png';
      $config['max_size']        = 2048; //allowed size 2Mb
      $config['file_name']       = $tipe.$id;
      $config['overwrite']       = TRUE;

      $this->load->library('upload');
		$this->upload->initialize($config);
      if(!empty($_FILES['filedoc']['name'])){
         if ($this->upload->do_upload('filedoc'))
         {
            $gbr = $this->upload->data();
            $gambar=$gbr['file_name']; //Mengambil file name dari gambar yang diupload
            $data = array (
               'nodoc' => $no,
               'typedoc' => $tipe,
               'namadoc' => $gambar,
               'halaman' => $lampiran,
               'tgl_upload' => $tgl,
               'id_kar' => $id
            );
            $this->M_Hrd->addPegDoc('tb_dockar',$data);
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('Hrd/infoKar/'.encrypt_url($id));
         } else {
            $error =  $this->upload->display_errors();
            echo print_r($error);
         }
      }else{
         echo "<script>
         alert ('Tidak ada file di upload');
         window.location='".site_url('Hrd/infoKar/').encrypt_url($id);"';
         </script>";
      }
      
      
   }
   
   // Hapus Dokumen Kepegawaian
   public function delPegDoc()
   {
      $id=decrypt_url($this->uri->segment(3));

      $this->M_Hrd->delPegDoc($id,'tb_dockar');
      if($this->db->affected_rows()){
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/infoKar/'.encrypt_url($id));
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/infoKar/'.encrypt_url($id));
      }
   }
   

   // Update Tanggal Bergabung Karyawan (dari table karyawan)
   public function updateJoinDate()
   {
      $id   = $this->input->post('idKar',TRUE);
      $tgl   = $this->input->post('tglJoin',TRUE);
      $tglpost = date('Y-m-d',strtotime($tgl));

      $data = array ( 'join_date' => $tglpost);

      $this->M_Hrd->updateJoinDate('tb_karyawan',$data,$id);; // menyimpan history perubahan kontrak
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/infoKar/'.encrypt_url($id));
   }
// ===================== ./ Halaman Info/Detail Karyawan ==============

// ===================== Halaman Perusahaan / SBU ==============
   // Load Halaman Perusahaan / SBU
   public function sbu()
   {
      $data = array (
         'judul' => 'BiasHRIS | SBU',
         'rowgrup' => $this->M_Hrd->getGrup(),
         'grupAkt' => $this->M_Hrd->getGrupAktif(),
         'rowsbu' => $this->M_Hrd->getSbu(),
         'rowsub' => $this->M_Hrd->getSub(),
         'idgrup' => $this->M_Hrd->genIdGrup(), // generate kode Sub Unit
         'kodesub' => $this->M_Hrd->genKodeSub(), // generate kode Sub Unit
      );
      $this->template->load('template','hrd/sbu',$data);
   }

   // Tambah Data Grup
   public function addGrup()
   {
      $idgrup     = $this->input->post('idgrup',TRUE);
      $kodegrup   = $this->input->post('kodegrup',TRUE);
      $namagrup   = $this->input->post('namagrup',TRUE);
      $status     = $this->input->post('status',TRUE);

      $data = array(
         'id_grup'   => $idgrup,
         'kode_grup' => $kodegrup,
         'nama_grup' => $namagrup,
         'status_grup'    => $status
      );

      $cek = $this->db->query("SELECT * FROM tb_sbu_grup WHERE kode_grup='$kodegrup'");
      if($cek->num_rows() != 0){
         $this->session->set_flashdata('flash_error','Ditambahkan');
         redirect('Hrd/sbu');
      }else{
         $query = $this->M_Hrd->addGrup('tb_sbu_grup',$data);
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect('Hrd/sbu');
      }
   }

   // Hapus Data Grup
   public function delGrup()
   {
      $id = decrypt_url($this->uri->segment(3));

      $this->M_Hrd->delGrup($id,'tb_sbu_grup');
      if($this->db->affected_rows()){
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/sbu');
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/sbu');
      }
      // echo $id;
   }

   // Update Data Grup
   public function updateGrup()
   {
      $id      = $this->input->post('id_grup',TRUE);
      $kode    = $this->input->post('kode_grup',TRUE);
      $nama    = $this->input->post('nama_grup',TRUE);

      $data    = array (
         'kode_grup' => $kode,
         'nama_grup' => $nama
      );

      $where = array ('id_grup' => $id);

      $query = $this->M_Hrd->updateGrup('tb_sbu_grup',$data,$where);
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/sbu');
   }

   // Update Status Grup
   public function updateStatus()
   {
      $id      = decrypt_url($this->uri->segment(3));
      $status  = decrypt_url($this->uri->segment(4));

      $data = array ('status_grup' => $status);

      $where = array ('id_grup' => $id);

      $query = $this->M_Hrd->updateStatusGrup('tb_sbu_grup',$data,$where);
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/sbu');
   }

   // Tambah Data SBU
   public function addSbu()
   {      
      $sbu     = $this->input->post('kode_sbu');
      $nama    = $this->input->post('nama_sbu');
      $grup    = $this->input->post('grup_sbu');

      $data=array(
         'kode'   => $sbu,
         'nama'   => $nama,
         'grup'   => $grup
      );

      $cek = $this->db->query("SELECT * FROM tb_sbu WHERE kode='$sbu'");
      if($cek->num_rows() != 0){
         $this->session->set_flashdata('flash_error','Ditambahkan');
         redirect('Hrd/sbu');
      }else {
         $query = $this->M_Hrd->addSbu('tb_sbu',$data);
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect('Hrd/sbu');
      }
   }

   // Edit Data SBU 
   public function updateSbu()
   {
      $sbu = $this->input->post('kodesbu',TRUE);
      $nama = $this->input->post('namasbu',TRUE);
      $grup = $this->input->post('grupsbu',TRUE);

      $data = array (
         'nama'   => $nama,
         'grup'   => $grup
      );

      $query = $this->M_Hrd->updateSbu('tb_sbu',$data,$sbu);
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/sbu');
   }

   //Delete SBU
   public function delSbu($id)
   {
      $this->M_Hrd->delSbu($id,'tb_sbu');
      if($this->db->affected_rows()){
         $this->M_Hrd->delUnit($id,'tb_subunit');
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/sbu');
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/sbu');
      }
   }  

   // Tambah Data SUb Unit
   public function addSub()
   {
      $idsub = $this->input->post('idsub',TRUE);
      $kode = $this->input->post('subkode');
      $nama = $this->input->post('namasub');
      $sbu = $this->input->post('sbu');

      $data = array (
         'id_sub' => $idsub,
         'sub'    => $kode,
         'namasub'=> $nama,
         'kode'   => $sbu
      );

      $cek = $this->db->query("SELECT * FROM tb_subunit WHERE sub='$kode'");
      if($cek->num_rows() != 0){
         $this->session->set_flashdata('flash_error','Ditambahkan');
         redirect('Hrd/sbu');
      }else {
         $query = $this->M_Hrd->addSub('tb_subunit',$data);
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect('Hrd/sbu');
      }
   }

   // Ubah Data Sub Unit
   public function updateSub()
   {
      $id = $this->input->post('idsub');
      $kode = $this->input->post('subkode');
      $nama = $this->input->post('namasub');
      $sbu = $this->input->post('sbu');

      $data = array (
         'sub' => $kode,
         'namasub' => $nama,
         'kode' => $sbu
      );

         $query = $this->M_Hrd->updateSub('tb_subunit',$data,$id);
         $this->session->set_flashdata('flash','Diubah');
         redirect('Hrd/sbu');
   
   }

   //Delete sub Unit
   public function delSub($id)
   {
      $this->M_Hrd->delSub($id,'tb_subunit');
      if($this->db->affected_rows()){
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/sbu');
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/sbu');
      }
   }  

// ======================  ./ Halaman Perusahaan / SBU ================

// ====================== Halaman Jabatan ================

   // Get Data untuk Page Jabatan
   public function jabatan()
   {
      $data = array (
         'judul' => 'BiasHRIS | Daftar Jabatan',
         'rowjab' => $this->M_Hrd->getJab(), //get data table jabatan
         'kodejab' => $this->M_Hrd->getKodeJab(), //generate otomatis Kode Jabatan
         'rowjail' => $this->M_Hrd->getJail(), //get data table detail jabatan
         'kodejail' => $this->M_Hrd->getKodeJail(), // generate kode detail jabatan
         'rowsbu' => $this->M_Hrd->getSbu() //get data table SBU
         
      );
      $this->template->load('template','hrd/jabatan',$data);
   }

   // Tambah data Detail Jabatan Karyawan
   public function addJail()
   {
      $kode = $this->input->post('kodejail');
      $nama = $this->input->post('namajail');
      $jabatan = $this->input->post('jabatan');
      // $sbu = $this->input->post('sbu');

      $data = array (
         'kode_jail' => $kode,
         'nama_jail' => $nama,
         'id_jab' => $jabatan,
         // 'sbu' => $sbu
      );

      $query = $this->M_Hrd->addJail('tb_jabatan_detail',$data);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect('Hrd/jabatan');
   }

   // Edit data Detail Jabatan Karyawan
   public function updateJail()
   {
      $id = $this->input->post('idjail');
      $kode = $this->input->post('kodejail');
      $nama = $this->input->post('namajail');
      $jabatan = $this->input->post('jabatan');
      // $sbu = $this->input->post('sbu');

      $data = array (
         'kode_jail' => $kode,
         'nama_jail' => $nama,
         'id_jab' => $jabatan,
         // 'sbu' => $sbu
      );

      $query = $this->M_Hrd->updateJail('tb_jabatan_detail',$data,$id);
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/jabatan');
   }

   //Delete Data Table Detail Jabatan Karyawan
   public function delJail($id)
   {
      $data = array('aktif' => "N");
      $this->M_Hrd->delJail('tb_jabatan_detail',$data,$id);
      if($this->db->affected_rows()){
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/jabatan');
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/jabatan');
      }
   }  

   // Tambah Data Table Jabatan
   public function addJab()
   {
      $id = $this->input->post('kodejab');
      $nama = $this->input->post('namajab');

      $data = array (
         'id_jab' => $id,
         'nama_jab' => $nama
      );

      $query = $this->M_Hrd->addJab('tb_jabatan',$data);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect('Hrd/jabatan');
   }

   // Edit / Update Data Table Jabatan
   public function updateJab()
   {
      $id = $this->input->post('kodejab');
      $nama = $this->input->post('namajab');

      $data = array (
         'id_jab' => $id,
         'nama_jab' => $nama
      );

      $query = $this->M_Hrd->updateJab('tb_jabatan',$data,$id);
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/jabatan');
   }

   //Delete Data Table Jabatan
   public function delJab($id)
   {
      $this->M_Hrd->delJab($id,'tb_jabatan');
      if($this->db->affected_rows()){
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/jabatan');
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/jabatan');
      }
   }  
// ====================== ./ Halaman Jabatan ================

// ===================== Halaman Departemen =======================
   // Load data untuk halaman Departemen
   public function departemen()
   {
      $data = array(
         'judul'  => 'BiasHRIS | Daftar Departemen',
         'rowsub' => $this->M_Hrd->getSub_Unit(),
         'rowdept'=> $this->M_Hrd->getDept(),
         'idDept' => $this->M_Hrd->genIdDept(),

      );
      $this->template->load('template','hrd/departemen',$data);
   }

   // Get Data Departemen link dari Sub Unit
   public function getDept()
   {
      $id = $this->input->post('id'); //id yang dilempar oleh json
      $data = $this->M_Hrd->getLinkDept($id);
      echo json_encode($data);
   }

   // MEnambahkan Departemen Baru 
   public function addDept()
   {
      $iddept     = $this->input->post('iddept',TRUE);
      $kodedept   = $this->input->post('kodedept',TRUE);
      $namadept   = $this->input->post('namadept',TRUE);
      $subunit    = $this->input->post('subunit',TRUE);

      $data = array (
         'id_dept'   => $iddept,
         'kode_dept' => $kodedept,
         'nama_dept' => $namadept,
         'id_sub'    => $subunit,
      );

      $cek = $this->db->query("SELECT * FROM tb_departemen WHERE kode_dept='$kodedept'");
      if($cek->num_rows() != 0){
         $this->session->set_flashdata('flash_error','Ditambahkan');
         redirect('Hrd/departemen');
      }else{
         $query = $this->M_Hrd->addDept('tb_departemen',$data); 
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect ('Hrd/departemen');
      }         
   }

   // Proses Update data Departemen
   public function updateDept()
   {
      $iddept     = $this->input->post('iddept',TRUE);
      $kodedept   = $this->input->post('kodedept',TRUE);
      $namadept   = $this->input->post('namadept',TRUE);
      $subunit    = $this->input->post('subunit',TRUE);

      $data = array(
         'kode_dept' => $kodedept,
         'nama_dept' => $namadept,
         'id_sub'    => $subunit,
      );

      $query = $this->M_Hrd->updateDept('tb_departemen',$data,$iddept);
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/departemen');
   }

   //Proses Delete Data Table Departemen
   public function delDept()
   {
      $id = decrypt_url($this->uri->segment(3));
      // echo $id;
      $this->M_Hrd->delDept($id,'tb_departemen');
      if($this->db->affected_rows()){
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/departemen');
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/departemen');
      }
   }  

// ===================== /. Halaman Departemen =======================

// ====================== Halaman Kontrak Karyawan ================
   // Get Data Table Kontrak -> page KONTRAK
   public function kontrak()
   {
      $data = array (
         'judul' => 'BiasHRIS | Kontrak Karyawan',
         'rownip' => $this->M_Hrd->getNip(), //get data to generate NIP        
         'rowkon' => $this->M_Hrd->getDetKon(), // get detail data kontrak from tb_kontrak
         'roweoc' => $this->M_Hrd->getEocKon(), // get detail data kontrak from tb_kontrak khusus ENd Of Contract
         'rowsbu' => $this->M_Hrd->getSbu(), //get data table SBU
         'rowjab' => $this->M_Hrd->getJab(), //get data table Jabatan
         'rowusreoc' => $this->M_Hrd->getUsrEoc(), // get user EOC dari tb_karyawan 
         'rowgrup'=> $this->M_Hrd->getGrup(), // get data Grup SBU
         'rowedu'=> $this->M_Hrd->getedu() // get data Edukasi tb_edukasi
      );
      $this->template->load('template','hrd/kontrak',$data);
   }

   // Edit Data EOC tab Daftar EOC
   // Versi 2 dari update data kontrak
   public function updateContract()
   {
      $id = $this->input->post('idkon');
      $nip = $this->input->post('nip');
      $pkwt = $this->input->post('pkwt');
      $statpkwt = $this->input->post('statpkwt');
      $tgl1 = $this->input->post('tglmulai');
      $tglmulai = date('Y-m-d',strtotime($tgl1));
      $tgl2 = $this->input->post('tglakhir');
      $tglakhir = date('Y-m-d',strtotime($tgl2));
      $selisih = $this->input->post('hitbeda');

      $data = array(
         'periodepkwt' => $pkwt,
         'durasi' => $selisih,
         'start' => $tglmulai,
         'end' => $tglakhir,
         'kontrak' => $statpkwt
      );
      // Data disimpan untuk history kontrak tb_hist_kontrak
      $data3 = array(
         'nip' => $nip,
         'tipe' => $statpkwt,
         'pkwt' => $pkwt,
         'awal' => $tglmulai,
         'akhir' => $tglakhir,
         'durasi' => $selisih
      );
      $this->M_Hrd->updateKontrak($id,$data,'tb_kontrak');
      $this->M_Hrd->addHisKontrak('tb_hist_kontrak',$data3);; // menyimpan history perubahan kontrak
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/kontrak');
   }

   // UPdate Detail Kontrak ver 2
   public function updateCont2()
   {
      $nip = $this->input->post('nip');
      $id = $this->input->post('idkon');
      $email = $this->input->post('email');
      $statkar = $this->input->post('statkar');
      $alasan = $this->input->post('alasan');
      $today = $this->input->post('today');
      $periode = $this->input->post('periode');
      $tipekon = $this->input->post('tipekon');
      $tgl1 = $this->input->post('tglawal');
      $tglawal = date("Y-m-d", strtotime($tgl1));
      $tgl2 = $this->input->post('tglakhir');
      $tglakhir = date("Y-m-d", strtotime($tgl2));
      $durasi = $this->input->post('durasi');
      $algojo = $this->fungsi->user_login()->nickname;

      // echo $tipekon."|".$statkar;

      // if($tipekon == "R"){
      //    // array data untuk proses renewal kontrak
      //    $data = array(
      //       'periodepkwt' => $periode,
      //       'durasi' => $durasi,
      //       'kontrak' => $tipekon,
      //       'start' => $tglawal,
      //       'end' => $tglakhir,
      //    );

      //    // array data untuk simpan history
      //    $data3 = array(
      //       'nip' => $nip,
      //       'tipe' => $tipekon, // R : Renewal / Perpanjangan KOntrak / PKWT ke II
      //       'pkwt' => $periode,
      //       'awal' => $tglawal,
      //       'akhir' => $tglakhir,
      //       'durasi' => $durasi
      //    );         
      //       $this->M_Hrd->updateKontrak($id,$data,'tb_kontrak');
      //       $this->M_Hrd->addHisKontrak('tb_hist_kontrak',$data3);; // menyimpan history perubahan kontrak
      //       $this->session->set_flashdata('flash','Diubah');
      //       redirect('Hrd/kontrak');
      // }
      if($statkar == "T"){// Jika Status karyawan TETAP
         $data=array(
            'periodepkwt' => "",
            'durasi' => "",
            'kontrak' => "P",
            'start' => $today,
            'end' => $today
         );
         $data2 = array('stat_kar'=> $statkar);

         $data3 = array(
            'nip' => $nip,
            'tipe' => "P", // P : Permanen / Merubah status menjadi permanen
            'pkwt' => "NULL",
            'awal' => $today,
            'akhir' => $today,
            'durasi' => ""
         );

         $this->M_Hrd->updateKontrakTetap($id,$data,'tb_kontrak'); // untuk kontrak karyawan "TETAP" ubah data pada table tb_kontrak
         $this->M_Hrd->updateStatKarTetap($email,$data2,'tb_karyawan'); // untuk perubahan  field (stat_kar) menjadi "T/TETAP"
         $this->M_Hrd->addHisKontrak('tb_hist_kontrak',$data3); // menyimpan history perubahan kontrak
         $this->session->set_flashdata('flash','Diubah');
         redirect('Hrd/kontrak');
      }else if ($statkar == "F"){ // Jika Status Karyawan FINISH
         // array data table kontrak (tb_kontrak)
         $data=array(            
            'kontrak' => "F", 
            'start' => $today,
            'end' => $today,
            'status' => "N"
         );
         // array data table karyawan (tb_karyawan)
         $data2 = array('stat_kar'=> $statkar);
         // array data table history kontrak (tb_hist_kontrak)
         $data3 = array(
            'nip' => $nip,
            'tipe' => "F", // F : FINISH / Mengakhiri Kontrak Karyawan
            'pkwt' => "NULL",
            'awal' => $today,
            'akhir' => $today,
            'durasi' => ""
         );
         // array data untuk table Kontrak EOC (tb_kontrak_eoc)
         $data4 = array(
            'nip' => $nip,
            'email' => $email,
            'tgl' => $today,
            'alasan' => $alasan,
            'algojo' => $algojo
         );

         $this->M_Hrd->updateKontrakFinish($id,$data,'tb_kontrak'); // untuk kontrak karyawan "Finish" ubah data pada table tb_kontrak
         $this->M_Hrd->updateStatKarFinish($email,$data2,'tb_karyawan'); // untuk perubahan  field (stat_kar) menjadi "F/FInish"
         $this->M_Hrd->addHisKontrak('tb_hist_kontrak',$data3); // menyimpan history perubahan kontrak
         $this->M_Hrd->addKontrakEoc('tb_kontrak_eoc',$data4); // menyimpan EOC kontrak karyawan pada table tb_kontrak_eoc
         $this->session->set_flashdata('flash','Diubah');
         redirect('Hrd/kontrak');
      }else if ($statkar == "K"){
         //array data untuk proses renewal kontrak
         $data = array(
            'periodepkwt' => $periode,
            'durasi' => $durasi,
            'kontrak' => $tipekon,
            'start' => $tglawal,
            'end' => $tglakhir,
         );

         // array data untuk simpan history
         $data3 = array(
            'nip' => $nip,
            'tipe' => $tipekon, // R : Renewal / Perpanjangan KOntrak / PKWT ke II
            'pkwt' => $periode,
            'awal' => $tglawal,
            'akhir' => $tglakhir,
            'durasi' => $durasi
         );         
            $this->M_Hrd->updateKontrak($id,$data,'tb_kontrak');
            $this->M_Hrd->addHisKontrak('tb_hist_kontrak',$data3);; // menyimpan history perubahan kontrak
            $this->session->set_flashdata('flash','Diubah');
            redirect('Hrd/kontrak');
      }

      
   }

   // Update data kontrak untuk Mengakhiri kontrak
   public function endContract()
   {
      $nip = decrypt_url($this->uri->segment(3));
      $email = decrypt_url($this->uri->segment(4));
      $algojo = $this->fungsi->user_login()->nickname;
      $today = gmdate("Y-m-d", time()+60*60*7);

      // data disimpan untuk perubahan pada table tb_kontrak
      $data = array(
         'kontrak' => "F",
         'start' => $today,
         'end' => $today,
         'status' => "N",
      );
      // array data table karyawan (tb_karyawan)
      $data2 = array('stat_kar'=> "F");
      // Data disimpan untuk history kontrak tb_hist_kontrak
      $data3 = array(
         'nip' => $nip,
         'tipe' => "F",
         'pkwt' => "",
         'awal' => $today,
         'akhir' => $today,
         'durasi' => ""
      );
      // array data untuk table Kontrak EOC (tb_kontrak_eoc)
      $data4 = array(
         'nip' => $nip,
         'email' => $email,
         'tgl' => $today,
         'alasan' => "Finish kontrak dan tidak diperpanjang",
         'algojo' => $algojo
      );

      $this->M_Hrd->endContract($nip,$data,'tb_kontrak');
      $this->M_Hrd->updateStatKarFinish($email,$data2,'tb_karyawan'); // untuk perubahan  field (stat_kar) menjadi "F/FInish"
      $this->M_Hrd->addHisKontrak('tb_hist_kontrak',$data3);; // menyimpan history perubahan kontrak
      $this->M_Hrd->addKontrakEoc('tb_kontrak_eoc',$data4); // menyimpan EOC kontrak karyawan pada table tb_kontrak_eoc
      $this->session->set_flashdata('flash','Diubah');
      redirect('Hrd/kontrak');
   }

   // Cek email karyawan EOC load pada textbar email
   public function cekEmailEoc()
   {
      $id = $this->input->post('id'); //id yang dilempar oleh json
      $data = $this->M_Hrd->cekEmailEoc($id);
      echo json_encode($data);
   }   

// ====================== ./ Halaman KOntrak Karyawan ================

   // get Data SBU untuk keperluan link Select dari CHANGE GRUP
   public function cariSbu()
   {
      $id = $this->input->post('id'); //id yang dilempar oleh json
      $data = $this->M_Hrd->getCariSbu($id);
      echo json_encode($data);
   }

   // get Data Sub Unit untuk keperluan link Select
   public function subUnit()
   {
      $id = $this->input->post('id'); //id yang dilempar oleh json
      $data = $this->M_Hrd->getSubUnit($id);
      echo json_encode($data);
   }
   // get Data Sub Unit untuk keperluan link Select
   // public function cariUnit()
   // {
   //    $id = $this->input->post('id'); //id yang dilempar oleh json
   //    $data = $this->M_Hrd->getSubUnit($id);
   //    echo json_encode($data);
   // }
   // get Data Detail Jabatan untuk keperluan link Select
   public function detailJab()
   {
      $id = $this->input->post('id'); //id yang dilempar oleh json
      $data = $this->M_Hrd->getDetailJab($id);
      echo json_encode($data);
   }

   // Get Data DOkumen Karyawan (Halaman Dokumen Kepegawaian )
   public function docKary($id)
   {
      $id = decrypt_url($id);
      $data=array(
         'judul' => "BiasHRIS | Dokumen Karyawan",
         'rowdok' => $this->M_Hrd->getPegDoc($id)
      );
      $this->template->load('template','hrd/docemp',$data);

   }

   // update Edit data KOntrak Karyawan EOC (Recontract)
   public function updateKonKarOld()
   {
      // var_dump($_POST);
      // tb_karyawan
      $id = $this->input->post('id_kar');
      $tgl1 = $this->input->post('tglmulai');
      $join = date("Y-m-d", strtotime($tgl1));
      $idjab = $this->input->post('levelOld');
      $defjab = $this->input->post('dejabOld');
      $grup = $this->input->post('grupOld');
      $kode = $this->input->post('sbuOld');
      $subunit = $this->input->post('subunitOld');
      $dept = $this->input->post('departemenOld',TRUE);
      $statkar = "K";
      // tb_kontrak
      $pkwt = "I";
      $durasi = $this->input->post('selisih78');
      $nip = $this->input->post('nip');
      $kontrak = "N";
      $tgl2 = $this->input->post('tglakhir');
      $end = date("Y-m-d", strtotime($tgl2));
      $urut = $this->input->post('urutan');
      $status = "Y";
      $email = $this->input->post('email');

      // data untuk table karyawan
      $data = array(
         'stat_kar'     => $statkar,
         'join_date'    => $join,
         'id_jab'       => $idjab,
         'def_jab'      => $defjab,
         'id_grup'      => $grup,
         'kode'         => $kode,
         'sub_unt'      => $subunit,
         'id_dept'      => $dept
      );


      // data untuk table kontrak 
      $data2 = array(
         'periodepkwt'  => $pkwt,
         'durasi'       => $durasi,
         'nip'          => $nip,
         'kontrak'      => $kontrak,
         'start'        => $join,
         'end'          => $end,
         'urutan'       => $urut,
         'status'       => $status,
         'email'        => $email
      );
      
      // Data untuk table history kontrak
      $data3 = array(
         'nip'          => $nip,
         'tipe'         => $kontrak,
         'pkwt'         => $pkwt,
         'awal'         => $join,
         'akhir'        => $end,
         'durasi'       => $durasi
      );

      // Data untuk table history kepegawaian
      $data4 = array(
         'nip'          => $nip,
         'jab'          => $idjab,
         'def_jab'      => $defjab,
         'sbu'          => $kode,
         'sub'          => $subunit,
         'id_dept'      => $dept,
         'tgl'          => $join
      );
      // Data 5 untuk simpan jatah cuti
      $data5 = array(
         'nip'       => $nip,
         'ttl_cuti'  => "12",
         'c_pribadi' => "",
         'c_bersama' => "",
         'sisa_cuti' => "12",
         'per_awal'  => "",
         'per_akhir' => "",
         'cuti_thn'  => "",
         'c_status'    => "",

      );
      
      $this->M_Hrd->updateKar($id,$data,'tb_karyawan');
      $this->M_Hrd->addKontrak('tb_kontrak',$data2);
      $this->M_Hrd->addHisKontrak('tb_hist_kontrak',$data3); // MEnyimpan data history kontrak
      $this->M_Hrd->addHisKepeg('tb_hist_kepegawaian',$data4); // Tambah data history kepegawaian (Jabatan, detail jabatan, SBU dan SUb Unit )
      $this->M_Hrd->addCuti('tb_cuti_jatah',$data5); //Otomatis menambahkan Jatah Cuti ke table jatah cuti
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect ('Hrd/kontrak');
   }

   // =========== HALAMAN LAPORAN ABSENSI=============
   //Load Halaman Absensi
   public function laporanAbsensi()
   {
      $id=decrypt_url($this->uri->segment(3));
      $fullname=decrypt_url($this->uri->segment(4));
      $key = gmdate("Y-m", time()+60*60*7); //like Tahun-Bulan berjalan
      $data = array(
         'judul' => "Bias HRIS | Laporan Absensi $fullname",
         'rowhadir'  => $this->M_Hrd->getHadirToday(),
         'rowkar'    => $this->M_Hrd->getKar(),
         'rowabsen'  => $this->M_Hrd->getAbsenBulan($key),
      );
      $this->template->load('template', 'hrd/laporanAbsensi',$data); //dashboard khusus HRD  

   }

   // =========== HALAMAN LAPORAN ABSENSI Karyawan=============
   // Get Data table absensi load ke Halaman laporan Absensi Karyawan
   public function laporanAbsenKar()
   {
      $id=decrypt_url($this->uri->segment(3));
      $fullname=decrypt_url($this->uri->segment(4));    
      $data = array(
         'judul' => "Bias HRIS | Laporan Absensi $fullname ",
         'rowkarbyid' => $this->M_Hrd->getKarById($id),
         'rowhadirkar' => $this->M_Hrd->getAbsenKar($id)
      );
      $this->template->load('template','hrd/laporanAbsensiKar',$data); //dashboard khusus HRD
   }
   
   public function laporanAbsenKar2()
   {
      $id = $this->input->post('idkar');
      $daterange = explode(" - ",$this->input->post('daterange'));
      $date1 = date("Y-m-d",strtotime($daterange[0]));
      $date2 = date("Y-m-d",strtotime($daterange[1]));

      $data = array(
         'judul' => "Bias HRIS | Laporan Absensi" ,
         'rowkarbyid' => $this->M_Hrd->getKarById($id),
         'presentrange' => $this->M_Hrd->getAbsenKarRange($id,$date1,$date2),
         'range1' => $date1,
         'range2' => $date2,
      );

      $this->template->load('template','hrd/laporanAbsensiKarRange',$data); //dashboard khusus HRD

   }
   // =========== ./ HALAMAN LAPORAN ABSENSI Karyawan=============
   
   // =========== HALAMAN LAPORAN ABSENSI ALL=============

   public function laporanAbsensiAll()
   {
      $reservation = explode(" - ",$this->input->post('reservation'));
      $dateawal = date("Y-m-d",strtotime($reservation[0]));
      $dateakhir = date("Y-m-d",strtotime($reservation[1]));

      // echo $dateawal," | ",$dateakhir;
      $data = array(
         'judul' => "Bias HRIS | Laporan Absensi Karyawan ",
         'rowabsen'  => $this->M_Hrd->getAbsenAll($dateawal,$dateakhir),
      );
      $this->template->load('template', 'hrd/laporanAbsensiAll',$data); //dashboard khusus HRD 
   }
   // =========== ./ HALAMAN LAPORAN ABSENSI ALL=============

   // ============ HALAMAN LAPORAN ISTIRAHAT ========================
   public function laporanIstirahat()
   {
      $today = gmdate("Y-m-d", time()+60*60*7); //like Tahun-Bulan berjalan
      $data = array (
         'judul'           => "Bias HRIS | Laporan Istirahat Karyawan ",
         'rowBreak'        => $this->M_Hrd->getBreakAll(),
         'rowBreakToday'   => $this->M_Hrd->getBreakToday($today),
      );
      $this->template->load('template', 'hrd/laporanIstirahat',$data); //dashboard khusus HRD 
   }

   // Filtered laporan istirahat karyawan 
   public function laporanIstirahatFilter()
   {
      $reservation = explode(" - ",$this->input->post('reservation'));
      $dateawal = date("Y-m-d",strtotime($reservation[0]));
      $dateakhir = date("Y-m-d",strtotime($reservation[1]));

      $data = array (
         'judul'           => "Bias HRIS | Laporan Istirahat Karyawan ",
         'rowBreakFilter'   => $this->M_Hrd->getBreakFilter($dateawal,$dateakhir),
      );

      $this->template->load('template', 'hrd/laporanIstirahatFilter',$data); //dashboard khusus HRD 
   }

   // ============ /. HALAMAN LAPORAN ISTIRAHAT ========================

   // =========== HALAMAN LAPORAN KONTRAK Karyawan=============
   public function laporanKontrak()
   {
      $data = array(
         'judul' => "Bias HRIS | Laporan Kontrak",
         'rowsbu' => $this->M_Hrd->getSbu(), //get data table SBU
         'rowjab' => $this->M_Hrd->getJab(), //get data table Jabatan
         'rowlist' => $this->M_Hrd->getkon2() // dipasang pada halaman Laporan Kontrak
      );
      $this->template->load('template','hrd/laporanKontrak',$data); //dashboard khusus HRD

   }

   public function laporanKontrakFilter()
   {
      // var_dump($_POST);
      
      $kode = $this->input->post('sbu');
      if($kode == ""){
         $sbu = "EMPTY";
      }else { $sbu = $kode; }
      
      $jabatan = $this->input->post('jabatan');
      if($jabatan == ""){
         $jab = "EMPTY";
      }else{ $jab = $jabatan; }

      $daterange = explode(" - ",$this->input->post('daterange'));
      $date1 = date("Y-m-d",strtotime($daterange[0]));
      $date2 = date("Y-m-d",strtotime($daterange[1]));

      $data = array(
         'judul' => "Bias HRIS | Laporan Kontrak",
         'sbu' => $sbu,
         'jabatan' => $jab,
         'range1' => $date1,
         'range2' => $date2,
         'rowsbu' => $this->M_Hrd->getSbu(), //get data table SBU
         'rowjab' => $this->M_Hrd->getJab(), //get data table Jabatan
         'rowlist' => $this->M_Hrd->getkonFil($sbu,$jab,$date1,$date2)
      );
      $this->template->load('template','hrd/laporanKontrakFiltered',$data); //dashboard khusus HRD
   }

   // =========== ./ HALAMAN LAPORAN KONTRAK Karyawan=============

    // =========== HALAMAN Kartu ID=============  Update untuk versi 20.01 (ditulis tgl 27/12/19)
   public function kartuId()
   {
      $data = array(
         'judul' => "BiasHRIS | Daftar Kartu ID",
         'rowusrall' => $this->M_Hrd->getUsrAll(),
         'rowCard' => $this->M_Hrd->getCard(),
         'cardSort' => $this->M_Hrd->getCardSorted()
      );
      $this->template->load('template','hrd/kartuId',$data); //dashboard khusus HRD
   }

   // Proses Pengecekan Kartu dan Menampilkan Tombol Absen 
   public function cekKartuId()
   {
      $rfid = $this->input->post('id_kartu');
      if(empty ($rfid)){
         echo "<span class='text-danger' style='margin-left:5px'> Data Kosong! <i class='fa fa-exclamation-circle pull-left' style='margin-left:10px;font-size:25px'></i></span>";
      }else{
         $cek = $this->db->query("SELECT * FROM tb_kartu WHERE id_kartu='$rfid'");
         if($cek->num_rows() >= 1){
            echo "<span class='text-danger' style='margin-left:5px'>  Kartu sudah dipakai ! <i class='fa fa-ban pull-left' style='margin-left:10px;font-size:25px'></i></span>";}
            else{
            echo "<span class='text-success' style='margin-left:5px;margin-top:30px'> Kartu tersedia ! <i class='fa fa-check-circle-o pull-left' style='margin-left:10px;font-size:25px'></i></span>";
         }
      }
   }

   // Pendaftaran Kartu ID
   public function regKartu()
   {
      $rfid = $this->input->post('rfid');
      $kar = $this->input->post('id_kar');
      $today = gmdate("Y-m-d", time()+60*60*7);

      $data = array (
         'id_kartu' => $rfid,
         'id_kar'   => $kar,
         'status'   => "A",
         'addtgl'   => $today
      );

      $cek = $this->db->query("SELECT * FROM tb_kartu WHERE id_kartu='$rfid' OR id_kar='$kar'");
      if($cek->num_rows() != 0){
         $this->session->set_flashdata('flash_error','Ditambahkan');
         redirect('Hrd/kartuId');
      }else{
         $query = $this->M_Hrd->addCard('tb_kartu',$data); 
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect ('Hrd/kartuId');
      }   
   }

   // Proses Hapus Kartu ID karyawan
   public function delKartu($id)
   {
      $rfid = decrypt_url($id);
      $this->M_Hrd->delCard($rfid,'tb_kartu');
      if($this->db->affected_rows()){
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/kartuId');
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/kartuId');
      }

   }
   
   // =========== ./ HALAMAN Kartu ID============= 
   
   // =========== HALAMAN HR MANAGEMENT -> MANAGEMENT CUTI=============  Update untuk versi 20.01 (ditulis tgl 3/02/2020)

   //Index Cuti Karyawan - MODUL MANAJEMEN CUTI 
   public function cuti()
   {
      $data = array(
         'judul' => "BiasHRIS | Manajemen Cuti ",
         'rowcutiTh' => $this->M_Hrd->getCutiTahunan(),
         'rowcutiKs' => $this->M_Hrd->getCutiKhusus(),   // Get Data Cuti Khusus
         'rownik'    => $this->M_Hrd->getNikAktif(),      // Get Nik Karyawan aktif
         'noform'    => $this->M_Aproject->getNoForm()   // get Maks urutan pengajuan cuti

      );
      $this->template->load('template','hrd/cuti',$data); //folder hrd (h huruf kecil)
   }

   // APVROVAL 2 untuk LEVEL HRD
   public function apvCuti()
   {
      $id = decrypt_url($this->uri->segment(3));
      $noform = decrypt_url($this->uri->segment(4));
      $level = decrypt_url($this->uri->segment(5));
      $nama = decrypt_url($this->uri->segment(6));
      $jabatan = decrypt_url($this->uri->segment(7));
      $today = gmdate("Y-m-d", time()+60*60*7);

      // echo  "<p>$id</p>";
      // echo  "<p>$noform</p>";
      // echo  "<p>$level</p>";
      // echo  "<p>$nama</p>";
      // echo  "<p>$jabatan</p>";

      if(($level == "A1") || ($level == "A2")){
         $data = array(
            'apv2'      => $nama,
            'tgl_apv2'  => $today,
            'jab_apv2'  => $jabatan
         );

         $data2 = array('stat_cukar' => "DISETUJUI");

         $this->M_Hrd->apvCutiKar($data2,'tb_cuti_karyawan',$id);
         $this->M_Hrd->apvCuti($data,'tb_cuti_aproval',$noform);
      }else if($level == "A4"){
         $data = array(
            'apv1'      => $nama,
            'tgl_apv1'  => $today,
            'jab_apv1'  => $jabatan
         );
         $this->M_Hrd->apvCuti($data,'tb_cuti_aproval',$noform);
      }

      $this->session->set_flashdata('flash','Disetujui');
      redirect('Hrd/cuti'); //COntroller 

   }

   // REJECTED Pengajuan Cuti 
   public function rejectCuti()
   {
      $id = decrypt_url($this->uri->segment(3));
      $noform = decrypt_url($this->uri->segment(4));
      $level = decrypt_url($this->uri->segment(5));
      $nama = decrypt_url($this->uri->segment(6));
      $jabatan = decrypt_url($this->uri->segment(7));
      $getct = decrypt_url($this->uri->segment(8));   //sisa cuti
      $hari = decrypt_url($this->uri->segment(9));    // Total hari yang diajukan
      $nip = decrypt_url($this->uri->segment(10));    // NIP Karyawan
      $tipe = decrypt_url($this->uri->segment(11));    // Tipe cuti
      $today = gmdate("Y-m-d", time()+60*60*7);

      $hasil = $hari + $getct; // mengembalikan nilai sisa cuti jika ditolak

      // echo  "<p>$id</p>";
      // echo  "<p>$noform</p>";
      // echo  "<p>$level</p>";
      // echo  "<p>$nama</p>";
      // echo  "<p>$jabatan</p>";
      // echo  "<p>Sisa Cuti : $getct</p>";
      // echo  "<p> Total Hari : $hari</p>";
      // echo  "<p>Sisa Cuti + Total Hari : $hasil</p>";
      // echo  "<p>$nip</p>";
      // echo  "<p>$tipe</p>";

      // untuk mengisi aproval pada table AProval Cuti "tb_cuti_aproval"
      $data = array(
         'apv2'      => $nama,
         'tgl_apv2'  => $today,
         'jab_apv2'  => $jabatan
      );

      // untuk merubah stat_cukar pada tabel cuti karyawan
      $data2 = array('stat_cukar' => "DITOLAK");

      // untuk mengembalikan nilai sisa cuti pada Table Jatah CUti
      $data3 = array('sisa_cuti' => $hasil);
      $where = array(
         'nip' => $nip,
         'c_status' => "A"
      );

      if($tipe == "TAHUNAN"){
         $this->M_Hrd->sisaCutiBack($data3,$where,'tb_cuti_jatah');   // mengembalikan hari jumlah sisa cuti pada table JATAH CUTI
         $this->M_Hrd->apvCutiKar($data2,'tb_cuti_karyawan',$id);
         $this->M_Hrd->apvCuti($data,'tb_cuti_aproval',$noform);
      }else{
         $this->M_Hrd->apvCutiKar($data2,'tb_cuti_karyawan',$id);
         $this->M_Hrd->apvCuti($data,'tb_cuti_aproval',$noform);
      }               

      $this->session->set_flashdata('flash','Ditolak');
      redirect('Hrd/cuti'); //COntroller 

   }  

   // Get data table jatah cuti dari operasi Tambah CUti Karyawan

   public function cariJatah()
   {
      // POST data
      $postData = $this->input->post();

      // get data
      $data = $this->M_Hrd->getJatahCuti($postData);

      echo json_encode($data);
   }

   // POTONG Cuti Karyawan
   public function potCuti()
   { 
      // var_dump($_POST);
      # Untuk data table CUti karyawan
      $noform     = $this->input->post('nocuti',TRUE);
      $today      = gmdate("Y-m-d", time()+60*60*7);
      $tglmulai   = $this->input->post('perawal',TRUE);
      $tglawl     = date("Y-m-d", strtotime($tglmulai));
      $tglakhir   = $this->input->post('perakhir',TRUE);
      $tglakr     = date("Y-m-d", strtotime($tglakhir));
      $ket        = $this->input->post('ketcuti',TRUE);
      $total      = $this->input->post('totalhr',TRUE);
      $nip        = $this->input->post('nip',TRUE);
      $idkar      = $this->input->post('idkar',TRUE);
      $sbu        = $this->input->post('sbu',TRUE);
      $urutan     = $this->input->post('urutan',TRUE);

      $data2 = array (
         'noform'    => $noform,
         'tglform'   => $today,
         'awal_cukar'=> $tglawl,
         'akhir_cukar'=>$tglakr,
         'ket_cukar' => $ket,
         'tipe_cukar'=> "TAHUNAN",
         'totalhr_cukar'=> $total,
         'stat_cukar'=> "DISETUJUI",
         'nip'       => $nip,
         'id_kar'    => $idkar,
         'sbu'       => $sbu,
         'urutan'    => $urutan
      );

      # Untuk data table jatah Cuti (edit sisa cuti nya)
      $id        = $this->input->post('karyawan',TRUE);
      $sisact    = $this->input->post('sisact',TRUE);

      $data = array(
         'sisa_cuti' => $sisact
      );

      #Untuk data pada table Aproval Cuti (OPerasi tambah cuti Aproval)
      $apv2       = $this->input->post('apv2',TRUE);
      $jabapv2    = $this->input->post('jabapv2',TRUE);
      $data3 = array(
         'noform'    => $noform,
         'tgl_form'  => $today,
         'apv1'      => "",
         'jab_apv1'  => "",
         'tgl_apv1'  => "",
         'apv2'      => $apv2,
         'jab_apv2'  => $jabapv2,
         'tgl_apv2'  => $today

      );

      $this->M_Hrd->updateCutiJatah('tb_cuti_jatah',$data,$id); #menggunakan Model yang sudah ada di Halaman Data Cuti Karyawan
      $this->M_Hrd->addCutiKar($data2,'tb_cuti_karyawan');
      $this->M_Hrd->addCutiApv($data3,'tb_cuti_aproval');
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect('Hrd/cuti');

   }
   
    // =========== ./ HALAMAN HR MANAGEMENT -> MANAGEMENT CUTI============= 

   // =========== HALAMAN Master Data -> Data Cuti Karyawan=============  Update untuk versi 20.01 (ditulis tgl 12/02/2020)
   // Index
   public function datacuti()
   {
      $data = array(
         'judul' => "BiasHRIS | Data Cuti",
         'rowcutibr' => $this->M_Aproject->getCutiBr(), // Get Cuti BErsama
         'rowjtct'   => $this->M_Hrd->getJtCutiAktif(), //Get Jatah CUti AKtif
         'rowjtct2'   => $this->M_Hrd->getJtCutiNonaktif(), //Get Jatah CUti NonaKtif
         'rowjtct3'   => $this->M_Hrd->getJtCutiBaru(), //Get Jatah CUti Baru
         //'rownipmati' => $this->M_Hrd->getNipMati(), // Get nip yang cutinya sudah mati atau nonaktif
         // 'rownik' => $this->M_Hrd->getNikAktif()
      );
      $this->template->load('template','hrd/datacuti',$data); //dashboard khusus HRD
   }

   // Tambah data Cuti Bersama
   public function addCutiBersama()
   {
      $uraian = $this->input->post('uraian');
      $tglmulai = $this->input->post('tglmulai');
      $tglawl = date("Y-m-d", strtotime($tglmulai));
      $tglakhir = $this->input->post('tglakhir');
      $tglakr = date("Y-m-d", strtotime($tglakhir));
      $selisih = $this->input->post('selisih');
      $kategori = $this->input->post('kategori');
      $periode = $this->input->post('periode');
      $status = $this->input->post('status');

      $data = array(
         'uraian' => $uraian,
         'awal_cuti' => $tglawl,
         'akhir_cuti' => $tglakr,
         'tahun' => $periode,
         'jml_hari' => $selisih,
         'kategori' => $kategori,
         'status' => $status
      );

      $this->M_Hrd->addCutiBersama('tb_cuti_bersama',$data);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect ('Hrd/datacuti');

   }

   // Edit Data Cuti Bersama
   public function updateCutiBersama()
   {
      $id = $this->input->post('idcuti');
      $uraian = $this->input->post('uraian');
      $tglmulai = $this->input->post('tglmulaiE');
      $tglawl = date("Y-m-d", strtotime($tglmulai));
      $tglakhir = $this->input->post('tglakhirE');
      $tglakr = date("Y-m-d", strtotime($tglakhir));
      $selisih = $this->input->post('selisihE');
      $kategori = $this->input->post('kategori');
      $periode = $this->input->post('periode');
      $cpbaru = $this->input->post('cpbaru');
      $scbaru = $this->input->post('scbaru');

      $data = array (
         'uraian' => $uraian,
         'awal_cuti' => $tglawl,
         'akhir_cuti' => $tglakr,
         'tahun' => $periode,
         'jml_hari' => $selisih,
         'kategori' => $kategori,
      );

      $data2 = array(
         'c_pribadi' => $cpbaru,
         'sisa_cuti' => $scbaru
      );

      $this->M_Hrd->updateCutiBersama('tb_cuti_bersama',$data,$id); //
      $this->M_Hrd->updateJtCuti('tb_cuti_jatah',$data2,$id); //Update field table Jatah Cuti berdasarkan id CUTI BERSAMA
      $this->session->set_flashdata('flash','Diubah');
      redirect ('Hrd/datacuti');

   }

   // Hapus Data CUti Bersama
   public function delCutiBersama($id)
   {
      $id = decrypt_url($id);
      $this->M_Hrd->delCutiBersama($id,'tb_cuti_bersama');
      if($this->db->affected_rows()){
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/datacuti');
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/datacuti');
      }
   }  

   // Edit Data Jatah Cuti Karyawan
   public function updateCutiKar()
   {
      // VAR_DUMP($_POST);
      // exit();
      $id = $this->input->post('idcuti',TRUE);
      $cutibrs = $this->input->post('cutibrs',TRUE);
      $cutipri = $this->input->post('cutipri',TRUE);
      $sisact = $this->input->post('sisact',TRUE);
      $periode = $this->input->post('periode',TRUE);
      $tglawal = $this->input->post('perawal',TRUE);
      $tglawl = date("Y-m-d", strtotime($tglawal));
      $tglakhir = $this->input->post('perakhir',TRUE);
      $tglakr = date("Y-m-d", strtotime($tglakhir));
      $sts = $this->input->post('sts',TRUE);

      $data = array (
         'c_bersama'    => $cutibrs,
         'c_pribadi'    => $cutipri,
         'sisa_cuti'    => $sisact,
         'per_awal'     => $tglawl,
         'per_akhir'    => $tglakr,
         'cuti_thn'     => $periode,
         'c_status'       => $sts
      );
      $this->M_Hrd->updateCutiJatah('tb_cuti_jatah',$data,$id);
      $this->session->set_flashdata('flash','Diubah');
      redirect ('Hrd/datacuti');
   }

   // Edit Data Cuti menjadi Nonaktif
   public function nonAktifCuti($id)
   {
      $id = decrypt_url($id);
      $data = array ('c_status' => "D");
      $this->M_Hrd->updateCutiJatahNonaktif('tb_cuti_jatah',$data,$id);
      $this->session->set_flashdata('flash','Diubah');
      redirect ('Hrd/datacuti');
   }

   // Hapus Data CUti NonoAktif
   public function delCutiNonaktif($id)
   {
      $id = decrypt_url($id);
      $this->M_Hrd->delCutiNonaktif($id,'tb_cuti_jatah');
      if($this->db->affected_rows()){
         $this->session->set_flashdata('flash','Dihapus');
         redirect('Hrd/datacuti');
      }else {
         $this->session->set_flashdata('flash_error','Dihapus');
         redirect('Hrd/datacuti');
      }
   }  

   // TAmbah Cuti Baru
   public function addCutiBaru()
   {
      $nip = $this->input->post('nip',TRUE);
      $periode = $this->input->post('periode',TRUE);
      $totalct = $this->input->post('totalct',TRUE);
      $ctber = $this->input->post('ctber',TRUE);
      $ssct = $this->input->post('ssct',TRUE);
      $ctpri = $this->input->post('ctpri',TRUE);
      $perawal = $this->input->post('perawal',TRUE);
      $tglawal = date("Y-m-d",strtotime($perawal));
      $perakhir = $this->input->post('perakhir',TRUE);
      $tglakhir = date("Y-m-d",strtotime($perakhir));

      $data = array(
         'nip' => $nip,
         'ttl_cuti'  => $totalct,
         'c_pribadi' => $ctpri,
         'c_bersama' => $ctber,
         'sisa_cuti' => $ssct,
         'per_awal'  => $tglawal,
         'per_akhir' => $tglakhir,
         'cuti_thn'  => $periode,
         'c_status'  => "A"
      );
      $this->M_Hrd->addCutiBaru('tb_cuti_jatah',$data);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect ('Hrd/datacuti');
   }

   // Get Data cuti bersama untuk operasi edit Data Cuti 
   public function cekCutiBrsm()
   {
      // POST data
      $postData = $this->input->post();

      // get data
      $data = $this->M_Hrd->getCuberDetails($postData);

      echo json_encode($data);
   }

   // Get Data Cuti Jatah untuk operasi edit data cuti bersama
   public function cekJatahCt()
   {
      // POST data
      $postData = $this->input->post();

      // get data
      $data = $this->M_Hrd->getJatahDetails($postData);

      echo json_encode($data);
   }
   // =========== ./ HALAMAN Master Data -> Data Cuti Karyawan=============  

}


/* End of file Hrd.php */
/* Location: ./application/models/Hrd.php */