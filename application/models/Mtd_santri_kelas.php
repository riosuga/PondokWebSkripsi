<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtd_santri_kelas extends CI_Model {
	var $table = 'td_santri_kelas';
	var $column_order = array('nama_kelas','nama_kelas_ar','kapasitas',null); //set column field database for datatable orderable
	var $column_search = array('nama_kelas','nama_kelas_ar','kapasitas'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id_kelas' => 'desc'); // default order 
	var $id_ta;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function setIdTa($id){
		$this->id_ta = $id;
	}

	public function getIdTA(){
		return $this->id_ta;
	}

	public function getKelasTaOnTdSantriKelas(){
		/*
		SELECT *,td_guru.nama as nama_guru FROM td_santri_kelas 
		join td_kelas_ta on td_santri_kelas.id_ta = td_kelas_ta.id_ta 
		join td_santri on td_santri_kelas.id_santri = td_santri.id_santri 
		join td_guru on td_kelas_ta.id_guru = td_guru.id_guru 
		join tr_kelas on td_kelas_ta.id_kelas = tr_kelas.id_kelas
		*/
		$this->db->select('*, td_guru.nama as nama_guru');
		$this->db->from($this->table);
		$this->db->join('td_santri', 'td_santri_kelas.id_santri = td_santri.id_santri', 'left');
		$this->db->join('td_kelas_ta', 'td_santri_kelas.id_ta = td_kelas_ta.id_ta', 'left');
		$this->db->join('td_guru', 'td_kelas_ta.id_guru = td_guru.id_guru', 'left');
		$this->db->join('tr_kelas', 'td_kelas_ta.id_kelas = tr_kelas.id_kelas', 'left');
		$query =  $this->db->get();
		return $query->result_array();
	}

	public function getSantriHasNotClass($id_ta){
		$querying = "select * from td_santri where not exists(select id_santri from td_santri_kelas 
		join td_kelas_ta on td_santri_kelas.id_ta = td_kelas_ta.id_ta
		where td_santri_kelas.id_santri = td_santri.id_santri and td_santri_kelas.id_ta ='".$id_ta."')";
		$query  = $this->db->query($querying);
		return $query->result_array();
	}


	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		$this->db->join('td_santri', 'td_santri_kelas.id_santri = td_santri.id_santri', 'left');
		$this->db->join('td_kelas_ta', 'td_santri_kelas.id_ta = td_kelas_ta.id_ta', 'left');
		$this->db->where('td_kelas_ta.id_ta', $this->id_ta);

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
	
	function getListSantriKelas()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function santriHasNotClassList(){
		$querying = "select td_santri.nis,td_santri.nama from td_santri_kelas where not exists(select nis from td_kelas_dtl where td_kelas_dtl.nis = td_santri.nis)";
		
		$query  = $this->db->query($querying);
		return $query->result_array();
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

	public function getTdSantriKelasById($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_Kelas',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function addTdSantriKelas($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function updateTdSantriKelas($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function deleteTdSantriKelas($id)
	{
		$this->db->where('id_Kelas', $id);
		$this->db->delete($this->table);
	}	
	

}

/* End of file Mtd_santri_kelas.php */
/* Location: ./application/models/Mtd_santri_kelas.php */