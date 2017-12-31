<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sms_inbox extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      $this->load->model('sms_model','sms_inbox');
  }

	public function index()
	{
		$data['title'] = 'Not Founds';
		$this->load->view('errors/html/error_404',$data);
	}

	public function ajax_list() {
	$list = $this->sms_inbox->get_datatables_inbox();
	$data = array();
	$no = $_POST['start'];
	foreach ($list as $br) {
		$no++;
		$row = array();

		$telp = str_replace("+62","",$br->SenderNumber);
		$query = $this->sms_inbox->get_customers_by($telp);
		if ($query->num_rows() > 0) {
			$q2 = $query->row();
			$kode_pelanggan = $q2->kode_pelanggan;
		} else {
			$kode_pelanggan = 'Unknown';
		}

		$row[] = $br->ID;
		$row[] = "<span class='font-bold'>$kode_pelanggan ($br->SenderNumber)</span>";
		$row[] = $br->Text;
		$row[] = $br->ReceivingDateTime;
	//add html for action
		$row[] = "<a class=\"btn btn-xs btn-primary\" href=\"javascript:void()\" onclick=\"views('$br->ID')\" title=\"Lihat Detail\"><i class=\"glyphicon glyphicon-eye-open\"></i></a>
				<a class=\"btn btn-xs btn-danger\" href=\"javascript:void()\" onclick=\"deletes('$br->ID')\" title=\"Hapus\" ><i class=\"glyphicon glyphicon-trash\"></i></a>";
		$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->sms_inbox->count_all_inbox(),
						"recordsFiltered" => $this->sms_inbox->count_filtered_inbox(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function delete($id)
	{
		$this->sms_inbox->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function get_edit($id=FALSE)
	{
		$q = $this->sms_inbox->get_by_id('inbox',$id);
		$data = array();
		$row = array();

		$row['id'] = $q->ID;
		$row['SenderNumber'] = $q->SenderNumber;
		$row['Text'] = $q->Text;
		$row['ReceivingDateTime'] = $q->ReceivingDateTime;

		$telp = str_replace("+62","",$q->SenderNumber);
		$query = $this->sms_inbox->get_customers_by($telp);
		if ($query->num_rows() > 0) {
			$q2 = $query->row();
			$row['kode_pelanggan'] = $q2->kode_pelanggan;
			$row['nama_lengkap'] = $q2->nama_lengkap;
			$row['wilayah'] = $q2->wilayah;
			$row['alamat'] = $q2->alamat;
			$row['telp'] = $q2->telp;
			$row['tarif'] = $q2->tarif;
			$row['status'] = $q2->status;
		} else {
			$row['kode_pelanggan'] = 'Not Founds!';
			$row['nama_lengkap'] = 'Not Founds!';
			$row['wilayah'] = 'Not Founds!';
			$row['alamat'] = 'Not Founds!';
			$row['telp'] = 'Not Founds!';
			$row['tarif'] = 'Not Founds!';
			$row['status'] = 'Not Founds!';
		}

		echo json_encode($row);
	}



}
