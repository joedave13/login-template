<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class User_model extends CI_Model {
        public function getWelcomeName()
        {
            return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        }
        
        public function editProfileName($image)
        {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //Cek if there is a picture that would be uploaded
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('image')){
                    $old_image = $image;
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                }
                else{
                    $error = $this->upload->display_errors();
                    echo $error;
                }
            }
            $this->db->set('name', $name);  
            $this->db->where('email', $email);
            $this->db->update('user');
        }

        public function changePassword($newPassword)
        {
            $this->db->set('password', $newPassword);
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user');
        }
    }
    
    /* End of file User_model.php */
    
?>
