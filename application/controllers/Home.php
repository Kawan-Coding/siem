<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged') || !$this->datamodel->logged($this->session->userdata('id'))) {
            redirect('logout');
        }
    }

    public function index()
    {
        $data['view'] = 'content/home';
        $this->load->view('template', $data);
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */