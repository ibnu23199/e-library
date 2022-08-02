<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('id')) {
            redirect('app');
        }

        $this->form_validation->set_rules('l_email', 'Email', 'required');
        $this->form_validation->set_rules('l_password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $data['setting'] = $this->db->get('setting')->row();
            $data['admin'] = $this->db->get('admin')->row();
            $this->load->view('auth/index', $data);
        } else {
            $admin = $this->db->get_where('admin', ['email' => $this->input->post('l_email')])->row();
            if ($admin == null) {
                // GAGAL
                $this->session->set_flashdata('pesan', '
                    <div class="alert alert-danger" role="alert">
                        Gagal Login, akun tidak ditemukan!
                    </div>
                ');
                redirect('auth');
            }

            if (password_verify($this->input->post('l_password'), $admin->password)) {
                // Password Benar
                $data_session = [
                    'id' => $admin->id_admin,
                    'email' => $admin->email
                ];
                $this->session->set_userdata($data_session);
                redirect('app');
            } else {
                // GAGAL
                $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger" role="alert">
                    Gagal Login, Password Salah!
                </div>
            ');
                redirect('auth');
            }
        }
    }

    public function daftar_admin()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $data_admin = [
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'avatar' => 'logo-mini.png'
        ];

        $query = $this->db->insert('admin', $data_admin);

        if ($query) {
            // Berhasil
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                    Berhasil Disimpan, Silahkan Login
                </div>
            ');
            redirect('auth');
        } else {
            // GAGAL
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger" role="alert">
                    gagal Disimpan, Silahkan Coba lagi!
                </div>
            ');
            redirect('auth');
        }
    }

    public function sign_out()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                    Berhasil Logut, Terimakasih
                </div>
            ');
        redirect('auth');
    }
}
