<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Perbaikan_gangguan extends CI_Controller {

	function __construct()
  {
      parent::__construct();
			$this->load->model('pengaduan_model','pengaduan');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function ajax_list() {
	$list = $this->pengaduan->get_datatables();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();
		$row[] = $br->id_pengaduan;
		$row[] = "<span class='font-bold'>$br->kode_pelanggan</span>";
		$row[] = "<span class='font-bold'>$br->nama_lengkap</span>";
		$row[] = $br->wilayah;
		$row[] = "<span class='font-bold text-warning'>$br->tgl_lapor</span>";
		$row[] = $br->jenis_gangguan;
		// status aduan
		$stsAduan = $prioritas ='';
		if ($br->status_aduan=='Menunggu') {
			$stsAduan = '<a href="javascript:void(0)" class="btn btn-xs btn-warning"><i class="fa fa-spinner"></i> '.$br->status_aduan.'</a>';
		} elseif ($br->status_aduan=='Selesai') {
			$stsAduan = '<a href="javascript:void(0)" class="btn btn-xs btn-success"><i class="fa fa-check"></i> '.$br->status_aduan.'</a>';
		} elseif ($br->status_aduan=='Pending') {
			$stsAduan = '<a href="javascript:void(0)" class="btn btn-xs btn-info"><i class="fa fa-clock-o></i> '.$br->status_aduan.'</a>';
		} else {
			$stsAduan = '<a href="javascript:void(0)" class="btn btn-xs btn-danger"><i class="fa fa-warning"></i> '.$br->status_aduan.'</a>';
		}
		// prioritas perbaikan
		if ($br->prioritas=='Danger') {
			$prioritas = '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.$br->prioritas.'</a>';
		} elseif ($br->prioritas=='Medium') {
			$prioritas = '<a href="javascript:void(0)" class="btn btn-xs btn-info">'.$br->prioritas.'</a>';
		} elseif ($br->prioritas=='High') {
			$prioritas = '<a href="javascript:void(0)" class="btn btn-xs btn-warning">'.$br->prioritas.'</a>';
		} else {
			$prioritas = '<a href="javascript:void(0)" class="btn btn-xs btn-default">'.$br->prioritas.'</a>';
		}
		$row[] = $prioritas;
		$row[] = $stsAduan;
	//add html for action
		$row[] = "<div class=\"btn-group\"><a class=\"btn btn-xs btn-outline btn-primary\" href=\"javascript:void(0)\" onclick=\"edits('$br->id_pengaduan')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i> Update</a>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pengaduan->count_all(),
						"recordsFiltered" => $this->pengaduan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function update_pengaduan()
	{
		//$this->_validate();
			// 'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			// 'tgl_lapor' => $this->input->post('tgl_lapor'),
			// 'tgl_gangguan' => $this->input->post('tgl_gangguan'),
			// 'prioritas' => $this->input->post('prioritas'),
			// 'jenis_gangguan' => $this->input->post('jenis_gangguan'),
			// 'keterangan' => $this->input->post('keterangan'),
			$teknisi = $this->input->post('teknisi');
		$data = array(
			'tgl_perbaikan' => $this->input->post('tgl_perbaikan'),
			'teknisi' => json_encode($teknisi),
			'sebab' => $this->input->post('sebab'),
			'tindakan' => $this->input->post('tindakan'),
			'status_aduan' => $this->input->post('status_aduan'),
		);
		$this->pengaduan->update(array('id_pengaduan' => $this->input->post('id_pengaduan')), $data);
		// echo json_encode(array("status" => TRUE));
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id_pengaduan=FALSE)
	{
		$data1= $this->pengaduan->v_get_by_id($id_pengaduan);
		if ($data1->status == 'Aktif') {
			$status = '<a href="javascript:void(0)" class="btn btn-xs btn-success">'.$data1->status.'</a>';
		} else {
			$status = '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.$data1->status.'</a>';
		}
		if ($data1->prioritas=='Danger') {
			$prioritas = '<a href="javascript:void(0)" class="btn btn-xs btn-danger">'.$data1->prioritas.'</a>';
		} elseif ($data1->prioritas=='Medium') {
			$prioritas = '<a href="javascript:void(0)" class="btn btn-xs btn-info">'.$data1->prioritas.'</a>';
		} elseif ($data1->prioritas=='High') {
			$prioritas = '<a href="javascript:void(0)" class="btn btn-xs btn-warning">'.$data1->prioritas.'</a>';
		} else {
			$prioritas = '<a href="javascript:void(0)" class="btn btn-xs btn-default">'.$data1->prioritas.'</a>';
		}
		$data = array(
			'id_pengaduan' => $data1->id_pengaduan,
			'kode_pelanggan' => $data1->kode_pelanggan,
			'nama_lengkap' => $data1->nama_lengkap,
			'wilayah' => $data1->wilayah,
			'alamat' => $data1->alamat,
			'status' => $status,
			'tgl_lapor' => $data1->tgl_lapor,
			'tgl_gangguan' => $data1->tgl_gangguan,
			'prioritas' => $prioritas,
			'jenis_gangguan' => $data1->jenis_gangguan,
			'keterangan' => $data1->keterangan,
			'tgl_perbaikan' => $data1->tgl_perbaikan,
			'teknisi' => json_decode($data1->teknisi),
			'sebab' => $data1->sebab,
			'tindakan' => $data1->tindakan,
			'status_aduan' => $data1->status_aduan,
		);
		echo json_encode($data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		//id tidak divalidasi karena auto_increment
		// validasi untuk admin

		// validasi untuk teknisi
		if($this->input->post('tgl_perbaikan') == '') {
			$data['inputerror'][] = 'tgl_perbaikan';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		// if($this->input->post('teknisi') == '') {
		// 	$data['inputerror'][] = 'teknisi';
		// 	$data['error_string'][] = 'Enter this field!';
		// 	$data['status'] = FALSE;
		// }
		if($this->input->post('sebab') == '') {
			$data['inputerror'][] = 'sebab';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('tindakan') == '') {
			$data['inputerror'][] = 'tindakan';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('status_aduan') == '') {
			$data['inputerror'][] = 'status_aduan';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
