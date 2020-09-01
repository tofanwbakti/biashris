<?php

Class Fungsi {

    protected $CI;

    function __construct(){
        $this->ci =&  get_instance();
    }

    function user_login(){
        $this->ci->load->model('M_Aproject');
        $user_id = $this->ci->session->userdata('iduserakses'); //iduserakses adalah session yang di dapat dari controller C_Auth
        $user_data = $this->ci->M_Aproject->get($user_id)->row();
        return $user_data;
    }


}