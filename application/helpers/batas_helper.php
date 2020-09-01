<?php

function cek_yeslogin(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('email');
    if ($user_session) {
        redirect ('Dashboard');
    }
}

function cek_nologin(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('email');
    if (!$user_session) {
        redirect ('Auth');
    }
}

function cek_admin(){
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if($ci->fungsi->user_login()->id_lvl == "A2"){
        redirect('Dashboard');
    }
}

function cek_admin2()
{
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if($ci->fungsi->user_login()->id_lvl == "A4" ){
    redirect('Dashboard');
    }
}

function cek_admin3()
{
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if($ci->fungsi->user_login()->id_lvl == "A5" ){
    redirect('Dashboard');
    }
}

// Cek jika user telah logout maka semua perangkat login akan di logout
function cek_logout(){
    $ci = & get_instance();
    $ci->load->library('fungsi');
    if($ci->fungsi->user_login()->status != "ON"){
        session_unset();
        redirect('Auth');
    }
}
    
    
