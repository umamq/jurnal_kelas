<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
        $this->load->helper(array('url', 'libs'));
        $this->load->library(array('session'));
    }

   

    public function start_cronjob()
    {
        $this->output->set_header('HTTP/1.0 200 OK');
        $this->output->set_header('HTTP/1.1 200 OK');
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        //cronjob akan memasukkan
        if (date("G") >= 1) {

            $current_date = date('Y-m-d');
            $libur        = cek_libur($current_date);

            if ($libur === 'TIDAK') {

                $cronjob_status = $this->db->get_where('cronjob_status', array('DATE(start_at)' => $current_date));

                if ($cronjob_status->num_rows() == 0) {

                    $keterangan = "";
                    $start_at   = date("Y-m-d H:i:s");

                    $day        = date('w');
                    $hari_array = array('MINGGU', 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU', 'MINGGU');

                    $hari_sekarang = $hari_array[$day];

                    $kelas = $this->db->get_where('kelas');
                    foreach ($kelas->result_array() as $key_kelas) {
                        $kelas_id = $key_kelas['id'];
                        $jadwal   = $this->db->get_where('jadwal_mengajar', array('kelas_id' => $kelas_id, 'hari' => $hari_sekarang));

                        $j = 0;
                        foreach ($jadwal->result_array() as $key_jadwal) {
                            // $tgl_sekarang       = date('Y-m-d');
                            $jadwal_mengajar_id = $key_jadwal['id'];

                            $this->db->insert('jurnal',
                                array(
                                    'tanggal'            => $current_date,
                                    'jadwal_mengajar_id' => $jadwal_mengajar_id,
                                )
                            );
                            $j++;
                        }

                        $keterangan .= "{'CMD':'INSERT_JADWAL','KELAS':'" . $kelas_id . "','JUMLAH_BARIS':'" . $j . "'},";

                    }

                    $end_at = date("Y-m-d H:i:s");

                    $keterangan = substr($keterangan, 0, -1);

                    $this->db->insert('cronjob_status',
                        array(
                            'start_at'   => $start_at,
                            'end_at'     => $end_at,
                            'keterangan' => $keterangan,
                        )
                    );

                    echo "Cronbot_job_end_at_" . date("Y-m-d H:i:s") . "::{'STATUS':'" . $keterangan . "'}";

                } else {
                    echo "Cronbot_job_end_at_" . date("Y-m-d H:i:s") . "::{'STATUS':'003'}";
                }

            } else {
                echo "Cronbot_job_end_at_" . date("Y-m-d H:i:s") . "::{'STATUS':'002'}";
            }

        } else {
            echo "Cronbot_job_end_at_" . date("Y-m-d H:i:s") . "::{'STATUS':'001'}";
        }

    }
}
