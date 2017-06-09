<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_test extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getDataGuru(){
		$this->db->select('*');
		$this->db->from('td_guru');
		$this->db->join('td_santri', 'td_guru.id_guru = td_santri.id_santri');
		$query = $this->db->get();
		return $query->result_array();
	}
	

}

/* End of file M_test.php */
/* Location: ./application/models/M_test.php */