<?php
	class Authentication_model extends CI_Model{

		public function signup_student($data){
			$this->db->insert('ci_students', $data);
			return $this->db->insert_id();
		}

		public function signup_instructor($data){
			$this->db->insert('ci_instructors', $data);
			return $this->db->insert_id();
		}

        public function update_otp_student($otp, $id){
            $this->db->where('student_id', $id);
            $this->db->update('ci_students', $otp);
        }

        public function update_otp_instructor($otp, $id){
            $this->db->where('instructor_id', $id);
            $this->db->update('ci_instructors', $otp);
        }

        public function get_student_by_id($id){
            $this->db->where('student_id', $id);
            return $this->db->get('ci_students')->row_array();
        }

        public function get_instructor_by_id($id){
            $this->db->where('instructor_id', $id);
            return $this->db->get('ci_instructors')->row_array();
        }


        public function verify_student($otp, $id){
            $this->db->where('login_otp', $otp);
            $this->db->where('student_id', $id);
            $query = $this->db->get('ci_students');
            if($query->num_rows()>0){
                return true;
            }else{
                return false;
            }
        }

        public function verify_instructor($otp, $id){
            $this->db->where('login_otp', $otp);
            $this->db->where('instructor_id', $id);
            $query = $this->db->get('ci_instructors');
            if($query->num_rows()>0){
                return true;
            }else{
                return false;
            }
        }

        public function verify_password_instructor($data){
            $this->db->where('email', $data['email']);
            $query = $this->db->get('ci_instructors');
            if ($query->num_rows() == 0){
                return false;
            }
            else{
                
                $result = $query->row_array();

                $validPassword = password_verify($data['password'], $result['password']);
                if($validPassword){
                    return $result['instructor_id'];
                }else{
                    return false;
                }
            }
        }

        public function verify_password_student($data){
            $this->db->where('email', $data['email']);
            $query = $this->db->get('ci_students');
            if ($query->num_rows() == 0){
                return false;
            }
            else{
                
                $result = $query->row_array();

                $validPassword = password_verify($data['password'], $result['password']);
                if($validPassword){
                    return $result['student_id'];
                }else{
                    return false;
                }
            }
        }

        public function check_auth(){
            if($this->session->userdata('is_logged_in')){
                return true;
            }else{
                $this->session->sess_destroy();
                redirect(base_url('auth/login'));
            }
        }


        public function check_email_student($email){
            $this->db->where('email', $email);
            $query = $this->db->get('ci_students');

            if($query->num_rows()>0){
                return $query->row_array();
            }else{
                return false;
            }
        }

        public function check_email_instructor($email){
            $this->db->where('email', $email);
            $query = $this->db->get('ci_instructors');

            if($query->num_rows()>0){
                return $query->row_array();
            }else{
                return false;
            }
        }

        public function set_password_student($password, $id){
            $this->db->where('student_id', $id);
            $this->db->update('ci_students', ['password'=>$password]);
            return true;
        }

        public function set_password_instructor($password, $id){
            $this->db->where('instructor_id', $id);
            $this->db->update('ci_instructors', ['password'=>$password]);
            return true;
        }
    }