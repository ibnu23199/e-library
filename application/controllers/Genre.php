<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Genre extends CI_Controller
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
        $data['genre'] = $this->db->get('genre')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/genre/genre', $data);
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
        $this->load->view('admin/genre/tambah-genre');
        $this->load->view('templates/footer', $data);
    }

    public function f_tambah()
    {
        $nama_genre = $this->input->post('nama_genre');
        $data_genre = [];
        foreach ($nama_genre as $nama) {
            array_push($data_genre, [
                'nama_genre' => $nama,
            ]);
        }

        $sql = $this->db->insert_batch('genre', $data_genre);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Genre <strong>Berhasil</strong> Disimpan
                </div>
            ');
            redirect('genre');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Genre <strong>Gagal</strong> Disimpan
                </div>
            ');
            redirect('genre');
        }
    }

    public function f_hapus($data_id_genre = '')
    {
        $id_genre = decrypt_url($data_id_genre);
        if ($id_genre == '' || $id_genre == null) {
            redirect('genre');
        }

        $sql = $this->db->delete('genre', ['id_genre' => $id_genre]);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Genre <strong>Berhasil Dihapus</strong>
                </div>
            ');
            redirect('genre');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Genre <strong>Gagal Dihapus</strong>
                </div>
            ');
            redirect('genre');
        }
    }

    public function f_edit()
    {
        $id_genre = decrypt_url($this->input->post('id_genre'));
        $nama_genre = $this->input->post('nama_genre');

        $this->db->set('nama_genre', $nama_genre);
        $this->db->where('id_genre', $id_genre);
        $this->db->update('genre');

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Genre <strong>Berhasil Di Upadte</strong>
                </div>
            ');
        redirect('genre');
    }
}
