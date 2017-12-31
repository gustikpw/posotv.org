<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tarif extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      $this->load->model('tarif_model','tarif');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function ajax_list() {
	$list = $this->tarif->get_datatables();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();
		$row[] = $br->id_tarif;
		$row[] = "<span class='font-bold'>$br->kode_tarif</span>";
		$row[] = "<span class='font-bold'>$br->jml_tv</span>";
		$row[] = "<span class='font-bold'>$br->tarif</span>";
		$row[] = $br->keterangan;
	//add html for action
		$row[] = "<a class=\"btn btn-xs btn-primary\" href=\"javascript:void()\" onclick=\"views('$br->id_tarif')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i> Lihat</a>
				<a class=\"btn btn-xs btn-warning\" href=\"javascript:void()\" onclick=\"edits('$br->id_tarif')\" title=\"Edit\"><i class=\"glyphicon glyphicon-pencil\"></i> Edit</a>
				<a class=\"btn btn-xs btn-danger\" href=\"javascript:void()\" onclick=\"deletes('$br->id_tarif')\" title=\"Hapus\" ><i class=\"glyphicon glyphicon-trash\"></i> Delete</a>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->tarif->count_all(),
						"recordsFiltered" => $this->tarif->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function save_tarif()
	{
		$this->_validate();
		$data = array(
			'kode_tarif' => $this->input->post('kode_tarif'),
			'jml_tv' => $this->input->post('jml_tv'),
			'tarif' => $this->input->post('tarif'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$insert = $this->tarif->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_tarif()
	{
		$this->_validate();
		$data = array(
			'kode_tarif' => $this->input->post('kode_tarif'),
			'jml_tv' => $this->input->post('jml_tv'),
			'tarif' => $this->input->post('tarif'),
			'keterangan' => $this->input->post('keterangan'),
		);
		$this->tarif->update(array('id_tarif' => $this->input->post('id_tarif')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_tarif($id_tarif)
	{
		$this->tarif->delete_by_id($id_tarif);
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id_tarif=FALSE)
	{
		$data= $this->tarif->get_by_id($id_tarif);
		echo json_encode($data);
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		//id tidak divalidasi karena auto_increment
		if($this->input->post('kode_tarif') == '') {
			$data['inputerror'][] = 'kode_tarif';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('jml_tv') == '') {
			$data['inputerror'][] = 'jml_tv';
			$data['error_string'][] = 'Enter this field!';
			$data['status'] = FALSE;
		}
		if($this->input->post('tarif') == '') {
			$data['inputerror'][] = 'tarif';
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
