<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtd_guru extends CI_Model {

	var $table = 'tr_Guru';
	var $column_order = array('uraian','uraian_ar','bobot',null); //set column field database for datatable orderable
	var $column_search = array('uraian','uraian_ar','bobot'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id_Guru' => 'desc'); // default order 


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
	
	function getListGuru()
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

	public function getTrGuruById($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_Guru',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function addTrGuru($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function updateTrGuru($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function deleteTrGuru($id)
	{
		$this->db->where('id_Guru', $id);
		$this->db->delete($this->table);
	}

}

/* End of file Mtd_guru.php */
/* Location: ./application/models/Mtd_guru.php */