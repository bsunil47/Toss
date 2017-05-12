<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends My_Controller {
	
	//private $redirecturl;
	
public function __construct(){
	
	
	 parent::__construct();
	 $allowed_methodes = array('forgot_changepassword');
	 $contlr=$this->uri->segment(1);
	 
	 $fnctn=$this->uri->segment(2);
	 
		/*if (!in_array($this->router->fetch_method(),$allowed_methodes) && !$this->_is_home_logged_in()) {

            redirect(base_url());
        }*/
	
	
	 $this->load->model("common_model");
	
	 

	 }
public function forgot_changepassword($id) {
   
        $data = array();
        $data['hashcode'] = $id;
       $this->load->library('form_validation');
        if (isset($_POST['submit'])) {
            /*if ($this->form_validation->run('forgottochange') == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            } else {*/
                $this->common_model->initialise('hashurl');
                $data_array = $this->common_model->get_record_single(array('hashcode' => $id), '*');
                if (empty($data_array)) {
                show_404();
                } else if ($data_array->status == 1) {
                    $this->session->set_flashdata('error', 'Already used this link');
                } else {
                    $this->common_model->initialise('users');
                    $this->common_model->array = array('password' => md5($_POST['c_n_pwd']));
                    $update=$this->common_model->update(array('user_id' => $data_array->user_id));
                if ($update==false) {
                    $this->session->set_flashdata('success', 'Password Changed Successfully');
                    $this->common_model->initialise('hashurl');
                    $this->common_model->array = array('status' => 1);
                    $this->common_model->update(array('hashcode' => $id));
                }
                }
                redirect(base_url().'frontend/forgot_changepassword/'.$id);
            /*}*/
            
        }
       
        $this->load->view("frontend/forgot", $data);
    }

}
?>