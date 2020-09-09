<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

	class M_Aproject extends CI_Model 
	{

		public function login($post)
		{
			$this->db->select('*');
			$this->db->from('tb_userakses');
			$this->db->where('email',$post['email']);
			$this->db->where('password',md5($post['pass']));

			$query = $this->db->get();
			return $query;


		}

		public function loginAdd($data){
			$insert = $this->db->insert('tb_login',$data);
			return $data;
		}

		public function loginUpdate($where,$data,$table){
			$this->db->where($where);
			$this->db->update($table,$data);
		}
//fungsi untuk cetak session
		public function get ($id=null)
		{
			$this->db->select('*');
			$this->db->from('tb_userakses');
			$this->db->join('tb_login','tb_login.email=tb_userakses.email','left');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_userakses.email','left');
			$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
			$this->db->join('tb_sbu_grup','tb_sbu_grup.id_grup=tb_karyawan.id_grup','left');
			if ($id != null){
				$this->db->where('id_uakses',$id);
			}
			$query = $this->db->get();
			return $query;

		}

		// update data ketika session expired
		public function sessionOff($email,$data)
		{
			$this->db->where($email);
			$this->db->update('tb_login',$data);
		}

// ============================ IJIN KELUAR ====================================
// Cetak database Ijin keluar
		public function get_ikel()
		{
			$id = $this->fungsi->user_login()->email;
			$id2 =  $this->fungsi->user_login()->id_lvl; //level tb_level
			$sbu =  $this->fungsi->user_login()->kode;
			$sub =  $this->fungsi->user_login()->sub_unt;
			$jab =  $this->fungsi->user_login()->id_jab;
			$dept = $this->fungsi->user_login()->id_dept;
			$grup = $this->fungsi->user_login()->id_grup;

			$this->db->select('*');
			$this->db->from('tb_ijinkeluar');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_ijinkeluar.id_kar','left');
			$this->db->join('tb_userakses','tb_userakses.email=tb_karyawan.email','left');
			$this->db->order_by('id_ikel','DESC');
			
			if ($id2 == "A5"){ // level karyawan
				$this->db->where('tb_userakses.email',$id); // berdasarkan email user
			}else if (($id2 == "A4") && ($jab == "J008") ){ # J008 adalah level manager
				$this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_dept',$dept); // berdasarkan departemen karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J007"); // berdasarkan jabatan karyawan
				$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
			}else if (($id2 == "A4") && ($jab == "J006")){ #jabatan direktur
				$this->db->where('tb_karyawan.id_grup',$grup); // berdasarkan SBU karyawan
			}else if(($id2 == "A4") && ($jab == "J007")){ #jabatan GM
				// $this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				// $this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_grup',$grup); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J006"); // berdasarkan bukan jabatan diatasnya
				$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
			}
			$query = $this->db->get();
			return $query;
		}
// Fungsi tambah pengajuan ijin keluar
		public function addikel($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}


		public function updateIkel($data,$where)
		{
			$this->db->where($where);
			$this->db->update('tb_ijinkeluar',$data);
		}

		public function approve2($data,$where,$table)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}

		// Batal pengajuan ijin Keluar
		public function batalIkel($where,$data,$table)
		{
			$this->db->where($where);
			$this->db->update('tb_ijinkeluar',$data);

		}


