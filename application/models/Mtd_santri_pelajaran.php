<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtd_santri_pelajaran extends CI_Model {
	var $table = 'td_santri_pelajaran';
	var $column_order = array('tr_pelajaran.uraian',
	'td_santri.nama',
	'td_kelas_ta.tahun',
	'td_kelas_ta.semester',
	'tr_kelas.nama_kelas',
	'td_guru.nama',
	'td_bayanat.nomor',
	'td_bayanat.tgl_ujian',
	'td_bayanat.tgl_remed',
	'tr_nilai.uraian',
	'td_santri_nilai.nilai_awal',
	'td_santri_nilai.nilai_akhir',
	'td_santri_nilai.nilai_remed',null); //set column field database for datatable orderable
	var $column_search = array('tr_pelajaran.uraian',
	'td_santri.nama',
	'td_kelas_ta.tahun',
	'td_kelas_ta.semester',
	'tr_kelas.nama_kelas',
	'td_guru.nama',
	'td_bayanat.nomor',
	'td_bayanat.tgl_ujian',
	'td_bayanat.tgl_remed',
	'tr_nilai.uraian',
	'td_santri_nilai.nilai_awal',
	'td_santri_nilai.nilai_akhir',
	'td_santri_nilai.nilai_remed'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id_santri' => 'desc'); // default order 
	var $id_santri;
	/*
	select 
	tr_pelajaran.uraian as nama_pelajaran,
	td_santri.nama as nama_santri,
	td_kelas_ta.tahun,
	td_kelas_ta.semester,
	tr_kelas.nama_kelas,
	td_guru.nama as nama_guru,
	td_bayanat.nomor,
	td_bayanat.tgl_ujian,
	td_bayanat.tgl_remed,
	tr_nilai.uraian as uraian_nilai,
	td_santri_nilai.nilai_awal,
	td_santri_nilai.nilai_akhir,
	td_santri_nilai.nilai_remed
	from td_santri_pelajaran
	join td_santri_kelas on td_santri_pelajaran.id_santri_kelas = td_santri_kelas.id_santri_kelas 
	join td_kelas_ta on td_santri_kelas.id_ta = td_kelas_ta.id_ta
	join td_guru on td_santri_pelajaran.id_guru = td_guru.id_guru
	join td_santri on td_santri_kelas.id_santri = td_santri.id_santri
	join tr_kelas on td_kelas_ta.id_kelas = tr_kelas.id_kelas
	join td_santri_nilai on td_santri_pelajaran.id_santri_pelajaran = td_santri_nilai.id_santri_pelajaran
	join tr_nilai on td_santri_nilai.id_nilai = tr_nilai.id_nilai
	join td_bayanat on td_santri_nilai.id_santri_nilai = td_bayanat.id_santri_nilai
	join tr_pelajaran on td_santri_pelajaran.id_pelajaran = tr_pelajaran.id_pelajaran
	where td_santri.id_santri ='2';
	*/	


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function setIdSantri($id){
		$this->id_santri = $id;
	}

	private function _get_datatables_query()
	{
		$this->db->select('
			td_santri_pelajaran.id_santri_pelajaran,
			td_santri_pelajaran.id_pelajaran,
			td_santri_nilai.id_santri_nilai,
			td_kelas_ta.id_ta,
			td_santri.id_santri,
			tr_pelajaran.uraian as nama_pelajaran,
			td_santri.nama as nama_santri,
			td_kelas_ta.tahun,
			td_kelas_ta.semester,
			tr_kelas.nama_kelas,
			td_guru.nama as nama_guru,
			td_bayanat.nomor,
			td_bayanat.tgl_ujian,
			td_bayanat.tgl_remed,
			tr_nilai.uraian as uraian_nilai,
			td_santri_nilai.nilai_awal,
			td_santri_nilai.nilai_akhir,
			td_santri_nilai.nilai_remed');
		$this->db->from($this->table);
		$this->db->join('td_santri_kelas', 'td_santri_pelajaran.id_santri_kelas = td_santri_kelas.id_santri_kelas', 'left');
		$this->db->join('td_kelas_ta', 'td_santri_kelas.id_ta = td_kelas_ta.id_ta', 'left');
		$this->db->join('td_guru', 'td_santri_pelajaran.id_guru = td_guru.id_guru', 'left');
		$this->db->join('td_santri', 'td_santri_kelas.id_santri = td_santri.id_santri', 'left');
		$this->db->join('tr_kelas', 'td_kelas_ta.id_kelas = tr_kelas.id_kelas', 'left');
		$this->db->join('td_santri_nilai', 'td_santri_pelajaran.id_santri_pelajaran = td_santri_nilai.id_santri_pelajaran', 'left');
		$this->db->join('tr_nilai', 'td_santri_nilai.id_nilai = tr_nilai.id_nilai', 'left');
		$this->db->join('td_bayanat', 'td_santri_nilai.id_santri_nilai = td_bayanat.id_santri_nilai', 'left');
		$this->db->join('tr_pelajaran', 'td_santri_pelajaran.id_pelajaran = tr_pelajaran.id_pelajaran', 'left');
		$this->db->where('td_santri.id_santri', $this->id_santri);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function getListSantri()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function getDataSantriOnSantriPelajaran($id){
		$this->db->select('*');
		$this->db->from('td_santri');
		$this->db->where('id_santri', $id);
		$query = $this->db->get();
		return $query->result_array();
		$query->free_result();
	}

	public function getGuruKompetensiBidangPelajaran(){
		$this->db->from('td_guru');
		$query = $this->db->get();
		return $query->result_array();
		$query->free_result();
	}

	public function getPelajaran(){
		$this->db->select('*');
		$this->db->from('tr_pelajaran');
		$query = $this->db->get();
		return $query->result_array();
		$query->free_result();
	}

	public function getAvailableSemesterOnSantri($id_santri){
		$this->db->select('*');
		$this->db->from('td_kelas_ta');
		$this->db->join('td_santri_kelas', 'td_kelas_ta.id_ta = td_santri_kelas.id_ta', 'left');
		$this->db->join('tr_kelas', 'td_kelas_ta.id_kelas = tr_kelas.id_kelas', 'left');
		$this->db->where('td_santri_kelas.id_santri', $id_santri);
		$query =  $this->db->get();
		return $query->result_array();
		$query->free_result();
	}

	public function getJenisNilai(){
		$this->db->select('*');
		$this->db->from('tr_nilai');
		$query = $this->db->get();
		return $query->result_array();
		$query->free_result();
	}

	public function getKKM($id_pelajaran, $id_ta){
		$this->db->from('tr_kkm');
		$this->db->where('id_pelajaran', $id_pelajaran);
		$this->db->where('id_ta', $id_ta);
		$query = $this->db->get();
		$ret =  $query->row();
		return $ret->nilai;
		$query->free_result();
	}

	public function addTdSantriPelajaran($data){
		$this->db->insert('td_santri_pelajaran',$data);
		return $this->db->insert_id();
	}

	public function addTdSantriNilaiOnPelajaran($data){
		$this->db->insert('td_santri_nilai',$data);
		return $this->db->insert_id();
	}

	public function addTdBayanatOnPelajaran($data){
		$this->db->insert('td_bayanat', $data);
		return $this->db->insert_id();
	}
	public function getIdSantriNilai($id){
		$this->db->select('id_santri_nilai');
		$this->db->from('td_santri_nilai');
		$this->db->where('id_santri_pelajaran', $id);
		$query =  $this->db->get();
		$ret =  $query->row();
		return $ret->id_santri_nilai;
		$query->free_result();
	}

	public function deleteTdSantriPelajaran($id){
		$this->db->where('id_santri_pelajaran', $id);
		$this->db->delete('td_santri_pelajaran');
	}

	public function deleteTdSantriNilaionPelajaran($id){
		$this->db->where('id_santri_nilai', $id);
		$this->db->delete('td_santri_nilai');

	}

	public function deleteTdBayanatonPelajaran($id){
		$this->db->where('id_santri_nilai', $id);
		$this->db->delete('td_bayanat');
	}


	public function getTdSantriPelajaranById($id){
		$this->db->select('
			td_santri_pelajaran.id_santri_pelajaran,
			td_santri_pelajaran.id_pelajaran,
			td_santri_nilai.id_santri_nilai,
			td_kelas_ta.id_ta,
			td_santri.id_santri,
			tr_pelajaran.uraian as nama_pelajaran,
			td_santri.nama as nama_santri,
			td_kelas_ta.tahun,
			td_guru.id_guru,
			tr_nilai.id_nilai,
			td_kelas_ta.semester,
			tr_kelas.nama_kelas,
			td_guru.nama as nama_guru,
			td_bayanat.nomor,
			td_bayanat.tgl_ujian,
			td_bayanat.tgl_remed,
			tr_nilai.uraian as uraian_nilai,
			td_santri_nilai.nilai_awal,
			td_santri_nilai.nilai_akhir,
			td_santri_nilai.nilai_remed');
		$this->db->from('td_santri_pelajaran');
		$this->db->join('td_santri_kelas', 'td_santri_pelajaran.id_santri_kelas = td_santri_kelas.id_santri_kelas', 'left');
		$this->db->join('td_kelas_ta', 'td_santri_kelas.id_ta = td_kelas_ta.id_ta', 'left');
		$this->db->join('td_guru', 'td_santri_pelajaran.id_guru = td_guru.id_guru', 'left');
		$this->db->join('td_santri', 'td_santri_kelas.id_santri = td_santri.id_santri', 'left');
		$this->db->join('tr_kelas', 'td_kelas_ta.id_kelas = tr_kelas.id_kelas', 'left');
		$this->db->join('td_santri_nilai', 'td_santri_pelajaran.id_santri_pelajaran = td_santri_nilai.id_santri_pelajaran', 'left');
		$this->db->join('tr_nilai', 'td_santri_nilai.id_nilai = tr_nilai.id_nilai', 'left');
		$this->db->join('td_bayanat', 'td_santri_nilai.id_santri_nilai = td_bayanat.id_santri_nilai', 'left');
		$this->db->join('tr_pelajaran', 'td_santri_pelajaran.id_pelajaran = tr_pelajaran.id_pelajaran', 'left');
		$this->db->where('td_santri_pelajaran.id_santri_pelajaran', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function updateTdSantriPelajaran($where, $data)
	{
		$this->db->update('td_santri_pelajaran', $data, $where);
		return $this->db->affected_rows();
	}

	public function updateTdSantriNilai($where, $data){
		$this->db->update('td_santri_nilai', $data, $where);
		return $this->db->affected_rows();
	}

	public function updateTdBayanat($where, $data){
		$this->db->update('td_bayanat', $data, $where);
		return $this->db->affected_rows();
	}
}

/* End of file Mtd_santri_pelajaran.php */
/* Location: ./application/models/Mtd_santri_pelajaran.php */