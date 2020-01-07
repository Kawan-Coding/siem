<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller
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
        $data['view'] = 'content/link';
        $this->load->view('template', $data);
    }

    public function autoload()
    {
        $data = $this->datamodel->selectAll('L_LINK');
        if (!empty($data)) {
            $res = array();
            $i = 1;
            foreach ($data as $key) {
                $temp = array(
                    'no' => $i,
                    'url' => substr($key->url, 0, 120),
                    'redirect' => $key->redirect,
                    'visit' => $key->visited,
                    'action' => '<a href="' . $key->url . '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-link"></i></a>'
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

/* End of file Controllername.php */