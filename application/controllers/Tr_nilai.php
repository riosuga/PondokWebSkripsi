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
		$data = array(
			"body" => $this->load->view('table/table_tr_nilai', null,TRUE),
			"modal" => $this->load->view('modal/modal_tr_nilai', null,TRUE),
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('tr_nilai/trNilaiList').'";
		var locPrev ="'.site_url('tr_nilai/priviewTrNilai').'";
		var locAdd ="'.site_url('tr_nilai/addTrNilai').'";
		var locUpd ="'.site_url('tr_nilai/updateTrNilai').'";
		var locDel ="'.site_url('tr_nilai/deleteTrNilai').'";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/tr_nilai.js').'"></script>';
		$this->load->view('main/main_view', $data);
	}

	public function trNilaiList(){
		$listNilai = $this->nilai->getListnilai();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listNilai as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->uraian;
			$row[] = $list->uraian_ar;
			$row[] = $list->bobot;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_nilai."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_nilai."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->nilai->count_all(),
			"recordsFiltered" => $this->nilai->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTrNilai(){
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'bobot' => $this->input->post('bobot'),
			);
		$isSuccses = $this->nilai->addTrNilai($data);
		echo json_encode(array("status" => TRUE));
	}

	public function priviewTrNilai($id){
		$data = $this->nilai->getTrNilaiById($id);
		echo json_encode($data);
	}

	public function updateTrNilai(){
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'bobot' => $this->input->post('bobot'),
			);
		$isSuccses = $this->nilai->updateTrNilai(array('id_nilai' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function deleteTrNilai($id){
		$isSuccses = $this->nilai->deleteTrNilai($id);
		echo json_encode(array("status" => TRUE));
	}
}

/* End of file Tr_nilai.php */
/* Location: ./application/controllers/Tr_nilai.php */