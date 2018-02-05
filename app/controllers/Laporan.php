<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {

	function __construct()
  {
      parent::__construct();
		$this->load->model('laporan_model','lap');
      $this->load->helper('MY_bulan');
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
		$x1 = html_escape($this->input->post('lap_wilayah'));
		$x2 = html_escape($this->input->post('lap_status'));
		$x3 = html_escape($this->input->post('lap_group_all'));
		$x4 = html_escape($this->input->post('lap_bln_instalasi'));
		$info = $this->db->query("SELECT * FROM profil_perusahaan WHERE id_profil = 1")->row();

		if (isset($x1)) {
			$data = $this->lap->by_wilayah($x1);
			$title = 'Laporan Pelanggan';
			$subtitle = 'Wilayah';
			$tanggal = tgl_sekarang();
			$this->load->view('admin/laporan/lap_pelanggan_by_wilayah',$data);
		}

		$output = array(
			'data' => $data,
			'summary' => $summary,
			'profil' => $info,
			'header' => array(
				'title' => $title,
				'subtitle' => $subtitle,
				'tanggal' => $tanggal
			)
		);


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

	public function tes()
	{
		echo tgl_sekarang()."<br>";
		echo bulan_tahun('2018-03')."<br>";
		echo tgl_lokal('2018-01-19')."<br>";
	}

}
