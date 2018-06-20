<?php defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use \PhpOffice\PhpSpreadsheet\IOFactory as IOFactory;

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
	* Export to Spreadsheet by template
	*/

	public function export_excel()
	{
		$kategori = html_escape($this->input->post('kategori'));
		$id_wilayah = html_escape($this->input->post('wilayah'));

		switch ($kategori) {
			case 'wilayah':
				$this->_export_pelanggan_by($id_wilayah);
				break;

			default:
				echo "Export not allowed!";
				break;
		}
	}

	public function tesx($id_wilayah)
	{
		$this->_export_pelanggan_by($id_wilayah);
	}

	private function _export_pelanggan_by($id_wilayah)
	{
		$pelanggan = $this->db->query("SELECT * FROM v_gis_pelanggan WHERE id_wilayah = '$id_wilayah' ")->result();
		$total_pelanggan = $this->db->query("SELECT count(*) AS total FROM v_gis_pelanggan WHERE id_wilayah = '$id_wilayah' ")->row();
		$jml_by_status = $this->db->query("SELECT count(*) AS status
			FROM v_gis_pelanggan p
			WHERE id_wilayah = '$id_wilayah'
			group by p.id_status
			order by p.id_status ASC")->result();
		$i = 0;
		foreach ($jml_by_status as $v) {
			$row[$i] = $v->status;
			$i++;
		}
		$sts_aktif = (isset($row[0])) ? $row[0] : 0;
		$sts_putus_sementara = (isset($row[1])) ? $row[1] : 0;
		$sts_putus_permanen = (isset($row[2])) ? $row[2] : 0;

		$template_path = BASEPATH.'../assets/report/template/excel/';
		$spreadsheet = IOFactory::load($template_path.'pelanggan_template.xlsx');
		$worksheet = $spreadsheet->getActiveSheet();
		// Set default Style
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(10);
		$styleArray = [
	    'borders' => [
	      'outline' => [
	          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
	          'color' => ['rgb' => 'A9A9A9'],
	      ],
	    ],
		];
		// Insert data
		$worksheet->getCell("D2")->setValue('Total : '.$total_pelanggan->total.' Pelanggan');
		$worksheet->getCell("E2")->setValue('Aktif : '.$sts_aktif);
		$worksheet->getCell("F2")->setValue('Putus Sementara : '.$sts_putus_sementara);
		$worksheet->getCell("I2")->setValue('Putus Permanen : '.$sts_putus_permanen);
		// Insert cell with looping data
		$no = 1;
		$cell = 5; // Cell start from A5
		foreach ($pelanggan as $r) {
			$worksheet->getStyle("A$cell:L$cell")->applyFromArray($styleArray);
			$worksheet->getCell("A$cell")->setValue($no);
			$worksheet->getCell("B$cell")->setValue($r->kode_pelanggan);
			$worksheet->getCell("C$cell")->setValue($r->nama_lengkap);
			$worksheet->getCell("D$cell")->setValue($r->alamat);
			$worksheet->getCell("E$cell")->setValue($r->tgl_pasang);
			$worksheet->getCell("F$cell")->setValue($r->telp);
			// set font color red if tarif >30
			if ( substr($r->tarif,0,2) > 30 ) {
				$worksheet->getStyle("G$cell")
				->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
			} else {
				$worksheet->getStyle("G$cell")
				->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
			}
			$worksheet->getCell("G$cell")->setValue(substr($r->tarif,0,2));
			$worksheet->getCell("H$cell")->setValue($r->status);
			$worksheet->getCell("I$cell")->setValue($r->no_ktp);
			$worksheet->getCell("J$cell")->setValue($r->pin_sms);
			$worksheet->getCell("K$cell")->setValue($r->lat);
			$worksheet->getCell("L$cell")->setValue($r->long);
			$no++;
			$cell++;
			$wilayah = $r->wilayah;
		}
		$worksheet->getCell("A2")->setValue('Wilayah : '.$wilayah);
		$worksheet->setTitle($wilayah);
		// set save path and file name
		$save_path = "assets/report/export/excel/";
		$file_name = 'export_'.$wilayah.'_'.date('d-m-Y').'.xlsx';
		// sent to browser client with http header
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		header ('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header ('Content-Disposition: attachment;filename="'.$file_name.'"');
		header ('Cache-Control: max-age=0');
		$writer->save('php://output');
		// $writer->save($save_path.$file_name);
	}

	public function export_pelanggan_all()
	{
		$wil = $this->db->query("SELECT * FROM wilayah ORDER BY id_wilayah ASC")->result();

		$template_path = BASEPATH.'../assets/report/template/excel/';
		$spreadsheet = IOFactory::load($template_path.'pelanggan_template.xlsx');
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(10);
		$styleArray = [
	    'borders' => [
	      'outline' => [
	          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
	          'color' => ['rgb' => 'A9A9A9'],
	      ],
	    ],
		];

		$save_path = "assets/report/export/excel/";
		$file_name = 'export_all_'.date('d-m-Y').'.xlsx';

		$index = 0;
		foreach ($wil as $w) {
			$worksheet = $spreadsheet->getActiveSheet();
			// start looping
			$pelanggan = $this->db->query("SELECT * FROM v_gis_pelanggan WHERE id_wilayah = '$w->id_wilayah' ")->result();
			$total_pelanggan = $this->db->query("SELECT count(*) AS total FROM v_gis_pelanggan WHERE id_wilayah = '$w->id_wilayah' ")->row();
			$jml_by_status = $this->db->query("SELECT count(*) AS status
				FROM v_gis_pelanggan p
				WHERE id_wilayah = '$w->id_wilayah'
				group by p.id_status
				order by p.id_status ASC")->result();
			$i = 0;
			foreach ($jml_by_status as $v) {
				$row[$i] = $v->status;
				$i++;
			}
			$sts_aktif = (isset($row[0])) ? $row[0] : 0;
			$sts_putus_sementara = (isset($row[1])) ? $row[1] : 0;
			$sts_putus_permanen = (isset($row[2])) ? $row[2] : 0;
			// Insert data
			$worksheet->getCell("D2")->setValue('Total : '.$total_pelanggan->total.' Pelanggan');
			$worksheet->getCell("E2")->setValue('Aktif : '.$sts_aktif);
			$worksheet->getCell("F2")->setValue('Putus Sementara : '.$sts_putus_sementara);
			$worksheet->getCell("I2")->setValue('Putus Permanen : '.$sts_putus_permanen);
			// Insert cell with looping data
			$no = 1;
			$cell = 5; // Cell start from A5
			foreach ($pelanggan as $r) {
				$worksheet->getStyle("A$cell:L$cell")->applyFromArray($styleArray);
				$worksheet->getCell("A$cell")->setValue($no);
				$worksheet->getCell("B$cell")->setValue($r->kode_pelanggan);
				$worksheet->getCell("C$cell")->setValue($r->nama_lengkap);
				$worksheet->getCell("D$cell")->setValue($r->alamat);
				$worksheet->getCell("E$cell")->setValue($r->tgl_pasang);
				$worksheet->getCell("F$cell")->setValue($r->telp);
				// set font color red if tarif >30
				if ( substr($r->tarif,0,2) > 30 ) {
					$worksheet->getStyle("G$cell")
					->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
				} else {
					$worksheet->getStyle("G$cell")
					->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
				}
				$worksheet->getCell("G$cell")->setValue(substr($r->tarif,0,2));
				$worksheet->getCell("H$cell")->setValue($r->status);
				$worksheet->getCell("I$cell")->setValue($r->no_ktp);
				$worksheet->getCell("J$cell")->setValue($r->pin_sms);
				$worksheet->getCell("K$cell")->setValue($r->lat);
				$worksheet->getCell("L$cell")->setValue($r->long);
				$no++;
				$cell++;
				$wilayah = $r->wilayah;
			}
			$worksheet->getCell("A2")->setValue('Wilayah : '.$wilayah);
			$worksheet->setTitle($w->wilayah);

			$myWorkSheet = new PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, "Sheet");
			$spreadsheet->addSheet($myWorkSheet);
			$spreadsheet->setActiveSheetIndexByName('Sheet');
		}
		// End looping

		// sent to browser client with http header
		header ('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header ('Content-Disposition: attachment;filename="'.$file_name.'"');
		header ('Cache-Control: max-age=0');
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		// $writer->save($save_path.$file_name);
	}

	public function tes_copy()
	{
		$template_path = BASEPATH.'../assets/report/template/excel/';
		$spreadsheet = IOFactory::load($template_path.'tes.xlsx');

		// $clonedWorksheet = clone $spreadsheet->getActiveSheet();
		// $clonedWorksheet->setTitle('Sheet2g');
		// $spreadsheet->addSheet($clonedWorksheet);
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(10);
		$worksheet = $spreadsheet->getActiveSheet();

		$styleArray = [
	    'borders' => [
	      'outline' => [
	          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
	          'color' => ['rgb' => 'A9A9A9'],
	      ],
	    ],
		];

		$worksheet->getStyle('A6:L6')->applyFromArray($styleArray);

		$worksheet->getCell("A6")->setValue('1');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$save_path = "assets/report/export/excel/";
		$file_name = 'tes_'.date('d-m-Y').'.xlsx';
		$writer->save($save_path.$file_name);

		// header ('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header ('Content-Disposition: attachment;filename="'.$file_name.'"');
		// header ('Cache-Control: max-age=0');
		// $writer->save('php://output');
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

	// public function pelanggan()
	// {
	// 	$x1 = html_escape($this->input->post('lap_wilayah'));
	// 	$x2 = html_escape($this->input->post('lap_status'));
	// 	$x3 = html_escape($this->input->post('lap_group_all'));
	// 	$x4 = html_escape($this->input->post('lap_bln_instalasi'));
	// 	$info = $this->db->query("SELECT * FROM profil_perusahaan WHERE id_profil = 1")->row();
	//
	// 	if (isset($x1)) {
	// 		$data = $this->lap->by_wilayah($x1);
	// 		$title = 'Laporan Pelanggan';
	// 		$subtitle = 'Wilayah';
	// 		$tanggal = tgl_sekarang();
	// 		$this->load->view('admin/laporan/lap_pelanggan_by_wilayah',$data);
	// 	}
	//
	// 	$output = array(
	// 		'data' => $data,
	// 		'summary' => $summary,
	// 		'profil' => $info,
	// 		'header' => array(
	// 			'title' => $title,
	// 			'subtitle' => $subtitle,
	// 			'tanggal' => $tanggal
	// 		)
	// 	);
	//
	//
	// }

	 /*
	 * EXPORT TO FPDF
	 */
	//
	// public function exportnow()
	// {
	// 	$data['data'] = $this->bagian->getAll();
	// 	$this->load->view('admin/bagian/report',$data);
	// 	// echo "<pre>";
	// 	// echo print_r($data);
	// 	// echo "</pre>";
	// }
	//
	// public function tes()
	// {
	// 	echo tgl_sekarang()."<br>";
	// 	echo bulan_tahun('2018-03')."<br>";
	// 	echo tgl_lokal('2018-01-19')."<br>";
	// }
}
