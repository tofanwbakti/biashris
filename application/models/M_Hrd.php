<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

	class M_Hrd extends CI_Model 
	{
		
        // ============================ DAFTAR USER ====================================
    // Line Function Modul User
		public function getuser()
		{
			$this->db->select('*');
			$this->db->from('tb_userakses');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_userakses.email','left');
			$this->db->join('tb_level','tb_level.id_lvl=tb_userakses.id_lvl','left');
			$data = $this->db->get();
			return $data->result_array();
		}

		public function getEmailUser()
		{
			$this->db->select('*');
			$this->db->from('tb_karyawan');;
			$this->db->where('tb_karyawan.stat_kar !=',"F");
			$this->db->where('email !=',"admin@batam-samudra.id");
			$this->db->order_by('email',"ASC");
			$query2 = $this->db->get();
			return $query2->result_array();
		}

		// tambah user
		public function tambahuser($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// update user
		public function userupdate($where, $data,$table)
		{
			// $uid = $this->input->post('idakses');
			$this->db->where($where);
			$this->db->update($table,$data);
        }
        // Hapus User
		public function deluser($where,$table)
		{
			$this->db->where($where);
			$this->db->delete($table);
		}
        
        public function updatepass($where, $data,$table)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}
		
	#Halaman SBU        
        // SBU dan SUb UNit
		public function getSbu()
		{
			$this->db->select('*');
			$this->db->from('tb_sbu');
			$data = $this->db->get();
			return $data->result_array();
		}
		
		// tambah grup
		public function addGrup($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Hapus Grup
		public function delGrup($id,$table)
		{
			$this->db->where('id_grup',$id);
			$this->db->delete($table);			
		}

		// Update Data Grup
		public function updateGrup($table,$data,$where)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}

		// Update Status Grup
		public function updateStatusGrup($table,$data,$where)
		{
			$this->db->where($where);
			$this->db->update($table,$data);
		}
        
        // tambah SBU
		public function addSbu($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Ubah Data Sub Unit
		public function updateSbu($table, $data,$sbu)
		{
			$this->db->where('kode',$sbu);
			$this->db->update($table,$data);
        }

		// Hapus SBU
		public function delSbu($id,$table)
		{
			$this->db->where('kode',$id);
			$this->db->delete($table);
			
		}

		public function getSub()
		{
			$this->db->select('*');
			$this->db->from('tb_subunit');
			$this->db->join('tb_sbu','tb_sbu.kode=tb_subunit.kode','left');
			$this->db->order_by('id_sub','Desc');
			$data = $this->db->get();
			return $data->result_array();
		}

		// tambah SUb Unit
		public function addSub($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}
		
		// Ubah Data Sub Unit
		public function updateSub($table, $data,$id)
		{
			$this->db->where('id_sub',$id);
			$this->db->update($table,$data);
        }

		// Hapus SUb Unit
		public function delSub($id,$table)
		{
			$this->db->where('id_sub',$id);
			$this->db->delete($table);
			
		}

		// Hapus SUb Unit koneksi dari delete SBU
		public function delUnit($id,$table)
		{
			$this->db->where('kode',$id);
			$this->db->delete($table);
			
		}

		// Generate nomor otomatis untuk Detail Jabatan Karyawan
		public function genKodeSub()
		{
			$prfx = 'SUB';
			$query = $this->db->query("SELECT MAX(id_sub) as maxKode FROM tb_subunit"); 
			$row = $query->row_array();
			$kodeSub = $row['maxKode'];
			$noUrut = (int) substr($kodeSub,3,3);
			$noUrut++;
			$newKode = $prfx.sprintf("%03s",$noUrut);
			return $newKode;
		}


		// GRUP SBU
		// Generate nomor otomatis untuk id Group
		public function genIdGrup()
		{
			$prfx = 'G';
			$query = $this->db->query("SELECT MAX(id_grup) as maxKode FROM tb_sbu_grup"); 
			$row = $query->row_array();
			$idGrup = $row['maxKode'];
			$noUrut = (int) substr($idGrup,1,1);
			$noUrut++;
			$newId = $prfx.sprintf($noUrut);
			return $newId;
		}

		// Get Data Grup
		public function getGrup()
		{
			$this->db->select('*');
			$this->db->from('tb_sbu_grup');
			// $this->db->join('tb_sbu','tb_sbu.grup=tb_sbu_grup.kode_grup','left');
			$this->db->order_by('id_grup','ASC');
			$data = $this->db->get();
			return $data->result_array();
		}

		// Get Data Grup
		public function getGrupAktif()
		{
			$this->db->select('*');
			$this->db->from('tb_sbu_grup');
			$this->db->order_by('id_grup','ASC');
			$this->db->where('status_grup',"A");
			$data = $this->db->get();
			return $data->result_array();
		}

		// Get Data Edukasi tb_edukasi
		public function getEdu()
		{
			$this->db->select('*');
			$this->db->from('tb_edukasi');
			$this->db->order_by('id_edu','ASC');
			$data = $this->db->get();
			return $data->result_array();
		}

		// Generate nomor otomatis untuk Table Jabatan
		public function getKodeJab()
		{
			$prfx = 'J';
			$query = $this->db->query("SELECT MAX(id_jab) as maxKode FROM tb_jabatan"); 
			$row = $query->row_array();
			$kode = $row['maxKode'];
			$noUrut = (int) substr($kode,1,3);
			$noUrut++;
			$kodeJab = $prfx.sprintf("%03s",$noUrut);
			return $kodeJab;
		}

		// Gat Data Table Jabatan
		public function getJab()
		{
			$this->db->select('*');
			$this->db->from('tb_jabatan');
			$this->db->where('id_jab !=','J000'); // where not DEVELOPER
			$data = $this->db->get();
			return $data->result_array();
		}

		// Add / Tambah data table Jabatan Karyawan 
		public function addJab($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Ubah Data Jabatan Karyawan 
		public function updateJab($table, $data,$id)
		{
			$this->db->where('id_jab',$id);
			$this->db->update($table,$data);
		}

		// Hapus Data Jabatan Karyawan
		public function delJab($id,$table)
		{
			$this->db->where('id_jab',$id);
			$this->db->delete($table);
			
		}

		// Get Data Table Jabatan Detail
		public function getJail()
		{
			$this->db->select('*');
			$this->db->from('tb_jabatan_detail');
			$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_jabatan_detail.id_jab','left');
			// $this->db->join('tb_sbu','tb_sbu.kode=tb_jabatan_detail.sbu','left');
			$this->db->where('tb_jabatan_detail.aktif',"Y");
			$data = $this->db->get();
			return $data->result_array();
		}

		// Generate nomor otomatis untuk Detail Jabatan Karyawan
		public function getKodeJail()
		{
			$prfx = 'JAB';
			$query = $this->db->query("SELECT MAX(kode_jail) as maxKode FROM tb_jabatan_detail"); 
			$row = $query->row_array();
			$kodeJab = $row['maxKode'];
			$noUrut = (int) substr($kodeJab,3,3);
			$noUrut++;
			$newKode = $prfx.sprintf("%03s",$noUrut);
			return $newKode;
		}

		// Add / Tambah data Detail Jabatan Karyawan 
		public function addJail($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Ubah Data Detail Jabatan Karyawan 
		public function updateJail($table, $data,$id)
		{
			$this->db->where('id_jail',$id);
			$this->db->update($table,$data);
		}
		
		// Hapus Data Jabatan Karyawan
		public function delJail($table, $data,$id)
		{
			$this->db->where('id_jail',$id);
			$this->db->update($table,$data);
			
		}

//============= PAGE DEPARTEMEN ==================//
		
		public function getSub_Unit() // method di panggil untuk Departemen
		{
			$this->db->select('*');
			$this->db->from('tb_subunit');
			// $this->db->join('tb_sbu','tb_sbu.kode=tb_subunit.kode','left');
			$this->db->order_by('sub','ASC');
			$data = $this->db->get();
			return $data->result_array();
		}

		public function getDept()
		{
			$this->db->select('*');
			$this->db->from('tb_departemen');
			$this->db->join('tb_subunit','tb_subunit.id_sub=tb_departemen.id_sub','left');
			$this->db->order_by('id_dept','DESC');
			$data = $this->db->get();
			return $data->result_array();
		}

		// Generate nomor otomatis untuk ID DEPARTEMEN
		public function genIdDept()
		{
			$prfx = 'DEPT';
			$query = $this->db->query("SELECT MAX(id_dept) as maxKode FROM tb_departemen"); 
			$row = $query->row_array();
			$idDept = $row['maxKode'];
			$noUrut = (int) substr($idDept,4,3); // format (string , left, right)
			$noUrut++;
			$newKode = $prfx.sprintf("%03s",$noUrut);
			return $newKode;
		}

		// Get Data Departemen link Sub unit
		public function getLinkDept($id)
		{
			// $query = $this->db->query("SELECT * FROM tb_departemen WHERE id_sub='$id'");
			$query = $this->db->query("SELECT * FROM tb_departemen WHERE id_sub='$id' ORDER By nama_dept ASC");
			return $query->result_array();
			// $this->db->select('*');
			// $this->db->from('tb_departemen');
			// $this->db->join('tb_subunit','tb_subunit.id_sub=tb_departemen.id_sub','left');
			// $this->db->where('tb_subunit.id_sub',$id);
			// $query = $this->db->get();
			// return $query->result_array();
		}

		// Proses menambahkan departemen Baru
		public function addDept($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Ubah Data Detail Departemen
		public function updateDept($table, $data,$iddept)
		{
			$this->db->where('id_dept',$iddept);
			$this->db->update($table,$data);
		}

		// Hapus Data Departemen
		public function delDept($id,$table)
		{
			$this->db->where('id_dept',$id);
			$this->db->delete($table);
			
		}
//============= ./ PAGE DEPARTEMEN ==================//

//============= PAGE KARYAWAN ==================//
		// Get Data Table Karyawan
		public function getKar()
		{
			$this->db->select('*');
			$this->db->from('tb_karyawan');
			$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
			$this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
			$this->db->join('tb_sbu','tb_sbu.kode=tb_karyawan.kode','left');
			// $this->db->join('tb_sbu_grup','tb_sbu_grup.id_grup=tb_karyawan.id_grup','left');
			$this->db->where('tb_karyawan.id_jab!=',"J000"); //where bukan Developer
			$this->db->where('tb_kontrak.status',"Y");
			$this->db->order_by('tb_karyawan.id_kar','ASC');
			$data = $this->db->get();
			return $data->result_array();
		}
		// Get Data Table Karyawan EOC
		public function getKarEoc()
		{
			$this->db->select('*');
			$this->db->from('tb_karyawan');
			$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
			$this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
			$this->db->join('tb_sbu','tb_sbu.kode=tb_karyawan.kode','left');
			$this->db->where('tb_karyawan.id_jab!=',"J000"); //where bukan Developer
			$this->db->where('tb_kontrak.kontrak',"F");
			$this->db->where('tb_karyawan.stat_kar',"F");
			$this->db->order_by('tb_karyawan.id_kar','ASC');
			// $this->db->group_by('tb_kontrak.email');
			$data = $this->db->get();
			return $data->result_array();
		}

		// Tambah Data Karyawan page Karyawan
		public function addKar($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Tambah data dafta cuti Karyawan
		public function addCuti($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Tambah Data Tb KOntrak
		public function addKontrak($table,$data2)
		{
			$insert = $this->db->insert($table,$data2);
			return $data2;
		}
		// Tambah Data History Tabel KOntrak
		public function addHisKontrak($table,$data3)
		{
			$insert = $this->db->insert($table,$data3);
			return $data3;
		}

		// Get Data Sub Unit
		public function getCariSbu($id)
		{
			$query = $this->db->query("SELECT * FROM tb_sbu WHERE grup='$id'");
			return $query->result_array();
		}

		// Get Data Sub Unit
		public function getSubUnit($id)
		{
			$query = $this->db->query("SELECT * FROM tb_subunit WHERE kode='$id'");
			return $query->result_array();
		}
		// Get Data Detail Jabatan
		public function getDetailJab($id)
		{
			$query = $this->db->query("SELECT * FROM tb_jabatan_detail WHERE id_jab='$id' AND aktif='Y' ORDER BY nama_jail ASC");
			return $query->result_array();
		}

// =============== PAGE INFO KARYAWAN ============//
		// Get Data Table Karyawan page Info Karyawan
		public function getInfoKar($id)
		{
			$this->db->select('*');
			$this->db->from('tb_karyawan');
			$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');					// join ke tb_jabatan
			$this->db->join('tb_jabatan_detail','tb_jabatan_detail.kode_jail=tb_karyawan.def_jab','left');	// join ke tb_jabatan_detail
			$this->db->join('tb_sbu','tb_sbu.kode=tb_karyawan.kode','left');								// join ke tb_sbu
			$this->db->join('tb_sbu_grup','tb_sbu_grup.id_grup=tb_karyawan.id_grup','left');				// join ke tb_sbu_grup
			$this->db->join('tb_subunit','tb_subunit.id_sub=tb_karyawan.sub_unt','left'); 						// join ke tb_subunit
			$this->db->join('tb_departemen','tb_departemen.id_dept=tb_karyawan.id_dept','left'); 			// join ke tb_departemen
			// $this->db->join('tb_subunit','tb_subunit.sub=tb_karyawan.sub_unt','left');
			$this->db->where('tb_karyawan.id_kar',$id);
			$data = $this->db->get();
			return $data->result_array();
		}

		// Get data Table Kontrak 
		public function getkon($id)
		{
			$this->db->select('*');
			$this->db->from('tb_kontrak');
			// $this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_kontrak.id_kar','left');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
			$this->db->where('tb_karyawan.id_kar',$id); 
			$this->db->where('tb_kontrak.status','Y');                            
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
			$this->db->where('tb_kontrak.status',"Y");
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
			$this->db->join('tb_subunit','tb_subunit.id_sub=tb_hist_kepegawaian.sub','left');
			$this->db->join('tb_departemen','tb_departemen.id_dept=tb_hist_kepegawaian.id_dept','left'); 			// join ke tb_departemen
			$this->db->where('tb_karyawan.id_kar',$id);
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get data DOkumen Karyawan /Kepegawaian
		public function getDocKar($id)
		{
			$this->db->select('*');
			$this->db->from('tb_dockar');
			$this->db->where('email',$id);                            
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Update data Karyawan (Tab Karyawan)
		public function updateKar($id,$data,$table)
		{
			$this->db->where('id_kar',$id);
			$this->db->update($table,$data);
		}	
		// Update data Karyawan (Tab Kepegawaian)
		public function updatePeg($id,$data,$table)
		{
			$this->db->where('id_kar',$id);
			$this->db->update($table,$data);
		}	
		// Add Data history Kepegawaian (Tab Kepegawaian) dari Halaman Info/Detail Karyawan
		// Proses terikat pada controller "updatePeg"
		public function addHistPeg($table,$data2)
		{
			$insert = $this->db->insert($table,$data2);
			return $data;
		}
		// Add Data history Kepegawaian dari Halaman Daftar Karyawan (Proses Tambah Kar)
		// Proses terikat pada controller "addKar"
		public function addHisKepeg($table,$data4)
		{
			$insert = $this->db->insert($table,$data4);
			return $data;
		}
		// Update data Kontrak Karyawan (Tab kontrak Kerja)
		public function updateKon($email,$data,$table)
		{
			$this->db->where('email',$email);
			$this->db->update($table,$data);
		}

		// add Dokumen Karyawan (Tab Dokumen Kepegawaian)
		public function addPegDoc($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Hapus DOcument Karyawan
		public function delPegDoc($id,$table)
		{
			$this->db->where('id_doc',$id);
			$this->db->delete($table);
		}

		// Get Dokumen Kepegawaian dari table tb_dockar di load pada halaman dok Emp
		public function getPegDoc($id)
		{
			$this->db->select('*');
			$this->db->from('tb_dockar');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_dockar.id_kar','left');
			$this->db->where('id_doc',$id);
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Update data Tgl Bergabung dari table karyawan
		public function updateJoinDate($table,$data,$id)
		{
			$this->db->where('id_kar',$id);
			$this->db->update($table,$data);
		}

		// ./ =============== INFO KARYAWAN =====================
		
		//Get Data to Generate NIP pada view Karyawan
		public function getNip()
		{
			$today = gmdate("Y-m-d", time()+60*60*7);
			$this->db->select_max('urutan','no_urut');
			// $this->db->select_max('id_kon');
			$this->db->where('start',$today);
			$this->db->where('kontrak',"N");
			$data = $this->db->get('tb_kontrak');
			return $data->result_array();
		}

		// get Data Agama
		public function getAgm()
		{
			$this->db->select('*');
			$this->db->from('tb_agama');
			$data =  $this->db->get();
			return $data->result_array();
		}

		// ================== PAGE DETAIL KONTRAK ======================

		// Get data Table Kontrak 
		public function getDetKon()
		{
			$this->db->select('*');
			$this->db->from('tb_kontrak');
			// $this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_kontrak.id_kar','left');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
			$this->db->where('tb_kontrak.status','Y');                            
			$this->db->where('tb_karyawan.id_jab !=','J000');   
			$this->db->order_by('start',"DESC");            
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get data Table Kontrak khusus End Of Contract
		public function getEocKon()
		{
			$this->db->select('*');
			$this->db->from('tb_kontrak');
			// $this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_kontrak.id_kar','left');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
			$this->db->where('tb_kontrak.end <=',"CURDATE() + INTERVAL 60 DAY",false);                            
			$this->db->where('tb_karyawan.id_jab !=','J000');  
			$this->db->where('tb_karyawan.stat_kar !=','T');  
			$this->db->where('tb_kontrak.status !=','N');  
			$this->db->order_by('tb_kontrak.end','DESC');
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Update data Kontrak Karyawan (Tab kontrak Kerja & Page Kontrak)
		public function updateKontrak($id,$data,$table)
		{
			$this->db->where('id_kon',$id);
			$this->db->update($table,$data);
		}

		// Update data Kontrak Karyawan menjadi "P:Permanen" (page kontrak Kerja)
		public function updateKontrakTetap($id,$data,$table)
		{
			$this->db->where('id_kon',$id);
			$this->db->update($table,$data);
		}

		// Update data Status Karyawan pada tabel karyawan menjadi "P:Permanen" (page kontrak Kerja)
		public function updateStatKarTetap($email,$data3,$table)
		{
			$this->db->where('email',$email);
			$this->db->update($table,$data3);
		}

		// Update data Kontrak Karyawan menjadi "FINISH" (page kontrak Kerja)
		public function updateKontrakFinish($id,$data,$table)
		{
			$this->db->where('id_kon',$id);
			$this->db->update($table,$data);
		}

		// Update data Status Karyawan pada tabel karyawan menjadi "F/FINISH"(page kontrak Kerja)
		public function updateStatKarFinish($email,$data2,$table)
		{
			$this->db->where('email',$email);
			$this->db->update($table,$data2);
		}

		// Mengakhiri kontrak 
		public function endContract($nip,$data,$table)
		{
			$this->db->where('nip',$nip);
			$this->db->update($table,$data);
		}

		// Tambah Data History Tabel KOntrak
		public function addKontrakEoc($table,$data4)
		{
			$insert = $this->db->insert($table,$data4);
			return $data;
		}

		// get user yang sudah finish kontrak
		public function getUsrEoc()
		{
			$this->db->select('*');
			$this->db->from('tb_karyawan');
            $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
			$this->db->where('tb_karyawan.stat_kar',"F");
			$this->db->where('tb_kontrak.kontrak',"F");		
			// $this->db->group_by('tb_kontrak.email');	
			// $this->db->order_by('tb_kontrak.id_kon','DESC');
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get email karyawan EOC
		public function cekEmailEoc($id)
		{
			$this->db->select('*');
			$this->db->from('tb_karyawan');
			$this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
			$this->db->where('tb_karyawan.id_kar',$id);
			$this->db->where('tb_karyawan.stat_kar',"F");
			$this->db->where('tb_kontrak.kontrak',"F");
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get Data for Export XLSX
		// Semua Kontrak Karyawan
		public function excelKontrak(){
			// Tarik Database
			$this->db->select('*');
			$this->db->from('tb_kontrak');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
			$this->db->where('tb_kontrak.status','Y');                            
			$this->db->where('tb_karyawan.id_jab !=','J000');   
			$this->db->order_by('tb_karyawan.fullname',"ASC"); 
			$data = $this->db->get();
			return $data->result();
		}

		// Semua Kontrak Expire
		public function excelKontrakEOC(){
			// Tarik Database
			$this->db->select('*');
			$this->db->from('tb_kontrak');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
			$this->db->where('tb_kontrak.status','Y');
			$this->db->where('tb_kontrak.end <=',"CURDATE() + INTERVAL 60 DAY",false);                            
			$this->db->where('tb_karyawan.id_jab !=','J000'); 
			$this->db->where('tb_karyawan.stat_kar !=','T');  
			$this->db->order_by('tb_karyawan.fullname',"ASC"); 
			$data = $this->db->get();
			return $data->result();
		}



		// ===================== HALAMAN DASHBOARD HRD ====================

		// get data kelamin / genre dari tb_karyawan
		public function getChart1()
		{
			
			$data = $this->db->query("SELECT * FROM tb_karyawan");
			return $data->result();

		}

		// ===================== ./ HALAMAN DASHBOARD HRD ====================
		// ===================== HALAMAN Laporan ABsensi ====================

		// Get data Absensi Today tb_absensi
		public function getHadirToday()
		{
			$today = gmdate("Y-m-d", time()+60*60*7);
			$this->db->select('*');
			$this->db->from('tb_absensi');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
			// $this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
			$this->db->where('tgl',$today);
			$this->db->where('tb_absensi.id_kar!=',"1");
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get Data Absensi per Karyawan
		public function excelAbsenKar($id,$awal,$akhir)
		{
			$this->db->select('*');
			$this->db->from('tb_absensi');
			$this->db->where('id_kar',$id);
			$this->db->where('tgl >=',$awal);
			$this->db->where('tgl <=',$akhir);
			$data = $this->db->get();
			return $data->result();
		}

		// ===================== ./HALAMAN Laporan ABsensi ====================

		// ===================== HALAMAN Laporan ABsensi Karyawan ====================
		// Get data Absensi Today tb_absensi
		public function getAbsenKar($id)
		{
			$this->db->select('*');
			$this->db->from('tb_absensi');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
			$this->db->where('tb_absensi.id_kar',$id);
			$this->db->order_by('tb_absensi.id_absen',"DESC");
			$data =  $this->db->get();
			return $data->result_array();
		}

		public function getKarById($id)
		{
			$this->db->select('*');
			$this->db->from('tb_karyawan');
			$this->db->where('id_kar',$id);
			$data = $this->db->get();
			return $data->result_array();
		}

		// Get data Absensi Today tb_absensi dengan Date Range Picker
		public function getAbsenKarRange($id,$awal,$akhir)
		{
			$this->db->select('*');
			$this->db->from('tb_absensi');
			$this->db->where('tgl >=',$awal);
			$this->db->where('tgl <=',$akhir);
			$this->db->where('id_kar',$id);
			$this->db->order_by('id_absen',"DESC");
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get data Absensi Bulan Aktif
		public function getAbsenBulan($key)
		{
			$this->db->select('*');
			$this->db->from('tb_absensi');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
			$this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
			$this->db->like('tb_absensi.tgl',$key);
			$this->db->where('tb_kontrak.kontrak !=',"F");
			$this->db->order_by('tb_absensi.id_absen',"DESC");
			$data =  $this->db->get();
			return $data->result_array();
		}
		
		// ===================== ./HALAMAN Laporan Absensi User ====================
		
		// ===================== HALAMAN Laporan Absensi Karyawan ALL ====================
		// Get data Absensi Bulan Aktif
		public function getAbsenAll()
		{
			$this->db->select('*');
			$this->db->from('tb_absensi');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absensi.id_kar','left');
			$this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
			$this->db->order_by('tb_absensi.id_absen',"DESC");
			$data =  $this->db->get();
			return $data->result_array();
		}

		// ===================== /. HALAMAN Laporan /. Absensi Karyawan ALL ====================

		// ============ HALAMAN LAPORAN ISTIRAHAT ========================
		// Get Semua Data Istirahat Karyawan
		public function getBreakAll()
		{
			$this->db->select('*');
			$this->db->from('tb_absen_istirahat');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absen_istirahat.id_kar','left');
			$this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
			$this->db->where('tb_karyawan.id_kar !=',"1");
			$this->db->order_by('tb_absen_istirahat.id_break',"DESC");
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get Semua data istirahat Karyawan Hari ini
		public function getBreakToday($today)
		{
			$this->db->select('*');
			$this->db->from('tb_absen_istirahat');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_absen_istirahat.id_kar','left');
			$this->db->join('tb_kontrak','tb_kontrak.email=tb_karyawan.email','left');
			$this->db->where('tb_absen_istirahat.tgl_break',$today);
			$this->db->where('tb_karyawan.id_kar !=',"1");
			$this->db->order_by('tb_absen_istirahat.id_break',"DESC");
			$data =  $this->db->get();
			return $data->result_array();
		}

		// ============ /. HALAMAN LAPORAN ISTIRAHAT ========================
		
		// ===================== HALAMAN Laporan Kontrak Karyawan ====================

		// Get data Table Kontrak 
		public function getkon2()
		{
			$this->db->select('*');
			$this->db->from('tb_kontrak');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
			$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
			$this->db->where('tb_kontrak.status','Y');  
			$this->db->where('tb_kontrak.kontrak !=','P');  
			$this->db->where('tb_karyawan.id_kar !=','1');  
			$this->db->order_by('id_kon','DESC');
			$data =  $this->db->get();
			return $data->result_array();
		}
		// Get data Table Kontrak 
		public function getkonFil($sbu,$jab,$awal,$akhir)
		{
			if(($sbu == "EMPTY") && ($jab == "EMPTY")) {
				$this->db->select('*');
				$this->db->from('tb_kontrak');
				$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
				$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
				$this->db->where('tb_kontrak.status','Y');  
				$this->db->where('tb_kontrak.kontrak !=','P');  
				$this->db->where('tb_karyawan.id_kar !=','1');
				// $this->db->like('tb_karyawan.kode',$sbu);
				// $this->db->like('tb_karyawan.id_jab',$jab);
				$this->db->where('tb_kontrak.start >=',$awal);
				$this->db->where('tb_kontrak.start <=',$akhir);  
				$this->db->order_by('id_kon','DESC');
				$data =  $this->db->get();
				return $data->result_array();
			}else if($sbu == "EMPTY"){
				$this->db->select('*');
				$this->db->from('tb_kontrak');
				$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
				$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
				$this->db->where('tb_kontrak.status','Y');  
				$this->db->where('tb_kontrak.kontrak !=','P');  
				$this->db->where('tb_karyawan.id_kar !=','1');
				// $this->db->like('tb_karyawan.kode',$sbu);
				$this->db->like('tb_karyawan.id_jab',$jab);
				$this->db->where('tb_kontrak.start >=',$awal);
				$this->db->where('tb_kontrak.start <=',$akhir);  
				$this->db->order_by('id_kon','DESC');
				$data =  $this->db->get();
				return $data->result_array();
			}else if($jab == "EMPTY"){
				$this->db->select('*');
				$this->db->from('tb_kontrak');
				$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
				$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
				$this->db->where('tb_kontrak.status','Y');  
				$this->db->where('tb_kontrak.kontrak !=','P');  
				$this->db->where('tb_karyawan.id_kar !=','1');
				$this->db->like('tb_karyawan.kode',$sbu);
				// $this->db->like('tb_karyawan.id_jab',$jab);
				$this->db->where('tb_kontrak.start >=',$awal);
				$this->db->where('tb_kontrak.start <=',$akhir);  
				$this->db->order_by('id_kon','DESC');
				$data =  $this->db->get();
				return $data->result_array();
			}else {
				$this->db->select('*');
				$this->db->from('tb_kontrak');
				$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','left');
				$this->db->join('tb_jabatan','tb_jabatan.id_jab=tb_karyawan.id_jab','left');
				$this->db->where('tb_kontrak.status','Y');  
				$this->db->where('tb_kontrak.kontrak !=','P');  
				$this->db->where('tb_karyawan.id_kar !=','1');
				$this->db->like('tb_karyawan.kode',$sbu);
				$this->db->like('tb_karyawan.id_jab',$jab);
				$this->db->where('tb_kontrak.start >=',$awal);
				$this->db->where('tb_kontrak.start <=',$akhir);  
				$this->db->order_by('id_kon','DESC');
				$data =  $this->db->get();
				return $data->result_array();
			}
			
		}
		
		// =====================./ HALAMAN Laporan Kontrak Karyawan ====================

		// ===================== HALAMAN Daftar Kartu ID ==================== (Update versi 20.01) ditulis 30-12-19

		// get user untuk pendaftaran kartu ID
		public function getUsrAll()
		{
			$this->db->select('*');
			$this->db->from('tb_karyawan');
			$this->db->where('id_jab !=',"J000");
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get Karyawan yang sudah memiliki Kartu RFID
		public function getCard()
		{
			$this->db->select('*');
			$this->db->from('tb_kartu');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_kartu.id_kar','left');
			$this->db->where('tb_karyawan.id_jab !=',"J000");
			$this->db->order_by('addtgl','DESC');
			$data = $this->db->get();
			return $data->result_array();
		}
		// Get Karyawan yang sudah memiliki Kartu RFID
		public function getCardSorted()
		{
			$bulanini = gmdate("m", time()+60*60*7);
			$this->db->select('*');
			$this->db->from('tb_kartu');
			$this->db->like('addtgl',$bulanini);
			$this->db->order_by('addtgl','DESC');
			$data = $this->db->get();
			return $data->result_array();
		}

		// Proses Tambah Kartu untuk karyawan
		public function addCard($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Proses Hapus Kartu ID Karyawan
		public function delCard($rfid,$table)
		{
			$this->db->where('id_kartu',$rfid);
			$this->db->delete($table);
		}

		// ===================== ./ HALAMAN Daftar Kartu ID ==================== 

		// ===================== HALAMAN Manajemen Cuti Karyawan ==================== Update untuk versi 20.01 (ditulis tgl 3/02/2020)
		// Index View Cuti
		// Get Data Cuti Tahunan
		public function getCutiTahunan()
		{
			$this->db->select('*');
			$this->db->from('tb_cuti_karyawan');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_cuti_karyawan.id_kar','LEFT');
			$this->db->where('tipe_cukar',"TAHUNAN");
			$this->db->where('stat_cukar !=',"BATAL");
			$this->db->order_by('id_cukar',"DESC");
			$data = $this->db->get();
			return $data->result_array();
		}

		// Get Data Cuti Khusus
		public function getCutiKhusus()
		{
			$this->db->select('*');
			$this->db->from('tb_cuti_karyawan');
			$this->db->join('tb_karyawan','tb_karyawan.id_kar=tb_cuti_karyawan.id_kar','LEFT');
			$this->db->where('tipe_cukar',"KHUSUS");
			$this->db->where('stat_cukar !=',"BATAL");
			$this->db->order_by('id_cukar','DESC');
			$data = $this->db->get();
			return $data->result_array();
		}

		// // Get Data Nik Karyawan Aktif
		// public function getNikKarAktif()
		// {
		// 	$this->db->select('*');
		// 	$this->db->from('tb_kontrak');
		// 	$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','LEFT');
		// 	$this->db->where('tb_kontrak.kontrak !=','F');
		// 	$this->db->where('tb_karyawan.id_jab !=','J000');
		// 	$this->db->order_by('tb_kontrak.email',"ASC");
		// 	$data = $this->db->get();
		// 	return $data->result_array();
		// }

		// Proses Aproval
		public function apvCuti($data,$table, $noform)
		{
			$this->db->where('noform',$noform);
			$this->db->update($table,$data);
		}

		// Proses Perubahan Status Pengajuan Cuti Karyawan (MENUGGU -> DISETUJUI)
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

		// Get Jatah Cuti pada operasi tambah cuti karyawan khusus potong cuti
		public function getJatahCuti($postData=array())
		{	
			$response = array();
		
			if(isset($postData['id']) ){
		
			// Select record
			$this->db->select('*');
			$this->db->from('tb_cuti_jatah');
			$this->db->join('tb_kontrak','tb_kontrak.nip=tb_cuti_jatah.nip','INNER');
			$this->db->join('tb_karyawan','tb_karyawan.email=tb_kontrak.email','INNER');
			$this->db->where('id_cutijt', $postData['id']);
			$this->db->where('c_status', "A");
			$this->db->where('tb_karyawan.stat_kar !=', "F");
			$records = $this->db->get();
			$response = $records->result_array();
		
			}
		
			return $response;
		}

		// Add Cuti Karyawan (Operasi Potong Karyawan)
		public function addCutiKar($data2,$table)
		{
			$this->db->insert($table,$data2);
			return $data;
		}

		// Add Cuti untuk Kasus POTONG CUTI KARYAWAN
		public function addCutiApv($data3,$table)
		{
			$this->db->insert($table,$data3);
			return $data;
		}
	// ===================== ./ HALAMAN Manajemen Cuti Karyawan ==================== 

	// ===================== HALAMAN Data Cuti Karyawan ==================== 

		// Get Cuti Bersama
		public function getCutiBr()
		{
			$this->db->select('*');
			$this->db->from('tb_cuti_bersama');
			$this->db->where('status',"A");
			// $this->db->where('id_cuti',"3");
			$data =  $this->db->get();
			return $data->result_array();
		}


		// LAIN2 
		// Get NIK Aktif
		public function getNikAktif()
		{
			$this->db->select('*');
			$this->db->from('tb_kontrak');
			$this->db->join('tb_cuti_jatah','tb_cuti_jatah.nip=tb_kontrak.nip','left');
			$this->db->where('tb_cuti_jatah.c_status', "A");
			$this->db->where('tb_kontrak.kontrak !=', "F");
			$this->db->where('tb_kontrak.nip !=', "0000000");
			$this->db->order_by('tb_kontrak.email','ASC');
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Get Jatqh Cuti untuk TAB CUTI AKTIF
		public function getJtCutiAktif()
		{
			$today = gmdate("Y-m-d", time()+60*60*7);
			$this->db->select('*');
			$this->db->from('tb_cuti_jatah');
			$this->db->join('tb_kontrak','tb_kontrak.nip=tb_cuti_jatah.nip','left');
			$this->db->join('tb_cuti_bersama','tb_cuti_bersama.id_cuti=tb_cuti_jatah.c_bersama','INNER');
			// $this->db->where('tb_cuti_jatah.per_akhir >= ',$today);
			$this->db->where('tb_cuti_jatah.c_status','A');
			$data =  $this->db->get();
			return $data->result_array();
		}
		// Get Jatqh Cuti untuk TAB CUTI NONAKTIF
		public function getJtCutiNonaktif()
		{
			$today = gmdate("Y-m-d", time()+60*60*7);
			$this->db->select('*');
			$this->db->from('tb_cuti_jatah');
			$this->db->join('tb_kontrak','tb_kontrak.nip=tb_cuti_jatah.nip','left');
			$this->db->join('tb_cuti_bersama','tb_cuti_bersama.id_cuti=tb_cuti_jatah.c_bersama','INNER');
			// $this->db->where('tb_cuti_jatah.per_akhir <= ',$today);
			$this->db->where('tb_cuti_jatah.c_status','D');
			$data =  $this->db->get();
			return $data->result_array();
		}
		// Get Jatqh Cuti untuk TAB CUTI BARU
		public function getJtCutiBaru()
		{
			$this->db->select('*');
			$this->db->from('tb_cuti_jatah');
			$this->db->join('tb_kontrak','tb_kontrak.nip=tb_cuti_jatah.nip','left');
			// $this->db->join('tb_cuti_bersama','tb_cuti_bersama.id_cuti=tb_cuti_jatah.c_bersama','INNER');
			$this->db->where('tb_cuti_jatah.c_status','N');
			$data =  $this->db->get();
			return $data->result_array();
		}

		// Tambah data CUti Bersama
		public function addCutiBersama($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// Edit Data Cuti Bersama
		public function updateCutiBersama($table,$data,$id)
		{
			$this->db->where('id_cuti',$id);
			$this->db->update($table,$data);
		}

		// Edit Data Jatah CUti (satu proses dengan edit cuti bersama)
		public function updateJtCuti($table,$data2,$id)
		{
			$this->db->where('c_bersama',$id);
			$this->db->update($table,$data2);
		}

		// Delete Data Cuti Bersama
		public function delCutiBersama($id,$table)
		{
			$this->db->where('id_cuti',$id);
			$this->db->delete($table);
		}

		
		// Update Jatah CUti
		public function updateCutiJatah($table,$data,$id)
		{
			$this->db->where('id_cutijt',$id);
			$this->db->update($table,$data);
		}
		// Update Jatah CUti menjadi Nonaktif
		public function updateCutiJatahNonaktif($table,$data,$id)
		{
			$this->db->where('id_cutijt',$id);
			$this->db->update($table,$data);
		}

		// Delete Data Cuti Bersama
		public function delCutiNonaktif($id,$table)
		{
			$this->db->where('id_cutijt',$id);
			$this->db->delete($table);
		}

		// Tambah CUti Baru
		public function addCutiBaru($table,$data)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		// CEk Detail Cuti Bersama
		function getCuberDetails($postData=array())
		{	
			$response = array();
		
			if(isset($postData['id_cuti']) ){
		
			// Select record
			$this->db->select('*');
			$this->db->where('id_cuti', $postData['id_cuti']);
			$records = $this->db->get('tb_cuti_bersama');
			$response = $records->result_array();
		
			}
		
			return $response;
		}

		// Cek Detal Cuti Jatah
		public function getJatahDetails($postData=array())
		{
			$response = array();

			if(isset($postData['id'])){
				// select record
				$this->db->select('*');
				$this->db->from('tb_cuti_jatah');
				$this->db->join('tb_cuti_bersama','tb_cuti_bersama.id_cuti=tb_cuti_jatah.c_bersama','INNER');
				$this->db->where('tb_cuti_jatah.c_bersama',$postData['id']);
				$record = $this->db->get();
				$response = $record->result_array();
			}
			return $response;
		}


	// ===================== ./HALAMAN Data Cuti Karyawan ==================== 
	
	
	}
	
/* End of file M_Hrd.php */
/* Location: ./application/models/M_Hrd.php */