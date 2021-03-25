<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        // $this->load->model('Admin_model');
        $this->load->model('Home_model');
    }

    public function index()
    {
        $data['title'] = "Admin | Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/wrapper/head.php', $data);
        $this->load->view('admin/wrapper/navbar.php');
        $this->load->view('admin/wrapper/sidebar.php', $data);
        $this->load->view('admin/index.php');
        $this->load->view('admin/wrapper/footer.php');
    }
    public function nilai()
    {
        $data['title'] = "Nilai Ujian";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kategori'] = $this->db->get_where('tbl_kategori')->result_array();
        $data['tp'] = $this->db->get_where('tbl_tp')->result_array();
        $data['kelas'] = $this->db->get_where('tbl_kelas')->result_array();
        $kategori = $this->input->get('kategori');
        $tp = $this->input->get('tp');
        $kelas = $this->input->get('kelas');
        $mapel = $this->input->get('mapel');
        $data['ktgr'] = $kategori;
        $data['mapel'] = $mapel;
        $data['tp2'] = $tp;
        $data['data'] = $this->Home_model->getSiswa($kelas);
        $this->load->view('admin/wrapper/head.php', $data);
        $this->load->view('admin/wrapper/navbar.php');
        $this->load->view('admin/wrapper/sidebar.php', $data);
        $this->load->view('admin/nilai', $data);
        $this->load->view('admin/wrapper/footer');
    }
    public function input_nilai()
    {
        $data['title'] = "Input Nilai Ujian";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kategori'] = $this->db->get_where('tbl_kategori')->result_array();
        $data['tp'] = $this->db->get_where('tbl_tp')->result_array();
        $data['kelas'] = $this->db->get_where('tbl_kelas')->result_array();
        $kategori = $this->input->get('kategori');
        $tp = $this->input->get('tp');
        $kelas = $this->input->get('kelas');
        $mapel = $this->input->get('mapel');
        $data['ktgr'] = $kategori;
        $data['mapel'] = $mapel;
        $data['tp2'] = $tp;
        $data['data'] = $this->Home_model->getSiswa($kelas);
        $this->load->view('admin/wrapper/head.php', $data);
        $this->load->view('admin/wrapper/navbar.php');
        $this->load->view('admin/wrapper/sidebar.php', $data);
        $this->load->view('admin/input-nilai', $data);
        $this->load->view('admin/wrapper/footer');
    }
    public function input_data()
    {
        $result = array();
        foreach ($_POST['nis'] as $key => $val) {
            $result[] = array(
                'id_kelas' => $_POST['kelas'][$key],
                'id_mapel' => $_POST['mapel'][$key],
                'id_kategori' => $_POST['kategori'][$key],
                'nilai' => $_POST['nilai'][$key],
                'tp' => $_POST['tp'][$key],
                'nis' => $_POST['nis'][$key],
                'nama' => $_POST['nama'][$key],
                'nilai' => $_POST['nilai'][$key],
            );
        }
        $this->db->insert_batch('tbl_nilai', $result);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil ditambahkan!!!</div>');
        redirect('admin/input_nilai');
    }
    public function import()
    {
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['upload_file']['name']);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            echo "<pre>";
            print_r($sheetData);
        }
    }

    public function master()
    {
        $data['title'] = "Master Data";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['tp'] = $this->db->get_where('tbl_tp')->result_array();
        $data['kategori'] = $this->db->get_where('tbl_kategori')->result_array();
        $data['kelas'] = $this->db->get_where('tbl_kelas')->result_array();
        $data['mapel'] = $this->db->get_where('tbl_mapel')->result_array();
        $this->load->view('admin/wrapper/head.php', $data);
        $this->load->view('admin/wrapper/navbar.php');
        $this->load->view('admin/wrapper/sidebar.php', $data);
        $this->load->view('admin/master.php');
        $this->load->view('admin/wrapper/footer.php');
    }
}
