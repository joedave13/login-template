<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Auth_model extends CI_Model {
        public function insertUserData()
        {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // Token 
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            return $token;
        }

        public function verifyEmail($email)
        {
            return $this->db->get_where('user', ['email' => $email])->row_array();
        }

        public function verifyToken($token)
        {
            return $this->db->get_where('user_token', ['token' => $token])->row_array();
        }

        public function activateUser($email)
        {
            $this->db->set('is_active', 1);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->db->delete('user_token', ['email' => $email]);
        }

        public function userExpired($email)
        {
            $this->db->delete('user', ['email' => $email]);  
            $this->db->delete('user_token', ['email' => $email]);
        }

        public function checkLogin($email, $password)
        {
            return $this->db->get_where('user', ['email' => $email])->row_array();
        }

        public function checkEmail($email)
        {
            return $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_object();
        }

        public function resetPassword($email)
        {
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user_token', $user_token);

            return $token;
        }

        public function changePassword()
        {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');
        }
    }
    
    /* End of file Auth_model.php */
    
?>
