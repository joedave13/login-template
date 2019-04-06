<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class User extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            //Do your magic here
            is_logged_in();
            $this->load->model('User_model');
        }
        
    
        public function index()
        {
            $data['title'] = 'My Profile';
            $data['user'] = $this->User_model->getWelcomeName();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        }

        public function edit()
        {
            $data['title'] = 'Edit Profile';
            $data['user'] = $this->User_model->getWelcomeName();
            $image = $data['user']['image'];

            $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/edit', $data);
                $this->load->view('templates/footer');
            } else {
                $this->User_model->editProfileName($image);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your profile has been updated.</div>');
                redirect('user');
            }  
        }

        public function changePassword()
        {
            $data['title'] = 'Change Password';
            $data['user'] = $this->User_model->getWelcomeName();

            $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
            $this->form_validation->set_rules('newPassword1', 'New Password', 'required|trim|min_length[3]|matches[newPassword2]');
            $this->form_validation->set_rules('newPassword2', 'Confirm New Password', 'required|trim|min_length[3]|matches[newPassword1]');
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/changePassword', $data);
                $this->load->view('templates/footer');  
            } else {
                $currentPassword = $this->input->post('currentPassword');
                $newPassword = $this->input->post('newPassword1');

                if (!password_verify($currentPassword, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Current Password!</div>');
                    redirect('user/changePassword');
                }
                else {
                    if ($currentPassword == $newPassword) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password Cannot Be The Same As Current Password!</div>');
                        redirect('user/changePassword');
                    }
                    else {
                        //Password Passed
                        $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
                        $this->User_model->changePassword($password_hash);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password is Succesfully Changed!</div>');
                        redirect('user/changePassword');
                    }
                }
            }
        }
    }
    
    /* End of User.php */
    
?>
