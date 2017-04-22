<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_kkm extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtr_kkm','kkm');
	}

	public function index()
	{
		$this->load->view('v_tr_kkm');
	}

	public function trKKMList(){
		$listNilai = $this->nilai->getListnilai();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listNilai as $list) {
			$row = array();
			$row[] = $list->uraian;
			$row[] = $list->uraian_ar;
			$row[] = $list->bobot;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_nilai."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_nilai."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->nilai->count_all(),
			"recordsFiltered" => $this->nilai->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTrKKM(){
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'bobot' => $this->input->post('bobot'),
			);
		$isSuccses = $this->nilai->addTrKKM($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTrKKM($id){
		$data = $this->nilai->getTrPlejaranById($id);
		echo json_encode($data);
	}

	public function updateTrKKM{
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'bobot' => $this->input->post('bobot'),
			);
		$isSuccses = $this->nilai->updateTrKKM(array('id_nilai' => $this->input->post('id_nilai')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTrKKM{
		$isSuccses = $this->nilai->deleteTrKKM($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Tr_kkm.php */
/* Location: ./application/controllers/Tr_kkm.php */