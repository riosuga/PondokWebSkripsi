<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//multi select with search http://harvesthq.github.io/chosen/
class Td_login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_login','login');
	}

	public function index()
	{
		$this->load->view('v_td_login');
	}

	public function tdLoginList(){
		$listTdLogin = $this->login->getListlogin();
		$data  = array();
		$no = $_POST['start'];
		foreach ($TdLogin as $list) {
			$row = array();
			$row[] = $list->username;
			$row[] = $list->uraian_ar;
			$row[] = $list->bobot;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_login."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_login."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->login->count_all(),
			"recordsFiltered" => $this->login->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTdLogin(){
		$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$isSuccses = $this->login->addTdLogin($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTdLogin($id){
		$data = $this->login->getTdLoginById($id);
		echo json_encode($data);
	}

	public function updateTdLogin(){
		$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$isSuccses = $this->login->updateTdLogin(array('id_login' => $this->input->post('id_login')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTdLogin(){
		$isSuccses = $this->login->deleteTdLogin($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}
}

/* End of file td_login.php */
/* Location: ./application/controllers/td_login.php */