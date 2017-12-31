<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jabatan extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      $this->load->model('jabatan_model','jabatan');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function ajax_list() {
	$list = $this->jabatan->get_datatables();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();
		$row[] = $br->id_jabatan;
		$row[] = "<span class='font-bold'>$br->jabatan</span>";
		$row[] = $br->keterangan;
	//add html for action
		$row[] = "<a class=\"btn btn-xs btn-primary\" href=\"javascript:void()\" onclick=\"views('$br->id_jabatan')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i> Lihat</a>
				<a class=\"btn btn-xs btn-warning\" href=\"javascript:void()\" onclick=\"edits('$br->id_jabatan')\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i> Edit</a>
				<a class=\"btn btn-xs btn-danger\" href=\"javascript:void()\" onclick=\"deletes('$br->id_jabatan')\" title=\"Hapus\" ><i class=\"glyphicon glyphicon-trash\"></i> Delete</a>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jabatan->count_all(),
						"recordsFiltered" => $this->jabatan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function save_jabatan()
	{
		$this->_validate();
		$data = array(
		'jabatan' => $this->input->post('jabatan'),
		'keterangan' => $this->input->post('keterangan'),
		);
		$insert = $this->jabatan->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_jabatan()
	{
		$this->_validate();
		$data = array(
		'jabatan' => $this->input->post('jabatan'),
		'keterangan' => $this->input->post('keterangan'),
		);
		$this->jabatan->update(array('id_jabatan' => $this->input->post('id_jabatan')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_jabatan($id_jabatan)
	{
		$this->jabatan->delete_by_id($id_jabatan);
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id_jabatan=FALSE)
	{
		$data= $this->jabatan->get_by_id($id_jabatan);
		echo json_encode($data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		//id tidak divalidasi karena auto_increment
		if($this->input->post('jabatan') == '') {
			$data['inputerror'][] = 'jabatan';
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