// ============================ IJIN TERLAMBAT ====================================

		// Get data to load at View
		public function get_lambat()
		{
			$id = $this->fungsi->user_login()->id_kar;
			$email = $this->fungsi->user_login()->email;
			$level =  $this->fungsi->user_login()->id_lvl;		
			$sbu =  $this->fungsi->user_login()->kode;
			$sub =  $this->fungsi->user_login()->sub_unt;
			$jab =  $this->fungsi->user_login()->id_jab;
			$dept = $this->fungsi->user_login()->id_dept;

			$this->db->select('*');
			$this->db->from('tb_ijinlambat');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_ijinlambat.id_kar','left');
			$this->db->join('tb_userakses','tb_userakses.email=tb_karyawan.email','left');
			$this->db->order_by('tb_ijinlambat.id_ila','DESC');
			if ($level == "A5"){ //karyawan
				$this->db->where('tb_userakses.email',$email);
			}else if(($level == "A4") && ($jab == "J008") ){ //Atasan level Manager
				$this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J007"); // berdasarkan jabatan karyawan
				#$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
				$this->db->where('tb_karyawan.id_dept',$dept); // berdasarkan departemen karyawan
			}else if (($level == "A4") && ($jab == "J006")){ #jabatan direktur
				$this->db->where('tb_karyawan.id_grup',$grup); // berdasarkan SBU karyawan
			}else if(($level == "A4") && ($jab == "J007")){ #jabatan GM
				$this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J006"); // berdasarkan bukan jabatan diatasnya
				$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
			}
			$query = $this->db->get();
			return $query->result_array();
		}

		// menyimpan data terlambat
		public function logLambat($table,$datalambat)
		{
			$insert = $this->db->insert($table,$datalambat);
			return $datalambat;
		}

		// Meyimoan alasan terlambat
		public function addComment($table,$data,$where)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}

		// Menyimpan User Aprover
		public function apvLambat($table,$data,$where)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}

// ============================ IJIN SAKIT ====================================
// Cetak ijin sakit
		public function get_sakit()
		{
			$id = $this->fungsi->user_login()->email;
			$id2 =  $this->fungsi->user_login()->id_lvl;		
			$sbu =  $this->fungsi->user_login()->kode;
			$sub =  $this->fungsi->user_login()->sub_unt;
			$jab =  $this->fungsi->user_login()->id_jab;
			$dept = $this->fungsi->user_login()->id_dept;

			$this->db->select('*');
			$this->db->from('tb_ijinsakit');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_ijinsakit.id_kar','left');
			$this->db->join('tb_userakses','tb_userakses.email=tb_karyawan.email','left');
			$this->db->order_by('id_sakit','DESC');
			if ($id2 == "A5"){ // level karyawan
				$this->db->where('tb_userakses.email',$id); // berdasarkan email user
			}else if (($id2 == "A4") && ($jab == "J008") ){ # J008 adalah level manager
				$this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_dept',$dept); // berdasarkan departemen karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J007"); // berdasarkan jabatan karyawan
				$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
			}else if (($id2 == "A4") && ($jab == "J006")){ #jabatan direktur
				$this->db->where('tb_karyawan.id_grup',$grup); // berdasarkan SBU karyawan
			}else if(($id2 == "A4") && ($jab == "J007")){ #jabatan GM
				$this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J006"); // berdasarkan bukan jabatan diatasnya
				$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
			}
			$query = $this->db->get();
			return $query;
		}
		// Tambah data pengajuan ijin sakit
		public function add_isak($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}
		// Persetujuan pengajuan ijin sakit
		public function apvIsak($where,$data)
		{
			$this->db->where($where);
			$this->db->update('tb_ijinsakit',$data);

		}
		// Batal pengajuan ijin sakit
		public function batalIsak($where,$data)
		{
			$this->db->where($where);
			$this->db->update('tb_ijinsakit',$data);

		}

