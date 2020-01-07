<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjam extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if (!$this->session->userdata('logged') || !$this->datamodel->logged($this->session->userdata('id'))) {
            redirect('logout');
        }
    }

    public function index()
    {
        $data['barang'] = $this->datamodel->getRow('barang');
        $data['pinjaman'] = $this->datamodel->getRow('peminjaman');
        $data['informasi'] = $this->datamodel->getRow('informasi');
        $data['view'] = 'content/home';
        $this->load->view('template', $data);
    }
}

/* End of file Controllername.php */