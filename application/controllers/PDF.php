<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PDF extends CI_Controller {
    public function __construct(){

		parent::__construct();
		
		$this->load->model('Authentication_model', 'auth');
		$this->load->model('dashboard_model', 'dashboard');
		
		$this->load->model('profile_model', 'profile');
		$this->load->model('pdf_model', 'pdf');
        $this->load->helper(array('form', 'url'));
        $this->auth->check_auth();
        
	}

    public function upload_file() {

        $title = $this->input->post('title');
        $lesson_id = $this->input->post('lesson_id');

        $config['upload_path']   = './uploads/pdfs/';
        $config['allowed_types'] = '*';
        $config['max_size']      = 204800; // 2MB max file size

        $timestamp = date('YmdHis');
        $file_name = $timestamp . '_' . $_FILES['pdffile']['name'];
        $config['file_name'] = $file_name;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('pdffile')) {
            // Upload failed
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        } else {
            // Upload success

            $upload_data = $this->upload->data();
            $file_path = './uploads/pdfs/' . $upload_data['file_name'];

            // Prepare data to store in database
            $data = array(
                'title' => $title,
                'pdf_src' => $file_path,
                'lesson_id' => $lesson_id,
            );

            $this->pdf->add($data);
            
            $data = array('upload_data' => $this->upload->data());
            echo json_encode($data);
        }
    }

    public function datatable_json_pdf($lesson_id){
        $records['data'] = $this->pdf->get_all_pdf_by_lesson_id($lesson_id);
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			
            
            
			$data[]= array(
				++$i,
				$row['title'],
               
               '<i class="fa-solid fa-file-pdf"></i>',
                
				
                date_time($row['created_at']),	

                "<a href='".base_url($row['pdf_src'])."' ><i class=' fa-solid fa-download'></i></a>",

                
			);
		}
		$records['data']=$data;
		echo json_encode($records);	
    }
}