// ============================ IJIN TIDAK MASUK / ALPA ===============================
		public function getAlpa()
		{
			$id = $this->fungsi->user_login()->email;
			$id2 =  $this->fungsi->user_login()->id_lvl;		
			$sbu =  $this->fungsi->user_login()->kode;
			$sub =  $this->fungsi->user_login()->sub_unt;
			$jab =  $this->fungsi->user_login()->id_jab;
			$dept = $this->fungsi->user_login()->id_dept;
			$grup = $this->fungsi->user_login()->id_grup;

			$this->db->select('*');
			$this->db->from('tb_ijinalpa');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_ijinalpa.id_kar','left');
			$this->db->join('tb_userakses','tb_userakses.email=tb_karyawan.email','left');
			$this->db->order_by('id_alpa','DESC');
			
			if ($id2 == "A5"){ // level karyawan
				$this->db->where('tb_userakses.email',$id); // berdasarkan email user
			}else if (($id2 == "A4") && ($jab == "J008") ){ # J008 adalah level manager
				$this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_dept',$dept); // berdasarkan departemen karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J007"); // berdasarkan jabatan karyawan
				$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
			}else if (($id2 == "A4") && ($jab == "J006")){ #jabatan direktur
				$this->db->where('tb_karyawan.id_grup',$grup); // berdasarkan SBU karyawan
			}else if(($id2 == "A4") && ($jab == "J007")){ #jabatan GM
				$this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J006"); // berdasarkan bukan jabatan diatasnya
				$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
			}
			// $id = $this->fungsi->user_login()->email;
			// $id2 =  $this->fungsi->user_login()->id_lvl;		
			// $sbu =  $this->fungsi->user_login()->kode;

			// $this->db->select('*');
			// $this->db->from('tb_ijinalpa');
			// $this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_ijinalpa.id_kar','left');
			// $this->db->join('tb_userakses','tb_userakses.email=tb_karyawan.email','left');
			// $this->db->order_by('id_alpa','DESC');
			
			// if ($id2 == "A5"){
			// 	$this->db->where('tb_userakses.email',$id);
			// }
			// if ($sbu != "NUL"){
			// 	$this->db->where('tb_karyawan.kode',$sbu);
			// }
			// $this->db->where('status',"y");
			$query = $this->db->get();
			return $query->result_array();
		}

		// Tambah data pengajuan ijin alpa
		public function addAlpa($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Batal pengajuan ijin Alpa
		public function batalAlpa($where,$data)
		{
			$this->db->where($where);
			$this->db->update('tb_ijinalpa',$data);
		}

		// Setujui pengajuan ijin Alpa
		public function apvAlpa($where,$data)
		{
			$this->db->where($where);
			$this->db->update('tb_ijinalpa',$data);
		}


// ============================ IJIN PULANG CEPAT ===============================
		public function getPulcep()
		{
			$id = $this->fungsi->user_login()->email;
			$id2 =  $this->fungsi->user_login()->id_lvl;		
			$sbu =  $this->fungsi->user_login()->kode;
			$sub =  $this->fungsi->user_login()->sub_unt;
			$jab =  $this->fungsi->user_login()->id_jab;
			$dept = $this->fungsi->user_login()->id_dept;

			$this->db->select('*');
			$this->db->from('tb_ijinpulcep');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_ijinpulcep.id_kar','left');
			$this->db->join('tb_userakses','tb_userakses.email=tb_karyawan.email','left');
			$this->db->order_by('id_ipul','DESC');
			if ($id2 == "A5"){ // level karyawan
				$this->db->where('tb_userakses.email',$id); // berdasarkan email user
			}else if (($id2 == "A4") && ($jab == "J008") ){ # J008 adalah level manager
				$this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_dept',$dept); // berdasarkan departemen karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J007"); // berdasarkan jabatan karyawan
				$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
			}else if (($id2 == "A4") && ($jab == "J006")){ #jabatan direktur
				$this->db->where('tb_karyawan.id_grup',$grup); // berdasarkan SBU karyawan
			}else if(($id2 == "A4") && ($jab == "J007")){ #jabatan GM
				$this->db->where('tb_karyawan.kode',$sbu); // berdasarkan SBU karyawan
				$this->db->where('tb_karyawan.sub_unt',$sub); // berdasarkan sub unit karyawan
				$this->db->where('tb_karyawan.id_jab !=',"J006"); // berdasarkan bukan jabatan diatasnya
				$this->db->or_like('tb_karyawan.email',$id); // berdasarkan email user
			}		
			$query = $this->db->get();
			return $query;
		}

		// add data ijin pulang cepat
		public function addPulcep($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Aproval ijin pulang cepat dari atasan 
		public function updatePulcep($where,$data)
		{
			$this->db->where($where);
			$this->db->update('tb_ijinpulcep',$data);
		}
		

// ============================ DASHBOARD ====================================
		// Edit Data Pribadi
		public function updatePri($data,$where,$table)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}

		// Cetak data keluarga
		public function getFam()
		{
			$kar = $this->fungsi->user_login()->id_kar;
			$this->db->select('*');
			$this->db->from('tb_keluarga');
			$this->db->join('tb_karyawan','tb_keluarga.id_kar=tb_karyawan.id_kar','left' );
			$this->db->where('tb_keluarga.id_kar',$kar);
			$data = $this->db->get();
			return $data->result_array();
		}
		// Cetak data pengalaman Kerja
		public function getPlam()
		{
			$kar = $this->fungsi->user_login()->id_kar;
			$this->db->select('*');
			$this->db->from('tb_pengalaman');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_pengalaman.id_kar','left' );
			$this->db->where('tb_pengalaman.id_kar',$kar);
			$data = $this->db->get();
			return $data->result_array();
		}

		// Cetak data dokumen pribadi
		public function getDoc()
		{
			$kar = $this->fungsi->user_login()->id_kar;
			$this->db->select('*');
			$this->db->from('tb_docprivate');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_docprivate.id_kar','left' );
			$this->db->where('tb_docprivate.id_kar',$kar);
			$data = $this->db->get();
			return $data->result_array();
		}

		// Tambah Anggota Keluarga
		public function addFamily($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Edit Data ANggota Keluarga
		public function updateFamily($data,$where,$table)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}

		// Tambah data Pengalaman Kerja
		public function addJobStory($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Edit Data PEngalaman Kerja
		public function updateJobStory($data,$where,$table)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}

		// Tambah data DOkument pribadi
		public function addDok($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Ganti Data Dokumen Pribadi
		public function updateDok($where,$data)
		{
			$this->db->where($where);
			$this->db->update('tb_docprivate',$data);
		}

		public function delDok($id)
		{
			$this->db->where('id_doc',$id);
			$this->db->delete('tb_docprivate');
		}

		public function getDok($id)
		{
			$this->db->select('*');
			$this->db->from('tb_docprivate');
			$this->db->join('tb_karyawan', 'tb_karyawan.id_kar=tb_docprivate.id_kar','left');
			$this->db->where('id_doc',$id);
			$data = $this->db->get();
			return $data->result_array();
		}

		// Ganti PAssword
		public function updatepass($where, $data,$table)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}
		// Ganti Foto
		public function uploadFoto($id,$foto)
		{
			$this->db->where('id_kar',$id);
			$this->db->update('tb_karyawan',$foto);
		}


		// Surat MC
		public function mcLetter($id)
		{
			$this->db->select('*');
			$this->db->from('tb_ijinsakit');
			$this->db->join('tb_karyawan', 'tb_karyawan.id_kar=tb_ijinsakit.id_kar','left');
			$this->db->where('id_sakit',$id);
			$data = $this->db->get();
			return $data->result_array();
		}
		
		// Get Data Absen
		public function getAbsen($idkar)
		{
			$this->db->select('*');
			$this->db->from('tb_absensi');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
			$this->db->where('tb_absensi.id_kar',$idkar);
			$this->db->order_by('id_absen','DESC');
			$data = $this->db->get();
			return $data->result_array();
		}
		// Get Data Absen
		public function getProsen($idkar)
		{
			
			$this->db->select('*');
			$this->db->from('tb_absensi');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
			$this->db->where('tb_absensi.id_kar',$idkar);
			$this->db->order_by('id_absen','DESC');
			$this->db->limit(1);
			$data = $this->db->get();
			return $data->result_array();
		}

		// Absen IN
		public function absenIn($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Absen Pulang
		public function absenHome($where, $data,$table)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}

	// ============================ KEPEGAWAIAN ====================================
		// Get Data Karyawan
		public function getInfoKar($id)
		{
			$this->db->select('*');
			$this->db->from('tb_karyawan');
			$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
			$this->db->join('tb_jabatan_detail','tb_jabatan_detail.kode_jail=tb_karyawan.def_jab','left');
			$this->db->join('tb_sbu','tb_sbu.kode=tb_karyawan.kode','left');
			$this->db->join('tb_subunit','tb_subunit.id_sub=tb_karyawan.sub_unt','left'); 						// join ke tb_subunit
			$this->db->join('tb_departemen','tb_departemen.id_dept=tb_karyawan.id_dept','left'); 			// join ke tb_departemen
			$this->db->where('tb_karyawan.id_kar',$id);
			$data = $this->db->get();
			return $data->result_array();
		}
		
		// Get Data NIP dari table Kontrak
		public function getNip($id)
		{
			$this->db->select('*');
			$this->db->from('tb_kontrak');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
			$this->db->where('tb_karyawan.id_kar',$id);
			$this->db->where('status','Y');                            
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get data DOkumen Karyawan /Kepegawaian
		public function getDocKar($id)
		{
			$this->db->select('*');
			$this->db->from('tb_dockar');
			$this->db->where('id_kar',$id);                            
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get data Histori Kepegawaian (Jabtan, SBU, dll) dari table hist_kepegawaian
		public function getHistPeg($id)
		{
			$this->db->select('*');
			$this->db->from('tb_hist_kepegawaian');
			$this->db->join('tb_kontrak','tb_kontrak.nip=tb_hist_kepegawaian.nip','left');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
			$this->db->join('tb_jabatan_detail','tb_jabatan_detail.kode_jail=tb_hist_kepegawaian.def_jab','left');
			$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_hist_kepegawaian.jab','left');
			$this->db->join('tb_subunit','tb_subunit.sub=tb_hist_kepegawaian.sub','left');
			$this->db->join('tb_departemen','tb_departemen.id_dept=tb_hist_kepegawaian.id_dept','left'); 			// join ke tb_departemen
			$this->db->where('tb_karyawan.id_kar',$id);
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get data Histori Kontrak dari table hist_kontrak
		public function getHistKon($id)
		{
			$this->db->select('*');
			$this->db->from('tb_hist_kontrak');
			$this->db->join('tb_kontrak','tb_kontrak.nip=tb_hist_kontrak.nip','left');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
			$this->db->where('tb_karyawan.id_kar',$id);
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get data DOkumen Karyawan /Kepegawaian Secara Detail 
		public function getDocEmp($id)
		{
			$this->db->select('*');
			$this->db->from('tb_dockar');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_dockar.id_kar','left');
			$this->db->where('id_doc',$id);                            
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Halaman Absensi Karyawan
		// Get Database Kartu RFID
		public function cekDbKartu($rfid)
		{
			$this->db->select('*');
			$this->db->from('tb_kartu');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_kartu.id_kar','left');
			$this->db->where('tb_kartu.id_kartu',$rfid);
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get Data Absen
		public function getAbsenAll($tgl)
		{
			$this->db->select('*');
			$this->db->from('tb_absensi');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
			$this->db->where('tb_absensi.tgl',$tgl);
			$this->db->where('tb_karyawan.id_jab !=',"J000");
			$this->db->order_by('id_absen','DESC');
			$data = $this->db->get();
			return $data->result_array();
		}

		// ----------KEPEGAWAIAN -> CUTI ---------------
		// Get data Cuti bersama (Tabel tb_cuti_bersama)
		public function getCutiBr() //[rowcutibr]
		{
			$tahun = gmdate("Y");
			$this->db->select('*');
			$this->db->from('tb_cuti_bersama');
			$this->db->where('status',"A");
			$this->db->where('tahun',$tahun);
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get data cuti karaywan (Table tb_cuti_karyawan)
		public function getDataCuti($id) // [rowcuti]
		{
			$this->db->select('*');
			$this->db->from('tb_cuti_karyawan');
			$this->db->join('tb_cuti_aproval','tb_cuti_aproval.noform=tb_cuti_karyawan.noform','INNER');
			$this->db->where('id_kar',$id);
			$this->db->where('stat_cukar !=','BATAL');
			$this->db->order_by('id_cukar','DESC');
			$data =  $this->db->get();
			return $data->result_array();

		}

		// Get Detail Jatah Cuti (Tabel tb_cuti_jatah)
		public function getDetailJtCt($email) //[rowjtct]
		{
			$this->db->select('*');
			$this->db->from('tb_cuti_jatah');
			$this->db->join('tb_kontrak','tb_kontrak.nip=tb_cuti_jatah.nip','LEFT');
			$this->db->join('tb_cuti_bersama','tb_cuti_bersama.id_cuti=tb_cuti_jatah.c_bersama','INNER');
			$this->db->where('tb_kontrak.email',$email);
			$this->db->where('tb_cuti_jatah.c_status','A');
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get data untuk hitung total cuti Khusus
		public function getTotKs($id)
		{
			$this->db->select_sum('totalhr_cukar');
			$this->db->where('id_kar',$id);
			$this->db->where('tipe_cukar',"KHUSUS");
			$this->db->where('stat_cukar',"DISETUJUI");
			$data = $this->db->get('tb_cuti_karyawan');
			if($data->num_rows()>0){
				return $data->row()->totalhr_cukar;
			}else{
				return 0;
			}
		}

		// Get Data Pengajuan Cuti Karyawan/Bawahan berdasarkan sbu dan sub unit
		public function getCtBawahan($sub,$sbu,$jab,$grup)
		{
			$this->db->select('*');
			$this->db->from('tb_cuti_karyawan');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_cuti_karyawan.id_kar','INNER');
			$this->db->join('tb_cuti_aproval','tb_cuti_aproval.noform=tb_cuti_karyawan.noform','INNER');
			$this->db->join('tb_sbu','tb_sbu.kode=tb_karyawan.kode','INNER');
			if(($jab == "J002") || ($jab == "J003")){ // Jika Jabatan CHAIRMAN atau VICE CHAIRMAN
				$this->db->where('tb_karyawan.id_jab',"J003");		// Jabatan Vice Chairman
				$this->db->or_where('tb_karyawan.id_jab',"J004");	// Jabatan CEO
				$this->db->or_where('tb_karyawan.id_jab',"J005");	// Jabatan Vice CEO
				$this->db->or_where('tb_karyawan.id_jab',"J006");	// Jabatan DIRECTOR
				// $this->db->or_where('tb_karyawan.id_jab',"J007");	// Jabatan GM/Kadiv
				// $this->db->or_where('tb_karyawan.id_jab',"J008");	// Jabatan Manager

			}elseif(($jab == "J004") || ($jab == "J005")){ // JIka jabatan CEO atau vice CEO
				$this->db->where('tb_karyawan.id_jab',"J005");	// Jabatan Vice CEO
				$this->db->or_where('tb_karyawan.id_jab',"J006");	// Jabatan DIRECTOR
				$this->db->or_where('tb_karyawan.id_jab',"J007");	// Jabatan GM/Kadiv
				$this->db->or_where('tb_karyawan.id_jab',"J008");	// Jabatan Manager

			}elseif($jab == "J006"){ // Jika Jabatan DIRECTOR
				// $this->db->where('tb_sbu.grup',"3");		// Jabatan GM/Kadiv
				$this->db->where('tb_karyawan.id_jab',"J007");		// Jabatan GM/Kadiv
				$this->db->or_where('tb_karyawan.id_jab',"J008");	// Jabatan Manager
				$this->db->where('tb_karyawan.id_grup',$grup);

			}elseif($jab == "J007"){ // Jabatan GENERAL MANAGER
				$this->db->where('tb_karyawan.id_jab !=',"J007");	// Jabatan GManager
				$this->db->where('tb_karyawan.id_jab',"J008");	// Jabatan Manager
				$this->db->where('tb_karyawan.id_grup',$grup);
				$this->db->or_where('tb_karyawan.id_jab',"J009");	// Jabatan SUPERVISOR
				// $this->db->where('tb_karyawan.kode',$sbu);
				$this->db->where('tb_karyawan.id_grup',$grup);
				// $this->db->or_where('tb_sbu.grup',"3");
				// $this->db->or_where('tb_karyawan.id_jab',"J010");	// Jabatan STAFF
				
			}else{ // lainnya adalah jabatan Manager
				$this->db->where('tb_karyawan.id_jab !=',$jab);
				$this->db->where('tb_karyawan.kode',$sbu);
				$this->db->where('tb_karyawan.sub_unt',$sub);
			}
			$this->db->where('stat_cukar !=','BATAL');
			$this->db->order_by('id_cukar','DESC');
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Update SIsa Jatah cuti (Tabel tb_cuti_jatah)
		public function updateSisaCuti($where,$data2,$table)
		{
			$this->db->where($where);
			$this->db->update($table,$data2);
		}

		// Membuat nomot form pengajuan otomatis
		public function getNoForm()
		{
			$this->db->select_max('urutan');
			$this->db->order_by('urutan','DESC');
			$this->db->where('tipe_cukar','TAHUNAN');
			$this->db->limit(1);
			$data = $this->db->get('tb_cuti_karyawan');
			return $data->result_array();
		}
		// Membuat nomot form pengajuan otomatis (CUTI KHUSUS)
		public function getNoFormKs()
		{
			$this->db->select_max('urutan');
			$this->db->order_by('urutan','DESC');
			$this->db->where('tipe_cukar','KHUSUS');
			$this->db->limit(1);
			$data = $this->db->get('tb_cuti_karyawan');
			return $data->result_array();
		}

		// Add Data Cuti Karyawan (TAHUNAN)
		public function addCutiKar($data,$table)
		{
			$this->db->insert($table,$data);
			return $data;
		}
		// Add Data Cuti Karyawan (KHUSUS)
		public function addCutiKarKus($data3,$table)
		{
			$this->db->insert($table,$data3);
			return $data3;
		}

		// Add Data Cuti untuk table CUti Aproval
		public function addApvCuti($data4,$table)
		{
			$this->db->insert($table,$data4);
			return $data4;
		}

		// Update Cuti Tahunan
		public function updateCutiTh($data,$id,$table)
		{
			$this->db->where('id_cukar',$id);
			$this->db->update($table,$data);
		}
		
		// Update CUti Khusus
		public function updateCutiKs($data3,$id,$table)
		{
			$this->db->where('id_cukar',$id);
			$this->db->update($table,$data3);
		}

		// Proses Aproval
		public function apvCuti($data,$table, $noform)
		{
			$this->db->where('noform',$noform);
			$this->db->update($table,$data);
		}

		// Proses Perubahan Status Pengajuan Cuti Karyawan (MENUNGGU -> DITOLAK)
		public function apvCutiKar($data2,$table,$id)
		{
			$this->db->where('id_cukar',$id);
			$this->db->update($table,$data2);
		}

		// Proses mengembalikan data SISA CUTI jika pengajuan DITOLAK ATASAN
		public function sisaCutiBack($data3,$where,$table)
		{
			$this->db->where($where);
			$this->db->update($table,$data3);
		}

		// ----------GANTI PASSWORD ---------------

		public function get_user($email)
		{
			$this->db->select('*');
			$this->db->from('tb_userakses');
			$this->db->where('email',$email);
			$data = $this->db->get();
			return $data->result_array();
			
		}

		// Proses Ganti Password
		public function resetPassword($email,$data){
			$this->db->where('email',$email);
			$this->db->update('tb_userakses',$data);
		}
// ==================================== LAPORAN =====================================
		// Get data cuti karaywan ALL  (Table tb_cuti_karyawan) "UNTUK CETAK REPORT
		public function getDataCutiAll($id) 
		{
			$this->db->select('*');
			$this->db->from('tb_cuti_karyawan');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_cuti_kar.id_kar','LEFT');
			$this->db->where('id_kar',$id);
			$this->db->order_by('id_cukar','DESC');
			$data =  $this->db->get();
			return $data->result_array();

		}

	}
