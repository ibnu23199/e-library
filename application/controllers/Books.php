<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Books extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('form_validation');
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
        $data['buku'] = $this->db->get('buku')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/buku/data_buku', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah()
    {
        $data['plugin'] = [
            'dashboard' => '',
            'datatables' => '',
            'select2_js' => '<script src="' .  base_url('assets/app-assets/e-library/') . 'vendors/select2/select2.min.js"></script>',
            'select2_css' => '<link rel="stylesheet" href="' .  base_url('assets/app-assets/e-library/') . 'vendors/select2/select2.min.css">',
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
        $data['genre'] = $this->db->get('genre')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/buku/tambah-buku', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah_excel()
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
        $this->load->view('templates/header', $data);
        $this->load->view('admin/buku/tambah-buku-excel');
        $this->load->view('templates/footer', $data);
    }

    public function template_excel()
    {
        force_download('./assets/app-assets/file-excel/template.xlsx', NULL);
    }

    public function f_tambah()
    {
        // HITUNG JUMLAH DATA MASUK ( acuannya judul )
        $judul_buku = $this->input->post('judul');
        $data_buku = [];
        // BUAT DATA INDEX UNTUK PERULANGAN
        $i = 0;
        foreach ($judul_buku as $judul) {
            array_push($data_buku, [
                'kode_buku' => $this->input->post('kode_buku')[$i],
                'judul_buku' => $judul,
                'sampul_buku' => 'default.png',
                'kategori_buku' => $this->input->post('kategori')[$i],
                'genre_buku' => $this->input->post('genre')[$i],
                'penulis' => $this->input->post('penulis')[$i],
                'penerbit' => $this->input->post('penerbit')[$i],
                'stok' => $this->input->post('stok')[$i],
            ]);
            $i++;
        }

        $this->db->insert_batch('buku', $data_buku);
        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data <strong>Berhasil Disimpan</strong>
                </div>
            ');
        redirect('books');
    }

    public function f_tambah_excel()
    {
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size']     = '5048';
        $config['upload_path'] = './assets/app-assets/file-excel/';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_excel')) {
            $this->session->set_flashdata('pesan', '
                    <div class="alert alert-danger mt-3" role="alert">
                        File <strong>Gagal Di Upload</strong>, silahkan coba kembali
                    </div>
                ');
            redirect('books/tambah_excel');
        } else {
            $inputFileName = './assets/app-assets/file-excel/' . $this->upload->data('file_name');

            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);

            $sheet = $objPHPExcel->getSheet(0);
            $higestRow = $sheet->getHighestRow();
            $higestColumn = $sheet->getHighestColumn();

            $buku = array();
            for ($row = 2; $row <= $higestRow; $row++) {
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $higestColumn . $row, NULL, TRUE, FALSE);
                if ($rowData[0][0] != null) {
                    array_push($buku, array(
                        'kode_buku' => $rowData[0][0],
                        'judul_buku' => $rowData[0][1],
                        'sampul_buku' => 'default.png',
                        'kategori_buku' => $rowData[0][2],
                        'genre_buku' => $rowData[0][3],
                        'penulis' => $rowData[0][4],
                        'penerbit' => $rowData[0][5],
                        'stok' => $rowData[0][6],
                    ));
                }
            }

            $sql = $this->db->insert_batch('buku', $buku);
            if ($sql) {

                // Hapus file yg sudah di upload tadi
                unlink(FCPATH . 'assets/app-assets/file-excel/' . $this->upload->data('file_name'));

                $this->session->set_flashdata('pesan', '
                        <div class="alert alert-success mt-3" role="alert">
                            Data <strong>Berhasil Di Simpan</strong>
                        </div>
                    ');
                redirect('books');
            } else {
                $this->session->set_flashdata('pesan', '
                        <div class="alert alert-danger mt-3" role="alert">
                            Data <strong>Gagal Di Simpan</strong>, silahkan coba kembali
                        </div>
                    ');
                redirect('books/tambah_excel');
            }
        }
    }

    public function f_hapus($data_kode_buku = '')
    {
        $kode_buku = decrypt_url($data_kode_buku);
        $this->db->delete('buku', ['kode_buku' => $kode_buku]);
        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data <strong>Berhasil Di Hapus</strong>
                </div>
            ');
        redirect('books');
    }

    public function detail($data_kode_buku = '')
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
        $kode_buku = decrypt_url($data_kode_buku);

        $this->db->select('*');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.kategori_buku');
        $this->db->join('genre', 'genre.id_genre = buku.genre_buku');
        $this->db->where('buku.kode_buku', $kode_buku);
        $data['buku'] = $this->db->get()->row();

        $data['kategori'] = $this->db->get('kategori')->result();
        $data['genre'] = $this->db->get('genre')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/buku/detail_buku', $data);
        $this->load->view('templates/footer', $data);
    }

    public function f_edit()
    {
        $kode_buku = decrypt_url($this->input->post('kode_buku'));
        $buku = $this->db->get_where('buku', ['kode_buku' => $kode_buku])->row();

        if ($_FILES['sampul']['name']) {

            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '5048';
            $config['upload_path'] = './assets/app-assets/buku/';
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $this->db->set('sampul_buku', $this->upload->data('file_name'));
                $old_image = $buku->sampul_buku;
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/app-assets/buku/' . $old_image);
                }
            }
        }

        $this->db->set('judul_buku', $this->input->post('judul'));
        $this->db->set('kategori_buku', $this->input->post('kategori_buku'));
        $this->db->set('genre_buku', $this->input->post('genre_buku'));
        $this->db->set('penulis', $this->input->post('penulis'));
        $this->db->set('penerbit', $this->input->post('penerbit'));
        $this->db->set('stok', $this->input->post('stok'));
        $this->db->where('kode_buku', $kode_buku);
        $this->db->update('buku');

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success mt-3" role="alert">
                    Data <strong>Berhasil Di Edit</strong>
                </div>
            ');
        redirect('books/detail/' . encrypt_url($kode_buku));
    }
}
