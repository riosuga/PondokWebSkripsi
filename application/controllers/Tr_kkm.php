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
		$listNilai = $this->kkm->getListkkm();
		$data  = array();
		$no = $_POST['start'];
		//jangan lupa join kelas_ta, guru, pelajaran, tr_kelas
		foreach ($listKKM as $list) {
			$row = array();
			$row[] = $list->tahun;
			$row[] = $list->semester;
			$row[] = $list->uraian;
			$row[] = $list->nama_kelas;
			$row[] = $list->nama;
			$row[] = $list->bobot;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_kkm."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_kkm."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kkm->count_all(),
			"recordsFiltered" => $this->kkm->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addtrKKM(){
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'bobot' => $this->input->post('bobot'),
			);
		$isSuccses = $this->kkm->addtrKKM($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewtrKKM($id){
		$data = $this->kkm->getTrKKMById($id);
		echo json_encode($data);
	}

	public function updatetrKKM(){
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'bobot' => $this->input->post('bobot'),
			);
		$isSuccses = $this->kkm->updatetrKKM(array('id_kkm' => $this->input->post('id_kkm')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deletetrKKM(){
		$isSuccses = $this->kkm->deletetrKKM($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Tr_kkm.php */
/* Location: ./application/controllers/Tr_kkm.php */