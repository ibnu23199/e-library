<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        date_default_timezone_set('Asia/Jakarta');
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
            'master_data' => '',
            'settings' => '',
            'transaksi' => 'active',
        ];
        $data['setting'] = $this->db->get('setting')->row();
        $data['admin'] = $this->db->get('admin')->row();
        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('denda', 'denda.id_denda = peminjaman.jenis_denda_harian');
        $this->db->join('siswa', 'siswa.no_induk = peminjaman.siswa');
        $data['peminjaman'] = $this->db->get()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/peminjaman/peminjaman');
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
            'master_data' => '',
            'settings' => '',
            'transaksi' => 'active',
        ];
        $data['setting'] = $this->db->get('setting')->row();
        $data['admin'] = $this->db->get('admin')->row();

        $data['siswa'] = $this->db->get('siswa')->result();
        $data['kategori'] = $this->db->get('kategori')->result();
        $data['genre'] = $this->db->get('genre')->result();
        $data['denda'] = $this->db->get_where('denda', ['jumlah_denda !=' => null])->result();

        $this->db->select('*');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.kategori_buku');
        $this->db->join('genre', 'genre.id_genre = buku.genre_buku');
        $data['buku'] = $this->db->get()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/peminjaman/tambah-peminjaman', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajax_buku()
    {
        if ($this->input->is_ajax_request()) {
            $buku = $this->db->get_where('buku', ['kode_buku' => $this->input->post('barcode')])->row();
            echo json_encode($buku);
        }
    }

    public function f_tambah()
    {
        $kode_peminjaman = "P-" . random_string('numeric', 10);
        $tgl_peminjaman = date('Y-m-d', time());
        $lama_pinjam = $this->input->post('lama_peminjaman');
        $tgl_kembali = date('Y-m-d', strtotime("+$lama_pinjam day", strtotime("$tgl_peminjaman")));


        $peminjaman = [
            'kode_peminjaman' => $kode_peminjaman,
            'siswa' => $this->input->post('siswa'),
            'tgl_peminjaman' => $tgl_peminjaman,
            'lama_peminjaman' => $lama_pinjam,
            'tgl_kembali' => $tgl_kembali,
            'jenis_denda_harian' => $this->input->post('denda'),
            'status' => 0
        ];

        $detail_peminjaman = [];
        $i = 0;
        $kode_buku = $this->input->post('kode_buku');

        foreach ($kode_buku as $buku) {

            $book = $this->db->get_where('buku', ['kode_buku' => $buku])->row();
            $stok_buku = ($book->stok - $this->input->post('jumlah_buku')[$i]);

            array_push($detail_peminjaman, [
                'kode_peminjaman' => $kode_peminjaman,
                'kode_buku' => $buku,
                'jumlah' => $this->input->post('jumlah_buku')[$i],
            ]);
            $i++;

            $this->db->set('stok', $stok_buku);
            $this->db->where('kode_buku', $buku);
            $this->db->update('buku');
        }

        $this->db->insert('peminjaman', $peminjaman);
        $this->db->insert_batch('detail_peminjaman', $detail_peminjaman);

        $this->session->set_flashdata("pesan", '
                <div class="alert alert-success mt-3" role="alert">
                    Data Peminjaman <strong>Berhasil Di Tambah</strong>
                </div>
            ');
        redirect('peminjaman');
    }

    public function detail($data_kode_peminjaman = '')
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
            'settings' => '',
            'transaksi' => 'active',
        ];
        $data['setting'] = $this->db->get('setting')->row();
        $data['admin'] = $this->db->get('admin')->row();
        $kode_peminjaman = decrypt_url($data_kode_peminjaman);

        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('siswa', 'siswa.no_induk = peminjaman.siswa');
        $this->db->join('denda', 'denda.id_denda = peminjaman.jenis_denda_harian');
        $this->db->where('peminjaman.kode_peminjaman', $kode_peminjaman);
        $data['peminjaman'] = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('detail_peminjaman');
        $this->db->join('buku', 'buku.kode_buku = detail_peminjaman.kode_buku');
        $this->db->where('detail_peminjaman.kode_peminjaman', $kode_peminjaman);
        $data['detail_peminjaman'] = $this->db->get()->result();

        $waktu_sekarang = date('d-M-Y', time());
        $awal  = date_create($waktu_sekarang);
        $akhir = date_create($data['peminjaman']->tgl_kembali); // waktu sekarang
        $diff  = date_diff($awal, $akhir);

        if ($awal >= $akhir) {
            // echo "Sudah Lewat " . $diff->days . " Hari Sejak tanggal Peminjaman";
            $data['denda'] = [
                'lewat_batas' => 1,
                'hari' => $diff->days,
            ];
        } else {
            // echo "Masih Tersiswa " . $diff->days . " Hari Sebelum terkena denda";
            $data['denda'] = [
                'lewat_batas' => 0,
                'hari' => $diff->days,
            ];
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/peminjaman/detail-peminjaman', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit($data_kode_peminjaman = '')
    {
        $data['plugin'] = [
            'dashboard' => '',
            'datatables' => '',
            'select2_js' => '<script src="' .  base_url('assets/app-assets/e-library/') . 'vendors/select2/select2.min.js"></script>',
            'select2_css' => '<link rel="stylesheet" href="' .  base_url('assets/app-assets/e-library/') . 'vendors/select2/select2.min.css">',
        ];
        $data['menu'] = [
            'dashboard' => '',
            'master_data' => '',
            'settings' => '',
            'transaksi' => 'active',
        ];
        $data['setting'] = $this->db->get('setting')->row();
        $data['admin'] = $this->db->get('admin')->row();
        $kode_peminjaman = decrypt_url($data_kode_peminjaman);

        $data['siswa'] = $this->db->get('siswa')->result();
        $data['kategori'] = $this->db->get('kategori')->result();
        $data['genre'] = $this->db->get('genre')->result();
        $data['denda'] = $this->db->get_where('denda', ['jumlah_denda !=' => null])->result();

        $this->db->select('*');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.kategori_buku');
        $this->db->join('genre', 'genre.id_genre = buku.genre_buku');
        $data['buku'] = $this->db->get()->result();

        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('siswa', 'siswa.no_induk = peminjaman.siswa');
        $this->db->join('denda', 'denda.id_denda = peminjaman.jenis_denda_harian');
        $this->db->where('peminjaman.kode_peminjaman', $kode_peminjaman);
        $data['peminjaman'] = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('detail_peminjaman');
        $this->db->join('buku', 'buku.kode_buku = detail_peminjaman.kode_buku');
        $this->db->where('detail_peminjaman.kode_peminjaman', $kode_peminjaman);
        $data['detail_peminjaman'] = $this->db->get()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/peminjaman/edit-peminjaman', $data);
        $this->load->view('templates/footer', $data);
    }

    public function f_edit()
    {
        $tgl_peminjaman = $this->input->post('tgl_peminjaman');
        $lama_pinjam = $this->input->post('lama_peminjaman');
        $tgl_kembali = date('Y-m-d', strtotime("+$lama_pinjam day", strtotime("$tgl_peminjaman")));

        $kode_peminjaman = $this->input->post('kode_peminjaman');
        $detail_peminjaman = $this->db->get_where('detail_peminjaman', ['kode_peminjaman' => $kode_peminjaman])->result();

        foreach ($detail_peminjaman as $dp) {
            $buku = $this->db->get_where('buku', ['kode_buku' => $dp->kode_buku])->row();
            $stok_buku = ($buku->stok + $dp->jumlah);
            $this->db->set('stok', $stok_buku);
            $this->db->where('kode_buku', $buku->kode_buku);
            $this->db->update('buku');
        }
        $this->db->delete('detail_peminjaman', ['kode_peminjaman' => $kode_peminjaman]);

        $detail_peminjaman = [];
        $i = 0;
        $kode_buku = $this->input->post('kode_buku');

        foreach ($kode_buku as $buku) {
            $book = $this->db->get_where('buku', ['kode_buku' => $buku])->row();
            $stok_buku = ($book->stok - $this->input->post('jumlah_buku')[$i]);

            array_push($detail_peminjaman, [
                'kode_peminjaman' => $kode_peminjaman,
                'kode_buku' => $buku,
                'jumlah' => $this->input->post('jumlah_buku')[$i],
            ]);
            $i++;

            $this->db->set('stok', $stok_buku);
            $this->db->where('kode_buku', $buku);
            $this->db->update('buku');
        }
        $this->db->insert_batch('detail_peminjaman', $detail_peminjaman);
        $this->db->set('siswa', $this->input->post('siswa'));
        $this->db->set('tgl_peminjaman', $this->input->post('tgl_peminjaman'));
        $this->db->set('lama_peminjaman', $this->input->post('lama_peminjaman'));
        $this->db->set('tgl_kembali', $tgl_kembali);
        $this->db->set('jenis_denda_harian', $this->input->post('denda'));
        $this->db->where('kode_peminjaman', $kode_peminjaman);
        $this->db->update('peminjaman');

        $this->session->set_flashdata("pesan", '
                <div class="alert alert-success mt-3" role="alert">
                    Data Peminjaman <strong>Berhasil Di Upadte</strong>
                </div>
            ');
        redirect('peminjaman');
    }

    public function f_hapus($data_kode_peminjaman = '')
    {
        $kode_peminjaman = decrypt_url($data_kode_peminjaman);
        $detail_peminjaman = $this->db->get_where('detail_peminjaman', ['kode_peminjaman' => $kode_peminjaman])->result();

        foreach ($detail_peminjaman as $dp) {
            $buku = $this->db->get_where('buku', ['kode_buku' => $dp->kode_buku])->row();
            $stok_buku = ($buku->stok + $dp->jumlah);
            $this->db->set('stok', $stok_buku);
            $this->db->where('kode_buku', $buku->kode_buku);
            $this->db->update('buku');
        }

        $this->db->delete('peminjaman', ['kode_peminjaman' => $kode_peminjaman]);
        $this->db->delete('detail_peminjaman', ['kode_peminjaman' => $kode_peminjaman]);

        $this->session->set_flashdata("pesan", '
                <div class="alert alert-success mt-3" role="alert">
                    Data Peminjaman <strong>Berhasil Di Hapus</strong>
                </div>
            ');
        redirect('peminjaman');
    }

    public function barcode($data_kode_peminjaman = '')
    {
        $kode_peminjaman = decrypt_url($data_kode_peminjaman);

        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($kode_peminjaman, $generator::TYPE_CODE_128);
        $html = '';

        $this->db->select_sum('jumlah');
        $this->db->where('kode_peminjaman', $kode_peminjaman);
        $query = $this->db->get('detail_peminjaman')->row();


        for ($i = 1; $i <= $query->jumlah; $i++) {
            $html .= '<div style="width: 270px; margin-top: 5px; margin-left: 5px;">';
            $html .= '<div>';
            $html .= '<p>' . $barcode . ' </p>';
            $html .= '<p style="font-size: 16px; margin-top: -10px; margin-left: 70px;">' . $kode_peminjaman . ' </p>';
            $html .= '</div>';
            $html .= '</div>';
        }
        echo $html;
    }

    public function laporan()
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
            'settings' => '',
            'transaksi' => 'active',
        ];
        $data['setting'] = $this->db->get('setting')->row();
        $data['admin'] = $this->db->get('admin')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/peminjaman/laporan');
        $this->load->view('templates/footer', $data);
    }

    public function filter_laporan()
    {
        if ($this->input->is_ajax_request()) {
            $from = $this->input->post('from');
            $to = $this->input->post('to');

            $this->db->select('*');
            $this->db->from('peminjaman');
            $this->db->join('siswa', 'siswa.no_induk = peminjaman.siswa');
            $this->db->where("peminjaman.tgl_peminjaman >=", $from);
            $this->db->where("peminjaman.tgl_peminjaman <=", $to);
            $peminjaman = $this->db->get()->result();

            // $html = var_dump($peminjaman);
            // die;

            $html = '
                    <table cellpadding="5" style="border: none;">
                        <tr>
                            <th>Mulai Tanggal</th>
                            <td> : ' . $from . '</td>
                        </tr>
                        <tr>
                            <th>Sampai Tanggal</th>
                            <td> : ' . $to . '</td>
                        </tr>
                    </table>
                    <a href="' . base_url('peminjaman/print_peminjaman?datafrom=') . $from . '&datato=' . $to . '" class="btn btn-success mt-2" target="_blank"><i class="icon-printer"></i> Print Data</a>
                    <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Peminjaman</th>
                                <th>Nama</th>
                                <th>Tgl Pinjam</th>
                                <th>Lama Pinjam</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>';
            $no = 1;
            foreach ($peminjaman as $p) {
                $this->db->select_sum('jumlah');
                $this->db->where('kode_peminjaman', $p->kode_peminjaman);
                $query = $this->db->get('detail_peminjaman')->row();

                $html .= '<tr>';
                $html .= '<td>' . $no++ . '</td>';
                $html .= '<td>' . $p->kode_peminjaman . '</td>';
                $html .= '<td>' . $p->nama_siswa . '</td>';
                $html .= '<td>' . date('d-M-Y', strtotime($p->tgl_peminjaman)) . '</td>';
                $html .= '<td>' . $p->lama_peminjaman . ' Hari</td>';
                $html .= '<td>' . $query->jumlah . ' Buku</td>';
                $html .= '<td>';
                if ($p->status == 0) {
                    $html .= "Belum Selesai";
                } else {
                    $html .= "Selesai";
                }
                $html .= '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '<tfoot>';
            $html .= '<tr>';
            $html .= '<th colspan="6" class="text-left">Total';
            $html .= '</th>';
            $html .= '<th>';
            $html .= count($peminjaman) . ' Transaksi';
            $html .= '</th>';
            $html .= '</tr>';
            $html .= '</tfoot>';
            $html .= '</table>';
            $html .= '</div>';
            if (count($peminjaman) != 0) {
                echo $html;
            } else {
                echo '<div class="alert alert-danger">Data Tidak Ditemukan</div>';
            }
        } else {
            exit('No direct script access allowed');
        }
    }

    public function print_peminjaman()
    {
        if (empty($this->input->get('datafrom')) && empty($this->input->get('datato'))) {
            redirect('eror');
        } else {
            $from = $this->input->get('datafrom');
            $to = $this->input->get('datato');

            $data = [
                'from' => $from,
                'to' => $to
            ];

            $this->db->select('*');
            $this->db->from('peminjaman');
            $this->db->join('siswa', 'siswa.no_induk = peminjaman.siswa');
            $this->db->where("peminjaman.tgl_peminjaman >=", $from);
            $this->db->where("peminjaman.tgl_peminjaman <=", $to);
            $data['peminjaman'] = $this->db->get()->result();
            $data['setting'] = $this->db->get('setting')->row();

            $this->load->view('admin/peminjaman/print-laporan', $data);
        }
    }
}
