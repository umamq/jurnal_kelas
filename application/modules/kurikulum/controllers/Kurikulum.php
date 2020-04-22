<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kurikulum extends MX_Controller
{
    private $user_id;
    private $base_breadcrumbs;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->database();
        $this->load->helper(array('url', 'libs', 'alert'));
        $this->load->library(array('form_validation', 'session', 'alert', 'breadcrumbs'));

        $this->breadcrumbs->load_config('default');

        $level                  = $this->session->userdata('user_level');
        $this->user_id          = $this->session->userdata('user_id');
        $this->base_breadcrumbs = '/kurikulum';

        if ($level !== 'KURIKULUM') {
            redirect(site_url('signout'), 'reload');
        }

        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    }

    public function _page_output($output = null)
    {

        $output['user_id']      = $this->user_id;
        $output['nama_lengkap'] = $this->session->userdata('user_username');
        $this->load->view('master_page.php', (array) $output);
    }

    public function index()
    {
        $this->breadcrumbs->push('Dashboard', $this->base_breadcrumbs);

        $data['page_name']  = 'beranda';
        $data['page_title'] = 'Beranda';
        $this->_page_output($data);
    }

    public function detailkehadiran()
    {
        header('content-type: application/json');

        $pegawai_id = $this->input->post('pegawai_id');
        $tgl_awal   = $this->input->post('tgl_awal');
        $tgl_akhir  = $this->input->post('tgl_akhir');

        $kehadiran = $this->db->query(
            "SELECT c.tanggal AS tgl,
                                      c.`status`
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
                              WHERE a.id = $pegawai_id");

        echo json_encode(
            array(
                'detail_kehadiran' => $this->load->view('ajax_kehadiran_guru', array('kehadiran' => $kehadiran), true),
            )
        );
    }

    public function rekap_jurnal_kelas()
    {

        if (!empty($_POST)) {
            $tgl_awal  = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $kelas_id  = $this->input->post('kelas_id');

            $jurnal = $this->db->query("SELECT a.tanggal,b.hari, b.jam, 
                                               c.nama AS pelajaran, 
                                               d.nama_lengkap AS nama_guru, 
                                               a.`status`,
                                               a.topik
                                        FROM jurnal a
                                        LEFT JOIN jadwal_mengajar b ON a.jadwal_mengajar_id = b.id 
                                        LEFT JOIN matapelajaran c ON b.matapelajaran_id = c.id
                                        LEFT JOIN pegawai d ON b.pegawai_id = d.id
                                        WHERE (a.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir') AND  b.kelas_id = $kelas_id");
            $data['jurnal'] = $jurnal;
        }
        
        $this->breadcrumbs->push('Dashboard', $this->base_breadcrumbs);
        $this->breadcrumbs->push('Rekapitulasi Jurnal Kelas', $this->base_breadcrumbs . '/rekap-jurnal-kelas');

        $data['kelas']      = $this->db->get('kelas');
        $data['page_name']  = 'rekap_jurnal_kelas';
        $data['page_title'] = 'Rekapitulasi Jurnal Kelas';
        $this->_page_output($data);

    }

    public function rekap_kehadiran_guru()
    {
        $data = array();

        if (!empty($_POST)) {
            $tgl_awal  = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');

            $kehadiran = $this->db->query(
                "SELECT a.id AS pegawai_id,
                                      a.nama_lengkap,
                                      a.nuptk,
                                      COUNT(c.id) AS guru_hadir,
                                      COUNT(d.id) AS guru_kosong,
                                      COUNT(e.id) AS guru_digantikan,
                                      CONCAT(ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0),'%') AS jml
                              FROM pegawai a
                              LEFT JOIN jadwal_mengajar b ON a.id = b.pegawai_id
                              LEFT JOIN jurnal c ON b.id = c.jadwal_mengajar_id AND c.`status`= 'HADIR' AND c.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
                              LEFT JOIN jurnal d ON b.id = d.jadwal_mengajar_id AND d.`status`= 'KOSONG' AND d.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
                              LEFT JOIN jurnal e ON b.id = e.jadwal_mengajar_id AND e.`status`= 'DIGANTIKAN' AND e.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
                              GROUP BY a.id
                              ORDER BY ROUND((COUNT(c.id) * 100) / (COUNT(c.id) + COUNT(d.id) + COUNT(e.id)),0) DESC, a.nama_lengkap ASC");
            $data['kehadiran'] = $kehadiran;

        }

        $this->breadcrumbs->push('Dashboard', $this->base_breadcrumbs);
        $this->breadcrumbs->push('Rekapitulasi Kehadiran Guru', $this->base_breadcrumbs . '/rekap-kehadiran-guru');

        $data['page_name']  = 'rekap_kehadiran_guru';
        $data['page_title'] = 'Rekapitulasi Kehadiran Guru';
        $this->_page_output($data);
    }

    public function jurnal_kelas($status_ajax = null)
    {

        $data = array();

        $data['keterangan'] = "<br/>";
        $data['keterangan'] .= "Jam selesai ditandai dengan warna header tabel hijau<br/>";
        $data['keterangan'] .= "Jam aktif ditandai dengan warna header tabel kuning<br/>";
        $data['keterangan'] .= "Kode Warna: <div style='display:inline' class='text-danger'>Merah</div> => belum isi jurnal; <div style='display:inline' class='text-success'>Hijau</div> => Guru Hadir;<div style='display:inline' class='text-warning'>Kuning</div> => Jam Kosong; <div style='display:inline' class='text-info'>Biru</div> => Digantikan";

        if ($status_ajax == null) {

            $this->breadcrumbs->push('Dashboard', $this->base_breadcrumbs);
            $this->breadcrumbs->push('Jurnal Kelas', $this->base_breadcrumbs . '/jurnal_kelas');

            $data['page_name']  = 'jurnal_kelas';
            $data['page_title'] = 'Jurnal Kelas';
            $this->_page_output($data);

        } else {

            header('content-type: application/json');

            $day        = date('w');
            $hari_array = array('MINGGU', 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU', 'MINGGU');

            $hari_sekarang = $hari_array[$day];

            $date_now = date('Y-m-d');
            $time_now = date('H:i:s');

            if (cek_libur($date_now) === 'YA') {

                echo json_encode(
                    array(
                        'jurnal_kelas' => $this->load->view('ajax_jurnal_kelas_libur', null, true),
                    )
                );

            } else {

                $jam_aktif = $this->db->query("SELECT jam_ke FROM jam_aktif WHERE mulai <= '$time_now' ORDER BY jam_ke DESC LIMIT 1");

                $jurnal = $this->db->query("
                SELECT a.kelas_id,
                       r.nama_kelas,
                       IFNULL(j.`status`,'PENDING') AS status_jam_1,
                       IFNULL(k.`status`,'PENDING') AS status_jam_2,
                       IFNULL(l.`status`,'PENDING') AS status_jam_3,
                       IFNULL(m.`status`,'PENDING') AS status_jam_4,
                       IFNULL(n.`status`,'PENDING') AS status_jam_5,
                       IFNULL(o.`status`,'PENDING') AS status_jam_6,
                       IFNULL(p.`status`,'PENDING') AS status_jam_7,
                       IFNULL(q.`status`,'PENDING') AS status_jam_8,
                       CONCAT(b.mp,' - ', b.pengampu) AS jam_1,
                       CONCAT(c.mp,' - ', c.pengampu) AS jam_2,
                       CONCAT(d.mp,' - ', d.pengampu) AS jam_3,
                       CONCAT(e.mp,' - ', e.pengampu) AS jam_4,
                       CONCAT(f.mp,' - ', f.pengampu) AS jam_5,
                       CONCAT(g.mp,' - ', g.pengampu) AS jam_6,
                       CONCAT(h.mp,' - ', h.pengampu) AS jam_7,
                       CONCAT(i.mp,' - ', i.pengampu) AS jam_8
                FROM jadwal_mengajar a

                LEFT JOIN (SELECT a.id,b.nama AS mp, c.nama_lengkap AS pengampu,a.kelas_id
                           FROM jadwal_mengajar a
                              LEFT JOIN matapelajaran b ON a.matapelajaran_id = b.id
                              LEFT JOIN pegawai c ON a.pegawai_id = c.id
                              WHERE a.jam LIKE '%1%' AND a.hari = '$hari_sekarang') b ON a.kelas_id = b.kelas_id
                LEFT JOIN jurnal j ON b.id  = j.jadwal_mengajar_id AND j.tanggal = '$date_now'

                LEFT JOIN (SELECT a.id,b.nama AS mp, c.nama_lengkap AS pengampu,a.kelas_id
                           FROM jadwal_mengajar a
                              LEFT JOIN matapelajaran b ON a.matapelajaran_id = b.id
                              LEFT JOIN pegawai c ON a.pegawai_id = c.id
                              WHERE a.jam LIKE '%2%' AND a.hari = '$hari_sekarang') c ON a.kelas_id = c.kelas_id
                LEFT JOIN jurnal k ON c.id  = k.jadwal_mengajar_id AND k.tanggal = '$date_now'

                LEFT JOIN (SELECT a.id,b.nama AS mp, c.nama_lengkap AS pengampu,a.kelas_id
                           FROM jadwal_mengajar a
                              LEFT JOIN matapelajaran b ON a.matapelajaran_id = b.id
                              LEFT JOIN pegawai c ON a.pegawai_id = c.id
                              WHERE a.jam LIKE '%3%' AND a.hari = '$hari_sekarang') d ON a.kelas_id = d.kelas_id
                LEFT JOIN jurnal l ON d.id  = l.jadwal_mengajar_id AND l.tanggal = '$date_now'

                LEFT JOIN (SELECT a.id,b.nama AS mp, c.nama_lengkap AS pengampu,a.kelas_id
                           FROM jadwal_mengajar a
                              LEFT JOIN matapelajaran b ON a.matapelajaran_id = b.id
                              LEFT JOIN pegawai c ON a.pegawai_id = c.id
                              WHERE a.jam LIKE '%4%' AND a.hari = '$hari_sekarang') e ON a.kelas_id = e.kelas_id
                LEFT JOIN jurnal m ON e.id  = m.jadwal_mengajar_id AND m.tanggal = '$date_now'

                LEFT JOIN (SELECT a.id,b.nama AS mp, c.nama_lengkap AS pengampu,a.kelas_id
                           FROM jadwal_mengajar a
                              LEFT JOIN matapelajaran b ON a.matapelajaran_id = b.id
                              LEFT JOIN pegawai c ON a.pegawai_id = c.id
                              WHERE a.jam LIKE '%5%' AND a.hari = '$hari_sekarang') f ON a.kelas_id = f.kelas_id
                LEFT JOIN jurnal n ON f.id  = n.jadwal_mengajar_id AND n.tanggal = '$date_now'

                LEFT JOIN (SELECT a.id,b.nama AS mp, c.nama_lengkap AS pengampu,a.kelas_id
                           FROM jadwal_mengajar a
                              LEFT JOIN matapelajaran b ON a.matapelajaran_id = b.id
                              LEFT JOIN pegawai c ON a.pegawai_id = c.id
                              WHERE a.jam LIKE '%6%' AND a.hari = '$hari_sekarang') g ON a.kelas_id = g.kelas_id
                LEFT JOIN jurnal o ON g.id  = o.jadwal_mengajar_id AND o.tanggal = '$date_now'

                LEFT JOIN (SELECT a.id,b.nama AS mp, c.nama_lengkap AS pengampu,a.kelas_id
                           FROM jadwal_mengajar a
                              LEFT JOIN matapelajaran b ON a.matapelajaran_id = b.id
                              LEFT JOIN pegawai c ON a.pegawai_id = c.id
                              WHERE a.jam LIKE '%7%' AND a.hari = '$hari_sekarang') h ON a.kelas_id = h.kelas_id
                LEFT JOIN jurnal p ON h.id  = p.jadwal_mengajar_id AND p.tanggal = '$date_now'

                LEFT JOIN (SELECT a.id,b.nama AS mp, c.nama_lengkap AS pengampu,a.kelas_id
                           FROM jadwal_mengajar a
                              LEFT JOIN matapelajaran b ON a.matapelajaran_id = b.id
                              LEFT JOIN pegawai c ON a.pegawai_id = c.id
                              WHERE a.jam LIKE '%8%' AND a.hari = '$hari_sekarang') i ON a.kelas_id = i.kelas_id
                LEFT JOIN jurnal q ON i.id  = q.jadwal_mengajar_id AND q.tanggal = '$date_now'

                LEFT JOIN kelas r ON a.kelas_id = r.id

                WHERE a.hari = '$hari_sekarang'
                GROUP BY a.kelas_id");

                if ($jam_aktif->num_rows() > 0) {
                    $jam_ke = $jam_aktif->row_array();

                    echo json_encode(
                        array(
                            'jurnal_kelas' => $this->load->view('ajax_jurnal_kelas',
                                array(
                                    'jurnal' => $jurnal,
                                    'jam_ke' => $jam_ke['jam_ke'],
                                ), true),
                        )
                    );
                } else {

                    echo json_encode(
                        array(
                            'jurnal_kelas' => $this->load->view('ajax_jurnal_kelas',
                                array(
                                    'jurnal' => $jurnal,
                                    'jam_ke' => 0,
                                ), true),
                        )
                    );

                }

            }

        }

    }

    public function profile()
    {

        try {
            $this->load->library(array('grocery_CRUD'));
            $crud = new Grocery_CRUD();

            $crud->set_table('user');
            $crud->set_subject('Profile');

            $crud->required_fields('nama_lengkap');
            $crud->columns('username', 'nama_lengkap', 'email', 'telp');
            $crud->field_type('tgl_update', 'hidden');
            $crud->field_type('password', 'hidden');
            $crud->field_type('terakhir_login', 'readonly');
            $crud->field_type('username', 'readonly');
            $crud->field_type('level', 'readonly');

            $crud->field_type('token_firebase', 'hidden');

            $crud->field_type('token_login', 'hidden');

            $crud->set_field_upload('foto', 'uploads/foto');

            // $crud->display_as('provinsi_id', 'Wilayah Kerja');

            $crud->callback_after_insert(function ($post_array, $primary_key) {

            });

            $crud->callback_after_update(function ($post_array, $primary_key) {

                $this->db->where('id', $primary_key);
                $this->db->update('user',
                    array(
                        'tgl_update' => date('Y-m-d H:i:s'),
                    )
                );
            });

            $this->breadcrumbs->push('Beranda', $this->base_breadcrumbs);
            // $this->breadcrumbs->push('Profil', $this->base_breadcrumbs . '/profile');

            $state = $crud->getState();
            if ($state === 'insert_validation') {
                // $crud->set_rules('npsn', 'NPSN', 'is_unique[sekolah.npsn]|required');
                // $crud->set_rules('email', 'Email', 'is_unique[sekolah.email]|valid_email');
            } elseif ($state === 'update_validation') {
                $crud->set_rules('email', 'Email', 'valid_email');
            } elseif ($state === 'add') {
                // $this->breadcrumbs->push('Tambah', $this->base_breadcrumbs . '/kelola-sekolah/add');
            } elseif ($state === 'edit') {

                $curr_user_id = $this->uri->segment(4);

                if ($curr_user_id != $this->user_id) {
                    redirect(site_url('kurikulum/profile/edit/' . $this->user_id), 'reload');
                }

                $this->breadcrumbs->push('Ubah Profil', $this->base_breadcrumbs . '/profile/edit');
            }

            $crud->unset_back_to_list();
            $extra = array('page_title' => 'Edit Profile');

            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

    }

    public function ganti_password()
    {
        if (!empty($_POST['pass_lama'])) {

            $password = $this->input->post('pass_lama');

            $cek_user = $this->db->get_where('user', array('id' => $this->user_id));

            if ($cek_user->num_rows() > 0) {

                $user = $cek_user->row_array();

                if (password_verify($password, $user['password'])) {

                    if (empty($_POST['pass_baru']) || empty($_POST['pass_ulangi'])) {
                        $this->alert->set('alert-danger', 'Password baru / ulangan tidak boleh kosong');
                        redirect(site_url('kurikulum/ganti-password'), 'reload');
                    } else {
                        $pass_baru   = $this->input->post('pass_baru');
                        $pass_ulangi = $this->input->post('pass_ulangi');

                        if ($pass_baru !== $pass_ulangi) {
                            $this->alert->set('alert-danger', 'Password baru & ulangan harus sama');
                            redirect(site_url('kurikulum/ganti-password'), 'reload');
                        } else {
                            $this->db->where('id', $this->user_id);
                            $this->db->update('user', array('password' => md5($pass_baru)));

                            $this->alert->set('alert-success', 'Password berhasil diupdate');
                            redirect(site_url('kurikulum/ganti-password'), 'reload');
                        }
                    }

                } else {

                    $this->alert->set('alert-danger', 'Password Lama Salah');
                    redirect(site_url('kurikulum/ganti-password'), 'reload');

                }

            } else {

            }
        }

        $data['page_name'] = 'ganti_password';

        $this->breadcrumbs->push('Beranda', $this->base_breadcrumbs);
        $this->breadcrumbs->push('Ganti Password', $this->base_breadcrumbs . '/ganti_password');

        $data['page_title'] = 'Ganti Password';

        $this->_page_output($data);
    }

}
