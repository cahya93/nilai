<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('email')) {
        //     redirect('auth');
        // }
        // $this->load->model('Admin_model');
        // $this->load->model('Home_model');
    }

    public function index()
    {
        $data['title'] = "Info Ujian";
        $data['kelas'] = $this->db->get_where('tbl_kelas', ['tingkat' => 1])->result_array();
        $data['data'] = $this->db->get_where('tbl_jadwal')->result_array();
        $this->load->view('home/wrapper/head', $data);
        $this->load->view('home/wrapper/navbar');
        $this->load->view('home/index', $data);
        $this->load->view('home/wrapper/footer');
    }
}
