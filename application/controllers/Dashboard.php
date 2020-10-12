<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller{

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
   public function index()
   {
      $idkar = $this->fungsi->user_login()->id_kar;

      $data = array (
         'judul' => "BiasHRIS | Dashboard",
         'row' => $this->M_Aproject->get_ikel(),
         'rowabs' => $this->M_Aproject->getAbsen($idkar),
         'rowpab' => $this->M_Aproject->getProsen($idkar),
         'rowbreak' => $this->M_Aproject->getBreak($idkar),
         'rowDtBreak' => $this->M_Aproject->getDtBreak($idkar),
      );
      $this->template->load('template', 'dashboard',$data);
   } 
}