<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_santri extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_santri','santri');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('v_td_santri', $data, FALSE);
	}

	public function tdSantriList(){
		$listSantri = $this->santri->getListSantri();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listSantri as $list) {
			$row = array();
			$row[] = $list->nama;
			$row[] = $list->nama_ar;
			$row[] = $list->daerah;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_pelajaran."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_pelajaran."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->santri->count_all(),
			"recordsFiltered" => $this->santri->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addtdSantri(){
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'urian_en' => $this->input->post('urian_en'),
			);
		$isSuccses = $this->pelajaran->addtdSantri($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewtdSantri($id){
		$data = $this->pelajaran->getTrPlejaranById($id);
		echo json_encode($data);
	}

	public function updatetdSantri{
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'urian_en' => $this->input->post('urian_en'),
			);
		$isSuccses = $this->pelajaran->updatetdSantri(array('id_pelajaran' => $this->input->post('id_pelajaran')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deletetdSantri{
		$isSuccses = $this->pelajaran->deletetdSantri($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Tr_santri.php */
/* Location: ./application/controllers/Tr_santri.php */