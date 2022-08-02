<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
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
        $data['jurusan'] = $this->db->get('jurusan')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/jurusan/jurusan', $data);
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
        $this->load->view('admin/jurusan/tambah-jurusan');
        $this->load->view('templates/footer', $data);
    }

    public function f_tambah()
    {
        $nama_jurusan = $this->input->post('nama_jurusan');
        $data_jurusan = [];
        foreach ($nama_jurusan as $nama) {
            array_push($data_jurusan, [
                'nama_jurusan' => $nama,
            ]);
        }

        $sql = $this->db->insert_batch('jurusan', $data_jurusan);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data jurusan <strong>Berhasil</strong> Disimpan
                </div>
            ');
            redirect('jurusan');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Jurusan <strong>Gagal</strong> Disimpan
                </div>
            ');
            redirect('jurusan');
        }
    }

    public function f_hapus($data_id_jurusan = '')
    {
        $id_jurusan = decrypt_url($data_id_jurusan);
        if ($id_jurusan == '' || $id_jurusan == null) {
            redirect('jurusan');
        }

        $sql = $this->db->delete('jurusan', ['id_jurusan' => $id_jurusan]);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Jurusan <strong>Berhasil Dihapus</strong>
                </div>
            ');
            redirect('jurusan');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Jurusan <strong>Gagal Dihapus</strong>
                </div>
            ');
            redirect('jurusan');
        }
    }

    public function f_edit()
    {
        $id_jurusan = decrypt_url($this->input->post('id_jurusan'));
        $nama_jurusan = $this->input->post('nama_jurusan');

        $this->db->set('nama_jurusan', $nama_jurusan);
        $this->db->where('id_jurusan', $id_jurusan);
        $this->db->update('jurusan');

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Jurusan <strong>Berhasil Di Upadte</strong>
                </div>
            ');
        redirect('jurusan');
    }
}
