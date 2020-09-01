<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

	class M_Dev extends CI_Model 
	{
        public function getVersi()
        {
            $this->db->select('*');
            $this->db->from('tb_zhistdev');
            $this->db->order_by('id','DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->result();
        }

        public function getJob()
        {
            $this->db->select('*');
            $this->db->from('tb_zhistdev');
            $this->db->order_by('id','DESC');
            $query = $this->db->get();
            return $query->result();
        }
        public function addJob($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}
    }