<?php

use Mpdf\Tag\Input;

defined('BASEPATH') or exit('No direct script access allowed');

class Students extends CI_Controller
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
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('jurusan', 'jurusan.id_jurusan = siswa.jurusan');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.kelas');
        $data['siswa'] = $this->db->get()->result();

        $data['jurusan'] = $this->db->get('jurusan')->result();
        $data['kelas'] = $this->db->get('kelas')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/siswa/siswa', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah()
    {
        $data['plugin'] = [
            'dashboard' => '',
            'datatables' => '',
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
        $data['kelas'] = $this->db->get('kelas')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/siswa/tambah-siswa', $data);
        $this->load->view('templates/footer', $data);
    }

    public function f_tambah()
    {
        $no_induk = $this->input->post('no_induk');
        $data_siswa = [];
        $i = 0;
        foreach ($no_induk as $no) {
            array_push($data_siswa, [
                'no_induk' => $no,
                'nama_siswa' => $this->input->post('nama_siswa')[$i],
                'jurusan' => $this->input->post('jurusan')[$i],
                'kelas' => $this->input->post('kelas')[$i]
            ]);
            $i++;
        }

        $sql = $this->db->insert_batch('siswa', $data_siswa);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Siswa <strong>Berhasil</strong> Disimpan
                </div>
            ');
            redirect('students');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Siswa <strong>Gagal</strong> Disimpan
                </div>
            ');
            redirect('students');
        }
    }

    public function f_hapus($data_no_induk = '')
    {
        $no_induk = decrypt_url($data_no_induk);
        if ($no_induk == '' || $no_induk == null) {
            redirect('students');
        }

        $sql = $this->db->delete('siswa', ['no_induk' => $no_induk]);

        if ($sql) {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Siswa <strong>Berhasil Dihapus</strong>
                </div>
            ');
            redirect('students');
        } else {
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Siswa <strong>Gagal Dihapus</strong>
                </div>
            ');
            redirect('students');
        }
    }

    public function f_edit()
    {
        $no_induk = decrypt_url($this->input->post('no_induk'));
        $nama_siswa = $this->input->post('nama_siswa');
        $jurusan = $this->input->post('jurusan');
        $kelas = $this->input->post('kelas');

        $this->db->set('nama_siswa', $nama_siswa);
        $this->db->set('jurusan', $jurusan);
        $this->db->set('kelas', $kelas);
        $this->db->where('no_induk', $no_induk);
        $this->db->update('siswa');

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data Siswa <strong>Berhasil Di Upadte</strong>
                </div>
            ');
        redirect('students');
    }
}
