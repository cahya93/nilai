<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            //validation berhasil
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            // user ada
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'level' => $user['level']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['level'] == 1) {
                        redirect('admin');
                    } else {
                        if ($user['level'] == 2) {
                            redirect('guru');
                        } else {
                            if ($user['role_id'] == 3) {
                                redirect('admin');
                            } else {
                                if ($user['role_id'] == 4) {
                                    redirect('siswa');
                                } else {
                                    if ($user['role_id'] == 5) {
                                        redirect('pendamping');
                                    } else {
                                        if ($user['role_id'] == 6) {
                                            redirect('KS');
                                        } else {
                                            if ($user['role_id'] == 7) {
                                                redirect('kajur');
                                            } else {
                                                if ($user['role_id'] == 8) {
                                                    redirect('bdp');
                                                } else {
                                                    if ($user['role_id'] == 11) {
                                                        redirect('bendahara');
                                                    } else {
                                                        if ($user['role_id'] == 12) {
                                                            redirect('adminlab');
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password!!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            This email has not been actived!</div>');
                redirect('auth');
            }
        } else {
            //user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered!!!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logged out!!!</div>');
        redirect('home');
    }
}
