<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Master extends CI_Controller {
	function __construct(){
		parent::__construct();
		// $this->load->model('M_Login');
		$this->load->model('M_Data_Master');
		$this->load->library('form_validation');
		// $this->load->model('M_TimbangRubber');
		if($this->session->userdata('status') != "login"){
	 		redirect(base_url("Auth/index"));
	 	}
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function User_Login()
	{
		$data['side'] = 'data_master-login';
		$data['page'] = 'Data User Login';
		$data['departement'] = $this->M_Data_Master->getDepartement()->result();
		$data['jabatan'] = $this->M_Data_Master->getJabatan()->result();
		$this->load->view('Data_Master/user_login/index', $data);
	}
	public function getTabelUserLogin()
	{
		$filSearch = $this->input->post("filSearch");
		$data['data'] = $this->M_Data_Master->getDataUserLogin($filSearch)->result();
		$this->load->view('Data_Master/user_login/tabel', $data);
	}
	public function getKaryawanMaintenance()
	{
		$cari = $this->input->post("cari");
		$sql = $this->M_Data_Master->getKaryawanMaintenance($cari);
		$item = $sql->result_array();
		$data = array();
		foreach ($item as $key) {
			$data[] = array('id' =>$key['nik'] , 'text' =>$key['nik'].' - '.$key['namapeg']);
		}
		echo json_encode($data);
	}
	public function tambahAkun()
	{
		$nik = $this->input->post("nik");
		$data = $this->M_Data_Master->tambahAkun($nik);
		echo json_encode($data);
	}
	public function ubahStatusAkun()
	{
		$nik = $this->input->post("nik");
		$status = $this->input->post("status");
		$data = $this->M_Data_Master->ubahStatusAkun($nik, $status);
		echo json_encode($data);
	}
	public function Tooling()
	{
		$data['side'] = 'data_master-tooling';
		$data['page'] = 'Data Master - Tooling';
		$data['jenis'] = $this->M_Data_Master->getJenisTool()->result();
		$data['proses'] = $this->M_Data_Master->getJenisProses()->result();
		$this->load->view("Data_Master/tooling/index", $data);
	}
	public function getTabelTooling()
	{
		$filKategori = $this->input->post("filKategori");
		$filJenisProses = $this->input->post("filJenisProses");
		$filJenisTool = $this->input->post("filJenisTool");
		$filSearch = $this->input->post("filSearch");
		$data['data'] = $this->M_Data_Master->getDataTooling($filKategori, $filJenisProses, $filJenisTool, $filSearch)->result();
		$this->load->view("Data_Master/tooling/tabel", $data);
	}
	public function Jenis_Tooling()
	{
		$data['side'] = 'data_master-jenis_tooling';
		$data['page'] = 'Data Master - Jenis Tooling';
		$data['jenis'] = $this->M_Data_Master->getJenisTool()->result();
		$data['proses'] = $this->M_Data_Master->getJenisProses()->result();
		$this->load->view("Data_Master/tooling/jenis_tooling", $data);
	}
	public function Area()
	{
		$data['side'] = 'data_master-area';
		$data['page'] = 'Data Master - Area';
		$data['data'] = $this->M_Data_Master->getArea()->result();
		$this->load->view("Data_Master/area/index", $data);
	}
	public function Supplier()
	{
		$data['side'] = 'data_master-supplier';
		$data['page'] = 'Data Master - Supplier';
		$data['data'] = $this->M_Data_Master->getSupplier()->result();
		$this->load->view("Data_Master/supplier/index", $data);
	}
}