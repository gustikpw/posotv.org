<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wilayah extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      $this->load->model('wilayah_model','wilayah');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function ajax_list() {
	$list = $this->wilayah->get_datatables();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();
		$row[] = $br->kode_wilayah;
		$row[] = "<span class='font-bold'>$br->wilayah</span>";
		$row[] = $br->keterangan;
	//add html for action
		$row[] = "<a class=\"btn btn-xs btn-primary\" href=\"javascript:void()\" onclick=\"views('$br->id_wilayah')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i> Lihat</a>
				<a class=\"btn btn-xs btn-warning\" href=\"javascript:void()\" onclick=\"edits('$br->id_wilayah')\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i> Edit</a>
				<a class=\"btn btn-xs btn-danger\" href=\"javascript:void()\" onclick=\"deletes('$br->id_wilayah')\" title=\"Hapus\" ><i class=\"glyphicon glyphicon-trash\"></i> Delete</a>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->wilayah->count_all(),
						"recordsFiltered" => $this->wilayah->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function save_wilayah()
	{
		$this->_validate();
		$data = array(
			'kode_wilayah' => $this->input->post('kode_wilayah'),
			'wilayah' => $this->input->post('wilayah'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$insert = $this->wilayah->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_wilayah()
	{
		$this->_validate();
		$data = array(
			'kode_wilayah' => $this->input->post('kode_wilayah'),
			'wilayah' => $this->input->post('wilayah'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->wilayah->update(array('id_wilayah' => $this->input->post('id_wilayah')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_wilayah($id_wilayah)
	{
		$this->wilayah->delete_by_id($id_wilayah);
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id_wilayah=FALSE)
	{
		$data= $this->wilayah->get_by_id($id_wilayah);
		echo json_encode($data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		//id tidak divalidasi karena auto_increment
		if($this->input->post('kode_wilayah') == '') {
			$data['inputerror'][] = 'kode_wilayah';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('wilayah') == '') {
			$data['inputerror'][] = 'wilayah';
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
