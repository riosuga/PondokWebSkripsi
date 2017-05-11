<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_pelajaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtr_pelajaran','pelajaran');
	}

	public function index()
	{
		$data = array(
			"body" => $this->load->view('table/table_tr_pelajaran', null,TRUE),
			"modal" => $this->load->view('modal/modal_tr_pelajaran', null,TRUE),
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('tr_pelajaran/trPelajaranList').'";
		var locPrev ="'.site_url('tr_pelajaran/priviewTrPelajaran').'";
		var locAdd ="'.site_url('tr_pelajaran/addTrPelajaran').'";
		var locUpd ="'.site_url('tr_pelajaran/updateTrPelajaran').'";
		var locDel ="'.site_url('tr_pelajaran/deleteTrPelajaran').'";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/tr_pelajaran.js').'"></script>';
		$this->load->view('main/main_view', $data);
	}

	public function trPelajaranList(){
		$listPelajaran = $this->pelajaran->getListpelajaran();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listPelajaran as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->uraian;
			$row[] = $list->uraian_en;
			$row[] = $list->uraian_ar;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_pelajaran."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_pelajaran."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
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
				'uraian_en' => $this->input->post('uraian_en'),
			);
		$isSuccses = $this->pelajaran->addTrPelajaran($data);
		echo json_encode(array("status" => TRUE));
	}

	public function priviewTrPelajaran($id){
		$data = $this->pelajaran->getTrPelajaranById($id);
		echo json_encode($data);
	}

	public function updateTrPelajaran(){
		$data = array(
				'uraian' => $this->input->post('uraian'),
				'uraian_ar' => $this->input->post('uraian_ar'),
				'uraian_en' => $this->input->post('uraian_en'),
			);
		$isSuccses = $this->pelajaran->updateTrPelajaran(array('id_pelajaran' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function deleteTrPelajaran($id){
		$isSuccses = $this->pelajaran->deleteTrPelajaran($id);
		echo json_encode(array("status" => TRUE));
	}

}

/* End of file Tr_pelajaran.php */
/* Location: ./application/controllers/Tr_pelajaran.php */