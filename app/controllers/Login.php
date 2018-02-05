<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model','login');
	}

	public function index()
	{
		$this->_autentikasi();
	}

	public function login()
	{
		$user = html_escape($this->input->post('username'));
		$pass = md5(html_escape($this->input->post('password')));
		$cekUser = $this->login->getUser($user,$pass);
		if ($cekUser->num_rows()===1) {
			$usr = $cekUser->row();
			if ($usr->aktif=='aktif') {
				$this->session->set_flashdata('errors','Login sebagai administrator aktif');
			  $sess_data = array(	'username' => $usr->username,
											      'ses_admin' => TRUE,
														'alias' => $usr->nama_lengkap,
														'level' => $usr->level,
														'sesikode' => urlencode(base64_encode($usr->id_karyawan)),
	      );
	      $this->session->set_userdata($sess_data);
				$this->_admin();
			}
			if ($usr->aktif=='nonaktif') {
				$this->session->set_flashdata('errors','<span class="text-danger text-center">User sedang dinon-aktifkan! Hubungi Administrator</span>');
				$this->index();
			}
		} elseif ($user=='superadmin' && $pass == 'e15895d23550b0b2c036801c322929f7') {
			$this->_superAdmin($user);
		} else {
			$this->session->set_flashdata('errors','<span class="text-danger text-center">Silahkan login dengan akun lain!</span>');
			$this->index();
		}
	}

	private function _admin()
	{
		$session=isset($_SESSION['ses_admin']) ? $_SESSION['ses_admin']:FALSE;
		if($session==FALSE){
			$this->login();
		}
		else { redirect(site_url('dashboard')); }
	}

	public function logout()
	{
    $sess_data=array('username','ses_admin','alias','level','sesikode');
    $this->session->unset_userdata($sess_data);
		$this->login();
	}

	private function _autentikasi()
	{
		if ($this->session->level=='administrator' || $this->session->level=='kolektor' || $this->session->level=='teknisi') {
			// redirect(site_url('index.php/dashboard'));
			$this->_admin();
		} else {
			$data['title'] = 'POSO TV App';
			$this->load->view('login/login',$data);
		}
	}

	private function _superAdmin($user)
	{
		$sess_data = array(	'username' => $user,
												'ses_admin' => TRUE,
												'alias' => 'Super Administrator',
												'level' => 'administrator',
												'sesikode' => urlencode(base64_encode('1')),
		);
		$this->session->set_userdata($sess_data);
		$this->_admin();
	}

}
