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
		$data = array(
			"body" => $this->load->view('table/table_tr_kelas', null,TRUE),
			"modal" => $this->load->view('modal/modal_tr_kelas', null,TRUE),
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('tr_kelas/trKelasList').'";
		var locPrev ="'.site_url('tr_kelas/priviewTrKelas').'";
		var locAdd ="'.site_url('tr_kelas/addTrKelas').'";
		var locUpd ="'.site_url('tr_kelas/updateTrKelas').'";
		var locDel ="'.site_url('tr_kelas/deleteTrKelas').'";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/tr_kelas.js').'"></script>';
		$this->load->view('main/main_view', $data);
	}

	public function trKKMList(){
		$listNilai = $this->kkm->getListkkm();
		$data  = array();
		$no = $_POST['start'];
		//jangan lupa join kelas_ta, guru, pelajaran, tr_kelas
		foreach ($listKKM as $list) {
			$no++;
			$row = array();
			$row[] = $list->tahun;
			$row[] = $list->semester;
			$row[] = $list->uraian;
			$row[] = $list->nama_kelas;
			$row[] = $list->nama;
			$row[] = $list->bobot;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_kkm."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_kkm."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data[] = $row;
		}
		$output = array(
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
		echo json_encode(array("status" => TRUE));
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
		echo json_encode(array("status" => TRUE));
	}

	public function deletetrKKM($id){
		$isSuccses = $this->kkm->deletetrKKM($id);
		echo json_encode(array("status" => TRUE));
	}

}

/* End of file Tr_kkm.php */
/* Location: ./application/controllers/Tr_kkm.php */