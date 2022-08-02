<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
        $data['kelas'] = $this->db->get('kelas')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/kelas/kelas', $data);
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
        $this->load->view('admin/kelas/tambah-kelas');
        $this->load->view('templates/footer', $data);
    }

    public function f_tambah()
    {
        $nama_kelas = $this->input->post('nama_kelas');
        $data_kelas = [];
        foreach ($nama_kelas as $nama) {
            array_push($data_kelas, [
                'nama_kelas' => $nama,
            ]);
        }

        $sql = $this->db->insert_batch('kelas', $data_kelas);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Kelas <strong>Berhasil</strong> Disimpan
                </div>
            ');
            redirect('kelas');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Kelas <strong>Gagal</strong> Disimpan
                </div>
            ');
            redirect('kelas');
        }
    }

    public function f_hapus($data_id_kelas = '')
    {
        $id_kelas = decrypt_url($data_id_kelas);
        if ($id_kelas == '' || $id_kelas == null) {
            redirect('kelas');
        }

        $sql = $this->db->delete('kelas', ['id_kelas' => $id_kelas]);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Kelas <strong>Berhasil Dihapus</strong>
                </div>
            ');
            redirect('kelas');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Kelas <strong>Gagal Dihapus</strong>
                </div>
            ');
            redirect('kelas');
        }
    }

    public function f_edit()
    {
        $id_kelas = decrypt_url($this->input->post('id_kelas'));
        $nama_kelas = $this->input->post('nama_kelas');

        $this->db->set('nama_kelas', $nama_kelas);
        $this->db->where('id_kelas', $id_kelas);
        $this->db->update('kelas');

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Kelas <strong>Berhasil Di Upadte</strong>
                </div>
            ');
        redirect('kelas');
    }
}
