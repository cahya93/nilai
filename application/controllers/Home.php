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
        $this->load->model('Home_model');
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
    public function nilai()
    {
        $data['title'] = "Nilai Ujian";
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
        $this->load->view('home/wrapper/head', $data);
        $this->load->view('home/wrapper/navbar');
        $this->load->view('home/nilai', $data);
        $this->load->view('home/wrapper/footer');
    }

    public function listMapel()
    {
        // Ambil data ID Provinsi yang dikirim via ajax post
        $kelas = $this->input->get('kelas');

        $data = $this->db->get_where('tbl_mapel', ['id_kelas' => $kelas])->result_array();

        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option value=''>Pilih Mata Pelajaran</option>";

        foreach ($data as $data) {
            $lists .= "<option value='" . $data['id'] . "'>" . $data['mapel'] . "</option>"; // Tambahkan tag option ke variabel $lists
        }

        $callback = array('list_mapel' => $lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }

    public function pdfJadwal()
    {
        $this->load->view('home/pdf-pts');

        $mpdf = new \Mpdf\Mpdf(
            [
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'setAutoTopMargin' => false
            ]
        );

        $html = $this->load->view('home/pdf-pts', [], true);
        $mpdf->WriteHTML($html);

        $mpdf->AddPage(
            [
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'setAutoTopMargin' => false
            ]
        );
        $html2 = $this->load->view('home/pdf-usek', [], true);
        $mpdf->WriteHTML($html2);
        $mpdf->Output('Rekap Jadwal PTS dan USEK.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function ujian()
    {
        $data['title'] = "Form Ujian Susulan";
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
        $this->load->view('home/wrapper/head', $data);
        $this->load->view('home/wrapper/navbar');
        $this->load->view('home/ujian', $data);
        $this->load->view('home/wrapper/footer');
    }
}
