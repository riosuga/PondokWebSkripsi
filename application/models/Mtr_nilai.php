<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtr_pelajaran extends CI_Model {

	var $table = 'tr_nilai';
	var $column_order = array('uraian','uraian_ar','bobot',null); //set column field database for datatable orderable
	var $column_search = array('uraian','uraian_ar','bobot'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id_nilai' => 'desc'); // default order 


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

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
	
	function getListpelajaran()
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

	public function getTrNilaiById($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_nilai',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function addTrNilai($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function updateTrNilai($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function deleteTrNilai($id)
	{
		$this->db->where('id_nilai', $id);
		$this->db->delete($this->table);
	}

}

/* End of file Mtr_pelajaran.php */
/* Location: ./application/models/Mtr_pelajaran.php */