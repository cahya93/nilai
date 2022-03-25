<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wali extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('wali');
        }
        // $this->load->model('Admin_model');
        $this->load->model('Home_model');
    }

    public function index()
    {
        $data['title'] = "Info Ujian";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kelas'] = $this->db->get_where('tbl_kelas', ['tingkat' => 1])->result_array();
        $data['data'] = $this->db->get_where('tbl_jadwal')->result_array();
        $this->load->view('wali/wrapper/head', $data);
        $this->load->view('wali/wrapper/navbar');
        $this->load->view('wali/index', $data);
        $this->load->view('wali/wrapper/footer');
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
        $this->load->view('wali/wrapper/head', $data);
        $this->load->view('wali/wrapper/navbar');
        $this->load->view('wali/nilai', $data);
        $this->load->view('wali/wrapper/footer');
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
        $this->load->view('wali/pdf-pts');

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
        $html2 = $this->load->view('wali/pdf-usek', [], true);
        $mpdf->WriteHTML($html2);
        $mpdf->Output('Rekap Jadwal PTS dan USEK.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function ujian()
    {
        $data['title'] = "Form Ujian Susulan";
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
        $this->load->view('wali/wrapper/head', $data);
        $this->load->view('wali/wrapper/navbar');
        $this->load->view('wali/ujian', $data);
        $this->load->view('wali/wrapper/footer');
    }

    public function laporan(){
        $data['title'] = "Laporan Hasil Belajar Siswa";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['wali'] = $this->Home_model->getWaliKelas();
        $data['tp'] = $this->db->get_where('tbl_tp')->result_array();
        $data['kelas'] = $this->db->get_where('tbl_kelas')->result_array();
        $wali_kelas = $this->input->get('wali');
        $tp = $this->input->get('tp');
        $kelas = $this->input->get('kelas');
        
        $data['data'] = $this->Home_model->getMaster($tp, $kelas);
        $this->load->view('wali/wrapper/head', $data);
        $this->load->view('wali/wrapper/navbar');
        $this->load->view('wali/laporan', $data);
        $this->load->view('wali/wrapper/footer');
    }

    public function cetak($nis)
    {
        $data['title'] = "Cetak Laporan Hasil Belajar Siswa";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nis'] = $nis;
        $data['data'] = $this->db->get_where('master',['id_siswa'=>$nis])->result_array();
        $data['nasional'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 1])->result_array();
        $data['wilayah'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 2])->result_array();
        $data['bidang_keahlian'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 3])->result_array();
        $data['program_keahlian'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 4])->result_array();
        $data['kompetensi_keahlian'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 5])->result_array();
        $data['lokal'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 6])->result_array();
        $data['khusus'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 7])->result_array();
        $data['pai'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 8])->result_array();
        $this->load->view('wali/cetak-laporan',$data);

        $mpdf = new \Mpdf\Mpdf(
            [
                'mode' => 'utf-8',
                'format' => array(215, 330),
                'orientation' => 'P',
                'setAutoTopMargin' => false
            ]
        );

        $html = $this->load->view('wali/cetak-laporan', [], true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Laporan siswa ' . $nis . '.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function cetaksemua()
    {
        $data['title'] = "Cetak Semua Belajar Siswa";
        $data['email'] = $this->input->get('email');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['nis'] = $nis;
        // $data['data'] = $this->db->get_where('master',['id_siswa'=>$nis])->result_array();
        // $data['nasional'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 1])->result_array();
        // $data['wilayah'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 2])->result_array();
        // $data['bidang_keahlian'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 3])->result_array();
        // $data['program_keahlian'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 4])->result_array();
        // $data['kompetensi_keahlian'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 5])->result_array();
        // $data['lokal'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 6])->result_array();
        // $data['khusus'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 7])->result_array();
        // $data['pai'] = $this->db->get_where('master',['id_siswa'=>$nis,'id_kelompok'=> 8])->result_array();
        $this->load->view('wali/cetak-semua',$data);

        $mpdf = new \Mpdf\Mpdf(
            [
                'mode' => 'utf-8',
                'format' => array(215, 330),
                'orientation' => 'P',
                'setAutoTopMargin' => false
            ]
        );
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");
        $html = $this->load->view('wali/cetak-semua', [], true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Laporan siswa.pdf', \Mpdf\Output\Destination::INLINE);
    }
}
