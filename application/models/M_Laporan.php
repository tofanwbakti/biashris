<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class M_Laporan extends CI_Model
    {
        // Get Eoc Kontrak
        public function getEocKontrak()
        {
            $this->db->select('*');
            $this->db->from('tb_kontrak');
            $this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
            $this->db->where('tb_kontrak.end <=',"CURDATE() + INTERVAL 30 DAY",false);                            
            $this->db->where('tb_karyawan.id_jab !=','J000');  
            $this->db->where('tb_karyawan.stat_kar !=','T');  
            $this->db->where('tb_kontrak.status !=','N');  
            $this->db->order_by('tb_kontrak.end','DESC');
            $this->db->get()->result();
        }
    }