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

    public function jurnal_kelas()
    {
        $this->breadcrumbs->push('Dashboard', $this->base_breadcrumbs);

        $data['page_name']  = 'beranda';
        $data['page_title'] = 'Beranda';
        $this->_page_output($data);
    }

    public function kelola_pegawai()
    {
        try {
            $this->load->library(array('grocery_CRUD'));
            $crud = new Grocery_CRUD();

            $crud->set_table('tes');
            $crud->set_subject('tes');
            $crud->order_by('name', 'ASC');

            $crud->required_fields('name');

            $crud->columns('name', 'jk', 'password');
            $crud->field_type('password', 'hidden');

            $crud->callback_after_insert(function ($post_array, $primary_key) {

                $this->db->where('id', $primary_key);
                $this->db->update(
                    'tes',
                    array(
                        'password'   => md5($post_array['qwerty']),
                    )
                );
            });

            $crud->callback_column('password', function ($value, $row) {

                return '<a onclick="return confirm(\'anda yakin melakukan reset password untuk pegawai ini?\');" class="text-danger" href="' . site_url('admin/reset-password-pegawai/' . $row->id) . '">RESET</a>';
            });

            $extra               = array('page_title' => 'Kelola Pegawai');

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
                $this->db->update(
                    'siswa',
                    array(
                        'password'   => md5($post_array['nisn']),
                        'tgl_update' => date('Y-m-d H:i:s'),
                    )
                );
            });

            $crud->callback_after_update(function ($post_array, $primary_key) {

                $this->db->where('id', $primary_key);
                $this->db->update(
                    'siswa',
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

            $crud->unset_read();
            $crud->unset_clone();

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
                $this->db->update(
                    'user',
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
