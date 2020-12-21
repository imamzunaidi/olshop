<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('m_admin');
    $this->load->model('m_kategori');
    $this->load->model('m_pesanan_masuk');
  }

    
  public function index(){
      $data = array(
          'title' => 'Dashboard',
          'total_barang' => $this->m_admin->total_barang(),
          'total_kategori' => $this->m_admin->total_kategori(),
          'isi' => 'v_admin'
      );
      $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  public function setting(){

    $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required', array(
      'required' => 'Nama Toko Wajib Diisi !!'
    ));
    $this->form_validation->set_rules('kota', 'Kota', 'required', array(
      'required' => 'Kota Wajib Diisi !!'
    ));
    $this->form_validation->set_rules('alamat', 'Alamat', 'required', array(
      'required' => 'Alamat Toko Wajib Diisi !!'
    ));
    $this->form_validation->set_rules('no_telpon', 'No Telepon', 'required', array(
      'required' => 'No_telefon Wajib Diisi !!'
    ));

    if($this->form_validation->run() == FALSE){
      $data = array(
        'title' => 'Setting',
        'setting' => $this->m_admin->data_setting(),
        'isi' => 'v_setting'
      );
      $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }else{
      $data = array(
        'id' => 1,
        'lokasi' => $this->input->post('kota'),
        'nama_toko' => $this->input->post('nama_toko'),
        'alamat_toko' => $this->input->post('alamat'),
        'no_telpon' => $this->input->post('no_telpon')
      );
      $this->m_admin->edit($data);
      $this->session->set_flashdata('pesan','Settingan berhasil diganti !!');

      redirect('admin/setting');
    }
  }
  public function pesanan_masuk(){
    $data = array(
        'title' => 'Pesanan Masuk',
        'pesanan' => $this->m_pesanan_masuk->pesanan(),
        'pesanan_diproses' => $this->m_pesanan_masuk->pesanan_diproses(),
        'pesanan_dikirim' => $this->m_pesanan_masuk->pesanan_dikirim(),
        'pesanan_selesai' => $this->m_pesanan_masuk->pesanan_selesai(),
        'isi' => 'v_pesanan_masuk'
    );
    $this->load->view('layout/v_wrapper_backend', $data, FALSE);
  }

  public function proses($id_transaksi){
    $data = array(
      'id_transaksi' => $id_transaksi,
      'status_order' => '1'
    );

    $this->m_pesanan_masuk->update_order($data);
    $this->session->set_flashdata('pesan','Pesanan Sudah berhasil di proses dan siap untuk dikemas !!');
    redirect('admin/pesanan_masuk');
    
  }

  public function kirim($id_transaksi){
    $data = array(
      'id_transaksi' => $id_transaksi,
      'no_resi' => $this->input->post('no_resi'),
      'status_order' => '2'
    );

    $this->m_pesanan_masuk->update_order($data);
    $this->session->set_flashdata('pesan','Pesanan Sudah berhasil di kirim !!');
    redirect('admin/pesanan_masuk');
    
  }
}

?>