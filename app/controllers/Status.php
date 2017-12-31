<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Status extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      $this->load->model('status_model','status');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function ajax_list() {
	$list = $this->status->get_datatables();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();
		$row[] = $br->id_status;
		$row[] = "<span class='font-bold'>$br->status</span>";
		$row[] = $br->keterangan;
	//add html for action
		$row[] = "<a class=\"btn btn-xs btn-primary\" href=\"javascript:void()\" onclick=\"views('$br->id_status')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i> Lihat</a>
				<a class=\"btn btn-xs btn-warning\" href=\"javascript:void()\" onclick=\"edits('$br->id_status')\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i> Edit</a>
				<a class=\"btn btn-xs btn-danger\" href=\"javascript:void()\" onclick=\"deletes('$br->id_status')\" title=\"Hapus\" ><i class=\"glyphicon glyphicon-trash\"></i> Delete</a>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->status->count_all(),
						"recordsFiltered" => $this->status->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function save_status()
	{
		$this->_validate();
		$data = array(
		'status' => $this->input->post('status'),
		'keterangan' => $this->input->post('keterangan'),
		);
		$insert = $this->status->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_status()
	{
		$this->_validate();
		$data = array(
		'status' => $this->input->post('status'),
		'keterangan' => $this->input->post('keterangan'),
		);
		$this->status->update(array('id_status' => $this->input->post('id_status')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_status($id_status)
	{
		$this->status->delete_by_id($id_status);
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id_status=FALSE)
	{
		$data= $this->status->get_by_id($id_status);
		echo json_encode($data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		//id tidak divalidasi karena auto_increment
		if($this->input->post('status') == '') {
			$data['inputerror'][] = 'status';
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
