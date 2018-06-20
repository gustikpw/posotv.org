<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('profil_perusahaan_model','dsh');
	}
	public function index()
	{
		$this->url('dashboard');
	}

	public function url($segmen)
	{
		if ($this->session->level=='administrator' || $this->session->level=='kolektor' || $this->session->level=='teknisi') {
			// validasi segmen
			$cekSessionSegmen = array(
				array('','profil_perusahaan','bagian','jabatan','karyawan',
				'wilayah','status','tarif','pelanggan','jenis_gangguan','pengaduan',
				'perbaikan_gangguan','kwitansi','kolektor','setoran_kolektor','tunggakan',
				'appsettings','dashboard','sms_inbox','pemutusan','laporan','quicklink'),
				array('','setoran'),
				array('','perbaikan','jenis_gangguan','pengaduan','perbaikan_gangguan'),
			);
			$level = $this->session->level;
			$sesi = 0;
			$page ='';
			$cekURL = 'off';
			if ($level == 'administrator') { $sesi = 0; $folder = 'admin'; }
			elseif ($level == 'kolektor') { $sesi = 1; $folder = 'kolektor'; }
			elseif ($level == 'teknisi') { $sesi = 2; $folder = 'teknisi'; }

		  for ($col = 0; $col < count($cekSessionSegmen[$sesi]); $col++) {
		    if ($segmen == $cekSessionSegmen[$sesi][$col]) {
		    	$page = $cekSessionSegmen[$sesi][$col];
					$cekURL = 'on';
		    }
		  }

			if ($cekURL == 'on') {
				$data['profilP'] = $this->dsh->get_by_id(1);
				$data['active'] = $page;
				$this->load->view("$folder/templates/sheader",$data);
				$this->load->view("$folder/templates/aside");
				$this->load->view("$folder/$page/$page");
				$this->load->view("$folder/templates/footer");
				$this->load->view("$folder/templates/sfooter");
				$this->load->view("$folder/$page/js_$page");
			} else {
				// echo "Halaman tidak tersedia Coy!";
			}
		}
		else {
			redirect(site_url('login'));
		}

	}

	private function _autentikasi()
	{
		if ($this->session->level=='administrator' || $this->session->level=='kolektor' || $this->session->level=='teknisi') {
			$this->url('dashboard');
		} else {
			redirect(site_url('login'));
			exit();
		}
	}

}
