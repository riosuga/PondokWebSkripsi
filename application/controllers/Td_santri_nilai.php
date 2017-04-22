<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_santri_nilai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_santri_nilai','santri_n');
	}

	public function index()
	{
		$this->load->view('v_td_santri_nilai');
	}

	public function tdSantriNilaiList(){
		//join aja sama guru gak kanggo
		$listSantriNilai = $this->santri_n->getListSantriNilai();
		$data  = array();
		$no = $_POST['start'];
		//join
		foreach ($listSantriNilai as $list) {
			$row = array();
			$row[] = $list->id_santri_pelajaran;//uraian pelajarannya nanti disitu
			$row[] = $list->id_nilai //jenis ujiannya
			$row[] = $list->nilai_awal;
			$row[] = $list->nilai_remed;
			$row[] = $list->nilai_akhir;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_santri_nilai."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_santri_nilai."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->santri_n->count_all(),
			"recordsFiltered" => $this->santri_n->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTdSantriNilai(){
		$data = array(
				'id_santri_pelajaran' => $this->input->post('id_santri_pelajaran'),
				'id_nilai' => $this->input->post('id_nilai'),
				'nilai_awal' => $this->input->post('nilai_awal'),
				'nilai_remed' => $this->input->post('nilai_remed'),
				'nilai_akhir' => $this->input->post('nilai_akhir'),
			);
		$isSuccses = $this->santri_n->addTdSantriNilai($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTdSantriNilai($id){
		//nanti beda
		$data = $this->santri_n->getTdSantriNilaiById($id);
		echo json_encode($data);
	}

	public function updateTdSantriNilai{
		$data = array(
				'id_pelajaran' => $this->input->post('id_pelajaran'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$isSuccses = $this->santri_n->updateTdSantriNilai(array('id_santri_nilai' => $this->input->post('id_santri_nilai')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTdSantriNilai{
		$isSuccses = $this->santri_n->deleteTdSantriNilai($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Td_santri_nilai.php */
/* Location: ./application/controllers/Td_santri_nilai.php */