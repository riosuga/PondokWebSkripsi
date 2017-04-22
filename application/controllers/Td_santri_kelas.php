<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_santri_kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_santri_kelas','santri_kelas');
	}

	public function index()
	{
		$this->load->view('v_td_santri_kelas');
	}

	public function tdSantriKelasList(){
		//pokok isine murid
		$listSantriKelas = $this->santri_kelas->getListSantriKelas();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listSantriKelas as $list) {
			$row = array();
			$row[] = /*'<a href="'.base_url()."/'". cikal bakal e*/$list->nama_kelas;
			$row[] = $list->nama_kelas_ar;
			$row[] = $list->kapasitas;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_santri_kelas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_santri_kelas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->santri_kelas->count_all(),
			"recordsFiltered" => $this->santri_kelas->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTdSantriKelas(){
		$data = array(
				'id_ta' => $this->input->post('id_ta'),
				'id_santri' => $this->input->post('id_santri'),
			);
		$isSuccses = $this->santri_kelas->addTdSantriKelas($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTdSantriKelas($id){
		//nanti beda
		$data = $this->santri_kelas->getTdSantriKelasById($id);
		echo json_encode($data);
	}

	public function updateTdSantriKelas{
		$data = array(
				'id_ta' => $this->input->post('id_ta'),
				'id_santri' => $this->input->post('id_santri'),
			);
		$isSuccses = $this->santri_kelas->updateTdSantriKelas(array('id_santri_kelas' => $this->input->post('id_santri_kelas')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTdSantriKelas{
		$isSuccses = $this->santri_kelas->deleteTdSantriKelas($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}


}

/* End of file Td_santri_kelas.php */
/* Location: ./application/controllers/Td_santri_kelas.php */