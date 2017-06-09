<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_santri_rapot extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_santri_rapot','santri_r');
	}

	public function index()
	{
		$this->load->view('v_td_santri_rapot');
	}

	public function rapot(){
		
	}

	public function tdSantriRapotList(){
		$listSantriRapot = $this->santri_r->getListSantriRapot();
		$data  = array();
		$no = $_POST['start'];
		//join
		foreach ($listSantriRapot as $list) {
			$row = array();
			$row[] = '<a href="'.base_url()."/'".$list->nama_kelas;
			$row[] = $list->nama_kelas_ar;
			$row[] = $list->kapasitas;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_santri_rapot."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_santri_rapot."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->santri_r->count_all(),
			"recordsFiltered" => $this->santri_r->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function getListSaranNilai($id_siswa){
		$listPelajaran  = $this->santri_r->getListPelajaran();
	}

	public function addTdSantriRapot(){
		$data = array(
				'id_santri_pelajaran' => $this->input->post('id_santri_pelajaran'),
				'nilai_awal' => $this->input->post('nilai_awal'),
				'nilai_akhir' => $this->input->post('nilai_akhir'),
			);
		$isSuccses = $this->santri_r->addTdSantriRapot($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTdSantriRapot($id){
		//nanti beda
		$data = $this->santri_r->getTdSantriRapotById($id);
		echo json_encode($data);
	}

	public function updateTdSantriRapot{
		$data = array(
				'id_santri_pelajaran' => $this->input->post('id_santri_pelajaran'),
				'nilai_awal' => $this->input->post('nilai_awal'),
				'nilai_akhir' => $this->input->post('nilai_akhir'),
			);
		$isSuccses = $this->santri_r->updateTdSantriRapot(array('id_santri_rapot' => $this->input->post('id_santri_rapot')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTdSantriRapot{
		$isSuccses = $this->santri_r->deleteTdSantriRapot($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Td_santri_rapot.php */
/* Location: ./application/controllers/Td_santri_rapot.php */