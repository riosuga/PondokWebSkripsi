<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_santri_pelajaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_santri_pelajaran','santri_p');
	}

	public function index()
	{
		$this->load->view('v_td_santri_pelajaran');
	}

	public function tdSantriPelajaranList(){
		$listSantriPelajaran = $this->santri_p->getListSantriPelajaran();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listKelas as $list) {
			$row = array();
			$row[] = '<a href="'.base_url()."/'".$list->nama_kelas;
			$row[] = $list->nama_kelas_ar;
			$row[] = $list->kapasitas;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_santri_pelajaran."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_santri_pelajaran."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->santri_p->count_all(),
			"recordsFiltered" => $this->santri_p->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTdSantriPelajaran(){
		$data = array(
				'id_ta' => $this->input->post('id_ta'),
				'id_santri' => $this->input->post('id_santri'),
			);
		$isSuccses = $this->santri_p->addTdSantriPelajaran($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTdSantriPelajaran($id){
		//nanti beda
		$data = $this->santri_p->getTdSantriPelajaranById($id);
		echo json_encode($data);
	}

	public function updateTdSantriPelajaran{
		$data = array(
				'id_ta' => $this->input->post('id_ta'),
				'id_santri' => $this->input->post('id_santri'),
			);
		$isSuccses = $this->santri_p->updateTdSantriPelajaran(array('id_santri_pelajaran' => $this->input->post('id_santri_pelajaran')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTdSantriPelajaran{
		$isSuccses = $this->santri_p->deleteTdSantriPelajaran($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Td_santri_pelajaran.php */
/* Location: ./application/controllers/Td_santri_pelajaran.php */