<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller
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
        $data['view'] = 'content/informasi';
        $this->load->view('template', $data);
    }

    public function autoload()
    {
        $data = $this->datamodel->selectAll('informasi');
        if (!empty($data)) {
            $res = array();
            $i = 1;
            foreach ($data as $key) {
                $temp = array(
                    'no' => $i,
                    'category' => $key->category,
                    'title' => $key->title,
                    'action' => '<a href="' . $key->url . '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-globe"></i></a>
                        <a href="' . $key->gambar . '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-image"></i></a>
                        <button class="btn btn-warning btn-xs" onclick="ubah(' . $key->id . ')"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-xs" onclick="hapus(' . $key->id . ')"><i class="fa fa-times"></i></button>'
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
            $do = $this->datamodel->deleteWhere('informasi', array('id' => $id));
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
        $judul = $this->input->post('nama');
        $url = $this->input->post('url_wordpress');
        $gambar = $this->input->post('url_gambar');
        $cat = $this->input->post('kategori');
        if (empty($id) || empty($judul) || empty($url) || empty($gambar) || empty($cat)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $data = array(
                'id' => '',
                'id_user' => $id,
                'category' => $cat,
                'title' => $judul,
                'gambar' => $gambar,
                'url' => $url
            );
            $do = $this->datamodel->insertTo('informasi', $data);
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
            $do = $this->datamodel->selectWhere('informasi', array('id' => $id));
            if ($do !== false) {
                $data = array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'success',
                    'data' => array(
                        'nama' => $do->title,
                        'url' => $do->url,
                        'gambar' => $do->gambar,
                        'kategori' => $do->category
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
        $id = $this->input->post('id');
        $judul = $this->input->post('nama');
        $url = $this->input->post('url_wordpress');
        $gambar = $this->input->post('url_gambar');
        $cat = $this->input->post('kategori');
        if (empty($id) || empty($judul) || empty($url) || empty($gambar) || empty($cat)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $data = array(
                'title' => $judul,
                'gambar' => $gambar,
                'url' => $url,
                'category' => $cat
            );
            $do = $this->datamodel->updateWheres(array('id' => $id), 'informasi', $data);
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

/* End of file Informasi.php */