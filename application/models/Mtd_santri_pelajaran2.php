<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtd_santri_pelajaran2 extends CI_Model {

	var $table = 'td_santri';
	var $column_order = array('nis','nama',null); //set column field database for datatable orderable
	var $column_search = array('nis','nama'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id_santri' => 'desc'); // default order 
	var $id_santri;

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

		$this->db->where('exists(select id_santri from td_santri_kelas where td_santri_kelas.id_santri = td_santri.id_santri)');
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
		$this->db->from('td_santri');
		$this->db->where('exists(select id_santri from td_santri_kelas where td_santri_kelas.id_santri = td_santri.id_santri)');
		$query = $this->db->get();
		return $query->num_rows();
	}

}

/* End of file Mtd_santri_pelajaran2.php */
/* Location: ./application/models/Mtd_santri_pelajaran2.php */