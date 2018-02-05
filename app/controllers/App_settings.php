<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_settings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('App_settings_model','settings');
    }

    public function index()
    {
        // $this->load->helper('url');
        echo "This not a Page!";
    }

   public function save_settings($option_name='')
   {
      switch ($option_name) {
         case 'invoice_key':
            $key_old = html_escape($this->input->post('invoice_key_old'));
            $key_new = html_escape($this->input->post('invoice_key_new'));
            if ($this->_cek_invoice_key($key_old) == TRUE) {
              $this->settings->update(array('option_name' => $option_name), array('option_value' => $key_new));
              echo json_encode(['status' => TRUE]);
            } else {
              echo json_encode(['status' => FALSE]);
            }
            break;
         case 'customer_service':

            break;
         case 'invoice_terms':
            $data = array(
                'batas' => html_escape($this->input->post('batas')),
                'info1' => html_escape($this->input->post('info1')),
                'info2' => html_escape($this->input->post('info2')),
                'info3' => html_escape($this->input->post('info3')),
                'info4' => html_escape($this->input->post('info4')),
                'info5' => html_escape($this->input->post('info5')),
                'info6' => html_escape($this->input->post('info6'))
            );
            $this->settings->update(array('option_name' => $option_name), array('option_value' => serialize($data)));
            echo json_encode(['status' => TRUE]);
            break;
         case 'login_info':

            break;
         case 'api_encrypt_key':

            break;
         case 'surat_pemutusan':
            $data = array(
                'perihal' => html_escape($this->input->post('perihal')),
                'pembuka' => html_escape($this->input->post('pembuka')),
                'ket1' => html_escape($this->input->post('ket1')),
                'penutup' => html_escape($this->input->post('penutup')),
                'pimpinan' => html_escape($this->input->post('pimpinan')),
                'jabatan' => html_escape($this->input->post('jabatan')),
            );
            $this->settings->update(array('option_name' => $option_name), array('option_value' => serialize($data)));
            echo json_encode(['status' => TRUE]);
            break;
         default:
            echo "default";
            break;
      }

   }

  private function _cek_invoice_key($key_old)
  {
    $q = $this->settings->getSettings('invoice_key');
    return ($key_old == $q->invoice_key) ? TRUE : FALSE;
  }

  public function call_settings()
  {
    $data = array(
      'terms' => unserialize($this->settings->getSettings_serial('invoice_terms')->option_value),
      'surat' => unserialize($this->settings->getSettings_serial('surat_pemutusan')->option_value)
    );
    echo json_encode($data);
  }

}
