<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') or exit('No direct script access allowed');

class API extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        header("Content-Type: application/json");
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get_staf($id_pengurus)
    {
        $get = $this->datamodel->getStaf(array('ID_PENGURUS' => $id_pengurus));
        if (!empty($get)) {
            $get=$get[0];
            $get->APRESIASI = json_decode($get->APRESIASI);
            $get->KESAN = json_decode($get->KESAN);
            echo json_encode(array(
                'status' => 200,
                'error' => false,
                'message' => 'success',
                'data' => $get
            ));
        } else {
            echo json_encode(array(
                'status' => 200,
                'error' => true,
                'message' => 'error bos'
            ));
        }
    }

    public function get_info()
    {
        $get = $this->datamodel->getInfo();
        echo json_encode(array(
            'status' => 200,
            'error' => false,
            'message' => 'success',
            'data' => $get
        ));
    }

    public function get_ads()
    {
        $get = $this->datamodel->selectRandAllLimit('ads', 2);
        echo json_encode(array(
            'status' => 200,
            'error' => false,
            'message' => 'success',
            'data' => $get
        ));
    }

    public function get_jual()
    {
        $get = $this->datamodel->selectAllWhere('barang', array('status_barang' => 'Jual'));
        if ($get) {
            echo json_encode(array(
                'status' => 200,
                'error' => false,
                'message' => 'success',
                'data' => $get
            ));
        } else {
            echo json_encode(array(
                'status' => 200,
                'error' => false,
                'message' => 'empty',
                'data' => array()
            ));
        }
    }

    public function get_pinjam()
    {
        $get = $this->datamodel->selectAllWhere('barang', array('status_barang' => 'Pinjam'));
        if ($get) {
            echo json_encode(array(
                'status' => 200,
                'error' => false,
                'message' => 'success',
                'data' => $get
            ));
        } else {
            echo json_encode(array(
                'status' => 200,
                'error' => false,
                'message' => 'empty',
                'data' => array()
            ));
        }
    }

    public function get_product_detail($id)
    {
        if (empty($id)) {
            echo json_encode(array(
                'status' => 200,
                'error' => true,
                'message' => 'empty',
                'data' => array()
            ));
        } else {
            $get = $this->datamodel->selectWhere('barang', array('id' => $id));
            if ($get) {
                echo json_encode(array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'success',
                    'data' => $get
                ));
            } else {
                echo json_encode(array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'empty',
                    'data' => array()
                ));
            }
        }
    }

    private function checknim($id)
    {
        $get = $this->datamodel->selectWhere('PENGURUS_EM', array('ID_PENGURUS' => $id));
        if($get!=null){
            return $get->NIM;
        }else{
            return $id;
        }
    }

    public function post_absen()
    {
        $id = $this->input->post('id_event');
        $ida = $this->checknim($this->input->post('id_anggota'));
        $nama = $this->input->post('nama_lengkap');
        if (empty($id) || empty($nama)) {
            echo json_encode(array(
                'status' => 200,
                'error' => true,
                'message' => 'Data Tidak Terkirim'
            ));
        } elseif (!$this->datamodel->loggedNIM($ida)) {
            echo json_encode(array(
                'status' => 200,
                'error' => true,
                'message' => 'Akun Tidak Ditemukan'
            ));
        } else {
            $check = $this->datamodel->getRowWhere('absensi_list', array('NIM' => $ida, 'id_absensi' => $id));
            if ($check > 1) {
                echo json_encode(array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'Telah Melakukan Absensi',
                ));
            } else if ($check == 0) {
                $profile = array(
                    'id' => '',
                    'id_absensi' => $id,
                    'nama_lengkap' => $nama,
                    'NIM' => $ida,
                    'waktu' => date("H:i"),
                    'status' => 'Masuk'

                );
                $this->datamodel->insertTo('absensi_list', $profile);
                echo json_encode(array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'success',
                ));
            } else {
                $row = $this->datamodel->selectWhere('absensi_list', array('NIM' => $ida, 'id_absensi' => $id));
                if (strtotime(date("H:i")) <= strtotime($row->waktu) + (60 * 30)) {
                    echo json_encode(array(
                        'status' => 200,
                        'error' => true,
                        'message' => 'Kamu Belum Lebih Dari 30 Menit Di Sekret',
                    ));
                } else {
                    $profile = array(
                        'id' => '',
                        'id_absensi' => $id,
                        'nama_lengkap' => $nama,
                        'NIM' => $ida,
                        'waktu' => date("H:i"),
                        'status' => 'Keluar'
                    );
                    $this->datamodel->insertTo('absensi_list', $profile);
                    echo json_encode(array(
                        'status' => 200,
                        'error' => false,
                        'message' => 'success',
                    ));
                }
            }
        }
    }

    public function get_sambat($id = FALSE)
    {
        if (!$id) {
            $temp = array();
            $data = $this->db->query('CALL BS_SAMBATAN()')->result();
            foreach ($data as $key) {
                $key->KOMENTAR = json_decode($key->KOMENTAR);
                array_push($temp, $key);
            }
            $result = array(
                'status' => 200,
                'error' => false,
                'message' => 'Success',
                'data' => $temp
            );
            echo json_encode($result);
        } else {
            // $data = $this->datamodel->selectWhere('BS_SAMBATAN', array('ID_SAMBATAN' => $id));
            // $new = $this->datamodel->selectAllWhere('BS_KOMENTAR', array('ID_SAMBATAN' => $data->ID_SAMBATAN));
            $data = $this->datamodel->getSambat(array('ID_SAMBATAN' => $id));
            if (empty($data)) {
                $result = array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'Data tidak ada'
                );
            } else {
                $data = $data[0];
                $result = array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success',
                    'data' => array(
                        'ID_SAMBATAN' => $data->ID_SAMBATAN,
                        'NIM' => $data->NIM,
                        'NAMA_LENGKAP'  => $data->NAMA_LENGKAP,
                        'JENIS_KELAMIN' => $data->JENIS_KELAMIN,
                        'RINGKASAN' => $data->RINGKASAN,
                        'R_KATEGORI' => $data->R_KATEGORI,
                        'KONTAK' => $data->KONTAK,
                        'STATUS' => $data->STATUS,
                        'PROGRES' => $data->PROGRES,
                        'FILE' => $data->FILE,
                        'R_TIMESTAMP' => $data->R_TIMESTAMP,
                        'KOMENTAR' => json_decode($data->KOMENTAR)
                    )
                );
            }
            echo json_encode($result);
        }
    }

    public function post_sambat()
    {
        $id = $this->input->post('nim');
        $komen = $this->input->post('komentar');
        $kategori = $this->input->post('kategori');
        $status = $this->input->post('status');
        $kontak = $this->input->post('kontak');
        if (empty($id) || empty($komen) || empty($kategori) || empty($status) || empty($kontak)) {
            echo json_encode(array(
                'status' => 200,
                'error' => true,
                'message' => 'No data!',
            ));
        } else {
            $check = $this->datamodel->getRowWhere('BS_SAMBATAN', array('NIM' => $id, 'DATE(R_TIMESTAMP)' => date('Y-m-d')));
            if ($check > 10) {
                echo json_encode(array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'Reach limit today!',
                ));
            } else {
                $data = array(
                    'ID_SAMBATAN'   => '',
                    'NIM'           => $id,
                    'RINGKASAN'     => $komen,
                    'R_KATEGORI'    => $kategori,
                    'STATUS'        => $status,
                    'KONTAK'        => $kontak,
                    'PROGRES'      => 'DIPELAJARI',
                    'file'          => '',
                    'R_TIMESTAMP'   => date("Y-m-d H:i:s")
                );
                $query = $this->datamodel->insertTo('BS_SAMBATAN', $data);
                if (!$query) {
                    echo json_encode(array(
                        'status' => 200,
                        'error' => true,
                        'message' => 'Internal server error!',
                    ));
                } else {
                    echo json_encode(array(
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success.',
                    ));
                }
            }
        }
    }

    public function post_komentar($id)
    {
        $nim = $this->input->post('nim');
        $komen = $this->input->post('komentar');
        $nama = $this->input->post('nama_mhs');
        if (empty($id) || empty($nim) || empty($komen)) {
            echo json_encode(array(
                'status' => 200,
                'error' => true,
                'message' => 'No data!',
            ));
        } else {
            $data = array(
                'ID_KOMENTAR' => '',
                'NIM'   => $nim,
                'ID_SAMBATAN' => $id,
                'NAMA_LENGKAP' => $nama,
                'BS_KOMENTAR' => $komen,
                'R_TIMESTAMP' => date('Y-m-d H:i:s')
            );
            $query = $this->datamodel->insertTo('BS_KOMENTAR', $data);
            if (!$query) {
                echo json_encode(array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'Internal server error!',
                ));
            } else {
                echo json_encode(array(
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success.',
                ));
            }
        }
    }

    public function post_transaksi($id)
    {
        $nim = $this->input->post('nim');
        $total = $this->input->post('total_beli');
        $jumlah = $this->input->post('jumlah_beli');
    }

    private function auth($nim, $password)
    {
        return json_decode(file_get_contents("https://em.ub.ac.id/redirect/login/loginApps/?nim=$nim&password=$password"));
    }
}

/* End of file API.php */
