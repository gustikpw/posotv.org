<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Register extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Users_model','users');
  }

  public function index()
  {
    $this->load->view('register/register');
  }

  public function post()
  {
    $data = array(
			'username' => html_escape($this->input->post('username')),
	    'password' => md5(html_escape($this->input->post('password'))),
	    'level' => 'administrator',
			'aktif' => 'aktif',
      'id_karyawan' => 1,
		);

    if( $this->input->post('username') !='' || $this->input->post('password') !='' ){
      $insert = $this->users->save($data);
      redirect('login');
    } else {
      redirect('register');
    }
  }
}
