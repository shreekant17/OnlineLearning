<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH. 'views/razorpay/Razorpay.php';
use Razorpay\Api\Api;

class Payment extends CI_Controller {

    public function __construct(){

		parent::__construct();
		
		$this->load->model('Authentication_model', 'auth');
		$this->load->model('dashboard_model', 'dashboard');
		$this->load->model('student_model', 'student');
		$this->load->model('payment_model', 'payment');
        $this->auth->check_auth();
        if(!$this->session->userdata('student_id')){
            redirect(base_url('dashboard'));
        }
	}

    public function checkout($id){

        $data['course'] = $this->dashboard->get_course_by_id($id);

        $data['student'] = $this->student->get_student_by_id($this->session->userdata['student_id']);

        $this->load->view('user/includes/header');
        $this->load->view('payment/checkout', $data);
        $this->load->view('user/includes/footer');
    }

    public function pay(){

        

        $key_id = "rzp_test_coUJEAjnC3hypb";
        $secret = "RnOXHVpBejUMPoghkyhCGihA";
        $api = new Api($key_id, $secret);

        $price=$this->input->post('price');
        $course_id=$this->input->post('course_id');
        

       

        $order = $api->order->create(array(
            'receipt' => '123', 
            'amount' => $price*100, 
            'currency' => 'INR', 
            'notes'=> array(
                'key1'=> 'value3',
                'key2'=> 'value2'
            )
        ));

        $data['order']=$order;

     

        $data['customer_data'] = $this->student->get_student_by_id($this->session->userdata['student_id']);
        $data['key_id'] = $key_id;
        $data['secret'] = $secret;
        $data['course_id'] = $course_id; 
        


        $this->load->view('payment/razorpay-checkout', $data);
    }

    public function payment_status(){


        $this->form_validation->set_rules('razorpay_payment_id', 'Razorpay Payment ID', 'trim|required|is_unique[payments.razorpay_payment_id]');
        $this->form_validation->set_rules('razorpay_order_id', 'Razorpay Order ID', 'trim|required|is_unique[payments.razorpay_order_id]');
        $this->form_validation->set_rules('razorpay_signature', 'Razorpay Signature ID', 'trim|required|is_unique[payments.razorpay_signature]');
        
        

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'errors' => validation_errors()
            );

            $this->load->view('payment/payment-failed');
            
        } else{

            $razorpay_payment_id=$this->input->post('razorpay_payment_id');
            $razorpay_order_id=$this->input->post('razorpay_order_id');
            $razorpay_signature=$this->input->post('razorpay_signature');

            $price = $this->input->post('price');
            $price = $price/100;

            $course_id = $this->input->post('course_id');

            $secret = "RnOXHVpBejUMPoghkyhCGihA";
            $data = $razorpay_order_id . "|" . $razorpay_payment_id;
            $generated_signature = hash_hmac("sha256", $data, $secret);
            if($generated_signature == $razorpay_signature){
                    $sales_data=array(
                        'course_id' => $course_id,
                        'student_id' => $this->session->userdata['student_id'],
                        'price' => $price,
                        'method'=> 'Razor Pay',
                        'razorpay_payment_id' => $razorpay_payment_id,
                        'razorpay_order_id' => $razorpay_order_id,
                        'razorpay_signature' => $razorpay_signature,
                    );
                    $this->payment->add($sales_data);

                    $this->load->view('payment/payment-successful');
            }else{
                $this->load->view('payment/payment-failed');
            }
        }
    }
}