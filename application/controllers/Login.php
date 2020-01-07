<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    private $msg;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')) {
            redirect('home');
        }
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if (empty($username) || empty($password)) {
            $this->msg = array(
                'status' => 200,
                'error' => true,
                'message' => 'Empty NIM or Password'
            );
        } else {
            $check = file_get_contents('https://em.ub.ac.id/redirect/login/loginApps/?nim=' . $username . '&password=' . $password);
            $check = json_decode($check);
            if (!$check->status) {
                $this->msg = array(
                    'status' => 200,
                    'error' => true,
                    'message' => 'Login failed, wrong NIM or password'
                );
            } else {
                $data = array(
                    'NIM' => $check->nim,
                    'p.TAHUN'=> date("Y")
                );
                if ($do = $this->datamodel->login('PENGURUS_EM', $data)) {
                    $arr = array(
                        'logged' => true,
                        'id' => $do->ID_PENGURUS,
                        'session' => substr(sha1($check->nim), 0, 10),
                        'role' => $do->NAMA,
                        'singkatan'=>$do->SINGKAT,
                        'id_role' => $do->ID_KEMENTERIAN,
                        'nim' => $do->NIM,
                        'nama' => $do->NAMA_LENGKAP,
                        'tahun' => $do->TAHUN,
                        'access' => $do->ACCESS,
                        'foto' => $check->foto
                    );
                    $this->session->set_userdata($arr);
                    $this->msg = array(
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success, wait a minutes ...'
                    );
                } else {
                    $this->msg = array(
                        'status' => 500,
                        'error' => true,
                        'message' => 'failed to do'
                    );
                }
            }
        }
        echo json_encode($this->msg);
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */