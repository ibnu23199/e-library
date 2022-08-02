<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['plugin'] = [
            'dashboard' => '',
            'datatables' => '',
            'select2_js' => '',
            'select2_css' => '',
        ];
        $data['menu'] = [
            'dashboard' => '',
            'master_data' => '',
            'settings' => 'active',
            'transaksi' => '',
        ];
        $data['admin'] = $this->db->get('admin')->row();
        $data['setting'] = $this->db->get('setting')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/pengaturan/pengaturan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function f_pengaturan()
    {
        $footer_1 = $this->input->post('footer_1');
        $footer_2 = $this->input->post('footer_2');
        $setting = $this->db->get('setting')->row();

        $config['allowed_types'] = 'png';
        $config['max_size']     = '5048';
        $config['upload_path'] = './assets/app-assets/e-library/images/';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if ($_FILES['logo']['name'] != null) {
            $this->upload->do_upload('logo');
            $data1 = $this->upload->data();
            $new_nama_file1 = $data1['file_name'];
            unlink(FCPATH . 'assets/app-assets/e-library/images/' . $setting->logo);
            $this->db->set('logo', $new_nama_file1);
        }

        if ($_FILES['logo_mini']['name'] != null) {
            $this->upload->do_upload('logo_mini');
            $data2 = $this->upload->data();
            $new_nama_file2 = $data2['file_name'];
            unlink(FCPATH . 'assets/app-assets/e-library/images/' . $setting->logo_mini);
            $this->db->set('logo_mini', $new_nama_file2);
        }

        $this->db->set('footer_1', $footer_1);
        $this->db->set('footer_2', $footer_2);
        $this->db->update('setting');

        $this->session->set_flashdata("setting", '
                <div class="alert alert-success mt-3" role="alert">
                    Data Pengaturan <strong>Berhasil Di Upadte</strong>
                </div>
            ');
        redirect('pengaturan');
    }

    public function f_profile()
    {
        $nama = $this->input->post('nama');

        $admin = $this->db->get('admin')->row();

        $config['allowed_types'] = 'jpg|png';
        $config['max_size']     = '5048';
        $config['upload_path'] = './assets/app-assets/user/';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if ($_FILES['image']['name'] != null) {
            $this->upload->do_upload('image');
            $data = $this->upload->data();
            $new_nama_file = $data['file_name'];
            unlink(FCPATH . 'assets/app-assets/user/' . $admin->avatar);
            $this->db->set('avatar', $new_nama_file);
        }

        $this->db->set('nama', $nama);
        $this->db->update('admin');

        $this->session->set_flashdata("profile", '
                <div class="alert alert-success mt-3" role="alert">
                    Profile <strong>Berhasil Di Upadte</strong>
                </div>
            ');
        redirect('pengaturan');
    }

    public function f_password()
    {
        $password = $this->input->post('password');
        $password2 = $this->input->post('password2');

        $admin = $this->db->get('admin')->row();

        if (password_verify($password, $admin->password)) {
            $this->db->set('password', password_hash($password2, PASSWORD_ARGON2I));
            $this->db->update('admin');

            $this->session->set_flashdata("profile", '
                <div class="alert alert-success mt-3" role="alert">
                    Password <strong>Berhasil Di Upadte</strong>
                </div>
            ');
            redirect('pengaturan');
        } else {
            $this->session->set_flashdata("profile", '
                <div class="alert alert-danger mt-3" role="alert">
                    Current Password salah
                </div>
            ');
            redirect('pengaturan');
        }
    }
}
