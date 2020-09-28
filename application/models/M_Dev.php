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
        
        public function getLogin()
        {
            $this->db->select('*');
            $this->db->from('tb_login');
            $this->db->order_by('date_login',"DESC");
            // $this->db->where('status',"ON");
            $query = $this->db->get();
            return $query->result();
        }

        public function turnOffLogin($table,$data,$where)
        {
            $this->db->where($where);
			$this->db->update($table,$data);
        }
    }