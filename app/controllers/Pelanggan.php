<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Pelanggan extends CI_Controller {


	function __construct()
  {
      parent::__construct();
			$this->load->model('pelanggan_model','pelanggan');
			$this->load->helper(array('MY_ribuan','MY_bulan'));
  }

	public function index()
	{
		// $data['title'] = 'Not Founds';
		// $this->load->view('errors/html/error_404',$data);
		echo "No direct script access allowed";
	}

	public function ajax_list() {
	$list = $this->pelanggan->get_datatables();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();
		// Foto Pelanggan
		if ($br->foto=='') {
			$foto = '<span class="client-avatar"><img src="'.base_url('assets/inspinia271/img/pelanggan/a8.jpg').'" onclick="views(\''.$br->id_pelanggan.'\')" alt="'.$br->nama_lengkap.'"></span>';
		} else {
			$foto = $br->foto;
		}
		$row[] = $foto;
		$row[] = "<span class='font-bold'>$br->kode_pelanggan</span>";
		$row[] = "<span class='font-bold'>$br->nama_lengkap</span>";
		// $row[] = $br->no_ktp;
		$row[] = $br->wilayah;
		$row[] = $br->alamat;
		$row[] = $br->tgl_pasang;
		// $row[] = $br->telp;
		// Tarif Pelanggan
		if ($br->id_tarif=='1') {
			$tarif = '<a href="javascript:void(0)" class="btn btn-xs btn-default"> Rp.'.ribuan($br->tarif).',-</a>';
		} elseif ($br->id_tarif=='2') {
			$tarif = '<a href="javascript:void(0)" class="btn btn-xs btn-success"> Rp.'.ribuan($br->tarif).',-</a>';
		} elseif ($br->id_tarif=='3') {
			$tarif = '<a href="javascript:void(0)" class="btn btn-xs btn-primary"> Rp.'.ribuan($br->tarif).',-</a>';
		} else {
			$tarif = '<a href="javascript:void(0)" class="btn btn-xs btn-warning"> Rp.'.ribuan($br->tarif).',-</a>';
		}
		// Status Pelanggan
		if ($br->id_status=='1') {
			$status = '<a href="javascript:void(0)" class="btn btn-xs btn-primary">'.$br->status.'</a>';
		} elseif ($br->id_status=='2') {
			$status = '<a href="javascript:void(0)" class="btn btn-xs btn-warning">'.$br->status.'</a>';
		} else {
			$status = '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.$br->status.'</a>';
		}
		$row[] = $tarif;
		$row[] = $status;
	//add html for action
		$row[] = "<div class=\"btn-group\"><a class=\"btn btn-xs btn-outline btn-primary\" href=\"javascript:void(0)\" onclick=\"views('$br->id_pelanggan')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i> Lihat</a>
				<a class=\"btn btn-xs btn-outline btn-warning\" href=\"javascript:void(0)\" onclick=\"edits('$br->id_pelanggan')\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i> Edit</a>
				<a class=\"btn btn-xs btn-outline btn-danger\" href=\"javascript:void(0)\" onclick=\"deletes('$br->id_pelanggan')\" title=\"Hapus\" ><i class=\"glyphicon glyphicon-trash\"></i> Delete</a></div>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pelanggan->count_all(),
						"recordsFiltered" => $this->pelanggan->count_filtered(),
						"data" => $data
					);
		//output to json format
		echo json_encode($output);
	}

	public function save_pelanggan()
	{
		$this->_validate();
		$data = array(
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'no_ktp' => $this->input->post('no_ktp'),
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'wilayah' => $this->input->post('wilayah'),
			'alamat' => $this->input->post('alamat'),
			'tgl_pasang' => $this->input->post('tgl_pasang'),
			'telp' => $this->input->post('telp'),
			'tarif' => $this->input->post('tarif'),
			'status' => $this->input->post('status'),
			'foto' => $this->input->post('foto'),
		);
		$insert = $this->pelanggan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_pelanggan()
	{
		$this->_validate();
		$data = array(
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'no_ktp' => $this->input->post('no_ktp'),
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'wilayah' => $this->input->post('wilayah'),
			'alamat' => $this->input->post('alamat'),
			'tgl_pasang' => $this->input->post('tgl_pasang'),
			'telp' => $this->input->post('telp'),
			'tarif' => $this->input->post('tarif'),
			'status' => $this->input->post('status'),
			'foto' => $this->input->post('foto'),
		);
		$this->pelanggan->update(array('id_pelanggan' => $this->input->post('id_pelanggan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_pelanggan($id_pelanggan)
	{
		$this->pelanggan->delete_by_id($id_pelanggan);
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id_pelanggan=FALSE)
	{
		$data= $this->pelanggan->get_by_id($id_pelanggan);
		echo json_encode($data);
	}

	public function vget_edit($id_pelanggan=FALSE)
	{
		$data1= $this->pelanggan->v_get_by_id($id_pelanggan);
		// Tarif Pelanggan
		if ($data1->id_tarif=='1') {
			$tarif = '<a href="javascript:void(0)" class="btn btn-xs btn-default"> Rp.'.ribuan($data1->tarif).',-</a>';
		} elseif ($data1->id_tarif=='2') {
			$tarif = '<a href="javascript:void(0)" class="btn btn-xs btn-success"> Rp.'.ribuan($data1->tarif).',-</a>';
		} elseif ($data1->id_tarif=='3') {
			$tarif = '<a href="javascript:void(0)" class="btn btn-xs btn-primary"> Rp.'.ribuan($data1->tarif).',-</a>';
		} else {
			$tarif = '<a href="javascript:void(0)" class="btn btn-xs btn-warning"> Rp.'.ribuan($data1->tarif).',-</a>';
		}
		// Status Pelanggan
		if ($data1->id_status=='1') {
			$status = '<a href="javascript:void(0)" class="btn btn-xs btn-primary">'.$data1->status.'</a>';
		} elseif ($data1->id_status=='2') {
			$status = '<a href="javascript:void(0)" class="btn btn-xs btn-warning">'.$data1->status.'</a>';
		} else {
			$status = '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.$data1->status.'</a>';
		}

		$data = array(
			'id_pelanggan' => $data1->id_pelanggan,
			'kode_pelanggan' => $data1->kode_pelanggan,
			'no_ktp' => $data1->no_ktp,
			'nama_lengkap' => $data1->nama_lengkap,
			'wilayah' => $data1->wilayah,
			'alamat' => $data1->alamat,
			'tgl_pasang' => $data1->tgl_pasang,
			'telp' => $data1->telp,
			'tarif' => $tarif,
			'status' => $status,
			'foto' => $data1->foto,
		);
		echo json_encode($data);
	}

	public function getCode($wil) {
    $id_wilayah = ucfirst($wil);
		$kodeWil = $this->pelanggan->cekKodeWil($id_wilayah);
    if ($id_wilayah !='' && $id_wilayah == $kodeWil->id_wilayah) {
			// Membuat Kode Pelanggan Baru Berdasarkan Wilayah
      $hasil = $this->pelanggan->cekLastKodeWil_v2($kodeWil->kode_wilayah);
      $kdMax = $hasil->maxKode;
      $noUrut = (int) substr($kdMax, 3, 5);
      $noUrut++;
      $newKode['newCode'] = strtoupper($kodeWil->kode_wilayah . sprintf("%03s", $noUrut));
			// echo json_encode($hasil)."<br>".(int)substr('KWA003', 3, 5)."<br>".strtoupper($newKode);
			echo json_encode($newKode);
		}
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		//id tidak divalidasi karena auto_increment
		if($this->input->post('kode_pelanggan') == '') {
			$data['inputerror'][] = 'kode_pelanggan';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('no_ktp') == '') {
			$data['inputerror'][] = 'no_ktp';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('nama_lengkap') == '') {
			$data['inputerror'][] = 'nama_lengkap';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('alamat') == '') {
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('tgl_pasang') == '') {
			$data['inputerror'][] = 'tgl_pasang';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('telp') == '') {
			$data['inputerror'][] = 'telp';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		// if($this->input->post('foto') == '') {
		// 	$data['inputerror'][] = 'foto';
		// 	$data['error_string'][] = 'Enter this field!';
		// 	$data['status'] = FALSE;
		// }

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}



   /*
	 *	Export to FPDF
	 */

	public function exportpdf()
	{
		$data['info'] = $this->db->query("SELECT * FROM profil_perusahaan WHERE id_profil=1 ")->row();
		$data['data'] = $this->pelanggan->get_datatables();
		$title = ($_POST['search']['value'] == null) ? "PELANGGAN" : $_POST['search']['value'];
		$data['other'] = array('bulan' => bulan(date('m'))." ".date('Y'),'title' => $title);
		$this->load->view('admin/pelanggan/report2',$data);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// echo $data['info']->nama_perusahaan;
	}

	public function gis_customers()
	{
		$req = $this->db->query("SELECT p.kode_pelanggan,p.nama_lengkap,p.wilayah,p.alamat,p.`status`,p.lat,p.`long`
			FROM v_gis_pelanggan p
			WHERE p.lat != '' AND p.`long` != ''
			ORDER BY p.id_wilayah ASC")->result();

		$data = array();
		$index = 0;
		foreach ($req as $k) {
			$index++;
			$row = array();
			$row[] = $index;
			$row[] = $k->lat;
			$row[] = $k->long;
			$row[] = $k->kode_pelanggan;
			$row[] = $k->nama_lengkap;
			$row[] = $k->wilayah;
			$row[] = $k->alamat;
			$row[] = $k->status;

			$data[] = $row;
		}

		// $option = array(
		// 	'zoom' => 13, // level zoom peta
		// 	'center' => 'centerMap',  // setting pusat peta ke centerMap
		// 	'mapTypeId' => 'google.maps.MapTypeId.ROADMAP' //menentukan tipe peta
		// );

		$output = array(
			'sites' => $data,
			// 'option' => $data,
		);

		echo json_encode($output);
	}

}
