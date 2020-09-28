<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Developer extends CI_Controller{

   public function __construct()
   {
      parent::__construct();
      cek_nologin();
      cek_admin();  
      // cek_admin2(); 
      $this->load->model('M_Dev');
      // $this->output->enable_profiler(TRUE);
      
   }
   public function index()
   {
      $idkar = $this->fungsi->user_login()->id_kar;
      $data = array (
         'judul' => "BiasHRIS | Dashboard",
         // 'versi' => $this->M_Dev->getVersi(),
         'rowjob' => $this->M_Dev->getJob()
      );
      $this->template->load('template', 'developer/dashboard',$data);
   } 

   public function addJob()
   {
      $tgl = gmdate("Y-m-d", time()+60*60*7);
      $desk = $this->input->post('job');
      // $versi = $this->input->post('versi');

      $data= array (
         'tgl' => $tgl,
         'rinci' => $desk
      );

      $query = $this->M_Dev->addJob('tb_zhistdev',$data);
      $this->session->set_flashdata('flash','Ditambahkan');
      redirect('Developer');
   }

# Halaman Log User Login
   public function logUserLogin()
   {
      $data = array (
         'judul' => "BiasHRIS | Log User Login",
         'row'   => $this->M_Dev->getLogin(),
      );
      $this->template->load('template', 'developer/userlogin',$data);
      
   }

   // Turn OFF login user
   public function turnOffLogin()
   {
      $email = decrypt_url($this->uri->segment(3));
      // echo $email;
      $data = array ('status' => "OFF");
      $where = array ('email' => $email);

      $query = $this->M_Dev->turnOffLogin('tb_login',$data,$where);
      $this->session->set_flashdata('flash','Diubah');
      redirect ('Developer/logUserLogin');

   }
# /. Halaman Log User Login

}