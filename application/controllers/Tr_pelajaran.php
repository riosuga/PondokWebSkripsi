<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_pelajaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtr_pelajaran','pelajaran');
		$this->load->helper('url');
	}

	public function index()
	{
		
		$this->load->view('v_tr_pelajarn');
	}

	public function trPelajaranList(){
		$listPelajaran = $this->pelajaran->getListpelajaran();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listPelajaran as $list) {
			$row = array();
			$row[] = $list->uraian;
			$row[] = $list->uraian_en;
			$row[] = $list->uraian_ar;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_pelajaran."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_pelajaran."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pelajaran->count_all(),
			"recordsFiltered" => $this->pelajaran->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTrPelajaran(){
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'urian_en' => $this->input->post('urian_en'),
			);
		$isSuccses = $this->pelajaran->addTrPelajaran($data);
		if($isSuccses != null && $isSuccses != 0){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTrPelajaran($id){
		$data = $this->pelajaran->getTrPelajaranById($id);
		echo json_encode($data);
	}

	public function updateTrPelajaran(){
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'urian_en' => $this->input->post('urian_en'),
			);
		$isSuccses = $this->pelajaran->updateTrPelajaran(array('id_pelajaran' => $this->input->post('id_pelajaran')), $data);
		if($isSuccses != null && $isSuccses != 0)){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTrPelajaran(){
		$isSuccses = $this->pelajaran->deleteTrPelajaran($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Tr_pelajaran.php */
/* Location: ./application/controllers/Tr_pelajaran.php */