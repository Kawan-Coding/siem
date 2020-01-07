<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller
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
        $data['view'] = 'content/barang';
        $this->load->view('template', $data);
    }

    public function autoload()
    {
        $data = $this->datamodel->selectAll('S_BARANG');
        if (!empty($data)) {
            $res = array();
            $i = 1;
            foreach ($data as $key) {
                $temp = array(
                    'no' => $i,
                    'nama_barang' => $key->NAMA . ' <label class="label label-primary">'.$key->STATUS.'</label>',
                    'jenis_barang' => $key->JENIS,
                    'stok_barang' => $key->STOK,
                    'action' => '<button class="btn btn-info btn-xs" onclick="view(' . $key->ID_BARANG . ')"><i class="fa fa-eye"></i></button>
                    <button class="btn btn-warning btn-xs" onclick="ubah(' . $key->ID_BARANG . ')"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-xs" onclick="hapus(' . $key->ID_BARANG . ')"><i class="fa fa-times"></i></button>'
                );
                array_push($res, $temp);
                $i++;
            }
            echo json_encode(array('data' => $res));
        } else {
            echo json_encode(array('data' => $data));
        }
    }

    public function hapus()
    {
        $id = $this->input->post('id');
        if (empty($id)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $do = $this->datamodel->deleteWhere('S_BARANG', array('ID_BARANG' => $id));
            if ($do == true) {
                echo json_encode(
                    array(
                        'status' => 200,
                        'error' => false,
                        'message' => 'success'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'status' => 500,
                        'error' => true,
                        'message' => 'failed to do'
                    )
                );
            }
        }
    }

    public function tambah()
    {
        $id = $this->session->userdata('id');
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $status = $this->input->post('status');
        $gambar = $this->input->post('link');
        $kontak = $this->input->post('kontak');
        $jenis = $this->input->post('jenis');
        $keterangan = $this->input->post('keterangan');
        if (empty($id) || empty($nama) || empty($harga) || empty($stok) || empty($status) || empty($gambar)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $data = array(
                'ID_BARANG' => '',
                'ID_PENGURUS' => $id,
                'NAMA' => $nama,
                'HARGA' => $harga,
                'STOK' => $stok,
                'KETERANGAN' => $keterangan,
                'JENIS' => $jenis,
                'GAMBAR' => $gambar,
                'KONTAK' => $kontak,
                'STATUS' => $status,
            );
            $do = $this->datamodel->insertTo('S_BARANG', $data);
            if ($do !== false) {
                echo json_encode(
                    array(
                        'status' => 200,
                        'error' => false,
                        'message' => 'success'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'status' => 500,
                        'error' => true,
                        'message' => 'failed to do'
                    )
                );
            }
        }
    }

    public function getdata()
    {
        $id = $this->input->post('id');
        if (empty($id)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $do = $this->datamodel->selectWhere('S_BARANG', array('ID_BARANG' => $id));
            if ($do !== false) {
                $data = array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'success',
                    'data' => array(
                        'nama' => $do->NAMA,
                        'harga' => $do->HARGA,
                        'link' => $do->GAMBAR,
                        'stok' => $do->STOK,
                        'keterangan' => $do->KETERANGAN,
                        'status' => $do->STATUS,
                        'jenis' => $do->JENIS,
                        'kontak' => $do->KONTAK
                    )
                );
                echo json_encode($data);
            } else {
                echo json_encode(
                    array(
                        'status' => 500,
                        'error' => true,
                        'message' => 'failed to do'
                    )
                );
            }
        }
    }

    public function ubahdata()
    {
        $id = $this->input->post('id-barang');
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $status = $this->input->post('status');
        $jenis = $this->input->post('jenis');
        $gambar = $this->input->post('link');
        $kontak = $this->input->post('kontak');
        $keterangan = $this->input->post('keterangan');
        if (empty($id) || empty($nama) || empty($harga) || empty($stok) || empty($status) || empty($gambar) || empty($jenis) || empty($kontak)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $data = array(
                'NAMA' => $nama,
                'HARGA' => $harga,
                'STOK' => $stok,
                'GAMBAR' => $gambar,
                'JENIS' => $jenis,
                'KETERANGAN' => $keterangan,
                'STATUS' => $status,
                'KONTAK' => $kontak
            );
            $do = $this->datamodel->updateWheres(array('ID_BARANG' => $id), 'S_BARANG', $data);
            if ($do == true) {
                echo json_encode(
                    array(
                        'status' => 200,
                        'error' => false,
                        'message' => 'success'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'status' => 500,
                        'error' => true,
                        'message' => 'failed to do'
                    )
                );
            }
        }
    }
}

/* End of file Sarana.php */
/* Location: ./application/controllers/Sarana.php */