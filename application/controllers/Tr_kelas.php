<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtr_kelas','kelas');
	}

	public function index()
	{
		$this->load->view('v_tr_kelas');
	}

	public function trKelasList(){
		$listKelas = $this->kelas->getListkelas();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listKelas as $list) {
			$row = array();
			$row[] = $list->nama_kelas;
			$row[] = $list->nama_kelas_ar;
			$row[] = $list->kapasitas;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_kelas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_kelas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kelas->count_all(),
			"recordsFiltered" => $this->kelas->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTrKelas(){
		$data = array(
				'nama_kelas' => $this->input->post('nama_kelas'),
				'nama_kelas_ar' => $this->input->post('nama_kelas_ar'),
				'kapasitas' => $this->input->post('kapasitas'),
			);
		$isSuccses = $this->kelas->addTrKelas($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTrKelas($id){
		$data = $this->kelas->getTrKelasById($id);
		echo json_encode($data);
	}

	public function updateTrKelas{
		$data = array(
				'nama_kelas' => $this->input->post('nama_kelas'),
				'nama_kelas_ar' => $this->input->post('nama_kelas_ar'),
				'kapasitas' => $this->input->post('kapasitas'),
			);
		$isSuccses = $this->kelas->updateTrKelas(array('id_kelas' => $this->input->post('id_kelas')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTrKelas{
		$isSuccses = $this->kelas->deleteTrKelas($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Tr_kelas.php */
/* Location: ./application/controllers/Tr_kelas.php */