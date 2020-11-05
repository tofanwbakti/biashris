<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class C_Personal extends CI_Controller{

   
   public function __construct()
   {
      parent::__construct();
      cek_nologin();
      cek_logout();
      // cek_admin();
      // cek_admin2();      
      $this->load->model('M_Aproject');
      // $this->output->enable_profiler(TRUE);
      
   }

   // ============================ IJIN KELUAR ============================
   function index()
   {
      
      $data = array( 
         'judul' => "BiasHRIS | Ijin Keluar",
         'row' => $this->M_Aproject->get_ikel()
      );
      $this->template->load('template','personal/v_ikel', $data);
   }

  
   function addikel()
   {
      $idkar = $_POST['InputIdKar'];
      $tgl = $_POST['Tanggal'];
      $ctgl = date('Y-m-d',strtotime($tgl));
      $jam = $_POST['Jam'];
      $alasan = $_POST['InputAlasan'];
      $data = array(
         'id_kar' => $idkar,
         'tanggal' => $ctgl,
         'jam' => $jam,
         'alasan' => $alasan,
         'apv1' => "null",
         'apv2' => "null",
         'status' => "N"
      );
      

      $query = $this->M_Aproject->addikel('tb_ijinkeluar',$data);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect('C_Personal');
      
   }

   function batalIkel()
   {
      $user = $this->fungsi->user_login()->nickname;
      $id = decrypt_url($this->uri->segment(3));
      $data = array ('apv2'=>$user, 'status' => "C");
      $where = array ('id_ikel' => $id);
      $this->M_Aproject->updateIkel($data,$where);
      $this->session->set_flashdata('flash','Dibatalkan');
      redirect ('C_Personal');

   }

   function apv1($id)
   {
      
      $id = decrypt_url($this->uri->segment(3));
      $user = $this->fungsi->user_login()->nickname;

      $data=array(
         'apv1' => $user
      );

      $where = array(
         'id_ikel'=>$id
      );

      $this->M_Aproject->updateIkel($data,$where);
      $this->session->set_flashdata('flash','Disetujui');
      redirect('C_Personal');
   }

   function apv2($id)
   {
      $user = $this->fungsi->user_login()->nickname;

      $data=array(
         'apv2' => $user,
         'status' => "Y"
      );

      $where = array(
         'id_ikel'=>$id
      );
      $this->M_Aproject->updateIkel($data,$where);
      $this->session->set_flashdata('flash','Disetujui');
      redirect('C_Personal');
   }

// ============================ IJIN TERLAMBAT ============================
   function ijinLambat()
   {
      $data = array(
         'judul'  => "BiasHRIS | Ijin Terlambat",
         'row'    => $this->M_Aproject->get_lambat()         
      ) ;      
      $this->template->load('template','personal/v_terlambat',$data);
   }

   // Proses Memasukkan alasan terlambat
   function addComment()
   {
      $id = $this->input->post('id_ila',TRUE);
      $alasan = $this->input->post('alasan',TRUE);

      $data = array (
         'keterangan' => $alasan
      );

      $where = array (
         'id_ila' =>$id
      );

      $this->M_Aproject->addComment('tb_ijinlambat',$data,$where);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect ('C_Personal/ijinLambat');
   }

   // Proses Tolak pengajuan oleh HRd dan input comment penolakan
   public function addCommentTolak()
   {
      $id = $this->input->post('id_ila',TRUE);
      $alasan = $this->input->post('commentTolak',TRUE);
      $user = $this->fungsi->user_login()->nickname;

      $data = array(
         'apv2' => $user,
         'status' => "N",
         'comment' => $alasan
      );

      $where = array ('id_ila' => $id);

      $this->M_Aproject->apvLambat('tb_ijinlambat',$data,$where);
      $this->session->set_flashdata('flashApv','Diproses');
      redirect ('C_Personal/ijinLambat');  
   }

   // Proses Aproval Ijin Terlambat
   function apvLambat ($id,$status)
   {
      $user = $this->fungsi->user_login()->nickname;
      $level = $this->fungsi->user_login()->id_lvl;

      $id = decrypt_url($this->uri->segment(3));
      $stt = decrypt_url($this->uri->segment(4));

      if($level == "A4"){
         $data = array (
            'apv1' => $user,
            'status' => $stt
         );
      }else {
         if($stt == "Y"){
            $data = array (
               'apv2' => $user,
               'status' => $stt
            );
         }else{
            $data = array (
               'apv2' => $user,
               'status' => $stt,
               'comment' => "TEST APV HRD"
            );
         }
      }

      $where = array ('id_ila' => $id);

      $this->M_Aproject->apvLambat('tb_ijinlambat',$data,$where);
      $this->session->set_flashdata('flashApv','Diproses');
      redirect ('C_Personal/ijinLambat');      
   }

// ============================ IJIN SAKIT ============================
// Izin Sakit
   function isak()
   {
      $data = array(
         'judul' => "BiasHRIS | Ijin Sakit",
         'row'=> $this->M_Aproject->get_sakit()         
      ) ;      
      $this->template->load('template','personal/v_sakit',$data);
   }

   function addisak()
   {
      $idkar = $_POST['InputIdKar'];
      $hari = $_POST['Hari'];
      $tgl = $_POST['Tanggal'];
      $ctgl = date('Y-m-d',strtotime($tgl));
      $alasan = $_POST['InputAlasan'];
      // $apv1 = $_POST['Apv1'];
      
      $config['upload_path']     = './uploads/suratmc/'; //path folder
      $config['allowed_types']   = 'pdf'; //type yang dapat diakses bisa anda sesuaikan
      $config['file_name']       = 'MC'.$this->fungsi->user_login()->nickname.gmdate("Y-m-d", time()+60*60*7);
      $config['max_size']        = 2048;
      $config['overwrite']        = TRUE;

      $this->load->library('upload');
		$this->upload->initialize($config);
      if(!empty($_FILES['suratmc']['name']))
      { 
         if ($this->upload->do_upload('suratmc'))
         {
            $gbr = $this->upload->data();
            $gambar=$gbr['file_name']; //Mengambil file name dari gambar yang diupload
            $data = array (
               'id_kar'       => $idkar,
               'hari'         => $hari,
               'tgl'          => $ctgl,
               'keterangan'   => $alasan,
               'suratmc'      => $gambar,
               'apv'          => "null",
               'status'       => "N"
            );
            $this->M_Aproject->add_isak('tb_ijinsakit',$data);
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect ('C_Personal/isak');
         } else {
            $error =  $this->upload->display_errors();
            echo print_r($error);
         }
      }else{
         echo "<script>
         alert ('Tidak ada file di upload');
         window.location='".site_url('C_Personal/isak')."';
         </script>";
      }
   }

   // Aprove Ijin Sakit
   public function apvIsak($id)
   {
      $apv = $this->fungsi->user_login()->nickname;
      $data = array ('apv' => $apv, 'status'=> "Y" );
      $where = array ('id_sakit' => $id);

      $this->M_Aproject->apvIsak($where,$data);
      $this->session->set_flashdata('flash','Disetujui');
      redirect ('C_Personal/isak');
   }

   // Hapus data /  cancel pengajuan ijin sakit
   public function batalIsak($id)
   {
      $apv = $this->fungsi->user_login()->nickname;
      $data = array ('apv' => $apv, 'status'=> "C" );
      $where = array ('id_sakit' => $id);

      $this->M_Aproject->batalIsak($where,$data);
      $this->session->set_flashdata('flash','Dibatalkan');
      redirect ('C_Personal/isak');
      
   }


// ============================ IJIN TIDAK MASUK /ALPA ============================
public function alpa()
{
   $data = array (
      'judul' => 'BiasHRIS | Ijin Alpa',
      'rowalpa' => $this->M_Aproject->getAlpa()
   );
   $this->template->load('template','personal/v_alpa',$data);
}

// Pengajuan ALpa
public function addalpa()
{
   $idkar =  $this->input->post('InputIdKar');
   $hari =  $this->input->post('Hari');
   $tgl =  $this->input->post('Tanggal');
   $ctgl = date('Y-m-d',strtotime($tgl));
   $alasan = $this->input->post('InputAlasan');
   $kompensasi = $this->input->post('kompensasi');
   $today = gmdate("Y-m-d", time()+60*60*7);

   $data = array(
      'id_kar' => $idkar,
      'hari' => $hari,
      'tgl' => $ctgl,
      'keterangan' => $alasan,
      'kompensasi' => $kompensasi,
      'apv' => "Null",
      'status' => "N",
      'tglstatus' => $today
   );

   $this->M_Aproject->addAlpa('tb_ijinalpa',$data);
   $this->session->set_flashdata('flash','Ditambahkan');
   redirect ('C_Personal/alpa');


}

// Batal Pengajuan
public function batalAlpa($id)
   {
      $id = decrypt_url($id);
      $apv = $this->fungsi->user_login()->nickname;
      $today = gmdate("Y-m-d", time()+60*60*7);
      $data = array (
         'apv' => $apv,
         'status'=> "C",
         'tglstatus' => $today
      );
      $where = array ('id_alpa' => $id);

      $this->M_Aproject->batalAlpa($where,$data);
      $this->session->set_flashdata('flash','Dibatalkan');
      redirect ('C_Personal/alpa');
      
   }

// Approval Pengajuan

public function apvAlpa($id)
{
   $id = decrypt_url($id);
   $apv = $this->fungsi->user_login()->nickname;
   $today = gmdate("Y-m-d", time()+60*60*7);
   $data = array (
      'apv' => $apv,
      'status'=> "Y",
      'tglstatus' => $today
   );
   $where = array ('id_alpa' => $id);

   $this->M_Aproject->apvAlpa($where,$data);
   $this->session->set_flashdata('flash','Disetujui');
   redirect ('C_Personal/alpa');
}




// ============================ IJIN PULANG CEPAT ============================

   public function pulcep()
   {
      $data = array (
         'judul' => 'BiasHRIS | Ijin Pulang Cepat',
         'rowipul' => $this->M_Aproject->getPulcep()
      );
      $this->template->load('template','personal/v_pulcep',$data);
   }

   // Tambah data ijin pulang cepat

   public function addPulcep()
   {
      $tgl = $this->input->post('tanggal');
      $ctgl = date('Y-m-d',strtotime($tgl));
      $hari = $this->input->post('hari');
      $jam = $this->input->post('jam');
      $note = $this->input->post('keterangan');
      $idkar = $this->input->post('idkar');

      $data = array (
         'hari' => $hari,
         'tanggal' => $ctgl,
         'jam' => $jam,
         'alasan' => $note,
         'apv1' => "null",
         'apv2' => "null",
         'status' => "N",
         'id_kar' => $idkar
      );

      $query = $this->M_Aproject->addPulcep('tb_ijinpulcep',$data);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect ('C_Personal/pulcep');
   }
   // Approval atasan ijin pulang cepat
   public function apvPulcep1($id)
   {
      $apv = $this->fungsi->user_login()->nickname;
      $data = array ('apv1' => $apv );
      $where = array ('id_ipul' => $id);

      $this->M_Aproject->updatePulcep($where,$data);
      $this->session->set_flashdata('flash','Disetujui');
      redirect ('C_Personal/pulcep');
   }
   // Approval atasan ijin pulang cepat
   public function apvPulcep2($id)
   {
      $apv = $this->fungsi->user_login()->nickname;
      $data = array ('apv2' => $apv, 'status' => "Y" );
      $where = array ('id_ipul' => $id);

      $this->M_Aproject->updatePulcep($where,$data);
      $this->session->set_flashdata('flash','Disetujui');
      redirect ('C_Personal/pulcep');
   }

   // Hapus data /  cancel pengajuan ijin sakit
   public function batalIpul($id)
   {
      $apv = $this->fungsi->user_login()->nickname;
      $data = array ('apv2'=>$apv, 'status'=> "C" );
      $where = array ('id_ipul' => $id);

      $this->M_Aproject->updatePulcep($where,$data);
      $this->session->set_flashdata('flash','Dibatalkan');
      redirect ('C_Personal/pulcep');
      
   }

// ============================ Data Pribadi ====================================
// Cetak Data Pribadi =>> Page data pribadi
   function data_pri()
   {
      $id = $this->fungsi->user_login()->id_kar;
      $data = array (
         'judul' => "BiasHRIS | Data Pribadi",
         'rowfam' => $this->M_Aproject->getFam(),
         'rowplam' => $this->M_Aproject->getPlam(),
         'rowdoc' => $this->M_Aproject->getDoc(),
         'rownip' => $this->M_Aproject->getNip($id),
      );
      $this->template->load('template','personal/v_pribadi',$data);
   }

   // Edit Data PRibadi
   public function updatePri()
   {
      $id = $this->input->post('idpri');
      $nama = $this->input->post('nama');
      $alamat = $this->input->post('alamat');
      $telp = $this->input->post('telp');
      $tempat = $this->input->post('tempat');
      $tgllahir = $this->input->post('tgllahir');
      $tgllhr = date('Y-m-d', strtotime($tgllahir));
      $genre = $this->input->post('genre');
      $status = $this->input->post('status');
      $negara = $this->input->post('negara');
      $agama = $this->input->post('agama');

      $data = array (
         'fullname' => $nama,
         'genre' => $genre,
         'alamat' => $alamat,
         'telp' => $telp,
         'tempat' => $tempat,
         'tgllahir' => $tgllhr,
         'martial' => $status,
         'agama' => $agama,
         'negara' => $negara
      );
      $where = array ('id_kar' => $id);

      $query = $this->M_Aproject->updatePri($data,$where,'tb_karyawan');
      $this->session->set_flashdata('flash','Diubah');
      redirect ('C_Personal/data_pri');
   }

   // Ganti Foto =>> Page Data PRibadi
   function gantifoto()
   {
      $config ['upload_path']    = './uploads/image/';
      $config['allowed_types']   = 'png|jpg|jpeg';
      $config['max_size']        = 2048;
      $config['file_name']       = $this->fungsi->user_login()->nickname;
      $config['overwrite']       = TRUE;

      $this->load->library('upload');
		$this->upload->initialize($config);
      if(!empty($_FILES['fotoku']['name'])){
         if ($this->upload->do_upload('fotoku'))
         {
            $gbr = $this->upload->data();
            $gambar=$gbr['file_name']; //Mengambil file name dari gambar yang diupload
            $foto = array ('foto' => $gambar);
            $id=strip_tags($this->input->post('id'));
            
            $this->M_Aproject->uploadFoto($id,$foto);
            $this->session->set_flashdata('flash','Diubah');
            // echo "Upload Berhasil";
            redirect ('C_Personal/data_pri');
         }else{
               $error =  $this->upload->display_errors();
               echo print_r($error);
               }
      }else{
         echo "<script>
         alert ('Tidak ada file di upload');
         window.location='".site_url('C_Personal/data_pri')."';
         </script>";
      }
   }

   // Tambah Anggota Keluarga =>> Page Data Pribadi
   public function addFamily()
   {
      $nama = $this->input->post('nama');
      $hub = $this->input->post('hubungan');
      $alamat = $this->input->post('alamat');
      $telp = $this->input->post('telp');
      $kar = $this->input->post('idkar');
      $genre = $this->input->post('genre');

      $data = array(
         'nama' => $nama,
         'jenkel' => $genre,
         'hubungan' => $hub,
         'rumah' => $alamat,
         'hp' => $telp,
         'id_kar' => $kar
      );

      $query = $this->M_Aproject->addFamily('tb_keluarga',$data);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect ('C_Personal/data_pri');

   }

   // UPdate data keluarga =>> Page Data Pribadi
   public function updateFamily()
   {
      $id = $this->input->post('idkel');
      $nama = $this->input->post('nama');
      $hub = $this->input->post('hubungan');
      $alamat = $this->input->post('alamat');
      $telp = $this->input->post('telp');
      $genre = $this->input->post('genre');

      $data = array(
         'nama' => $nama,
         'hubungan' => $hub,
         'rumah' => $alamat,
         'hp' => $telp,
         'jenkel' => $genre
      );

      $where = array ('id_kel' => $id);

      $query = $this->M_Aproject->updateFamily($data,$where,'tb_keluarga');
      $this->session->set_flashdata('flash','Diubah');
      redirect ('C_Personal/data_pri');
   }

   // Tambah data Pengalaman Kerja =>> Page Data Pribadi
   public function addJobstory()
   {
      $perusahaan = $this->input->post('nama');
      $jabatan = $this->input->post('jabatan');
      $durasi = $this->input->post('durasi');
      $awal = $this->input->post('awal');
      $akhir = $this->input->post('akhir');
      $idkar = $this->input->post('idkar');

      $data = array (
         'perusahaan' => $perusahaan,
         'posisi' => $jabatan,
         'durasi' => $durasi,
         'tahun_masuk' => $awal,
         'tahun_keluar' => $akhir,
         'id_kar' => $idkar
      );

      $query = $this->M_Aproject->addJobStory('tb_pengalaman',$data);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect ('C_Personal/data_pri');
   }
   
   // Edit Data pengalamann kerja =>>Page Data Pribadi
   public function updateJobstory()
   {
      $idplam = $this->input->post('idplam');
      $perusahaan = $this->input->post('nama');
      $jabatan = $this->input->post('jabatan');
      $durasi = $this->input->post('durasi');
      $awal = $this->input->post('awal');
      $akhir = $this->input->post('akhir');

      $data = array (
         'perusahaan' => $perusahaan,
         'posisi' => $jabatan,
         'durasi' => $durasi,
         'tahun_masuk' => $awal,
         'tahun_keluar' => $akhir,
      );

      $where = array ('id_plam' => $idplam);

      $query = $this->M_Aproject->updateJobStory($data,$where,'tb_pengalaman');
      $this->session->set_flashdata('flash','Diubah');
      redirect ('C_Personal/data_pri');
   }

   // Tambah data Dokumen pribadi
   public function addDok()
   {
      $no = $this->input->post('nodoc') ;
      $tipe = $this->input->post('jenisdoc');
      $idkar = $this->input->post('idkar');

      $config ['upload_path']    = './uploads/documents/';
      $config['allowed_types']   = 'pdf'; // hanya file PDF
      // $config['allowed_types']   = 'pdf|jpg|jpeg|png';
      $config['max_size']        = 1024;
      $config['file_name']       = $tipe.$this->fungsi->user_login()->nickname;
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
               'id_kar' => $idkar
            );
            $this->M_Aproject->addDok('tb_docprivate',$data);
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect ('C_Personal/data_pri');
         } else {
            $error =  $this->upload->display_errors();
            echo print_r($error);
         }
      }else{
         echo "<script>
         alert ('Tidak ada file di upload');
         window.location='".site_url('C_Personal/data_pri')."';
         </script>";
      }
      
   }

   // Edit Data Dokumen  Pribadi
   public function updateDok()
   {
      $id = $this->input->post('iddoc') ;
      $no = $this->input->post('nodoc') ;
      $tipe = $this->input->post('jenisdoc');
      $idkar = $this->input->post('idkar');

      $data = array (
         'nodoc' => $no,
         'typedoc' => $tipe,
         'namadoc' => $gambar,
         'id_kar' => $idkar
      );
      $where = array ('id_doc' => $id);
      $this->M_Aproject->updateDok($where,$data);
      $this->session->set_flashdata('flash','Diubah');
      redirect ('C_Personal/data_pri');
         
   }

   // Hapus Data Dokumen Pribadi

   public function delDoc($id)
   {
      $this->M_Aproject->delDok($id);
      $this->session->set_flashdata('flash','Dihapus');
      redirect ('C_Personal/data_pri');
   }

   // detail data dokumen - menampilkan dokumen pribadi
   public function myDoc($id)
   {
      $id = decrypt_url($id);
      $data = array(
         'judul' => "BiasHRIS | Dokumen Pribadi",
         'rowdok' => $this->M_Aproject->getDok($id)
      );
      $this->template->load('template','personal/v_mydoc',$data);
   }

   // detail data dokumen - menampilkan dokumen surat MC
   public function suratMC($id)
   {
      $data = array (
         'judul' => "BiasHRIS | Surat MC",
         'rowisak' => $this->M_Aproject->mcLetter($id) 
      );
      $this->template->load('template','personal/v_mc',$data);
   }
