<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsumen extends CI_Controller
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
        $data['title'] = "Konsumen";
        $data['konsumen'] = $this->admin->get('konsumen');
        $this->template->load('templates/dashboard', 'konsumen/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_konsumen', 'Nama Konsumen', 'required|trim');
        $this->form_validation->set_rules('alamat_konsumen', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_tlp', 'Nomor Telepon', 'required|trim|numeric');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "konsumen";
              // Mengenerate ID Konsumen
            $kode_terakhir = $this->admin->getMax('konsumen', 'id_konsumen');
            $kode_tambah = substr($kode_terakhir, -2, 2);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 2, '0', STR_PAD_LEFT);
            $data['id_konsumen'] = 'K' . $number;
            $this->template->load('templates/dashboard', 'konsumen/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('konsumen', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('konsumen');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('konsumen/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "konsumen";
            $data['konsumen'] = $this->admin->get('konsumen', ['id_konsumen' => $id]);
            $this->template->load('templates/dashboard', 'konsumen/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('konsumen', 'id_konsumen', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('konsumen');
            } else {
                set_pesan('data gagal diedit.');
                redirect('konsumen/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('konsumen', 'id_konsumen', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('konsumen');
    }
}
