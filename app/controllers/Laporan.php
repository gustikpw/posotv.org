<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {

	function __construct()
  {
      parent::__construct();
		$this->load->model('laporan_model','lap');
      $this->load->helper('bulan');
  }

	public function index()
	{

	}

	/*
	 * EXPORT TO FPDF
	 * PELANGGAN
	 * Filter by
	 * @wilayah
	 * @aktif
	 * @non-aktif
	 * @putus
	 * @all_group_by_wilayah
	 */

	public function pelanggan()
	{
		$x1 = html_escape($this->input->post('wilayah'));
		$x2 = html_escape($this->input->post('aktif'));
		$x3 = html_escape($this->input->post('non_aktif'));
		$x4 = html_escape($this->input->post('putus'));
		$x5 = html_escape($this->input->post('group_all'));
		$info = $this->db->query("SELECT * FROM profil_perusahaan WHERE id_profil = 1")->row();

		if (isset($x1)) {
			$data = $this->lap->by_wilayah($x1);
			$output = array(
				'data' => $data,
				'profil' => $info,
				'header' => array(
					'title' => 'Laporan Pelanggan',
					'subtitle' => 'Wilayah',
					'tanggal' => '30 Desember 2017',
				),
			);

			$this->load->view('admin/laporan/lap_pelanggan_by_wilayah',$data)
		}


	}

   /*
	 * EXPORT TO FPDF
	 */

	public function exportnow()
	{
		$data['data'] = $this->bagian->getAll();
		$this->load->view('admin/bagian/report',$data);
		// echo "<pre>";
		// echo print_r($data);
		// echo "</pre>";
	}

}
