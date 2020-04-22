<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MX_Controller
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
        $this->base_breadcrumbs = '/admin';

        if ($level !== 'ADMIN') {
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

    // private function _cek_libur($tgl)
    // {
    //     $this->db->select('a.fulldate,IF(a.dayofweek = 7,"YA",IF(b.id > 0,"YA","TIDAK")) AS libur');
    //     $this->db->join('hari_libur b', 'a.fulldate = b.tgl', 'left');
    //     $this->db->where('a.fulldate', $tgl);
    //     $dates = $this->db->get('dates a')->row_array();

    //     return $dates['libur'];
    // }

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

                if($jam_aktif->num_rows() > 0){
                  $jam_ke = $jam_aktif->row_array();

                  echo json_encode(
                      array(
                          'jurnal_kelas' => $this->load->view('ajax_jurnal_kelas', 
                            array(
                              'jurnal' => $jurnal,
                              'jam_ke' => $jam_ke['jam_ke']
                            ), true),
                      )
                  );
                }else{

                  echo json_encode(
                      array(
                          'jurnal_kelas' => $this->load->view('ajax_jurnal_kelas', 
                            array(
                              'jurnal' => $jurnal,
                              'jam_ke' => 0
                            ), true),
                      )
                  );

                }
                

            }

        }

    }

    public function kelola_jadwalpelajaran($kelas_id = null)
    {

        if ($kelas_id != null) {
            try {

                $cek = $this->db->get_where('kelas', array('id' => $kelas_id));
                if ($cek->num_rows() == 0) {
                    redirect(site_url('admin/kelola-jadwalpelajaran'), 'reload');
                }

                $this->load->library(array('grocery_CRUD'));
                $crud = new Grocery_CRUD();

                $crud->set_table('jadwal_mengajar');
                $crud->set_subject('Jadwal Mengajar');
                $crud->where('kelas_id', $kelas_id);
                $crud->order_by('id', 'ASC');

                $crud->required_fields('hari', 'jam', 'matapelajaran_id', 'pegawai_id');

                $crud->columns('hari', 'jam', 'matapelajaran_id', 'pegawai_id');
                $crud->field_type('kelas_id', 'hidden', $kelas_id);

                // $crud->callback_column('jam', function ($value, $row) {

                //     return 'Jam ke-' . $row->jam_mulai . '&nbsp;s/d&nbsp;' . $row->jam_selesai;
                // });

                $crud->callback_after_insert(function ($post_array, $primary_key) {

                });

                $crud->callback_after_update(function ($post_array, $primary_key) {

                });

                //tags
                // $this->db->order_by('jam_ke ASC');
                // $jam_aktif = $this->db->get('jam_aktif');

                // $set_jam = array();
                // foreach ($jam_aktif->result_array() as $row) {
                //     $set_jam[$row['id']] = 'Jam ke - ' . $row['jam_ke'] . '&nbsp;(' . $row['mulai'] . ' s/d ' . $row['selesai'] . ')';
                // }

                // $crud->field_type('jam_mulai', 'dropdown', $set_jam);
                // $crud->field_type('jam_selesai', 'dropdown', $set_jam);
                // $crud->display_as('jam_mulai', 'Mulai mengajar');
                // $crud->display_as('jam_selesai', 'Sampai dengan');

                $crud->set_relation('pegawai_id', 'pegawai', 'nama_lengkap');
                $crud->display_as('pegawai_id', 'Nama Pengampu');

                $crud->set_relation('matapelajaran_id', 'matapelajaran', 'nama');
                $crud->display_as('matapelajaran_id', 'Mata Pelajaran');

                $crud->field_type('tgl_update', 'hidden');

                $pelajaran = $cek->row_array();

                $this->breadcrumbs->push('Beranda', $this->base_breadcrumbs);
                $this->breadcrumbs->push('Jadwal Pelajaran', $this->base_breadcrumbs . '/kelola-jadwalpelajaran');
                $this->breadcrumbs->push($pelajaran['nama_kelas'], $this->base_breadcrumbs . '/kelola_jadwalpelajaran/' . $kelas_id);

                $state = $crud->getState();
                if ($state === 'insert_validation') {

                } elseif ($state === 'update_validation') {

                } elseif ($state === 'add') {
                    $this->breadcrumbs->push('Tambah', $this->base_breadcrumbs . '/jadwal-mengajar/add');
                } elseif ($state === 'edit') {

                    $this->breadcrumbs->push('Ubah', $this->base_breadcrumbs . '/jadwal-mengajar/add');
                }

                $crud->unset_clone();
                $crud->unset_read();

                $extra  = array('page_title' => 'Kelola jadwal pelajaran <span class="text-danger">' . strtoupper($pelajaran['nama_kelas']) . '</span>');
                $output = $crud->render();

                $output = array_merge((array) $output, $extra);

                $this->_page_output($output);
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
        } else {

            $this->breadcrumbs->push('Dashboard', $this->base_breadcrumbs);
            $this->breadcrumbs->push('Kelola Jadwal Pelajaran', $this->base_breadcrumbs . '/kelola-jadwalpelajaran');

            $kelas = $this->db->query("SELECT a.id AS kelas_id,
                                              a.nama_kelas AS nama_kelas,
                                              b.nama AS nama_jurusan,
                                              CONCAT(COUNT(c.id),'&nbsp;','Siswa') AS jumlah_siswa
                                       FROM kelas a
                                       LEFT JOIN jurusan b ON a.jurusan_id = b.id
                                       LEFT JOIN siswa c ON a.id = c.kelas_id
                                       GROUP BY a.id");
            $data['keterangan'] = 'Pilih kelas yang akan dikelola jadwal pelajarannya';
            $data['kelas']      = $kelas;
            $data['page_name']  = 'list_kelas';
            $data['page_title'] = 'Kelola Jadwal Pelajaran';
            $this->_page_output($data);

        }

    }

    public function hapus_siswa_kelas($siswa_id, $kelas_id)
    {

        $siswa_id = simple_crypt($siswa_id, 'd');
        $kelas_id = simple_crypt($kelas_id, 'd');

        $cek = $this->db->get_where('siswa', array('id' => $siswa_id));
        if ($cek->num_rows() > 0) {
            $this->db->where('id', $siswa_id);
            $this->db->update('siswa', array('kelas_id' => 0));
        }

        redirect(site_url('admin/kelola-siswa-kelas/' . $kelas_id));

    }

    public function kelola_siswa_kelas($kelas_id = null)
    {

        if (!empty($_POST)) {
            $kelas_id = $this->input->post('kelas_id');
            $siswa    = $this->input->post('siswa');

            foreach ($siswa as $value) {
                $this->db->where('id', $value);
                $this->db->update('siswa', array('kelas_id' => $kelas_id));
            }
        }

        $data = array();
        $this->breadcrumbs->push('Dashboard', $this->base_breadcrumbs);
        $this->breadcrumbs->push('Kelas', $this->base_breadcrumbs . '/kelola-kelas');

        $this->breadcrumbs->push('Data Siswa Kelas', $this->base_breadcrumbs . '/kelola-siswa-kelas/' . $kelas_id);

        $data['kelas_id'] = $kelas_id;

        $cek = $this->db->get_where('kelas', array('id' => $kelas_id));

        if ($cek->num_rows() > 0) {
            $db_kelas           = $cek->row_array();
            $data['page_title'] = 'Siswa Kelas ' . $db_kelas['nama_kelas'];
        } else {
            redirect(site_url('admin'), 'reload');
        }

        $this->db->order_by('nama_lengkap', 'ASC');
        $data['list_siswa'] = $this->db->get_where('siswa', array('kelas_id' => $kelas_id));
        $data['page_name']  = 'list_siswa';

        $this->_page_output($data);
    }

    public function kelola_kelas()
    {
        try {
            $this->load->library(array('grocery_CRUD'));
            $crud = new Grocery_CRUD();

            $crud->set_table('kelas');
            $crud->set_subject('Kelas');
            $crud->order_by('nama_kelas', 'ASC');

            $crud->required_fields('jurusan_id', 'nama_kelas');

            $crud->columns('nama_kelas', 'siswa');
            $crud->field_type('tgl_update', 'hidden');

            $crud->set_relation('jurusan_id', 'jurusan', 'nama');

            $crud->display_as('jurusan_id', 'Jurusan');

            $crud->callback_after_insert(function ($post_array, $primary_key) {

            });

            $crud->callback_after_update(function ($post_array, $primary_key) {

            });

            $crud->callback_column('siswa', function ($value, $row) {

                return '<a href="' . site_url('admin/kelola-siswa-kelas/' . $row->id) . '">Kelola</a>';
            });

            $this->breadcrumbs->push('Beranda', $this->base_breadcrumbs);
            $this->breadcrumbs->push('Kelas', $this->base_breadcrumbs . '/kelola-kelas');

            $state = $crud->getState();
            if ($state === 'insert_validation') {

            } elseif ($state === 'update_validation') {

            } elseif ($state === 'add') {
                $this->breadcrumbs->push('Tambah', $this->base_breadcrumbs . '/kelola-kelas/add');
            } elseif ($state === 'edit') {
                $this->breadcrumbs->push('Ubah', $this->base_breadcrumbs . '/kelola-kelas/add');
            }

            $crud->unset_clone();
            $crud->unset_read();

            $extra  = array('page_title' => 'Kelola Kelas');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function kelola_matapelajaran()
    {
        try {
            $this->load->library(array('grocery_CRUD'));
            $crud = new Grocery_CRUD();

            $crud->set_table('matapelajaran');
            $crud->set_subject('Mata Pelajaran');

            $crud->required_fields('nama');

            $crud->columns('nama');

            $crud->callback_after_insert(function ($post_array, $primary_key) {

            });

            $crud->callback_after_update(function ($post_array, $primary_key) {

            });

            $this->breadcrumbs->push('Beranda', $this->base_breadcrumbs);
            $this->breadcrumbs->push('Mata Pelajaran', $this->base_breadcrumbs . '/kelola-matapelajaran');

            $state = $crud->getState();
            if ($state === 'insert_validation') {

            } elseif ($state === 'update_validation') {

            } elseif ($state === 'add') {
                $this->breadcrumbs->push('Tambah', $this->base_breadcrumbs . '/kelola-matapelajaran/add');
            } elseif ($state === 'edit') {

                $this->breadcrumbs->push('Ubah', $this->base_breadcrumbs . '/kelola-matapelajaran/add');
            }

            $crud->unset_clone();
            $crud->unset_read();

            $extra  = array('page_title' => 'Kelola Mata Pelajaran');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function reset_password_siswa($siswa_id)
    {

        $cek = $this->db->get_where('siswa', array('id' => $siswa_id))->row_array();

        $nisn_pass = md5($cek['nisn']);

        $this->db->set('password', "'" . $nisn_pass . "'", false);
        $this->db->where('id', $siswa_id);
        $this->db->update('siswa');

        $this->alert->set('alert-success', 'Password berhasil direset dan diganti menjadi NISN');

        redirect(site_url('admin/kelola-siswa'), 'reload');
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
                    redirect(site_url('admin/profile/edit/' . $this->user_id), 'reload');
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

    public function kelola_jam_aktif()
    {
        try {

            $this->load->library(array('grocery_CRUD'));
            $crud = new Grocery_CRUD();

            $crud->set_table('jam_aktif');
            $crud->set_subject('Jam aktif');

            $crud->required_fields('mulai', 'selesai');
            $crud->columns('jam_ke', 'mulai', 'selesai');

            $crud->callback_after_insert(function ($post_array, $primary_key) {

            });

            $crud->callback_after_update(function ($post_array, $primary_key) {

            });

            $crud->field_type('tgl_update', 'hidden');
            $crud->field_type('jam_ke', 'readonly');

            $this->breadcrumbs->push('Beranda', $this->base_breadcrumbs);
            $this->breadcrumbs->push('Jam Aktif', $this->base_breadcrumbs . '/kelola-jam-aktif');

            $crud->unset_add();
            $crud->unset_clone();
            $crud->unset_read();
            $crud->unset_delete();

            $extra  = array('page_title' => 'Kelola Jam Aktif');
            $output = $crud->render();

            $state = $crud->getState();
            if ($state === 'insert_validation') {

            } elseif ($state === 'update_validation') {

            } elseif ($state === 'add') {
                $extra['keterangan'] = 'Format jam mulai dan jam selesai => jam:menit (misal jam 8 pagi => 08:00) ';
                $this->breadcrumbs->push('Tambah', $this->base_breadcrumbs . '/kelola-jam-aktif/add');
            } elseif ($state === 'edit') {
                $extra['keterangan'] = 'Format => jam:menit (misal jam 8 pagi => 08:00) ';
                $this->breadcrumbs->push('Ubah', $this->base_breadcrumbs . '/kelola-jam-aktif/add');
            }

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function jadwal_mengajar($pegawai_id)
    {
        try {

            $cek = $this->db->get_where('pegawai', array('id' => $pegawai_id));
            if ($cek->num_rows() == 0) {
                redirect(site_url('admin/kelola-pegawai'), 'reload');
            }

            $this->load->library(array('grocery_CRUD'));
            $crud = new Grocery_CRUD();

            $crud->set_table('jadwal_mengajar');
            $crud->set_subject('Jadwal Mengajar');
            $crud->where('pegawai_id', $pegawai_id);

            $crud->required_fields('hari', 'jam_mulai', 'jam_selesai', 'matapelajaran_id', 'kelas_id');

            $crud->field_type('pegawai_id', 'hidden', $pegawai_id);

            $crud->columns('hari', 'jam', 'kelas_id', 'matapelajaran_id');

            $crud->callback_column('jam', function ($value, $row) {

                return 'Jam ke-' . $row->jam_mulai . '&nbsp;s/d&nbsp;' . $row->jam_selesai;
            });

            $crud->callback_after_insert(function ($post_array, $primary_key) {

            });

            $crud->callback_after_update(function ($post_array, $primary_key) {

            });

            //tags
            $this->db->order_by('jam_ke ASC');
            $jam_aktif = $this->db->get('jam_aktif');

            $set_jam = array();
            foreach ($jam_aktif->result_array() as $row) {
                $set_jam[$row['id']] = 'Jam ke - ' . $row['jam_ke'] . '&nbsp;(' . $row['mulai'] . ' s/d ' . $row['selesai'] . ')';
            }

            $crud->field_type('jam_mulai', 'dropdown', $set_jam);
            $crud->field_type('jam_selesai', 'dropdown', $set_jam);
            $crud->display_as('jam_mulai', 'Mulai mengajar');
            $crud->display_as('jam_selesai', 'Sampai dengan');

            $crud->set_relation('kelas_id', 'kelas', 'nama_kelas');
            $crud->display_as('kelas_id', 'Kelas');

            $crud->set_relation('matapelajaran_id', 'matapelajaran', 'nama');
            $crud->display_as('matapelajaran_id', 'Mata Pelajaran');

            $crud->field_type('tgl_update', 'hidden');

            $this->breadcrumbs->push('Beranda', $this->base_breadcrumbs);
            $this->breadcrumbs->push('Kelola Pegawai', $this->base_breadcrumbs . '/kelola_pegawai');
            $this->breadcrumbs->push('Jadwal Mengajar', $this->base_breadcrumbs . '/jadwal-mengajar');

            $state = $crud->getState();
            if ($state === 'insert_validation') {

            } elseif ($state === 'update_validation') {

            } elseif ($state === 'add') {
                $this->breadcrumbs->push('Tambah', $this->base_breadcrumbs . '/jadwal-mengajar/add');
            } elseif ($state === 'edit') {

                $this->breadcrumbs->push('Ubah', $this->base_breadcrumbs . '/jadwal-mengajar/add');
            }

            $crud->unset_clone();
            $crud->unset_read();

            $pegawai = $cek->row_array();

            $extra  = array('page_title' => 'Kelola jadwal mengajar untuk<br/><span class="text-info">' . $pegawai['nama_lengkap'] . ' (' . $pegawai['nuptk'] . ')</span>');
            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function reset_password_pegawai($pegawai_id)
    {

        $cek = $this->db->get_where('pegawai', array('id' => $pegawai_id))->row_array();

        $nuptk_pass = md5($cek['nuptk']);

        $this->db->set('password', "'" . $nuptk_pass . "'", false);
        $this->db->where('id', $pegawai_id);
        $this->db->update('pegawai');

        $this->alert->set('alert-success', 'Password berhasil direset dan diganti menjadi NUPTK');

        redirect(site_url('admin/kelola-pegawai'), 'reload');
    }

    public function kelola_pegawai()
    {
        try {
            $this->load->library(array('grocery_CRUD'));
            $crud = new Grocery_CRUD();

            $crud->set_table('pegawai');
            $crud->set_subject('Pegawai');
            $crud->order_by('nama_lengkap', 'ASC');

            $crud->required_fields('jabatan', 'status_pegawai', 'nuptk', 'nama_lengkap', 'jk');

            $crud->columns('nama_lengkap','nuptk',  'jabatan', /* 'mengajar',*/'password');
            $crud->field_type('tgl_update', 'hidden');
            $crud->field_type('password', 'hidden');
            $crud->field_type('token_firebase', 'hidden');
            $crud->field_type('terakhir_login', 'hidden');
            $crud->field_type('wali_kelas', 'hidden');
            $crud->field_type('token_login', 'hidden');

            $crud->display_as('nuptk', 'NUPTK');
            $crud->display_as('status_pegawai', 'Status');
            $crud->display_as('nama_lengkap', 'Nama');

            $crud->callback_after_insert(function ($post_array, $primary_key) {

                $this->db->where('id', $primary_key);
                $this->db->update('pegawai',
                    array(
                        'password'   => md5($post_array['nuptk']),
                        'tgl_update' => date('Y-m-d H:i:s'),
                    )
                );
            });

            $crud->callback_after_update(function ($post_array, $primary_key) {

                $this->db->where('id', $primary_key);
                $this->db->update('pegawai',
                    array(
                        'tgl_update' => date('Y-m-d H:i:s'),
                    )
                );
            });

            $crud->callback_column('jabatan', function ($value, $row) {

                return $value;
            });

            // $crud->callback_column('mengajar', function ($value, $row) {

            //     if ($row->jabatan === 'GURU') {
            //         return '<a href="' . site_url('admin/jadwal-mengajar/' . $row->id) . '">JADWAL</a>';
            //     } else {
            //         return '-';
            //     }
            // });

            $crud->callback_column('password', function ($value, $row) {

                return '<a onclick="return confirm(\'anda yakin melakukan reset password untuk pegawai ini?\');" class="text-danger" href="' . site_url('admin/reset-password-pegawai/' . $row->id) . '">RESET</a>';

            });

            $crud->set_field_upload('foto', 'uploads/foto');

            $this->breadcrumbs->push('Beranda', $this->base_breadcrumbs);
            $this->breadcrumbs->push('Pegawai', $this->base_breadcrumbs . '/kelola-pegawai');

            $state = $crud->getState();
            if ($state === 'insert_validation') {
                $crud->set_rules('nuptk', 'NUPTK', 'is_unique[pegawai.nuptk]|required');
                $crud->set_rules('email', 'Email', 'is_unique[pegawai.email]|valid_email');
            } elseif ($state === 'update_validation') {
                $crud->set_rules('email', 'Email', 'valid_email');
            } elseif ($state === 'add') {
                $this->breadcrumbs->push('Tambah', $this->base_breadcrumbs . '/kelola-pegawai/add');
            } elseif ($state === 'edit') {
                $this->breadcrumbs->push('Ubah', $this->base_breadcrumbs . '/kelola-pegawai/edit');
            }

            $extra               = array('page_title' => 'Kelola Pegawai');
            $keterangan          = '<br/>* Anda dapat meng-import data pegawai dari file Microsoft Excel. Klik <a class="text-danger" href="' . site_url('admin/import-pegawai') . '">DISINI</a>&nbsp;untuk melakukannya';
            $extra['keterangan'] = $keterangan;

            $crud->unset_clone();
            $crud->unset_read();

            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function import_pegawai()
    {

        if (!empty($_POST)) {

            $config['upload_path']   = './uploads';
            $config['allowed_types'] = 'xls';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {

                $this->alert->set('alert-danger', '<p class="text-danger">' . $this->upload->display_errors() . '</p>', true);

            } else {
                include_once APPPATH . 'libraries/excel_reader2.php';
                $xl_data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

                $j            = 0;
                $new_rows     = 0;
                $updated_rows = 0;

                //baris data dimulai dari baris ke 2
                for ($i = 2; $i <= ($xl_data->rowcount($sheet_index = 0)); ++$i) {

                    $nama_lengkap = strtoupper(trim($xl_data->val($i, 1)));
                    $kode_pegawai = strtoupper(trim($xl_data->val($i, 2)));
                    $nuptk        = trim($xl_data->val($i, 3));
                    $jabatan      = trim($xl_data->val($i, 4));
                    $jk           = strtoupper(trim($xl_data->val($i, 5)));
                    $alamat       = trim($xl_data->val($i, 6));
                    $email        = trim($xl_data->val($i, 7));
                    $telp         = trim($xl_data->val($i, 8));

                    if ($nuptk === "") {continue;}

                    $r = $this->db->get_where('pegawai', array('nuptk' => $nuptk));

                    if ($r->num_rows() == 0) {
                        //hanya data baru aja yang dimasukkin
                        $in = array(
                            'kode_pegawai' => $kode_pegawai,
                            'nuptk'        => $nuptk,
                            'password'     => md5($nuptk),
                            'jabatan'      => $jabatan,
                            'nama_lengkap' => $nama_lengkap,
                            'jk'           => $jk,
                            'alamat'       => $alamat,
                            'email'        => $email,
                            'telp'         => $telp,
                        );

                        $this->db->insert('pegawai', $in);
                        ++$new_rows;
                    } else {
                        //lets update
                        $up = array(
                            'kode_pegawai'   => $kode_pegawai,
                            'jabatan'        => $jabatan,
                            'status_pegawai' => $status_pegawai,
                            'nama_lengkap'   => $nama_lengkap,
                            'jk'             => $jk,
                            'alamat'         => $alamat,
                            'email'          => $email,
                            'telp'           => $telp,
                        );

                        $this->db->where('nuptk', $nuptk);
                        $this->db->update('pegawai', $up);

                        ++$updated_rows;
                    }

                    ++$j;
                }

                $success   = $this->upload->data();
                $file_name = $success['file_name'];

                @unlink('./uploads/' . $file_name);
                $this->alert->set('alert-success', 'Data berhasil dimasukkan dengan ' . $new_rows . ' Data baru ' . 'dan ' . $updated_rows . ' Data Lama / Data Update', true);
                //$data['msg'] = 'Data berhasil dimasukkan dengan ' . $new_rows . ' Data baru ' . 'dan ' . $updated_rows . ' Data Lama / Data Update';

            }

        }

        $this->breadcrumbs->push('Dashboard', $this->base_breadcrumbs);
        $this->breadcrumbs->push('Kelola Pegawai', $this->base_breadcrumbs . '/kelola-pegawai');
        $this->breadcrumbs->push('Import Data', $this->base_breadcrumbs . '/import-pegawai');

        $data['page_name']  = 'import_pegawai';
        $data['page_title'] = 'Import Data Pegawai';
        $this->_page_output($data);
    }

    public function kelola_siswa()
    {
        try {
            $this->load->library(array('grocery_CRUD'));
            $crud = new Grocery_CRUD();

            $crud->set_table('siswa');
            $crud->set_subject('Siswa');

            $crud->required_fields('nisn', 'email', 'nama_lengkap', 'jk');

            $crud->columns('nama_lengkap', 'nisn', 'password');
            $crud->field_type('tgl_update', 'hidden');
            $crud->field_type('password', 'hidden');
            $crud->field_type('token_firebase', 'hidden');
            $crud->field_type('terakhir_login', 'hidden');
            // $crud->field_type('kelas_id', 'hidden');
            $crud->set_relation('kelas_id', 'kelas', 'nama_kelas');

            $crud->field_type('token_login', 'hidden');
            $crud->display_as('nisn', 'NISN');
            $crud->display_as('kelas_id', 'Kelas');
            $crud->display_as('petugas_jurnal', 'Pencatat Jurnal Kelas ?');

            $crud->callback_after_insert(function ($post_array, $primary_key) {

                $this->db->where('id', $primary_key);
                $this->db->update('siswa',
                    array(
                        'password'   => md5($post_array['nisn']),
                        'tgl_update' => date('Y-m-d H:i:s'),
                    )
                );
            });

            $crud->callback_after_update(function ($post_array, $primary_key) {

                $this->db->where('id', $primary_key);
                $this->db->update('siswa',
                    array(
                        'tgl_update' => date('Y-m-d H:i:s'),
                    )
                );
            });

            $crud->callback_column('password', function ($value, $row) {

                return '<a onclick="return confirm(\'anda yakin melakukan reset password untuk siswa ini?\');" class="text-danger" href="' . site_url('admin/reset-password-siswa/' . $row->id) . '">RESET</a>';

            });

            $crud->set_field_upload('foto', 'uploads/foto');

            $this->breadcrumbs->push('Beranda', $this->base_breadcrumbs);
            $this->breadcrumbs->push('Siswa', $this->base_breadcrumbs . '/kelola-siswa');

            $state = $crud->getState();
            if ($state === 'insert_validation') {
                $crud->set_rules('nisn', 'NISN', 'is_unique[siswa.nisn]|required');
                $crud->set_rules('email', 'Email', 'is_unique[siswa.email]|valid_email');
            } elseif ($state === 'update_validation') {
                $crud->set_rules('email', 'Email', 'valid_email');
            } elseif ($state === 'add') {
                $this->breadcrumbs->push('Tambah', $this->base_breadcrumbs . '/kelola-siswa/add');
            } elseif ($state === 'edit') {

                $this->breadcrumbs->push('Ubah', $this->base_breadcrumbs . '/kelola-siswa/add');
            }

            $extra               = array('page_title' => 'Kelola Siswa');
            $extra['keterangan'] = 'Anda dapat meng-import data siswa dari file Microsoft Excel. Klik di <a class="text-danger" href="' . site_url('admin/import-siswa') . '">SINI</a>&nbsp;untuk melakukannya';

            $crud->unset_read();
            $crud->unset_clone();

            $output = $crud->render();

            $output = array_merge((array) $output, $extra);

            $this->_page_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function import_siswa()
    {

        if (!empty($_POST)) {

            $config['upload_path']   = './uploads';
            $config['allowed_types'] = 'xls';
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {

                $this->alert->set('alert-danger', '<p class="text-danger">' . $this->upload->display_errors() . '</p>', true);

            } else {
                include_once APPPATH . 'libraries/excel_reader2.php';
                $xl_data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

                $j            = 0;
                $new_rows     = 0;
                $updated_rows = 0;

                //baris data dimulai dari baris ke 2
                for ($i = 2; $i <= ($xl_data->rowcount($sheet_index = 0)); ++$i) {

                    $nama_lengkap = strtoupper(trim($xl_data->val($i, 1)));
                    $nisn         = trim($xl_data->val($i, 2));
                    $jk           = strtoupper(trim($xl_data->val($i, 3)));
                    $alamat       = trim($xl_data->val($i, 4));
                    $email        = trim($xl_data->val($i, 5));
                    $telp         = trim($xl_data->val($i, 6));

                    if ($nisn === "") {continue;}

                    $r = $this->db->get_where('siswa', array('nisn' => $nisn));

                    if ($r->num_rows() == 0) {
                        //hanya data baru aja yang dimasukkin
                        $in = array(
                            'nisn'         => $nisn,
                            'password'     => md5($nisn),
                            'nama_lengkap' => $nama_lengkap,
                            'jk'           => $jk,
                            'alamat'       => $alamat,
                            'email'        => $email,
                            'telp'         => $telp,
                        );

                        $this->db->insert('siswa', $in);
                        ++$new_rows;
                    } else {
                        //lets update
                        $up = array(
                            'nama_lengkap' => $nama_lengkap,
                            'jk'           => $jk,
                            'alamat'       => $alamat,
                            'email'        => $email,
                            'telp'         => $telp,
                        );

                        $this->db->where('nisn', $nisn);
                        $this->db->update('siswa', $up);

                        ++$updated_rows;
                    }

                    ++$j;
                }

                $success   = $this->upload->data();
                $file_name = $success['file_name'];

                @unlink('./uploads/' . $file_name);
                $this->alert->set('alert-success', 'Data berhasil dimasukkan dengan ' . $new_rows . ' Data baru ' . 'dan ' . $updated_rows . ' Data Lama / Data Update', true);
                //$data['msg'] = 'Data berhasil dimasukkan dengan ' . $new_rows . ' Data baru ' . 'dan ' . $updated_rows . ' Data Lama / Data Update';

            }

        }

        $this->breadcrumbs->push('Dashboard', $this->base_breadcrumbs);
        $this->breadcrumbs->push('Kelola Siswa', $this->base_breadcrumbs . '/kelola-siswa');
        $this->breadcrumbs->push('Import Data', $this->base_breadcrumbs . '/import-siswa');

        $data['page_name']  = 'import_siswa';
        $data['page_title'] = 'Import Data Siswa';
        $this->_page_output($data);
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
                        redirect(site_url('admin/ganti-password'), 'reload');
                    } else {
                        $pass_baru   = $this->input->post('pass_baru');
                        $pass_ulangi = $this->input->post('pass_ulangi');

                        if ($pass_baru !== $pass_ulangi) {
                            $this->alert->set('alert-danger', 'Password baru & ulangan harus sama');
                            redirect(site_url('admin/ganti-password'), 'reload');
                        } else {
                            $this->db->where('id', $this->user_id);
                            $this->db->update('user', array('password' => md5($pass_baru)));

                            $this->alert->set('alert-success', 'Password berhasil diupdate');
                            redirect(site_url('admin/ganti-password'), 'reload');
                        }
                    }

                } else {

                    $this->alert->set('alert-danger', 'Password Lama Salah');
                    redirect(site_url('admin/ganti-password'), 'reload');

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
