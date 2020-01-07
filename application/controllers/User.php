<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
    	parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    	//Do your magic here
    }

    public function index()
    {

    }

    public function absen($id)
    {
        $id = $this->uri->segment(3);
        $section = $this->uri->segment(4);
        if (!$this->datamodel->selectWhere('absensi', array('id' => $id)) || empty($section)) {
            redirect('absensi');
        } else {
            $get = $this->datamodel->selectWhere('absensi', array('id' => $id));
            if (strtotime($get->tanggal) == strtotime(date("Y-m-d")) && (strtotime($get->berakhir) > strtotime(date("H:i:s")) || strtotime($get->mulai) < strtotime(date("H:i:s")))) {
                $data['absen'] = $get;
                $this->load->view('front_absen', $data);
            } else {
                $data['absen'] = $get;
                $this->load->view('index', $data);
            }
        }
    }

}

/* End of file User.php */