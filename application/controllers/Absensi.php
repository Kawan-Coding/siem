<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller
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
        $data['view'] = 'content/absensi';
        $this->load->view('template', $data, FALSE);
    }

    public function data($id)
    {
        $id = $this->uri->segment(3);
        $section = $this->uri->segment(4);
        if (!$this->datamodel->selectWhere('absensi', array('id' => $id)) || empty($section)) {
            redirect('absensi');
        } else {
            $data['data'] = $this->datamodel->selectWhere('absensi', array('id' => $id));
            $data['view'] = 'content/data_absensi';
            $this->load->view('template', $data, FALSE);
        }
    }

    public function autoload()
    {
        $data = $this->datamodel->selectAllWhere('absensi', array('ID_PENGURUS' => $this->session->userdata('id')));
        if ($data) {
            $res = array();
            $i = 1;
            foreach ($data as $key) {
                $temp = array(
                    'no' => $i,
                    'title' => '<a href="' . base_url('absensi/data/' . $key->id . '/' . substr(sha1($key->berakhir), 0, 10)) . '">' . $key->nama_absensi . '</a>',
                    'mulai' => $key->mulai,
                    'selesai' => $key->berakhir,
                    'tanggal' => $key->tanggal,
                    'action' => '<button class="btn btn-warning btn-xs" onclick="ubah(' . $key->id . ')"><i class="fa fa-pencil"></i></button>
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

    public function get($id)
    {
        $id = $this->uri->segment(3);
        if (empty($id)) {
            redirect('absensi');
        } else {
            $data = $this->datamodel->getAbsensi($id);
            if ($data) {
                $res = array();
                $i = 1;
                foreach ($data as $key) {
                    $temp = array(
                        'no' => $i,
                        'nim' => $key->NIM,
                        'nama' => $key->NAMA_LENGKAP,
                        'kementrian' => $key->NAMA,
                        'jam' => $key->waktu,
                        'status' => $key->status
                    );
                    array_push($res, $temp);
                    $i++;
                }
                echo json_encode(array('data' => $res));
            } else {
                echo json_encode(array('data' => $data));
            }
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
            $do = $this->datamodel->deleteWhere('absensi', array('id' => $id));
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
        $tahun = $this->session->userdata('tahun');
        $nama = $this->input->post('nama');
        $mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');
        $kategori = $this->input->post('kategori');
        $tanggal_p = $this->input->post('tanggal');
        if (empty($id) || empty($nama) || empty($mulai) || empty($selesai) || empty($tanggal_p)) {
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
                'ID_PENGURUS' => $id,
                // 'TAHUN' => $tahun,
                'nama_absensi' => $nama,
                'mulai' => $mulai,
                'berakhir' => $selesai,
                'tanggal' => $tanggal_p,
                'kategori' => $kategori
            );
            $do = $this->datamodel->insertTo('absensi', $data);
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
            $do = $this->datamodel->selectWhere('absensi', array('id' => $id));
            if ($do !== false) {
                $data = array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'success',
                    'data' => array(
                        'nama' => $do->nama_absensi,
                        'mulai' => $do->mulai,
                        'selesai' => $do->berakhir,
                        'kementrian' => $do->id_kementerian,
                        'tanggal' => $do->tanggal
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
        $nama = $this->input->post('nama');
        $mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');
        $kementrian = $this->input->post('kementrian');
        $tanggal_p = $this->input->post('tanggal');
        if (empty($id) || empty($nama) || empty($mulai) || empty($selesai) || empty($kementrian) || empty($tanggal_p)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $data = array(
                'nama_absensi' => $nama,
                'mulai' => $mulai,
                'berakhir' => $selesai,
                'id_kementerian' => $kementrian,
                'tanggal' => $tanggal_p
            );
            $do = $this->datamodel->updateWheres(array('id' => $id), 'absensi', $data);
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

/* End of file Absensi.php */