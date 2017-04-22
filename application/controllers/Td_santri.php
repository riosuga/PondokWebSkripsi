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
		//horizontal table
		foreach ($listSantri as $list) {
			$row = array();
			$row[] = $list->nis;
			$row[] = $list->nisn;
			$row[] = $list->nama;
			$row[] = $list->nama_ar;
			$row[] = $list->kelamin;
			$row[] = $list->tempat_lahir;
			$row[] = $list->tgl_lahir;
			$row[] = $list->daerah;
			$row[] = $list->daerah_ar;
			$row[] = $list->tgl_awal;
			$row[] = $list->tgl_akhir;
			$row[] = $list->nama_ayah;
			$row[] = $list->no_hp_ayah;
			$row[] = $list->nama_ibu;
			$row[] = $list->no_hp_ibu;
			$row[] = $list->alamat;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_santri."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_santri."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'
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
				'nis' => $this->input->post('nis'),
				'nisn' => $this->input->post('nisn'),
				'nama' => $this->input->post('nama'),
				'nama_ar' => $this->input->post('nama_ar'),
				'kelamin' => $this->input->post('kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'tgl_awal' => $this->input->post('tgl_awal'),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'no_hp_ayah' => $this->input->post('no_hp_ayah'),
				'nama_ibu' => $this->input->post('nama_ibu'),
				'no_hp_ibu' => $this->input->post('no_hp_ibu'),
				'alamat' => $this->input->post('alamat'),
			);
		$isSuccses = $this->santri->addtdSantri($data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function priviewtdSantri($id){
		$data = $this->santri->getTrSantriById($id);
		echo json_encode($data);
	}

	public function updatetdSantri(){
		$data = array(
				'nis' => $this->input->post('nis'),
				'nisn' => $this->input->post('nisn'),
				'nama' => $this->input->post('nama'),
				'nama_ar' => $this->input->post('nama_ar'),
				'kelamin' => $this->input->post('kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'tgl_awal' => $this->input->post('tgl_awal'),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'no_hp_ayah' => $this->input->post('no_hp_ayah'),
				'nama_ibu' => $this->input->post('nama_ibu'),
				'no_hp_ibu' => $this->input->post('no_hp_ibu'),
				'alamat' => $this->input->post('alamat'),
			);
		$isSuccses = $this->santri->updatetdSantri(array('id_santri' => $this->input->post('id_santri')), $data);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
		}
	}

	public function deletetdSantri(){
		$isSuccses = $this->santri->deletetdSantri($id);
		if($isSuccses){
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => TRUE));
		}
		
	}

}

/* End of file Tr_santri.php */
/* Location: ./application/controllers/Tr_santri.php */