<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangkeluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }
    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('konsumen_id', 'Konsumen', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
       

        $input = $this->input->post('barang_id', true);
        $stok = $this->admin->get('barang', ['stok','id_barang' => $input]);
        $stok_valid = $stok ;

        $this->form_validation->set_rules(
            'jumlah_keluar',
            'Jumlah Keluar',
            "required|trim|numeric|greater_than[0]|less_than[{$stok_valid}]",
            [
                'less_than' => "Jumlah Keluar tidak boleh lebih dari {$stok}"
            ]
        );
    }


    public function index()
    {
        $result =  array();
         $barangs = $this->admin->getBarangkeluar();
        foreach ($barangs as $barang){
            $harga = $barang['harga'];
           
            $jumlah_keluar = $barang['jumlah_keluar'];
            $kalkulasi = $harga * $jumlah_keluar;
        
            $harga_barang=["total_harga"=> $kalkulasi];
           
            $result[] = array_merge($harga_barang, $barang); 
            //continue;
        }
    

       $data['title'] = "Barang Keluar";
       $data['barangkeluar'] = $this->admin->getBarangkeluar();
    $data['barangkeluar'] = $result;

       // dd($data);
        $this->template->load('templates/dashboard', 'barang_keluar/data', $data);
    }


 public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Keluar";
            $data['barang'] = $this->admin->get('barang', null, ['stok >' => 0]);
            $data['konsumen'] = $this->admin->get('konsumen');
           

            // Mendapatkan dan men-generate kode transaksi barang keluar
            $kode = 'T-BK-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('barang_keluar', 'id_barang_keluar', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_barang_keluar'] = $kode . $number;

            $this->template->load('templates/dashboard', 'barang_keluar/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('barang_keluar', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('barangkeluar');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('barangkeluar/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_keluar', 'id_barang_keluar', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barangkeluar');
    }
}
