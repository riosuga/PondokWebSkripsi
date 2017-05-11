<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_guru extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_guru','guru');
		$this->load->model('Mtd_guru_kompetensi','guru_k');
	}

	public function index()
	{
		$dataPelajaran['pelajaran'] = $this->guru->getListPelajaranOnTdGuru();
		$data = array(
			"body" => $this->load->view('table/table_td_guru', null,TRUE),
			"modal" => $this->load->view('modal/modal_td_guru', $dataPelajaran,TRUE),
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('td_guru/tdGuruList').'";
		var locPrev ="'.site_url('td_guru/priviewtdGuru').'";
		var locAdd ="'.site_url('td_guru/addtdGuru').'";
		var locUpd ="'.site_url('td_guru/updatetdGuru').'";
		var locDel ="'.site_url('td_guru/deletetdGuru').'";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/td_guru.js').'"></script>';
		$this->load->view('main/main_view', $data);
	}

	public function tdGuruList(){
		$listGuru = $this->guru->getListGuru();
		$data  = array();
		$no = $_POST['start'];
		//horizontal table
		foreach ($listGuru as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->nip;
			$row[] = $list->nama;
			$row[] = $list->nama_ar;
			$row[] = $list->uraian;
			$row[] = $list->kelamin;
			$row[] = $list->tempat_lahir;
			$row[] = $list->tgl_lahir;
			$row[] = $list->alamat;
			$row[] = $list->no_hp;
			$row[] = $list->email;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_guru."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_guru."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->guru->count_all(),
			"recordsFiltered" => $this->guru->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTdGuru(){
		$data = array(
				'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'nama_ar' => $this->input->post('nama_ar'),
				'kelamin' => $this->input->post('kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
			);

		$lastIdGuru = $this->guru->addTdGuru($data);

		$dataKompetensi = array('id_guru' => $lastIdGuru,
								'id_pelajaran' => $this->input->post('pelajaran'));
		$isSuccses = $this->guru_k->addTdGuruKompetensi($dataKompetensi);

		echo json_encode(array("status" => TRUE));
	}

	public function priviewTdGuru($id){
		$data = $this->guru->getTdGuruById($id);
		echo json_encode($data);
	}

	public function updateTdGuru(){
		$data = array(
				'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'kelamin' => $this->input->post('kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
			);
		$isSuccses = $this->guru->updateTdGuru(array('id_guru' => $this->input->post('id')), $data);

		$dataKompetensi = array('id_pelajaran' => $this->input->post('pelajaran'));
		$isSuccses = $this->guru_k->updateTdGuruKompetensi($this->input->post('id'), $dataKompetensi);
		echo json_encode(array("status" => TRUE));
	}

	public function deleteTdGuru($id){
		$isSuccses = $this->guru->deleteTdGuru($id);
		$isSuccses = $this->guru_k->deleteTdGuruKompetensi($id);
		echo json_encode(array("status" => TRUE));
	}

}

/* End of file Td_guru.php */
/* Location: ./application/controllers/Td_guru.php */