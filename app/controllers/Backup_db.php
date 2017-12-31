<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup_db extends CI_Controller {

	function __construct()
	{
			parent::__construct();
			$this->load->dbutil();
	}

	public function backup()
	{
		$filename = "backup_".date('Y-m-d H_m_s').".sql";
		$prefs = array(
        'tables'        => array('profil_perusahaan',
					'settings',
					'bagian',
					'jabatan',
					'jenis_gangguan',
					'tarif',
					'status',
					'wilayah',
					'karyawan',
					'kolektor',
					'pelanggan',
					'pengaduan',
					'tagihan',
					'temp_invoice',
					'users',
					'v_karyawan',
					'v_kolektor',
					'v_pelanggan',
					'v_pengaduan',
					'v_temp_invoice',
					'v_users'),   // Array of tables to backup.
        'ignore'        => array(),                     // List of tables to omit from the backup
        'format'        => 'txt',                       // gzip, zip, txt
        'filename'      => $filename,              // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
        'newline'       => "\n"                         // Newline character used in backup file
		);

		$backup = $this->dbutil->backup($prefs);
		write_file(FCPATH.'assets/backup/'.$filename, $backup);

		// $this->load->helper('download');
		// force_download($filename, $backup);

		// echo base_url().'assets/backup/'.$filename.'<br>';
		// echo FCPATH.'/assets/backup/'.$filename;
	}

}
