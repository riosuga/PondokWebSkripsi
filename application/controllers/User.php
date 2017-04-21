<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_model','my');
	

	}

	public function index(){
		$this->load->helper('url');
		$this->load->view('v_myView');
	}

	public function listData()
	{
		$mahasiswa = $this->my->testOutput();
		$no = 0;

		foreach ($mahasiswa as $getMahasiswa) {
			$no++:
			$row = array();
			$row[] = $getMahasiswa->nama;
			$row[] =  $getMahasiswa->kelas;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function createSession(){
		
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */