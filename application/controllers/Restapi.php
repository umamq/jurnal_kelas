<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Restapi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
        $this->load->helper(array('url', 'libs'));
    }

    public function send_tokenid()
    {
        header('content-type: application/json');

        if (isset($_POST['user_level']) && isset($_POST['user_id'])) {

            $response["error"]     = false;
            $response["error_msg"] = "Send Token BERHASIL";

            $user_level     = $this->input->post('user_level');
            $user_id        = $this->input->post('user_id');
            $token_firebase = $this->input->post('token_firebase');

            $this->db->where('id', $user_id);

            if ($user_level === 'ADMIN' || $user_level === 'KURIKULUM') {
                $this->db->update('user', array('token_firebase' => $token_firebase));
            } elseif ($user_level === 'SISWA' || $user_level === 'SISWA-JURNAL') {
                $this->db->update('siswa', array('token_firebase' => $token_firebase));
            } elseif ($user_level === 'GURU' || $user_level === 'KASI' || $user_level === 'KASEK') {
                $this->db->update('pegawai', array('token_firebase' => $token_firebase));
            } else {
                $response["error"]     = true;
                $response["error_msg"] = "CMD tidak valid";
            }

            echo json_encode($response);

        } else {

            $response["error"]     = true;
            $response["error_msg"] = "Send Token ID GAGAL!";
            echo json_encode($response);
        }

    }

    private function _update_token_login($table_name, $user_id)
    {
        $uuid = generate_uuid();

        $this->db->where('id', $user_id);
        $this->db->update($table_name, array('token_login' => $uuid));

        return $uuid;
    }


    public function get_jadwal(){

        header("content-type: application/json");

        $siswa_id = $this->input->get('siswa_id');

        $jadwal = $this->db->query("
            SELECT b.hari,GROUP_CONCAT(CONCAT(b.jam,'|', c.nama, '|', d.nama_lengkap) ORDER BY b.jam SEPARATOR '::') AS jadwal
            FROM siswa a
            LEFT JOIN jadwal_mengajar b ON a.kelas_id = b.kelas_id
            LEFT JOIN matapelajaran c ON b.matapelajaran_id = c.id
            LEFT JOIN pegawai d ON b.pegawai_id = d.id
            WHERE a.id = $siswa_id
            GROUP BY b.hari
            ORDER BY FIELD(b.hari,'SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU'), b.jam ASC");


        $json = '{"jadwal":[';        
        
        $json_jadwal = "";

        foreach ($jadwal->result_array() as $key) {
            $json_jadwal .= '{';
            $json_jadwal .= '   "hari":"' . $key['hari'] .'",';

            $lists = explode('::', $key['jadwal']);

            $json_jadwal .= '       "detail":[';

            $json_details = "";
            foreach ($lists as $list) {
                $details = explode('|',$list);

                $json_details .= '              {';
                $json_details .= '                  "jam":"' . $details[0] . '",';
                $json_details .= '                  "matapelajaran":"' . $details[1] . '",';
                $json_details .= '                  "guru":"' . $details[2] . '"';
                $json_details .= '              },';
            }

            $json_jadwal .= substr($json_details, 0 ,-1);

            $json_jadwal .= '        ]';

            $json_jadwal .= '},';
        }

        $json .= substr($json_jadwal, 0 , -1);

        $json .= ']}';

        // echo "<pre>";
        echo $json;
        // echo "</pre>";
        //  echo json_encode(
        //     array(
        //         'error'   => false,
        //         'message' => 'Data berhasil diambil',
        //         'jadwalList'    => $json,
        //     )
        // );




    }


    public function get_guru()
    {

        header("content-type: application/json");

        $imgbase = site_url('uploads/foto/');

        $this->db->select("a.id,
                           CONCAT('$imgbase', IFNULL(foto,'no_foto.png')) AS fotoUrl,
                           IFNULL(a.kode_pegawai,'-') AS kode_guru,
                           a.nama_lengkap,
                           IFNULL(a.alamat,'-') AS alamat,
                           IFNULL(a.telp,'-') AS telp,
                           IFNULL(a.email,'-') AS email,
                           GROUP_CONCAT(DISTINCT c.nama) AS mengajar");
        $this->db->join('jadwal_mengajar b','a.id = b.pegawai_id','left');
        $this->db->join('matapelajaran c','b.matapelajaran_id = c.id','left');
        $this->db->group_by('a.id');
        $this->db->where('a.jabatan','GURU');
        $qry = $this->db->get('pegawai a');

        echo json_encode(
            array(
                'error'   => false,
                'message' => 'Data berhasil diambil',
                'guruList'    => $qry->result(),
            )
        );

    }


    public function login()
    {
        header('content-type: application/json');

        $this->load->library('form_validation');

        if (isset($_POST['username']) && isset($_POST['password'])) {

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == true) {

                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $cek = $this->db->get_where('user', array('username' => $username, 'password' => md5($password)));
                if ($cek->num_rows() > 0) {
                    $user = $cek->row_array();

                    $foto = !empty($user['foto']) ? site_url('uploads/foto/' . $user["foto"]) : site_url('uploads/foto/no_foto.png');

                    $response["error"]                = false;
                    $response["user"]["id"]           = $user['id'];
                    $response["user"]["username"]     = $user['username'];
                    $response["user"]["nama_lengkap"] = $user['nama_lengkap'];
                    $response["user"]["email"]        = $user['email'];
                    $response["user"]["level"]        = $user['level'];
                    $response["user"]["token_login"]  = $this->_update_token_login('user', $user['id']);
                    $response["user"]["foto"]         = $foto;

                    echo json_encode($response);

                } else {

                    $cek = $this->db->get_where('pegawai', array('nuptk' => $username, 'password' => md5($password)));
                    if ($cek->num_rows() > 0) {
                        $user = $cek->row_array();

                        $foto              = !empty($user['foto']) ? site_url('uploads/foto/' . $user["foto"]) : site_url('uploads/foto/no_foto.png');
                        $response["error"] = false;

                        $response["user"]["id"]           = $user['id'];
                        $response["user"]["username"]     = $user['nuptk'];
                        $response["user"]["nama_lengkap"] = $user['nama_lengkap'];
                        $response["user"]["email"]        = $user['email'];
                        $response["user"]["level"]        = $user['jabatan'];
                        $response["user"]["token_login"]  = $this->_update_token_login('pegawai', $user['id']);
                        $response["user"]["foto"]         = $foto;                        

                        echo json_encode($response);

                    } else {

                        $cek = $this->db->get_where('siswa', array('nisn' => $username, 'password' => md5($password)));
                        if ($cek->num_rows() > 0) {
                            $user = $cek->row_array();

                            $foto = !empty($user['foto']) ? site_url('uploads/foto/' . $user["foto"]) : site_url('uploads/foto/no_foto.png');

                            $response["error"]                = false;
                            $response["user"]["id"]           = $user['id'];
                            $response["user"]["username"]     = $user['nisn'];
                            $response["user"]["nama_lengkap"] = $user['nama_lengkap'];
                            $response["user"]["email"]        = $user['email'];
                            
                            if($user['petugas_jurnal'] === 'YA'){
                                $response["user"]["level"]        = "SISWA-JURNAL";
                            }else{
                                $response["user"]["level"]        = "SISWA";
                            }
                            
                            $response["user"]["token_login"] = $this->_update_token_login('siswa', $user['id']);
                            $response["user"]["foto"]         = $foto;

                            

                            echo json_encode($response);

                        } else {

                            $response["error"]     = true;
                            $response["error_msg"] = "Username tidak ditemukan !";
                            echo json_encode($response);

                        }

                    }

                }

            }

        }

    }

}
