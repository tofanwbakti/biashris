<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller
{

    function __contruct(){
        parent :: __contruct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('session');
        // $this->output->enable_profiler(TRUE);
    }
// LOAD Index page start
    public function index()
    {
        cek_yeslogin();
        $this->load->view('v_login2');
        $this->session->sess_destroy();
    }
// Proses login start
    public function proceed()
    {

        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])){
            $this->load->model('M_Aproject');
            $query_login = $this->M_Aproject->login($post);
            if ($query_login->num_rows()> 0){
                $row = $query_login->row();
                $params = array(
                    'iduserakses' => $row->id_uakses,
                    'email' => $row->email,
                    'level' =>$row->id_lvl
                );
                $this->session->set_userdata($params);
                // Insert into tb_login
                $cek = $this->db->query("SELECT * FROM tb_login WHERE email='$row->email'");
                if($cek->num_rows() == 0){
                    $data = array (
                        'email' => $row->email,
                        'time_login' => gmdate("G:i:s", time()+60*60*7),
                        'date_login' => gmdate("Y-m-d", time()+60*60*7),
                        'status' => "ON"
                    );
                    $this->M_Aproject->loginAdd($data);
                }else{
                    $where = array(
                        'email' => $row->email
                    );
                    $data = array ( 
                        'time_login' => gmdate("G:i:s", time()+60*60*7),
                        'date_login' => gmdate("Y-m-d", time()+60*60*7),
                        'status' => "ON"
                    );
                    $this->M_Aproject->loginUpdate($where,$data,'tb_login');
                }
                // -----
                echo "<script>
                    alert ('Selamat, login berhasil');
                    window.location='".site_url('Dashboard')."';
                </script>";
            }            
            else{
                echo "<script>
                    alert ('Login Gagal');
                    window.location='".site_url('Auth')."';
                </script>";
            }

        }
    }   
// Proses Logout start
    function logout(){
        $where = array(
            'email' => $this->fungsi->user_login()->email
        );
        $data = array ( 
            'time_login' => gmdate("G:i:s", time()+60*60*7),
            'date_login' => gmdate("Y-m-d", time()+60*60*7),
            'status' => "OFF"
        );
        
        $this->M_Aproject->loginUpdate($where,$data,'tb_login');
        $this->session->sess_destroy();
        //$url=base_url('');
        redirect('Auth');
    }

     // update data ketika session expired
    function sessionOff(){
        $email= array('email' => $this->fungsi->user_login()->email);

        $data = array ( 
            'time_login' => gmdate("G:i:s", time()+60*60*7),
            'date_login' => gmdate("Y-m-d", time()+60*60*7),
            'status' => "OFF"
        );

        $this->M_Aproject->sessionOff($email,$data);
        redirect('Auth');
    }
}
