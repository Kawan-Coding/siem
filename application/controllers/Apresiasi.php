<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apresiasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if (!$this->session->userdata('logged') || !$this->datamodel->logged($this->session->userdata('id'))) {
            redirect('logout');
        }
    }

    public function kementerian($i)
    {
        $data['view'] = 'content/apresiasi';
        $data['id_kementerian'] = $i;
        $this->load->view('template', $data, FALSE);
    }

    public function autoload($i)
    {
        $data = $this->datamodel->selectAllWhere('PENGURUS_EM', array('ID_KEMENTERIAN' => $i));
        if ($data) {
            $res = array();
            $i = 1;
            foreach ($data as $key) {
                $temp_id = "'" . $key->ID_PENGURUS . "'";
                $button = '<button class="btn btn-warning btn-xs" onclick="ubah(' . $temp_id . ')"><i class="fa fa-pencil"></i></button>';
                $button .= '<button class="btn btn-primary btn-xs" style="margin-left:10px"> <a href="' . base_url("member/$key->ID_PENGURUS") . '" target="_blank" style="color:white"><i class="fa fa-eye"></i></a>  </button>';
                if (!empty($key->APRESIASI) && $key->APRESIASI != '[]') {
                    $button .= '<button class="btn btn-success btn-xs" style="margin-left:10px"><i class="fa fa-star"></i></button>';
                }
                if (!empty($key->KESAN) && $key->KESAN != '[]') {
                    $button .= '<button class="btn btn-danger btn-xs" style="margin-left:10px"><i class="fa fa-comment "></i></button>';
                }
                $temp = array(
                    'no' => $i,
                    'nim' => $key->NIM,
                    'nama' => $key->NAMA_LENGKAP,
                    'fakultas' => $key->FAKULTAS,
                    'action' => $button
                );
                array_push($res, $temp);
                $i++;
            }
            echo json_encode(array('data' => $res));
        } else {
            echo json_encode(array('data' => $data));
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
            $do = $this->datamodel->getStaf(array('ID_PENGURUS' => $id));
            if ($do !== false) {
                $do = $do[0];
                $data = array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'success',
                    'data' => array(
                        'id_pengurus' => $do->ID_PENGURUS,
                        'nim' => $do->NIM,
                        'nama' => $do->NAMA_LENGKAP,
                        'fakultas' => $do->FAKULTAS,
                        'kementerian' => $do->KEMENTERIAN,
                        'apresiasi' => $do->APRESIASI,
                        'kesan' => $do->KESAN
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
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $fakultas = $this->input->post('fakultas');
        $apresiasi = $this->input->post('apresiasi');
        $star = $this->input->post('star');
        $nim_bph = $this->input->post('nim_bph');
        $bph = $this->input->post('bph');
        $kesan = $this->input->post('kesan');

        $data_kesan = array();
        $data_apresiasi = array();
        $data = array(
            "KESAN" => "",
            "APRESIASI" => ""
        );
        for ($i = 0; $i < count($nim_bph); $i++) {
            if (empty($nim_bph[$i]) | empty($bph[$i]) | empty($kesan[$i])) {
                // zonk
            } else {
                $temp = array(
                    'nim' => $nim_bph[$i],
                    'nama' => $bph[$i],
                    'kesan' => $kesan[$i],
                );
                array_push($data_kesan, $temp);
            }
            $data['KESAN'] = json_encode($data_kesan);
        }

        for ($i = 0; $i < count($apresiasi); $i++) {
            if (empty($apresiasi[$i])| empty($star[$i])) {
                // zonk
            } else {
                $rat=$star[$i];
                if($rat>5){
                    $rat=5;
                }
                $temp = array(
                    'apresiasi' => $apresiasi[$i],
                    'rating' => $rat,
                );
                array_push($data_apresiasi, $temp);
            }
            $data['APRESIASI'] = json_encode($data_apresiasi);
        }

        if (empty($id) || empty($nama) || empty($nim) || empty($fakultas)) {
            echo json_encode(
                array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'empty'
                )
            );
        } else {
            $where = array(
                'ID_PENGURUS' => $id,
                'NIM' => $nim,
                'NAMA_LENGKAP' => $nama,
                'FAKULTAS' => $fakultas
            );
            $do = $this->datamodel->updateWheres($where, 'PENGURUS_EM', $data);
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

    public function get_kementerian()
    {
        $where=array(
            'TAHUN'=>date("Y")
        );
        $data = $this->datamodel->selectAllWhere('EM_KEMENTERIAN',$where);
        echo json_encode(array('data' => $data));
    }
}

/* End of file Absensi.php */
