<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Awarding extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('parsing');
    }

    // public function nominasi()
    // {
    //     $kategori= $this->input->post('kategori');
    //     $list_kategori=array(
    //         "dpm","bem","ukm","chairman"
    //     );
    //     if(!empty($kategori) && in_array($kategori,$list_kategori)){
    //         $data = $this->datamodel->selectAllWhere('nominasi',array("kategori"=>$kategori));
    //         sukses($data);
    //     }else{
    //         error("kategori tidak sesuai");
    //     }
    // }

    public function add()
    {
        $nim= $this->input->post('nim');
        $password= $this->input->post('password');
        $id= $this->input->post('id_nominasi');
        $check=checkCIAM($nim,$password);
        if($check->status){
            $get=$this->datamodel->selectAllWhere('nominasi',array("id"=>$id));
            if($get!=false){
                $data=array(
                    "NIM"=> $nim,
                    "nominasi_id"=>$get[0]->id,
                    "kategori"=>$get[0]->kategori
                );
                $do= $this->datamodel->insertTo('vote',$data);
                if($do){
                    sukses($do);
                }else{
                    error("entah apa yang kau lakukan");
                }
            }else{
                error("hayo nominasinya ngawur");
            }
        }else{
            error("bukan mahasiswa ub");
        }

    }

    public function rekap()
    {
        $nim= $this->input->post('nim');
        $password= $this->input->post('password');
        $rekap=$this->datamodel->rekap_awarding();
        $list_rekap=array();
        foreach ($rekap as $index => $value) {
            $list_rekap[$value['kategori']][]=$value;
        }
        $check=checkCIAM($nim,$password);
        if($check->status){
            $vote=$this->datamodel->selectAllWhere('vote',array("NIM"=>$nim));
            $data['vote']=$vote;
            $data['rekap']=$list_rekap;
            sukses($data);
        }else{
            $data['vote']="tidak terautentikasi";
            $data['rekap']=$list_rekap;
            sukses($data);
        }
        
    }

}

/* End of file Absensi.php */