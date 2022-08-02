<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
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
            'dashboard' => '<script src="' .  base_url('assets/app-assets/e-library/') . 'js/dashboard.js"></script>',
            'datatables' => '',
            'select2_js' => '',
            'select2_css' => '',
        ];
        $data['menu'] = [
            'dashboard' => 'active',
            'master_data' => '',
            'settings' => '',
            'transaksi' => '',
        ];
        $data['setting'] = $this->db->get('setting')->row();
        $data['admin'] = $this->db->get('admin')->row();
        $data['buku'] = $this->db->get('buku')->result();
        $data['siswa'] = $this->db->get('siswa')->result();
        $data['peminjaman'] = $this->db->get('peminjaman')->result();
        $data['pengembalian'] = $this->db->get('pengembalian')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajax_buku()
    {
        if ($this->input->is_ajax_request()) {

            $this->db->select('*');
            $this->db->from('buku');
            $this->db->join('kategori', 'kategori.id_kategori = buku.kategori_buku');
            $this->db->join('genre', 'genre.id_genre = buku.genre_buku');
            $this->db->where('buku.kode_buku', $this->input->post('barcode'));
            $buku = $this->db->get()->row();
            if ($buku != null) {
                $html = '';
                $html .= '<div class="text-center mt-2"><img src="' . base_url('assets/app-assets/buku/') . $buku->sampul_buku . '" alt="" style="width: 250px; height: 250px;"></div>';
                $html .= '
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Genre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>' . $buku->kode_buku . '</td>
                                <td>' . $buku->judul_buku . '</td>
                                <td>' . $buku->nama_kategori . '</td>
                                <td>' . $buku->nama_genre . '</td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $html .= '
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>' . $buku->penulis . '</td>
                                <td>' . $buku->penerbit . '</td>
                                <td>' . $buku->stok . '</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                echo $html;
            } else {
                $html = '
                    <div class="alert alert-danger mt-3" role="alert">
                        Data Buku <strong>Tidak Ditemukan</strong>
                    </div>
                ';

                echo $html;
            }
        }
    }

    public function ajax_peminjaman()
    {
        if ($this->input->is_ajax_request()) {
            $kode_peminjaman = $this->input->post('barcode');

            $this->db->select('*');
            $this->db->from('peminjaman');
            $this->db->join('siswa', 'siswa.no_induk = peminjaman.siswa');
            $this->db->join('denda', 'denda.id_denda = peminjaman.jenis_denda_harian');
            $this->db->where('peminjaman.kode_peminjaman', $kode_peminjaman);
            $peminjaman = $this->db->get()->row();

            $this->db->select('*');
            $this->db->from('detail_peminjaman');
            $this->db->join('buku', 'buku.kode_buku = detail_peminjaman.kode_buku');
            $this->db->where('detail_peminjaman.kode_peminjaman', $kode_peminjaman);
            $detail_peminjamam = $this->db->get()->result();

            if ($peminjaman != null) {
                $waktu_sekarang = date('d-M-Y', time());
                $awal  = date_create($waktu_sekarang);
                $akhir = date_create($peminjaman->tgl_kembali); // waktu sekarang
                $diff  = date_diff($awal, $akhir);

                if ($awal >= $akhir) {
                    // echo "Sudah Lewat " . $diff->days . " Hari Sejak tanggal Peminjaman";
                    $denda = [
                        'lewat_batas' => 1,
                        'hari' => $diff->days,
                    ];
                } else {
                    // echo "Masih Tersiswa " . $diff->days . " Hari Sebelum terkena denda";
                    $denda = [
                        'lewat_batas' => 0,
                        'hari' => $diff->days,
                    ];
                }

                $html = '
                <div class="table-responsive mt-3">
                    <table class="table">
                        <tr>
                            <th>Peminjam</th>
                            <td class="text-left">: ' .  $peminjaman->nama_siswa . '</td>
                        </tr>
                        <tr>
                            <th>Tgl Peminjaman</th>
                            <td class="text-left">:  ' . $peminjaman->tgl_peminjaman . '</td>
                        </tr>
                        <tr>
                            <th>Lama Peminjaman</th>
                            <td class="text-left">:  ' . $peminjaman->lama_peminjaman . ' Hari</td>
                        </tr>
                        <tr>
                            <th>Batas Pengembalian</th>
                            <td class="text-left">:  ' . $peminjaman->tgl_kembali . '</td>
                        </tr>
                        <tr>
                            <th>Status Peminjaman</th>
                            <td class="text-left">: ';

                if ($peminjaman->status == 0) {
                    $html .= '<span class="badge badge-primary">Belum Dikembalikan</span>';
                } else {
                    $html .= '<span class="badge badge-success">DiKembalikan</span>';
                }
                $html .= '
                </td>
                </tr>';

                $html .= '
                <tr>
                    <th>Denda <sup class="text-danger">*jika terlambat mengembalikan</sup></th>
                    <td class="text-left">: Rp. ' . number_format($peminjaman->jumlah_denda) . ' / Hari</td>
                </tr>
                ';
                $html .= '
                <tr>
                <td colspan="2" class="text-primary text-wrap">
                ';
                if ($denda['lewat_batas'] == 0 && $peminjaman->status == 0) {
                    $html .= '
                    <span class="text-primary">
                        *Masih tersisa <strong> ' . $denda['hari'] . '</strong> Hari untuk mengembalikan buku sebelum mendapatkan Denda
                    </span>
                ';
                }

                if ($denda['lewat_batas'] == 1 && $peminjaman->status == 0) {
                    $html .= '
                    <span class="text-danger">
                        *Anda Terlambat <strong> ' . $denda['hari'] . '</strong> Hari, Total Denda = Rp.  ' . number_format($peminjaman->jumlah_denda * $denda['hari']) . '
                    </span>
                ';
                }

                $html .= '
                        </td>
                        </tr>
                        </table>
                    </div>
                ';


                $html .= '
                    <div class="table-responsive">
                        <table class="table table-bordered">
                ';
                foreach ($detail_peminjamam as $dp) {
                    $html .= '<tr>';
                    $html .= '<td class="text-center">';
                    $html .= '<img src="' . base_url('assets/app-assets/buku/') . '' . $dp->sampul_buku . '" alt="" style="width: 80px; height: 80px;">';
                    $html .= '</td>';
                    $html .= '<td>' . $dp->judul_buku . '</td>';
                    $html .= '<td>' . $dp->jumlah . ' Buku</td>';
                    $html .= '</tr>';
                }
                $html .= '
                        </table>
                    </div>
                ';

                echo $html;
            } else {
                $html = '
                    <div class="alert alert-danger mt-3" role="alert">
                        Data Peminjam <strong>Tidak Ditemukan</strong>
                    </div>
                ';

                echo $html;
            }
        }
    }
}
