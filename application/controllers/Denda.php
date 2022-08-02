<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Denda extends CI_Controller
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
        $data['denda'] = $this->db->get_where('denda', ['jumlah_denda !=' => null])->result();
        $data['denda_lainnya'] = $this->db->get_where('denda', ['jumlah_denda =' => null])->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/denda/denda');
        $this->load->view('templates/footer', $data);
    }

    public function tambah($data_jenis_tambah = '')
    {
        $jenis = decrypt_url($data_jenis_tambah);

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

        if ($jenis == 1) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/denda/tambah-denda-harian');
            $this->load->view('templates/footer', $data);
        }

        if ($jenis == 2) {
            $this->load->view('templates/header', $data);
            $this->load->view('admin/denda/tambah-denda-lainnya');
            $this->load->view('templates/footer', $data);
        }
    }

    public function f_tambah($data_jenis_tambah = '')
    {
        $jenis = decrypt_url($data_jenis_tambah);

        $nama_denda = $this->input->post('nama_denda');
        $jumlah_denda = $this->input->post('jumlah_denda');
        $i = 0;
        $data_denda = [];

        if ($jenis == 1) {
            foreach ($nama_denda as $nama) {
                array_push($data_denda, [
                    'nama_denda' => $nama,
                    'jumlah_denda' => $jumlah_denda[$i]
                ]);

                $i++;
            }
        }

        if ($jenis == 2) {
            foreach ($nama_denda as $nama) {
                array_push($data_denda, [
                    'nama_denda' => $nama,
                    'jumlah_denda' => null
                ]);
            }
        }

        $sql = $this->db->insert_batch('denda', $data_denda);

        if ($sql) {
            $this->session->set_flashdata("pesan$jenis", '
                <div class="alert alert-success mt-3" role="alert">
                    Data Denda <strong>Berhasil Disimpan</strong>
                </div>
            ');
            redirect('denda');
        } else {
            $this->session->set_flashdata("pesan$jenis", '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Denda <strong>Gagal Disimpan</strong>
                </div>
            ');
            redirect('denda');
        }
    }

    public function f_hapus($data_id_denda = '', $jenis = '')
    {
        $id_denda = decrypt_url($data_id_denda);
        if ($id_denda == '' || $id_denda == null) {
            redirect('denda');
        }

        $sql = $this->db->delete('denda', ['id_denda' => $id_denda]);

        if ($sql) {
            $this->session->set_flashdata("pesan$jenis", '
                <div class="alert alert-success mt-3" role="alert">
                    Data Denda <strong>Berhasil Dihapus</strong>
                </div>
            ');
            redirect('denda');
        } else {
            $this->session->set_flashdata("pesan$jenis", '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Denda <strong>Gagal Dihapus</strong>
                </div>
            ');
            redirect('denda');
        }
    }

    public function f_edit($jenis = '')
    {

        if ($jenis == 2) {

            $id_denda = decrypt_url($this->input->post('id_denda2'));
            $nama_denda = $this->input->post('nama_denda2');

            $this->db->set('nama_denda', $nama_denda);
            $this->db->where('id_denda', $id_denda);
            $this->db->update('denda');
        } else {

            $id_denda = decrypt_url($this->input->post('id_denda1'));
            $nama_denda = $this->input->post('nama_denda1');
            $jumlah_denda = $this->input->post('jumlah_denda');

            $this->db->set('nama_denda', $nama_denda);
            $this->db->set('jumlah_denda', $jumlah_denda);
            $this->db->where('id_denda', $id_denda);
            $this->db->update('denda');
        }

        $this->session->set_flashdata("pesan$jenis", '
                <div class="alert alert-success mt-3" role="alert">
                    Data Denda <strong>Berhasil Di Upadte</strong>
                </div>
            ');
        redirect('denda');
    }
}
