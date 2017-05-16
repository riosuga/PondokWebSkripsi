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

	public function trKelasList(){
		$listKelas = $this->kelas->getListkelas();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listKelas as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->nama_kelas;
			$row[] = $list->nama_kelas_ar;
			$row[] = $list->kapasitas;
			$row[] ='
			<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" 
			onclick="edit_person('."'".$list->id_kelas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" 
			onclick="delete_person('."'".$list->id_kelas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
			<a href="'.base_url('td_kelas_ta/mainKelasTA/'.$list->id_kelas).'" class="btn btn-info" role="button"><i class="glyphicon glyphicon-info-sign"></i> Detail</a>';
			$data[] = $row;
		}
		$output = array(
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
		echo json_encode(array("status" => TRUE));
	}

	public function priviewTrKelas($id){
		$data = $this->kelas->getTrKelasById($id);
		echo json_encode($data);
	}

	public function updateTrKelas(){
		$data = array(
				'nama_kelas' => $this->input->post('nama_kelas'),
				'nama_kelas_ar' => $this->input->post('nama_kelas_ar'),
				'kapasitas' => $this->input->post('kapasitas'),
			);
		$isSuccses = $this->kelas->updateTrKelas(array('id_kelas' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
		
	}

	public function deleteTrKelas($id){
		$isSuccses = $this->kelas->deleteTrKelas($id);
		echo json_encode(array("status" => TRUE));
	}

}

/* End of file Tr_kelas.php */
/* Location: ./application/controllers/Tr_kelas.php */