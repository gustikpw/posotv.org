<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan extends CI_Controller {

	function __construct()
  {
      parent::__construct();
			$this->load->model('karyawan_model','karyawan');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function ajax_list() {
	$list = $this->karyawan->get_datatables();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();
		$row[] = $br->id_karyawan;
		$row[] = "<span class='font-bold'>$br->kode_karyawan</span>";
		$row[] = "<span class='font-bold'>$br->nama_lengkap</span>";
		$row[] = $br->bagian;
		$row[] = $br->jabatan;
		$row[] = $sts = ($br->status == 'Aktif') ? '<a href="javascript:void()" class="btn btn-xs btn-primary">'.$br->status.'</a>' : '<a href="javascript:void()" class="btn btn-xs btn-warning">'.$br->status.'</a>' ;
	//add html for action
		$row[] = "<a class=\"btn btn-xs btn-primary\" href=\"javascript:void()\" onclick=\"views('$br->id_karyawan')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i> Lihat</a>
				<a class=\"btn btn-xs btn-warning\" href=\"javascript:void()\" onclick=\"edits('$br->id_karyawan')\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i> Edit</a>
				<a class=\"btn btn-xs btn-danger\" href=\"javascript:void()\" onclick=\"deletes('$br->id_karyawan')\" title=\"Hapus\" ><i class=\"glyphicon glyphicon-trash\"></i> Delete</a>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->karyawan->count_all(),
						"recordsFiltered" => $this->karyawan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function save_karyawan()
	{
		$this->_validate();
		$data = array(
			'kode_karyawan' => $this->input->post('kode_karyawan'),
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'bagian' => $this->input->post('bagian'),
			'jabatan' => $this->input->post('jabatan'),
			'status' => $this->input->post('status'),
			'tgl_masuk' => $this->input->post('tgl_masuk'),
			'tgl_berakhir' => $this->input->post('tgl_berakhir'),
			'no_ktp' => $this->input->post('no_ktp'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
		);
		$insert = $this->karyawan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_karyawan()
	{
		$this->_validate();
		$data = array(
			'kode_karyawan' => $this->input->post('kode_karyawan'),
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'bagian' => $this->input->post('bagian'),
			'jabatan' => $this->input->post('jabatan'),
			'status' => $this->input->post('status'),
			'tgl_masuk' => $this->input->post('tgl_masuk'),
			'tgl_berakhir' => $this->input->post('tgl_berakhir'),
			'no_ktp' => $this->input->post('no_ktp'),
			'alamat' => $this->input->post('alamat'),
			'telp' => $this->input->post('telp'),
		);
		$this->karyawan->update(array('id_karyawan' => $this->input->post('id_karyawan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_karyawan($id_karyawan)
	{
		$this->karyawan->delete_by_id($id_karyawan);
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id_karyawan=FALSE)
	{
		$data= $this->karyawan->get_by_id($id_karyawan);
		echo json_encode($data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		//id tidak divalidasi karena auto_increment
		if($this->input->post('kode_karyawan') == '') {
			$data['inputerror'][] = 'kode_karyawan';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('nama_lengkap') == '') {
			$data['inputerror'][] = 'nama_lengkap';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('bagian') == '') {
			$data['inputerror'][] = 'bagian';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('jabatan') == '') {
			$data['inputerror'][] = 'jabatan';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('status') == '') {
			$data['inputerror'][] = 'status';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('tgl_masuk') == '') {
			$data['inputerror'][] = 'tgl_berakhir';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('no_ktp') == '') {
			$data['inputerror'][] = 'no_ktp';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('alamat') == '') {
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('telp') == '') {
			$data['inputerror'][] = 'telp';
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
