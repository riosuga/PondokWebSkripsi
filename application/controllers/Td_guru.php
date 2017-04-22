<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_guru extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_guru','guru');
	}

	public function index()
	{
		$this->load->view('v_td_guru');
	}

	public function tdGuruList(){
		$listGuru = $this->guru->getListGuru();
		$data  = array();
		$no = $_POST['start'];
		//horizontal table
		foreach ($listGuru as $list) {
			$row = array();
			$row[] = $list->nip;
			$row[] = $list->nama;
			$row[] = $list->nama_ar;
			$row[] = $list->kelamin;
			$row[] = $list->tempat_lahir;
			$row[] = $list->tgl_lahir;
			$row[] = $list->alamat;
			$row[] = $list->no_hp;
			$row[] = $list->email;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_guru."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_guru."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
			$data = $row[];
		}
		$output - array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->guru->count_all(),
			"recordsFiltered" => $this->guru->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTdGuru(){
		$data = array(
				'nip' => $this->input->post('nama'),
				'nama_ar' => $this->input->post('nama_ar'),
				'kelamin' => $this->input->post('kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
			);
		$isSuccses = $this->guru->addTdGuru($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewTdGuru($id){
		$data = $this->guru->getTrGuruById($id);
		echo json_encode($data);
	}

	public function updateTdGuru(){
		$data = array(
				'nip' => $this->input->post('nama'),
				'nama_ar' => $this->input->post('nama_ar'),
				'kelamin' => $this->input->post('kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
			);
		$isSuccses = $this->guru->updateTdGuru(array('id_guru' => $this->input->post('id_guru')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deleteTdGuru(){
		$isSuccses = $this->guru->deleteTdGuru($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Td_guru.php */
/* Location: ./application/controllers/Td_guru.php */