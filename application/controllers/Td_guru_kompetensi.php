<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_guru_kompetensi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_guru_kompentensi','guru_k');
	}

	public function index()
	{
		$this->load->view('v_td_guru_kompentensi');
	}

	public function tdGuruKompetensiList(){
		//join aja sama guru gak kanggo
		$listGuruKompetensi = $this->guru_k->getListGuruKompetensi();
		$data  = array();
		$no = $_POST['start'];
		//join
		foreach ($listGuruKompetensi as $list) {
			$row = array();
			$row[] = '<a href="'.base_url()."/'".$list->nama_kelas;
			$row[] = $list->nama_kelas_ar;
			$row[] = $list->kapasitas;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_guru_kompetensi."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_guru_kompetensi."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->guru_k->count_all(),
			"recordsFiltered" => $this->guru_k->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTdGuruKompetensi(){
		$data = array(
				'id_pelajaran' => $this->input->post('id_pelajaran'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$isSuccses = $this->guru_k->addTdGuruKompetensi($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTdGuruKompetensi($id){
		//nanti beda
		$data = $this->guru_k->getTdGuruKompetensiById($id);
		echo json_encode($data);
	}

	public function updateTdGuruKompetensi{
		$data = array(
				'id_pelajaran' => $this->input->post('id_pelajaran'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$isSuccses = $this->guru_k->updateTdGuruKompetensi(array('id_guru_kompetensi' => $this->input->post('id_guru_kompetensi')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTdGuruKompetensi{
		$isSuccses = $this->guru_k->deleteTdGuruKompetensi($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Td_guru_kompetensi.php */
/* Location: ./application/controllers/Td_guru_kompetensi.php */