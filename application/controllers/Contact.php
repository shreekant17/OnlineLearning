<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
    public function __construct(){

		parent::__construct();
		
	}

    public function index(){
        if($this->input->post('submit')){

            $email = "shreekantkalwar@gmail.com";
            $sender = $this->input->post('email');
            $name = $this->input->post('name');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $msg = "<p>From - </p>";
            $msg.= "<p>Name:- ".$name."</p>";
            $msg.= "<p>Email:- ".$sender."</p>";
            $msg.= "<p>Subect:- ".$subject."</p>";
            $msg.= "<p>".$message."</p>";

            $this->functions->mails($email, $msg,'Message From '.$name);

            $this->session->set_flashdata('success', 'Message Sent Succesfully');

            redirect(base_url('contact'), 'refresh');
            
        }else{
           $this->load->view('user/includes/header');
           $this->load->view('user/contact/contact');
           $this->load->view('user/includes/footer');
        }
    }
}