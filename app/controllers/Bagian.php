<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bagian extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      $this->load->model('bagian_model','bagian');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function ajax_list() {
	$list = $this->bagian->get_datatables();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();
		$row[] = $br->id_bagian;
		$row[] = "<span class='font-bold'>$br->bagian</span>";
		$row[] = $br->keterangan;
	//add html for action
		$row[] = "<a class=\"btn btn-xs btn-primary\" href=\"javascript:void()\" onclick=\"views('$br->id_bagian')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i> Lihat</a>
				<a class=\"btn btn-xs btn-warning\" href=\"javascript:void()\" onclick=\"edits('$br->id_bagian')\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i> Edit</a>
				<a class=\"btn btn-xs btn-danger\" href=\"javascript:void()\" onclick=\"deletes('$br->id_bagian')\" title=\"Hapus\" ><i class=\"glyphicon glyphicon-trash\"></i> Delete</a>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->bagian->count_all(),
						"recordsFiltered" => $this->bagian->count_filtered(),
						"data" => $data,
						// "list" => $list,
				);
		//output to json format
		echo json_encode($output);
	}

	public function save_bagian()
	{
		$this->_validate();
		$data = array(
		'bagian' => $this->input->post('bagian'),
		'keterangan' => $this->input->post('keterangan'),
		);
		$insert = $this->bagian->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_bagian()
	{
		$this->_validate();
		$data = array(
		'bagian' => $this->input->post('bagian'),
		'keterangan' => $this->input->post('keterangan'),
		);
		$this->bagian->update(array('id_bagian' => $this->input->post('id_bagian')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_bagian($id_bagian)
	{
		$this->bagian->delete_by_id($id_bagian);
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id_bagian=FALSE)
	{
		$data= $this->bagian->get_by_id($id_bagian);
		echo json_encode($data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		//id tidak divalidasi karena auto_increment
		if($this->input->post('bagian') == '') {
			$data['inputerror'][] = 'bagian';
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

}
