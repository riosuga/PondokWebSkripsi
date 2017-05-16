<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Td_santri_pelajaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mtd_santri_pelajaran','santri_p');
		$this->load->model('Mtd_santri_pelajaran2','santri_p2');
	}

	public function index()
	{
		$data = array(
			"body" => $this->load->view('table/table_td_santri_pelajaran2', null,TRUE),
			"modal" => null,
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('td_santri_pelajaran/tdSantriPelajaranList').'";
		var locPrev ="";
		var locAdd ="";
		var locUpd ="";
		var locDel ="";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/td_santri_pelajaran2.js').'"></script>';
		$this->load->view('main/main_view', $data);
	}

	public function tdSantriPelajaranDetail(){
		$id_santri = $this->uri->segment(3);
		$this->santri_p->setIdSantri($id_santri);
		
		$newData = array('id_santri'=> $id_santri);
		$this->session->set_userdata($newData);

		$datax['data_santri'] = $this->santri_p->getDataSantriOnSantriPelajaran($id_santri);
		$datax['data_guru_pelajaran'] = $this->santri_p->getGuruKompetensiBidangPelajaran();
		$datax['pelajaran'] = $this->santri_p->getPelajaran();
		$datax['tahun_ajaran'] = $this->santri_p->getAvailableSemesterOnSantri($id_santri);
		$datax['jenis_nilai'] = $this->santri_p->getJenisNilai();
		$data = array(
			"body" => $this->load->view('table/table_td_santri_pelajaran', $datax,TRUE),
			"modal" => $this->load->view('modal/modal_td_santri_pelajaran',$datax,TRUE),
			);
		$data['script_var_location'] = 
		'<script type="text/javascript">
		var locList ="'.site_url('td_santri_pelajaran/tdSantriPelajaranDetaiList').'";
		var locPrev ="'.site_url('td_santri_pelajaran/priviewTdSantriPelajaran').'";
		var locAdd ="'.site_url('td_santri_pelajaran/addTdSantriPelajaran').'";
		var locUpd ="'.site_url('td_santri_pelajaran/updateTdSantriPelajaran').'";
		var locDel ="'.site_url('td_santri_pelajaran/deleteTdSantriPelajaran').'";
		</script>';
		$data['script_js'] = '<script src="'.base_url('assets/customJs/td_santri_pel.js').'"></script>';
		$this->load->view('main/main_view', $data);
	}

	public function tdSantriPelajaranDetaiList(){
		$id_santri = $this->session->userdata('id_santri');
		$this->santri_p->setIdSantri($id_santri);

		$listSantri = $this->santri_p->getListSantri();
		$data  = array();
		$no = $_POST['start'];
		//join
		foreach ($listSantri as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->nama_kelas;
			$row[] = $list->nama_pelajaran;
			$row[] = $list->nama_guru;
			$row[] = $list->tahun;
			$row[] = $list->semester;
			$row[] = $list->uraian_nilai;
			$row[] = $list->tgl_ujian;
			$row[] = $list->tgl_remed;
			$row[] = $list->nomor;
			$row[] = $list->nilai_awal;
			$row[] = $list->nilai_remed;
			$row[] = $list->nilai_akhir;

			$batasRemidi = $this->santri_p->getKKM($list->id_pelajaran, $list->id_ta);
			if($list->nilai_akhir < $batasRemidi){
					$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_santri_pelajaran."'".')"><i class="glyphicon glyphicon-pencil"></i> Update Nilai</a>
			<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="remidi_person('."'".$list->id_santri_pelajaran."'".')"><i class="glyphicon glyphicon-pencil"></i> Insert Remidi</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_santri_pelajaran."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
				}else{
					$row[] ='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$list->id_santri_pelajaran."'".')"><i class="glyphicon glyphicon-pencil"></i> Update Nilai</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$list->id_santri_pelajaran."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
				}
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->santri_p->count_all(),
			"recordsFiltered" => $this->santri_p->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
		$this->session->userdata('id_santri');
		
	}

	public function tdSantriPelajaranList(){
		$listSantri = $this->santri_p2->getListSantri();
		$data  = array();
		$no = $_POST['start'];
		//join
		foreach ($listSantri as $list) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $list->nis;
			$row[] = $list->nama;
			$row[] ='<a class="btn btn-sm btn-primary" href="'.base_url('td_santri_pelajaran/tdSantriPelajaranDetail/'.$list->id_santri).'" title="Tambah Nilai"><i class="glyphicon glyphicon-pencil"></i> Tambah Nilai</a>
					<a class="btn btn-sm btn-primary" href="#" title="Tambah Rapot"><i class="glyphicon glyphicon-pencil"></i> Tambah Rapot</a>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->santri_p2->count_all(),
			"recordsFiltered" => $this->santri_p2->count_filtered(),
			"data" => $data,
			);
		echo json_encode($output);
	}

	public function addTdSantriPelajaran(){
		$data = array(
				'id_pelajaran' => $this->input->post('pelajaran'),
				'id_santri_kelas' => $this->input->post('id_santri_kelas'),
				'id_guru' => $this->input->post('guru'),
			);
		$lastIdSantriPelajaran = $this->santri_p->addTdSantriPelajaran($data);
		
		$dataNilai = array(
			'id_santri_pelajaran' => $lastIdSantriPelajaran,
			'id_nilai' => $this->input->post('jns_kegiatan'),
			'nilai_awal' => $this->input->post('nilai_awal'),
			'nilai_remed' => $this->input->post('nilai_remed'),
			'nilai_akhir' => $this->input->post('nilai_akhir'),
			);
		$lastIdSantriNilai = $this->santri_p->addTdSantriNilaiOnPelajaran($dataNilai);

		$dataBayanat = array(
			'id_santri_nilai' => $lastIdSantriNilai,
			'tgl_ujian' => $this->input->post('tgl_ujian'),
			'tgl_remed' =>$this->input->post('tgl_remed'),
			'nomor'=>$this->input->post('nomor'));
		$lastIdBayanat = $this->santri_p->addTdBayanatOnPelajaran($dataBayanat);

		echo json_encode(array("status" => TRUE));
		
	}

	public function priviewTdSantriPelajaran($id){
		//nanti beda
		$data = $this->santri_p->getTdSantriPelajaranById($id);
		echo json_encode($data);
	}

	public function updateTdSantriPelajaran($id){
		$data = array(
				'id_pelajaran' => $this->input->post('id_pelajaran'),
				'id_santri_kelas' => $this->input->post('id_santri_kelas'),
				'id_guru' => $this->input->post('id_guru'),
			);
		$this->santri_p->updateTdSantriPelajaran(array('id_santri_pelajaran' => $this->input->post('id')), $data);

		$dataNilai = array(
			'id_nilai' => $this->input->post('jns_kegiatan'),
			'nilai_awal' => $this->input->post('nilai_awal'),
			'nilai_remed' => $this->input->post('nilai_remed'),
			'nilai_akhir' => $this->input->post('nilai_akhir'),
			);
		$this->santri_p->updateTdSantriNilai(array('id_santri_nilai' => $this->input->post('id_kelas_nilai')), $dataNilai);

		$dataBayanat = array(
			'tgl_ujian' => $this->input->post('tgl_ujian'),
			'tgl_remed' =>$this->input->post('tgl_remed'),
			'nomor'=>$this->input->post('nomor'));
		$this->santri_p->updateTdBayanat(array('id_santri_nilai' => $this->input->post('id_kelas_nilai')), $dataBayanat);

		echo json_encode(array("status" => TRUE));


	}

	public function deleteTdSantriPelajaran($id){
		$id_santri_nilai = $this->santri_p->getIdSantriNilai($id);
		$this->santri_p->deleteTdSantriPelajaran($id);
		$this->santri_p->deleteTdSantriNilaionPelajaran($id_santri_nilai);
		$this->santri_p->deleteTdBayanatonPelajaran($id_santri_nilai);
		echo json_encode(array("status" => TRUE));
		
	}

}

/* End of file Td_santri_pelajaran.php */
/* Location: ./application/controllers/Td_santri_pelajaran.php */