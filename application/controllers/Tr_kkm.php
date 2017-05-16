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

		$datax['tahun_ajaran'] = $this->kkm->getUraianTahunAjaranOnKKM();
		$datax['pelajaran'] = $this->kkm->getPeljaranOnKKM();

		$data = array(
			"body" => $this->load->view('table/table_tr_kkm', null,TRUE),
			"modal" => $this->load->view('modal/modal_tr_kkm', $datax,TRUE),
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('tr_kkm/trKKMList').'";
		var locPrev ="'.site_url('tr_kkm/priviewtrKKM').'";
		var locAdd ="'.site_url('tr_kkm/addtrKKM').'";
		var locUpd ="'.site_url('tr_kkm/updatetrKKM').'";
		var locDel ="'.site_url('tr_kkm/deletetrKKM').'";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/tr_kkm.js').'"></script>';
		$this->load->view('main/main_view', $data);
	}

	public function trKKMList(){
		$listKKM = $this->kkm->getListkkm();
		$data  = array();
		$no = $_POST['start'];
		//jangan lupa join kelas_ta, guru, pelajaran, tr_kkm
		foreach ($listKKM as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->nilai;
			$row[] = $list->uraian;
			$row[] = 'Tahun ajaran '.$list->tahun.' pada semester '.$list->semester.' pada kelas '.$list->nama_kelas.' dengan Walli Kelas '.$list->nama;
			$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_kkm."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_kkm."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
				'nilai' => $this->input->post('nilai'),
				'id_ta' => $this->input->post('id_ta'),
				'id_pelajaran' => $this->input->post('pelajaran'),
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
				'nilai' => $this->input->post('nilai'),
				'id_ta' => $this->input->post('id_ta'),
				'id_pelajaran' => $this->input->post('pelajaran'),
			);
		$isSuccses = $this->kkm->updatetrKKM(array('id_kkm' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function deletetrKKM($id){
		$isSuccses = $this->kkm->deletetrKKM($id);
		echo json_encode(array("status" => TRUE));
	}

}

/* End of file Tr_kkm.php */
/* Location: ./application/controllers/Tr_kkm.php */