<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {
    public function __construct(){

		parent::__construct();
		
		$this->load->model('Authentication_model', 'auth');
		$this->load->model('dashboard_model', 'dashboard');
		
		$this->load->model('profile_model', 'profile');
		$this->load->model('comment_model', 'comment');
        $this->auth->check_auth();
        
	}

    public function add_comment(){
        
        $data = array(

            'lesson_id' => $this->input->post('lesson_id'),
            'comment'=> $this->input->post('comment'),
        );
        if($this->comment->add_comment($data)){
            return true;
        }
    }


    public function add_reply(){
        
        $data = array(

            'comment_id' => $this->input->post('comment_id'),
            'reply'=> $this->input->post('reply'),
        );
        if($this->comment->add_reply($data)){
            return true;
        }
    }

    public function get_comments(){
        echo json_encode($this->comment->get_comments_by_lesson_id($this->input->post('lesson_id')));
    }


    public function get_replies(){
        echo json_encode($this->comment->get_replies_by_comment_id($this->input->post('comment_id')));
    }
}