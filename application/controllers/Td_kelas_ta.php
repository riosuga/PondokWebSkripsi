<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_kelas_ta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_kelas_ta','kelas_ta');
	}

	public function index()
	{
		$this->load->view('v_td_kelas_ta');
	}

	public function tdKelasTAList(){
		$listKelasTA = $this->kelas->getListKelasTA();
		$data  = array();
		$no = $_POST['start'];
		//join guru nama kelas
		foreach ($listKelasTA as $list) {
			$row = array();
			$row[] = $list->nama_kelas;
			$row[] = $list->nama;
			$row[] = $list->semester;
			$row[] = $list->tahun;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_ta."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_ta."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
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

	public function addTdKelasTA(){
		$data = array(
				'id_kelas' => $this->input->post('id_kelas'),
				'id_guru' => $this->input->post('id_guru'),
				'semester' => $this->input->post('semester'),
				'tahun' => $this->input->post('tahun'),
			);
		$isSuccses = $this->kelas_ta->addTdKelasTA($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTdKelasTA($id){
		$data = $this->kelas->getTdKelasTAById($id);
		echo json_encode($data);
	}

	public function updateTdKelasTA{
		$data = array(
				'id_kelas' => $this->input->post('id_kelas'),
				'id_guru' => $this->input->post('id_guru'),
				'semester' => $this->input->post('semester'),
				'tahun' => $this->input->post('tahun'),
			);
		$isSuccses = $this->kelas->updateTdKelasTA(array('id_ta' => $this->input->post('id_ta')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTdKelasTA{
		$isSuccses = $this->kelas->deleteTdKelasTA($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}


}

/* End of file Td_kelas_ta.php */
/* Location: ./application/controllers/Td_kelas_ta.php */