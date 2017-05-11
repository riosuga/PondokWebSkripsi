<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtd_guru_kompetensi extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function addTdGuruKompetensi($data){
		$this->db->insert('td_guru_kompentensi', $data);
		return $this->db->insert_id();
	}

	public function updateTdGuruKompetensi($where,$data){
		$this->db->update('td_guru_kompentensi', $data,$where);
		return $this->db->affected_rows();
	}

	public function deleteTdGuruKompetensi($id){
		$this->db->where('id_guru', $id);
		$this->db->delete('td_guru_kompentensi');
	}
}

/* End of file Mtd_guru_kompetensi.php */
/* Location: ./application/models/Mtd_guru_kompetensi.php */