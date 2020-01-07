<?php
defined('BASEPATH') or exit('No direct script access allowed');

function r($value)
{
	$search = array("'",  '"');
	$replace = array(" ");
	if (is_null($value)) {
		return "";
	}
	return str_replace($search, $replace, $value);
}

function checkCIAM($nim, $auth)
{
	$auth = base64_decode($auth);
	$url = file_get_contents("https://em.ub.ac.id/redirect/login/loginAppsCiam/?nim=" . $nim . "&password=" . $auth);
	return json_decode($url);
}

function pilihan($data)
{
	$res = array();
	foreach ($data as $pilihan) {
		if ($pilihan['HAK'] == 'BPH') {
			$temp = array(
				'ID_PILIHAN' => $pilihan['ID_PILIHAN'],
				'TB_PILIHAN' => $pilihan['TB_PILIHAN'],
			);
			array_push($res, $temp);
		}
	}
	return $res;
}

function divisi($data)
{
	$res = array();
	foreach ($data as $pilihan) {
		$divisi="'".$pilihan['TB_PILIHAN']."'";
		// $hak="'".$pilihan['HAK']."'";
		$temp = array(
			'ID_PILIHAN' => $pilihan['ID_PILIHAN'],
			'TB_PILIHAN' => $pilihan['TB_PILIHAN'],
			'HAK' => $pilihan['HAK'],
			'ACTION'=> '<a href="#!" onclick="edit_divisi('.$pilihan['ID_PILIHAN'].','.$divisi.')" class="secondary-content tooltipped" tooltip="Ubah Pengurus"> <i class="material-icons right" style="margin-right:2em">create</i></a>
						<a href="#!" onclick="hapus_divisi('.$pilihan['ID_PILIHAN'].','.$divisi.')" class="secondary-content tooltipped" tooltip="Ubah Pengurus"> <i class="material-icons right">delete</i></a>'
		);
		array_push($res, $temp);
	}
	return $res;
}
function sukses($data){
header('Content-Type: application/json');
echo json_encode(
array(
        "error"=>false,
        "message"=>"query berhasil",
        "data"=>$data
    ));
}

function error($message){
header('Content-Type: application/json');
echo json_encode(
array(
        "error"=> true,
        "message"=>$message,
        "data"=>null
    ));
}

function agenda($data)
{
	$card = "";
	foreach ($data as $print) {
		$card .= '<div class="col l3">
					<div class="card">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src="' . $print["FOTO"] . '">
						</div>
					<div class="card-content">
					<span class="card-title activator grey-text text-darken-4">' . substr($print["TB_AGENDA"], 0, 17) . '<br> </span> 
					<p>
						<a href="' . base_url('presensi/index/' . base64_encode($print['ID_AGENDA'])) . '">Masuk</a> 
						<a class="modal-trigger" href="#hapus_agenda" data-target="hapus_agenda" onclick="hapus_agenda(' . "'" . base64_encode($print['ID_AGENDA']) . "', " . $print['NIM'].",'".$print['TB_AGENDA']."','".$print["FOTO"] ."'".')">
							<i class="material-icons right">delete</i>
						</a> 
						<a class="modal-trigger" href="#edit_agenda" onclick="edit_agenda(' . "'" . base64_encode($print['ID_AGENDA']) . "'" . ')">
							<i class="material-icons right">create</i>
						</a> 
					</p>
					</div>
					<div class="card-reveal">
						<span class="card-title grey-text text-darken-4">' . $print["TB_AGENDA"] . '<i class="material-icons right">close</i></span><p>' . $print["DESKRIPSI"] . '</p>
						</div>
					</div>
				</div>';
	}
	return $card;
}
