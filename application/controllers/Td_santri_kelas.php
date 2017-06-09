<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_santri_kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_santri_kelas','santri_kelas');
		$this->load->library('session');
	}

	public function index()
	{
		//rusak
		echo 'rusak';
	}

	public function mainTdSantriKelas($id_ta){
		$id_ta = $this->uri->segment(3);
		$this->santri_kelas->setIdTa($id_ta);
		
		$newData = array('id_ta'=> $id_ta);
		$this->session->set_userdata($newData);

		$data2['data_kelas'] = $this->santri_kelas->getKelasTaOnTdSantriKelas($id_ta);
		$data2['data_santri'] = $this->santri_kelas->getSantriHasNotClass($id_ta);
		$data2['slug'] = $id_ta;
		$data = array(
			"body" => $this->load->view('table/table_td_santri_kelas', $data2,TRUE),
			"modal" => $this->load->view('modal/modal_td_santri_kelas', $data2,TRUE),
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('td_santri_kelas/tdSantriKelasList').'";
		var locPrev ="'.site_url('td_santri_kelas/priviewtdSantriKelas').'";
		var locAdd ="'.site_url('td_santri_kelas/addtdSantriKelas').'";
		var locUpd ="'.site_url('td_santri_kelas/updatetdSantriKelas').'";
		var locDel ="'.site_url('td_santri_kelas/deletetdSantriKelas').'";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/td_santri_kelas.js').'"></script>';
		$this->load->view('main/main_view', $data);
	}

	public function tdSantriKelasList(){
		//pokok isine murid

		$id_ta = $this->session->userdata('id_ta');
		$this->santri_kelas->setIdTa($id_ta);
		
		$listSantriKelas = $this->santri_kelas->getListSantriKelas();
		$data  = array();
		$no = $_POST['start'];
		foreach ($listSantriKelas as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->nis;
			$row[] = $list->nama;
			$row[] ='<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_santri_kelas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->santri_kelas->count_all(),
			"recordsFiltered" => $this->santri_kelas->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
		$this->session->userdata('id_ta');
	}

	public function addTdSantriKelas(){
		$data = $this->input->post('myField');
		$id = $this->input->post('id_ta');
		$tampung = explode(',',$data);
		foreach ($tampung as $masuk) {
			$isExist = $this->santri_kelas->muridIsExists($masuk,$id);
			if($isExist == false){
				continue;
			}else{
					$data = array(
					'id_santri' =>  $masuk,
					'id_ta' => $id
					);
				$this->santri_kelas->addTdSantriKelas($data);
			}
			
		}
		 echo json_encode(array("status" => TRUE));
	}

	public function priviewTdSantriKelas($id){
		//nanti beda
		$data = $this->santri_kelas->getTdSantriKelasById($id);
		echo json_encode($data);
	}

	public function updateTdSantriKelas(){
		$data = array(
				'id_ta' => $this->input->post('id_ta'),
				'id_santri' => $this->input->post('id_santri'),
			);
		$isSuccses = $this->santri_kelas->updateTdSantriKelas(array('id_santri_kelas' => $this->input->post('id_santri_kelas')), $data);
		echo json_encode(array("status" => TRUE));

	}

	public function deleteTdSantriKelas($id){
		$isSuccses = $this->santri_kelas->deleteTdSantriKelas($id);
		echo json_encode(array("status" => TRUE));
		
	}


}

/* End of file Td_santri_kelas.php */
/* Location: ./application/controllers/Td_santri_kelas.php */