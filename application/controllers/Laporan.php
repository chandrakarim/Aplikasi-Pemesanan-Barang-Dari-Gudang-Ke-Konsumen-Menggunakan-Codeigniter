<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('transaksi', 'Transaksi', 'required|in_list[barang_masuk,barang_keluar]');
        $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');

        $tsk = $this->input->post('transaksi');
 
        if ($tsk == "barang_keluar"){
            $this->form_validation->set_rules('konsumen_id', 'Konsumen', 'required');

            $input = $this->input->post('konsumen_id', true);
            $konsumen = $this->admin->get('konsumen', ['id_konsumen' => $input]);
            $konsumen_valid = $konsumen ;
    
            $this->form_validation->set_rules(
                'konsumen_id',
                'Konsumen',
                "required",
            );
    
        }




        if ($this->form_validation->run() == false) {
            $data['title'] = "Laporan Transaksi";
            $data['konsumen'] = $this->admin->get('konsumen');
            $this->template->load('templates/dashboard', 'laporan/form', $data);
        } else {
            
            $input = $this->input->post(null, true);
            $table = $input['transaksi'];
            $tanggal = $input['tanggal'];

            if ($table == "barang_keluar"){
                $konsumen_id = $input['konsumen_id'];
            }

            $pecah = explode(' - ', $tanggal);
            $mulai = date('Y-m-d', strtotime($pecah[0]));
            $akhir = date('Y-m-d', strtotime(end($pecah)));

            $query = '';
            if ($table == 'barang_masuk') {
                $query = $this->admin->getBarangMasuk(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } else {
                
                $query = $this->admin->getBarangKeluar(null, null, ['mulai' => $mulai, 'akhir' => $akhir],  $konsumen_id);
            }
           
            $this->_cetak($query, $table, $tanggal);
        }
    }

    private function _cetak($data, $table_, $tanggal)
    {
       
        $this->load->library('CustomPDF');
        $table = $table_ == 'barang_masuk' ? 'Barang Masuk' : 'Barang Keluar';
        $pdf = new FPDF();
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(190, 7, 'Laporan ' . $table, 0, 1, 'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(190, 6, 'Skripsi Aplikasi Pemesanan Barang  Dari Gudang Ke Konsumen Menggunakan Framework (Codeigneiter & Bootstrap) ' , 0, 1, 'C');
        $pdf->Cell(190, 6, 'Nama : Yakob Abner Ngutra Nim : 125410196', 0, 1, 'C');
        $pdf->Cell(190, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);

        if ($table_ == 'barang_masuk') :
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Tgl Masuk', 1, 0, 'C');
            $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(55, 7, 'Nama Barang', 1, 0, 'C');
            $pdf->Cell(40, 7, 'Nama Gudang', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Jumlah Masuk', 1, 0, 'C');
            $pdf->Ln();


            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, $d['tanggal_masuk'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['id_barang_masuk'], 1, 0, 'C');
                $pdf->Cell(55, 7, $d['nama_barang'], 1, 0, 'L');
                $pdf->Cell(40, 7, $d['nama_gudang'], 1, 0, 'L');
                $pdf->Cell(30, 7, $d['jumlah_masuk'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Ln();
            } else :
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Tgl Keluar', 1, 0, 'C');
            $pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Nama Konsumen', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Nama Barang', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Jumlah Keluar', 1, 0, 'C');
            $pdf->Cell(20, 7, 'Harga', 1, 0, 'C');
            $pdf->Cell(20, 7, 'Total Harga', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            $total = $hasil = 0;

            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(25, 7, $d['tanggal_keluar'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['id_barang_keluar'], 1, 0, 'C');
                $pdf->Cell(30, 7, $d['nama_konsumen'], 1, 0, 'L');
                $pdf->Cell(30, 7, $d['nama_barang'], 1, 0, 'L');
                $pdf->Cell(25, 7, $d['jumlah_keluar'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
                $pdf->Cell(20, 7, $d['harga'], 1, 0, 'C');
 
                $hasil = $d['jumlah_keluar'] * $d['harga'];
                $total = $hasil + $total;
                $pdf->Cell(20, 7, $hasil, 1, 0, 'C');
                $pdf->Ln();

            }

            $pdf->Cell(155, 7, '', 0, 0, 'R');
            $pdf->Cell(20, 7, 'Total Harga', 1, 0, 'C');
            $pdf->Cell(20, 7,  $total, 1, 1, 'C');
           
        endif;
        

        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }
}
