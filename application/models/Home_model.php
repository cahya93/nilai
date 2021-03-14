<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

    public function getSiswa($kelas)
    {
        $this->db->order_by('NIS', 'ASC');
        return $this->db->get_where('tbl_siswa', ['kelas' => $kelas])->result_array();
    }
}