#=============================== Halaman Dashboard ===============================
   // Proses Absensi Hadir
   public function absenHadir()
   {
      $jamin = gmdate("G:i:s", time()+60*60*7);
      $tgl = gmdate("Y-m-d", time()+60*60*7);
      $day = gmdate("l",time()+60*60*7);
      $idkar = $this->fungsi->user_login()->id_kar;
      $ip = $this->input->ip_address();

      if ($day == "Friday") {
         $jammasuk= strtotime('07:35');
      }else if($day == "Monday" || $day == "Tuesday" || $day == "Wednesday" || $day == "Thursday") {$jammasuk= strtotime('08:05');} //nilai default jam masuk
      
      if(strtotime(gmdate("G:i", time()+60*60*7)) <= $jammasuk ){
         $status = "1";
      } else $status = "2"; //kondisi 1 = ontime; 2 = terlambat

      if($day == "Saturday" || $day == "Sunday"){
         $status = "1";}

      #meyimpan data untuk table absensi dengankondisi weekday atau weekend
      if($day == "Saturday" || $day == "Sunday"){
         $data = array  (
            'tgl' => $tgl,
            'hari' => $day,
            'jam_masuk' => $jamin,
            'jam_pulang' => "null",
            'id_kar' => $idkar,
            'absen_status' => "1",
            'ipaddress' => $ip
         );
      }else{
         $data = array  (
            'tgl' => $tgl,
            'hari' => $day,
            'jam_masuk' => $jamin,
            'jam_pulang' => "null",
            'id_kar' => $idkar,
            'absen_status' => $status,
            'ipaddress' => $ip
         );
      }


      $datalambat = array ( //array table ijin terlambat
         'id_kar' => $idkar,
         'hari'   => $day,
         'tgl'    => $tgl,
         'jam_masuk' => $jamin,
         'keterangan'=> "NULL",
         'apv1'   => "NULL",
         'apv2'   => "NULL",
         'comment'=> "NULL",
         'status' => "W"
      );
      $cek = $this->db->query("SELECT * FROM tb_absensi WHERE tgl='$tgl' AND id_kar='$idkar' ");
      if($cek->num_rows() != 0){
         $this->session->set_flashdata('flash_error','Ditambahkan');
         redirect ('dashboard');
      }else {
         $query = $this->M_Aproject->absenIn('tb_absensi',$data);
         if($status == "2"){
            $querylambat = $this->M_Aproject->logLambat('tb_ijinlambat',$datalambat);            
         }
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect ('dashboard');
      }
   }

   // proses Absensi Pulang
   public function absenPulang($id)
   {
      $jampul = gmdate("G:i:s", time()+60*60*7);
      $data = array ('jam_pulang' => $jampul );
      $where = array ('id_absen' => $id);

      $cek = $this->db->query("SELECT * FROM tb_absensi WHERE id_absen=$id AND jam_pulang='null' ");
      if($cek->num_rows() <= 0){
         $this->session->set_flashdata('flash_error','Ditambahkan');
         redirect ('dashboard');
      }else {
         $query = $this->M_Aproject->absenHome($where,$data,'tb_absensi');
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect ('dashboard');
      }
   }

   // Proses Absen Istirahat Mulai
   public function breakOn()
   {
      $breakstart = gmdate("G:i:s", time()+60*60*7);
      $tgl = gmdate("Y-m-d", time()+60*60*7);
      $idkar = $this->fungsi->user_login()->id_kar;
      $ip = $this->input->ip_address();
      $status = "ON";
      
      $data = array (
         'tgl_break'    => $tgl,
         'start_break'  => $breakstart,
         'end_break'    => "NULL",
         'id_kar'       => $idkar,
         'break_status' => $status,
         'ipaddress'    => $ip
      );

      $cek = $this->db->query("SELECT * FROM tb_absen_istirahat WHERE tgl_break='$tgl' AND id_kar='$idkar' ");
      if($cek->num_rows() != 0){
         $this->session->set_flashdata('flash_break_error','Ditambahkan');
         redirect ('dashboard');
      }else {
         $query = $this->M_Aproject->breakOn('tb_absen_istirahat',$data);
         $this->session->set_flashdata('flash_break','Ditambahkan');
         redirect ('dashboard');
      }
   }

   // Proses Absen istirahat Selesai
   public function breakOff($id)
   {
      $id = decrypt_url($id);
      $breakend = gmdate("G:i:s", time()+60*60*7);
      $status = "OFF";

      $data = array (
         'end_break'    => $breakend,
         'break_status' => $status
      );
      $where = array ('id_break' => $id);

      $cek = $this->db->query("SELECT * FROM tb_absen_istirahat WHERE id_break=$id AND end_break='NULL' ");
      if($cek->num_rows() <= 0){
         $this->session->set_flashdata('flash_break_error','Ditambahkan');
         redirect ('dashboard');
      }else {
         $query = $this->M_Aproject->breakOff($where,$data,'tb_absen_istirahat');
         $this->session->set_flashdata('flash_break','Ditambahkan');
         redirect ('dashboard');
      }
   }

   #======================= /. Halaman Dashboard =======================

   // ========================== KEPEGAWAIAN =============================== //
   public function kepeg()
   {
      $id = $this->fungsi->user_login()->id_kar;
      $data = array (
         'judul' => "BiasHRIS | Data Kepegawaian",
         'rowkar' => $this->M_Aproject->getInfokar($id),//get data pegawai dari table Karyawan
         'rownip' => $this->M_Aproject->getNip($id), //get data Nip dari table KOntrak
         'rowdok' => $this->M_Aproject->getDocKar($id), //get data DOkumen Karyawan darii table dockar
         'rowhispeg' => $this->M_Aproject->getHistPeg($id), //Get Data History Kepegawaian (Jabatan, sbu, dll) tabel tb_hist_kepegawaian
         'rowhiskon' => $this->M_Aproject->getHistKon($id), //Get Data History Kontrak tabel tb_hist_kontrak
      );
      $this->template->load('template','personal/v_kepegawaian', $data);
   }

   // detail data dokumen - menampilkan dokumen pribadi
   public function docEmp($id)
   {
      
      $data = array(
         'judul' => "BiasHRIS | Dokumen Kepegawaian",
         'rowdocemp' => $this->M_Aproject->getDocEmp($id), //get data Detail DOkumen Karyawan darii table dockar
         
      );
      $this->template->load('template','personal/v_doc_emp',$data);
   }

   // ========================== ABSENSI =============================== // edit tgl 10 Des 2019

   public function absenHome()
   {
      $tgl = gmdate("Y-m-d", time()+60*60*7);
      $data = array (
         'judul' => "BiasHRIS | Absensi Karyawan",
         'dtabsen' => $this->M_Aproject->getAbsenAll($tgl) //get data absessi all
      );
      $this->template->load('template','personal/v_absen',$data);
   }

   // Proses Pengecekan Kartu dan Menampilkan Tombol Absen 
   public function cekKartuId()
   {
      $rfid = $this->input->post('id_kartu');
      $cek = $this->db->query("SELECT * FROM tb_kartu WHERE id_kartu='$rfid'");
      if($cek->num_rows() >= 1){
         $hasil = $this->M_Aproject->cekDbKartu($rfid);
         foreach ($hasil as $row){
            echo "<p><h2 style='margin-top:5px;margin-bottom:5px;text-align:center'><span class='text-success'>  $row[fullname] ! <i class='icon fa fa-check' style='margin-top:3px'></i></span></h2></p>";
            if(date("D")=="Fri"){ $jam = strtotime('07:30');} else $jam = strtotime('08:00'); //nilai default jam masuk kerja
            if(date("D")=="Fri"){ $pulang = strtotime('17:30');} else $pulang = strtotime('17:00'); //nilai default jam pulang kerja
            $sekarang =  strtotime(gmdate("G:i", time()+60*60*7)); 
            if ($sekarang <= $jam ){ echo 
               "<div class='box-body text-center'><a href='". site_url('C_Personal/absenIn/').encrypt_url($row['id_kar'])."' data-tooltip='tooltip' id='btnAbsen' title='Masuk' class='btn btn-info ' style='width:370px;height:370px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:335px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:250px;margin-top:50px'></a></div>";
            }else if($sekarang >=$jam && $sekarang <= $pulang ){echo
                  "<div class='box-body text-center'><a href='". site_url('C_Personal/absenIn/').encrypt_url($row['id_kar'])."' data-tooltip='tooltip' id='btnAbsen' title='Masuk Telat' class='btn btn-warning tombol-in' style='width:370px;height:370px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:335px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:250px;margin-top:50px'></a></div>";
            } else if($sekarang >= $pulang) {   echo 
                  "<div class='box-body text-center'><a href='". site_url('C_Personal/absenOut/').encrypt_url($row['id_kar'])."' data-tooltip='tooltip' id='btnAbsen' title='Pulang' type='button' class='btn btn-success ' style='width:370px;height:370px;padding: 10px 16px;font-size: 75px;line-height: 1.33;border-radius:335px'><img src='".base_url('assets/images/fp.png')."' alt='' style='height:250px;margin-top:50px'></a></div>";
            }
         }
         
         // echo "<span class='text-danger'>  Data Sudah Ada ! <i class='icon fa fa-ban pull-left' style='margin-top:3px'></i></span>";
      }else{
         echo "<h2 style='margin-top:5px;margin-bottom:5px;text-align:center'><span class='text-danger'> Data Kosong! <i class='icon fa fa-ban' style='margin-top:3px'></i></span></h2>";
      }
   }

   // Proses Absen In 
   public function absenIn($id)
   {
      $idkar = decrypt_url($id);
      // echo $id;

      $jamin = gmdate("G:i:s", time()+60*60*7);
      $tgl = gmdate("Y-m-d", time()+60*60*7);
      $day = gmdate("l");
      $ip = $this->input->ip_address();
      // $idkar = $this->fungsi->user_login()->id_kar;
      if ($day == "Friday") {$jammasuk= strtotime('07:30');}else  $jammasuk= strtotime('08:00'); //nilai default jam masuk
      if(strtotime(gmdate("G:i", time()+60*60*7)) <= $jammasuk ){
      $status = "1";} else $status = "2"; //kondisi 1 = ontime; 2 = terlambat

      $data = array  (
         'tgl' => $tgl,
         'hari' => $day,
         'jam_masuk' => $jamin,
         'jam_pulang' => "null",
         'id_kar' => $idkar,
         'absen_status' => $status,
         'ipaddress' => $ip
      );
      $datalambat = array ( //array table ijin terlambat
         'id_kar' => $idkar,
         'hari'   => $day,
         'tgl'    => $tgl,
         'jam_masuk' => $jamin,
         'keterangan'=> "NULL",
         'apv1'   => "NULL",
         'apv2'   => "NULL",
         'comment'=> "NULL",
         'status' => "W"
      );
      $cek = $this->db->query("SELECT * FROM tb_absensi WHERE tgl='$tgl' AND id_kar='$idkar' ");
      if($cek->num_rows() != 0){
         $this->session->set_flashdata('flashGagal','Ditambahkan');
         redirect ('C_Personal/absenHome');
      }else {
         $query = $this->M_Aproject->absenIn('tb_absensi',$data);
         if($status == "2"){
            $querylambat = $this->M_Aproject->logLambat('tb_ijinlambat',$datalambat);
         }
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect ('C_Personal/absenHome');
      }
   }

   // Proses Absen Out/Pulang
   public function absenOut($id)
   {
      $idkar = decrypt_url($id);
      $tgl = gmdate("Y-m-d", time()+60*60*7);
      $jampul = gmdate("G:i:s", time()+60*60*7);

      $data = array ('jam_pulang' => $jampul );
      $where = array (
         'id_kar' => $idkar,
         'tgl' => $tgl
      );

      $cek = $this->db->query("SELECT * FROM tb_absensi WHERE id_kar='$idkar' AND tgl='$tgl' AND jam_pulang='null' ");
      // $cek = $this->M_Aproject->cekAbsenPlg($idkar);
      if($cek->num_rows() <= 0){
         $this->session->set_flashdata('flashGagal','Ditambahkan');
         redirect ('C_Personal/absenHome');
      }else {
         $query = $this->M_Aproject->absenHome($where,$data,'tb_absensi');
         $this->session->set_flashdata('flash','Ditambahkan');
         redirect ('C_Personal/absenHome');
      }
   }

   // ========================== CUTI =============================== // edit tgl 24 Januari 2020
   public function cuti()
   {
      
      $id = $this->fungsi->user_login()->id_kar;
      $email = $this->fungsi->user_login()->email;
      $sbu = $this->fungsi->user_login()->kode;
      $sub = $this->fungsi->user_login()->sub_unt;
      $jab = $this->fungsi->user_login()->id_jab;
      $grup = $this->fungsi->user_login()->id_grup;
      // $grup = $this->fungsi->user_login()->grup;
      $data = array(
         'judul' => "BiasHRIS | Cuti Karyawan",
         'rowcutibr' => $this->M_Aproject->getCutiBr(),
         'rowjtct'   => $this->M_Aproject->getDetailJtCt($email), //get detail Jatah CUti
         'rownip'    => $this->M_Aproject->getNip($id), //get data Nip dari table KOntrak
         'noform'    => $this->M_Aproject->getNoForm(),
         'noformKs'  => $this->M_Aproject->getNoFormKs(),
         'rowcuti'   => $this->M_Aproject->getDataCuti($id), // get data table tb_cuti_karyawan
         'rowctks'   => $this->M_Aproject->getTotKs($id),
         'ctbawahan' => $this->M_Aproject->getCtBawahan($sub,$sbu,$jab,$grup), // Get Data Pengajuan Cuti Karyawan/Bawahan berdasarkan sbu dan sub unit
         //'ctbawahanGm' => $this->M_Aproject->GM_getCtBawahan($sbu), // Get Data Pengajuan Cuti Karyawan/Bawahan berdasarkan sbu dan sub unit
      
         // 'sisact'    => $this->M_Aproject->getSisaCuti($id)
         // 'rowcutiDel'=> $this->M_Aproject->getCutiDel($id) //Get data cuti untuk fungsi pembatalan pengajuan
      );
      $this->template->load('template','personal/v_cuti',$data);
   }

   // Add Pengajuan CUti Karyawan
   public function addCutiKar()
   {
      // Hidden Element
      $tipe = $this->input->post('tipect',true);
      $urutan = $this->input->post('nourut',true);
      $status = $this->input->post('statct',true);
      $nip = $this->input->post('nip',true);
      $sbu = $this->input->post('sbu',true);
      $idkar = $this->input->post('idkar',true);
      // Show Element
      $noform = $this->input->post('nocuti',true);
      $today = gmdate("Y-m-d", time()+60*60*7);
      $awal = $this->input->post('perawal',true);
      $tglawl = date("Y-m-d",strtotime($awal));
      $akhir = $this->input->post('perakhir',true);
      $tglakr = date("Y-m-d",strtotime($akhir));
      $totalhr = $this->input->post('totalhr',true);
      $ket = $this->input->post('ketcuti',true);

      // Element khusus cuti KHUSUS
      $awlct = $this->input->post('awalct',true);
      $tglawlct = date("Y-m-d",strtotime($awlct));
      $akrct = $this->input->post('akrct',true);
      $tglakrct = date("Y-m-d",strtotime($akrct));
      $totalct = $this->input->post('totalct',true);

      $sisact = $this->input->post('sisact',true);

      // data array untuk tb_cuti_karyawan (CUTI TAHUNAN)
      $data = array(
         'noform'       => $noform,
         'tglform'      => $today,
         'awal_cukar'   => $tglawl,
         'akhir_cukar'  => $tglakr,
         'ket_cukar'    => $ket,
         'tipe_cukar'   => $tipe,
         'totalhr_cukar'=> $totalhr,
         'stat_cukar'   => $status,
         'nip'          => $nip,
         'id_kar'       => $idkar,
         'sbu'          => $sbu,
         'urutan'       => $urutan
      );

      // Data array untuk tb_cuti_jatah
      $data2 = array(
         'sisa_cuti' => $sisact,
      );

      $where = array(
         'nip' => $nip,
         'c_status' => "A"
      );

       // data array untuk tb_cuti_karyawan (CUTI KHUSUS)
      $data3 = array(
         'noform'       => $noform,
         'tglform'      => $today,
         'awal_cukar'   => $tglawlct,
         'akhir_cukar'  => $tglakrct,
         'ket_cukar'    => $ket,
         'tipe_cukar'   => $tipe,
         'totalhr_cukar'=> $totalct,
         'stat_cukar'   => $status,
         'nip'          => $nip,
         'id_kar'       => $idkar,
         'sbu'          => $sbu,
         'urutan'       => $urutan
      );

      // Insert data ke table Cuti Aproval
      $data4 = array(
         'noform'    => $noform,
         'tgl_form'  => $today,
         'apv1'      => "",
         'tgl_apv1'  => "",
         'apv2'      => "",
         'tgl_apv2'  => "",
      );

      if($tipe == "TAHUNAN"){
         $this->M_Aproject->addCutiKar($data,'tb_cuti_karyawan');
         $this->M_Aproject->updateSisaCuti($where,$data2,'tb_cuti_jatah');
      }else{
         $this->M_Aproject->addCutiKarKus($data3,'tb_cuti_karyawan');
      }
      $this->M_Aproject->addApvCuti($data4,'tb_cuti_aproval');
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect ('C_Personal/cuti');
   }

   // Update Data pengjuan Cuti karyawan 
   public function updateCutiThKar()
   {
      // var_dump($_POST);
      $id = $this->input->post('idcutith');
      $awal = $this->input->post('awalth',true);
      $tglawl = date("Y-m-d",strtotime($awal));
      $akhir = $this->input->post('akhirth',true);
      $tglakr = date("Y-m-d",strtotime($akhir));
      $total = $this->input->post('totalth',true);
      $ket = $this->input->post('ketth',true);

      // Element untuk table tb_cuti_jatah
      $sisa = $this->input->post('sisath',true);
      $nip = $this->input->post('nip',true);

      // Data Table tb_cuti_karyawan
      $data = array(
         'awal_cukar'   => $tglawl,
         'akhir_cukar'  => $tglakr,
         'totalhr_cukar'=> $total,
         'ket_cukar'    => $ket
      );

      // Data Tabel Jatah CUti tb_cuti_jatah
      $data2 = array('sisa_cuti' => $sisa);
      $where = array(
         'nip' => $nip,
         'c_status' => "A"
      );
      $this->M_Aproject->updateCutiTh($data,$id,'tb_cuti_karyawan');
      $this->M_Aproject->updateSisaCuti($where,$data2,'tb_cuti_jatah');
      $this->session->set_flashdata('flash','Diubah');
      redirect ('C_Personal/cuti');
   }

   // Update Data pengajuan CUti Khusus
   public function updateCutiKs()
   {
      $id = $this->input->post('idcutiks',TRUE);
      $awal = $this->input->post('awalctks',TRUE);
      $tglawl = date("Y-m-d",strtotime($awal));
      $akhir = $this->input->post('akrctks',true);
      $tglakr = date("Y-m-d",strtotime($akhir)); 
      $total = $this->input->post('totalctks',TRUE);
      $ket = $this->input->post('ketcutiks',TRUE);

      $data3 = array (
         'awal_cukar'      => $tglawl,
         'akhir_cukar'     => $tglakr,
         'totalhr_cukar'   => $total,
         'ket_cukar'       => $ket
      );

      $this->M_Aproject->updateCutiKs($data3,$id,'tb_cuti_karyawan');
      $this->session->set_flashdata('flash','Diubah');
      redirect ('C_Personal/cuti');
   }

   public function delCutiKar()
   {
      $id = decrypt_url($this->uri->segment(3));
      $totalhr = decrypt_url($this->uri->segment(4));
      $tipe = decrypt_url($this->uri->segment(5));
      $nip = decrypt_url($this->uri->segment(6));
      $sisact = decrypt_url($this->uri->segment(7));

      $hasil = $totalhr + $sisact; // mengembeli

      // Operasi untuk table tb_cuti_karyawan
      $data = array (
         'stat_cukar' => "BATAL",
      );
      $data3 = array (
         'stat_cukar' => "BATAL",
      );

      // Operasi untuk table tb_cuti_jatah
      $data2 = array(
         'sisa_cuti' => $hasil,
      );

      $where = array(
         'nip' => $nip,
         'c_status' => "A"
      );

      if($tipe == "TAHUNAN"){
         $this->M_Aproject->updateCutiTh($data,$id,'tb_cuti_karyawan');
         $this->M_Aproject->updateSisaCuti($where,$data2,'tb_cuti_jatah');
      }else{
         $this->M_Aproject->updateCutiKs($data3,$id,'tb_cuti_karyawan');
      }
      $this->session->set_flashdata('flash','Dihapus');
      redirect ('C_Personal/cuti');   
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

      $data = array(
         'apv1'      => $nama,
         'tgl_apv1'  => $today,
         'jab_apv1'  => $jabatan
      );
      $this->M_Aproject->apvCuti($data,'tb_cuti_aproval',$noform);    
      
      $this->session->set_flashdata('flash','Disetujui');
      redirect('C_Personal/cuti'); //COntroller 

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
      // echo  "<p>$getct</p>";
      // echo  "<p>$hari</p>";
      // echo  "<p>$hasil</p>";
      // echo  "<p>$nip</p>";
      // echo  "<p>$tipe</p>";

            
      $data = array(
         'apv1'      => $nama,
         'tgl_apv1'  => $today,
         'jab_apv1'  => $jabatan
      );

      $data2 = array('stat_cukar' => "DITOLAK");

      // untuk mengembalikan nilai sisa cuti pada Table Jatah CUti
      $data3 = array('sisa_cuti' => $hasil);
      $where = array(
         'nip' => $nip,
         'c_status' => "A"
      );

      // Jika tipe pengajuan adalah TAHUNAN
      if($tipe == "TAHUNAN"){
         $this->M_Aproject->sisaCutiBack($data3,$where,'tb_cuti_jatah');   // mengembalikan hari jumlah sisa cuti pada table JATAH CUTI      
         $this->M_Aproject->apvCuti($data,'tb_cuti_aproval',$noform);      // memasukkan PIC yang menyetujui pada table PAROVAL CUTI
         $this->M_Aproject->apvCutiKar($data2,'tb_cuti_karyawan',$id);     // merubah status CUTI pada table CUTI KARYAWAN
      }else{
         $this->M_Aproject->apvCuti($data,'tb_cuti_aproval',$noform);      // memasukkan PIC yang menyetujui pada table PAROVAL CUTI
         $this->M_Aproject->apvCutiKar($data2,'tb_cuti_karyawan',$id);     // merubah status CUTI pada table CUTI KARYAWAN
      }     

      $this->session->set_flashdata('flash','Ditolak');
      redirect('C_Personal/cuti'); //COntroller 

   }

   // HALAMAN GANTI PASSWORD
   function gantiPassword()
   {
      $email = $this->fungsi->user_login()->email;
      $data = array( 
         'judul' => "BiasHRIS | Ganti Password",
         'row' => $this->M_Aproject->get_user($email)
      );
      $this->template->load('template','personal/v_gantiPass', $data);
   }

   // Proses Ganti Password
   function resetPassword(){
      $email = $this->input->post('email',TRUE);
      $pass = md5($this->input->post('newpass',TRUE));

      $data = array('password' => $pass);

      $this->M_Aproject->resetPassword($email,$data);

      $this->session->set_flashdata('flash','Dirubah');
      redirect('C_Personal/gantiPassword'); //COntroller 

   }
   // ./ HALAMAN GANTI PASSWORD



} //END OF CLASS