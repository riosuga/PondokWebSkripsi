<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_kelas_ta extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_kelas_ta','kelas');
		$this->load->library('session');
	}

	public function index($id)
	{
		//error
		/*$id_kelas = $this->uri->segment(3);
		$this->kelas->setIdKelas($id_kelas);
		$data2['data_kelas'] = $this->kelas->getKelasOnTdKelasTa();
		$data2['data_guru'] = $this->kelas->getGuruOnTdKelasTa();
		$data = array(
			"body" => $this->load->view('table/table_td_kelas_ta', $data2,TRUE),
			"modal" => $this->load->view('modal/modal_td_kelas_ta', $data2,TRUE),
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('td_kelas_ta/tdKelasTAList').'";
		var locPrev ="'.site_url('td_kelas_ta/priviewtdKelasTA').'";
		var locAdd ="'.site_url('td_kelas_ta/addtdKelasTA').'";
		var locUpd ="'.site_url('td_kelas_ta/updatetdKelasTA').'";
		var locDel ="'.site_url('td_kelas_ta/deletetdKelasTA').'";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/td_kelas_ta.js').'"></script>';
		$this->load->view('main/main_view', $data);*/
		echo 'mati';
		die;
	}

	public function mainKelasTA($id_kelas){
		$id_kelas = $this->uri->segment(3);
		$this->kelas->setIdKelas($id_kelas);
		
		$newData = array('id_kelas'=> $id_kelas);
		$this->session->set_userdata($newData);

		$data2['data_kelas'] = $this->kelas->getKelasOnTdKelasTa();
		$data2['data_guru'] = $this->kelas->getGuruOnTdKelasTa();
		$data = array(
			"body" => $this->load->view('table/table_td_kelas_ta', $data2,TRUE),
			"modal" => $this->load->view('modal/modal_td_kelas_ta', $data2,TRUE),
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('td_kelas_ta/tdKelasTAList').'";
		var locPrev ="'.site_url('td_kelas_ta/priviewtdKelasTA').'";
		var locAdd ="'.site_url('td_kelas_ta/addtdKelasTA').'";
		var locUpd ="'.site_url('td_kelas_ta/updatetdKelasTA').'";
		var locDel ="'.site_url('td_kelas_ta/deletetdKelasTA').'";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/td_kelas_ta.js').'"></script>';
		$this->load->view('main/main_view', $data);
	}

	public function tdKelasTAList(){
		$id_kelas = $this->session->userdata('id_kelas');
		$this->kelas->setIdKelas($id_kelas);

		$listKelasTA = $this->kelas->getListKelasTA();
		$data  = array();
		$no = $_POST['start'];
		//join guru nama kelas
		foreach ($listKelasTA as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->nama_kelas;
			$row[] = $list->nama;
			$row[] = $list->semester;
			$row[] = $list->tahun;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_ta."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_ta."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
					<a href="'.base_url('td_santri_kelas/mainTdSantriKelas/'.$list->id_ta).'" class="btn btn-info" role="button"><i class="glyphicon glyphicon-info-sign"></i> Daftar Siswa</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kelas->count_all(),
			"recordsFiltered" => $this->kelas->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);

		$this->session->userdata('id_kelas');
	}

	public function addTdKelasTA(){
		$data = array(
				'id_kelas' => $this->input->post('id_kelas'),
				'id_guru' => $this->input->post('id_guru'),
				'semester' => $this->input->post('semester'),
				'tahun' => $this->input->post('tahun'),
			);
		$isSuccses = $this->kelas->addTdKelasTA($data);
		echo json_encode(array("status" => TRUE));
	}

	public function priviewTdKelasTA($id){
		$data = $this->kelas->getTdKelasTAById($id);
		echo json_encode($data);
	}

	public function updateTdKelasTA(){
		$data = array(
				'id_kelas' => $this->input->post('id_kelas'),
				'id_guru' => $this->input->post('id_guru'),
				'semester' => $this->input->post('semester'),
				'tahun' => $this->input->post('tahun'),
			);
		$isSuccses = $this->kelas->updateTdKelasTA(array('id_ta' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function deleteTdKelasTA($id){
		$isSuccses = $this->kelas->deleteTdKelasTA($id);
		echo json_encode(array("status" => TRUE));
	}

}

/* End of file Td_kelas_ta.php */
/* Location: ./application/controllers/Td_kelas_ta.php */