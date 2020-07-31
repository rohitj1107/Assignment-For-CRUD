<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->helper('security');
        $this->load->library('form_validation');
    }
  	public function index(){
  		  $this->load->view('Login_view');
  	}

    public function user_login(){

        $this->form_validation->set_rules('email','Registered Email','trim|required|min_length[3]');
        $this->form_validation->set_rules('password','Password','trim|md5|required');

        if ($this->form_validation->run()) {
            $email = $this->security->xss_clean($this->input->post('email'));
            // $password = md5($this->input->post('password'));
            $password = $this->input->post('password');

            $result = $this->Home_model->check_user($email,$password);

            if ($result) {

                $user_data = array('email'=>$email,'u_id'=>$result[0]->u_id,'logged_in'=>true);

                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('login_success','You are now logged in');

                return redirect('staff');
            } else {
                $this->session->set_flashdata('login_faild','ID and Password not match');
                return redirect('login');
            }
        } else {
          $data =  array('errors' => validation_errors());
          $this->session->set_flashdata($data);
          return redirect('login');
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        return redirect('login');
    }
}
