<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
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
            'datatables' => '<script src="' .  base_url('assets/app-assets/e-library/') . 'js/data-table.js"></script>',
            'select2_js' => '',
            'select2_css' => '',
        ];
        $data['menu'] = [
            'dashboard' => '',
            'master_data' => 'active',
            'settings' => '',
            'transaksi' => '',
        ];
        $data['setting'] = $this->db->get('setting')->row();
        $data['admin'] = $this->db->get('admin')->row();
        $data['kategori'] = $this->db->get('kategori')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kategori/kategori', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah()
    {
        $data['plugin'] = [
            'dashboard' => '',
            'datatables' => '<script src="' .  base_url('assets/app-assets/e-library/') . 'js/data-table.js"></script>',
            'select2_js' => '',
            'select2_css' => '',
        ];
        $data['menu'] = [
            'dashboard' => '',
            'master_data' => 'active',
            'settings' => '',
            'transaksi' => '',
        ];
        $data['setting'] = $this->db->get('setting')->row();
        $data['admin'] = $this->db->get('admin')->row();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kategori/tambah-kategori');
        $this->load->view('templates/footer', $data);
    }

    public function f_tambah()
    {
        $nama_kategori = $this->input->post('nama_kategori');
        $data_kategori = [];
        foreach ($nama_kategori as $nama) {
            array_push($data_kategori, [
                'nama_kategori' => $nama,
            ]);
        }

        $sql = $this->db->insert_batch('kategori', $data_kategori);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Kategori <strong>Berhasil</strong> Disimpan
                </div>
            ');
            redirect('category');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Kategori <strong>Gagal</strong> Disimpan
                </div>
            ');
            redirect('category');
        }
    }

    public function f_hapus($data_id_kategori = '')
    {
        $id_kategori = decrypt_url($data_id_kategori);
        if ($id_kategori == '' || $id_kategori == null) {
            redirect('category');
        }

        $sql = $this->db->delete('kategori', ['id_kategori' => $id_kategori]);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Kategori <strong>Berhasil Dihapus</strong>
                </div>
            ');
            redirect('category');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Kategori <strong>Gagal Dihapus</strong>
                </div>
            ');
            redirect('category');
        }
    }

    public function f_edit()
    {
        $id_kategori = decrypt_url($this->input->post('id_kategori'));
        $nama_kategori = $this->input->post('nama_kategori');

        $this->db->set('nama_kategori', $nama_kategori);
        $this->db->where('id_kategori', $id_kategori);
        $this->db->update('kategori');

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Kategori <strong>Berhasil Di Upadte</strong>
                </div>
            ');
        redirect('category');
    }
}
