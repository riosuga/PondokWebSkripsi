<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_nilai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtr_nilai','nilai');
	}

	public function index()
	{
		$this->load->view('v_tr_nilai');
	}

	public function trNilaiList(){
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

	public function addTrNilai(){
		$data = array(
				'nilai' => $this->input->post('nilai'),
				'id_ta' => $this->input->post('id_ta'),
				'id_nilai' => $this->input->post('id_nilai'),
			);
		$isSuccses = $this->nilai->addTrNilai($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTrNilai($id){
		$data = $this->nilai->getTrNilaiById($id);
		echo json_encode($data);
	}

	public function updateTrNilai(){
		$data = array(
				'nilai' => $this->input->post('nilai'),
				'id_ta' => $this->input->post('id_ta'),
				'id_nilai' => $this->input->post('id_nilai'),
			);
		$isSuccses = $this->nilai->updateTrNilai(array('id_nilai' => $this->input->post('id_nilai')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTrNilai(){
		$isSuccses = $this->nilai->deleteTrNilai($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Tr_nilai.php */
/* Location: ./application/controllers/Tr_nilai.php */