<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index($i)
    {
        $get = file_get_contents(base_url("API/get_staf/$i"));
        $data = json_decode($get);
        if(!$data->error){
            $nim=$data->data->NIM;
            if(substr($nim,0,2)<19) {               
                $data->data->FOTO="http://siakad.ub.ac.id/siam/biodata.fotobynim.php?nim=$nim&key=MzIxZm90b3V5ZTEyMysyMDE5LTEyLTEwIDE5OjA2OjA5";
            }else{
                $data->data->FOTO="https://em.ub.ac.id/apps/img/logo2.png";
            }
        }
        // header('Content-Type: application/json');
        // echo json_encode($data);
        if($data->error){
            redirect('https://em.ub.ac.id/siem/member/20190618');
        }
        $this->load->view('sertif', array('data' => $data));
    }

    public function getName($i)
    {
        $data=$this->datamodel->selectAll('PENGURUS_EM');
        echo json_encode($data);
    }
}

/* End of file Absensi.php */
