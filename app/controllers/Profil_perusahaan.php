<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_perusahaan extends CI_Controller {
	function __construct()
  {
      parent::__construct();
      $this->load->model('profil_perusahaan_model','profil');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function update_profil_perusahaan()
	{
		// if ($this->session->level=='administrator') {
			$data = array(
			'nama_perusahaan' => $this->input->post('nama_perusahaan'),
			'alias' => $this->input->post('alias'),
			'slogan' => $this->input->post('slogan'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'telp' => $this->input->post('telp'),
			'kodepos' => $this->input->post('kodepos'),
			'logo' => $this->input->post('logo'),
			);
			$this->profil->update(array('id_profil' => $this->input->post('id_profil')), $data);
			echo json_encode(array("status" => TRUE));
		// } else {
		// 	echo json_encode(array("status" => FALSE));
		// }
	}

	public function get($id)
	{
		// if ($this->session->level=='administrator') {
			$data = $this->profil->get_by_id($id);
			echo json_encode($data);
		// } else {
		// 	echo json_encode(array("status" => FALSE));
		// }
	}

}
