<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends CI_Controller {

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
        $data['view'] = 'content/ads';
        $this->load->view('template', $data);
    }

    public function autoload()
    {
        $data = $this->datamodel->selectAll('L_ADS');
        if (!empty($data)) {
            $res = array();
            $i = 1;
            foreach ($data as $key) {
                $temp = array(
                    'no' => $i,
                    'pemilik' => $key->PEMILIK,
                    'view' => $key->VIEW,
                    'target' => $key->TARGET,
                    'action' => '<a href="' . $key->POSTER . '.jpg" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-image"></i></a>
                        <button class="btn btn-warning btn-xs" onclick="ubah(' . $key->ID_ADS . ')"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btn-xs" onclick="hapus(' . $key->ID_ADS . ')"><i class="fa fa-times"></i></button>'
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
            $do = $this->datamodel->deleteWhere('L_ADS', array('ID_ADS' => $id));
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
        $pemilik = $this->input->post('nama');
        $gambar = $this->input->post('url_gambar');
        $target = $this->input->post('target');
        if (empty($id) || empty($pemilik) || empty($gambar) || empty($target)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $data = array(
                'ID_ADS' => '',
                'PEMILIK' => $pemilik,
                'POSTER' => $gambar,
                'VIEW' => 0,
                'TARGET' => $target,
            );
            $do = $this->datamodel->insertTo('L_ADS', $data);
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
            $do = $this->datamodel->selectWhere('L_ADS', array('ID_ADS' => $id));
            if ($do !== false) {
                $data = array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'success',
                    'data' => array(
                        'nama' => $do->PEMILIK,
                        'url' => $do->POSTER,
                        'target' => $do->TARGET
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
        $pemilik = $this->input->post('nama');
        $gambar = $this->input->post('url_gambar');
        $target = $this->input->post('target');
        if (empty($id) || empty($pemilik) || empty($gambar) || empty($target)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $data = array(
                'pemilik' => $pemilik,
                'poster' => $gambar,
                'target' => $target
            );
            $do = $this->datamodel->updateWheres(array('ID_ADS' => $id), 'L_ADS', $data);
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

/* End of file Ads.php */