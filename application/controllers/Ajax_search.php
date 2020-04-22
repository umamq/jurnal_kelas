<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_search extends CI_Controller
{
    private $user_id;
    private $base_breadcrumbs;
    private $provinsi_id;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
        $this->load->helper(array('url', 'libs'));
        $this->load->library(array('session'));

        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    }

    public function siswa()
    {

        header('content-type: application/json');

        $q          = $this->input->get('q');
        $page       = $this->input->get('page');
        
        $this->db->where('aktif','YA');
        $this->db->like('nama_lengkap', $q);
        $this->db->or_like('nisn', $q);
        $all_result = $this->db->get('siswa');

        if ($all_result->num_rows() > 0) {

            $ajax_return = '{';
            $ajax_return .= '    "total_count":' . $all_result->num_rows() . ',';
            $ajax_return .= '    "incomplete_results":false,';
            $ajax_return .= '    "items": [';

            $this->db->like('nama_lengkap', $q);
            $this->db->or_like('nisn', $q);
            $this->db->limit(10, $page);
            $pagging_result = $this->db->get('siswa');

            $db_return = '';
            foreach ($pagging_result->result_array() as $key) {
                $db_return .= '{';
                $foto = !empty($key['foto']) ? $key['foto'] : 'foto/no_foto.png';

                $db_return .= '     "id":' . $key['id'] . ',';
                $db_return .= '     "nama_lengkap":' . '"' . $key['nama_lengkap'] . '",';
                $db_return .= '     "nisn":' . '"' . $key['nisn'] . '",';
                $db_return .= '     "email":' . '"' . $key['email'] . '",';
                $db_return .= '     "telp":' . '"' . $key['telp'] . '",';
                $db_return .= '     "alamat":' . '"' . $key['alamat'] . '",';
                $db_return .= '     "foto":' . '"' . site_url('uploads/' . $foto) . '"';
                $db_return .= '},';
            }

            

            $ajax_return .= substr($db_return, 0 , -1);
            $ajax_return .= '    ]';
            $ajax_return .= '}';

            echo $ajax_return;

        } else {

            $ajax_return = '{';
            $ajax_return .= '    "total_count":' . $all_result->num_rows() . ',';
            $ajax_return .= '    "incomplete_results":false,';
            $ajax_return .= '    "items": [';
            $ajax_return .= '    ]';
            $ajax_return .= '}';

            echo $ajax_return;

        }

    }
}
