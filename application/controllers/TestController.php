<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_test');
	}

	public function index()
	{
		$data = $this->M_test->getDataGuru();
		var_dump($data);
	}

}

/* End of file TestController.php */
/* Location: ./application/controllers/TestController.php */