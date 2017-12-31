<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jenis_gangguan extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      $this->load->model('jenis_gangguan_model','jenis_gangguan');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function ajax_list() {
	$list = $this->jenis_gangguan->get_datatables();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();
		$row[] = $br->id_jenis_gangguan;
		$row[] = "<span class='font-bold'>$br->jenis_gangguan</span>";
		$row[] = $br->keterangan;
	//add html for action
		$row[] = "<a class=\"btn btn-xs btn-primary\" href=\"javascript:void()\" onclick=\"views('$br->id_jenis_gangguan')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i> Lihat</a>
				<a class=\"btn btn-xs btn-warning\" href=\"javascript:void()\" onclick=\"edits('$br->id_jenis_gangguan')\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i> Edit</a>
				<a class=\"btn btn-xs btn-danger\" href=\"javascript:void()\" onclick=\"deletes('$br->id_jenis_gangguan')\" title=\"Hapus\" ><i class=\"glyphicon glyphicon-trash\"></i> Delete</a>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jenis_gangguan->count_all(),
						"recordsFiltered" => $this->jenis_gangguan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function save_jenis_gangguan()
	{
		$this->_validate();
		$data = array(
		'jenis_gangguan' => $this->input->post('jenis_gangguan'),
		'keterangan' => $this->input->post('keterangan'),
		);
		$insert = $this->jenis_gangguan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_jenis_gangguan()
	{
		$this->_validate();
		$data = array(
		'jenis_gangguan' => $this->input->post('jenis_gangguan'),
		'keterangan' => $this->input->post('keterangan'),
		);
		$this->jenis_gangguan->update(array('id_jenis_gangguan' => $this->input->post('id_jenis_gangguan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_jenis_gangguan($id_jenis_gangguan)
	{
		$this->jenis_gangguan->delete_by_id($id_jenis_gangguan);
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id_jenis_gangguan=FALSE)
	{
		$data= $this->jenis_gangguan->get_by_id($id_jenis_gangguan);
		echo json_encode($data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		//id tidak divalidasi karena auto_increment
		if($this->input->post('jenis_gangguan') == '') {
			$data['inputerror'][] = 'jenis_gangguan';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('keterangan') == '') {
			$data['inputerror'][] = 'keterangan';
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
