<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $absen->nama_absensi; ?> - EM UB 2019</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/main.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/sweetalert2@8.5.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.5.0/dist/sweetalert2.all.js"></script>
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <span class="login100-form-title p-b-26">Scan Kartu Anggota Kamu</span>
            <br>
            <div style="margin: 0px auto; border-radius: 10px; height: 300px; position: relative; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                <video id="preview" style="height: 300px;"></video>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?= base_url(); ?>vendor/daterangepicker/moment.min.js"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">
    const opt = {
        video: document.getElementById('preview'),
        continuous: true,
        scanPeriod: 5,
        mirror: true,
        refractoryPeriod: 3000,
    };
    let scanner = new Instascan.Scanner(opt);
    let i = 1;
    scanner.addListener('scan', function (content) {
        let data = (JSON).parse(content);
        let id = "<?php echo $absen->id; ?>";
        console.log(content);
        console.log(data);
        Swal.fire({
            title: 'Benar Ingin Absen?',
            text: data.nama + " apakah ingin melakukan absen ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url(); ?>api/post/absen",
                    type: "POST",
                    dataType: "json",
                    data: {nama_lengkap: data.nama, id_event: id, id_anggota: data.id},
                    success: function (data) {
                        if (!data.error) {
                            Swal.fire(
                                'Berhasil !',
                                'Berhasil Melakukan Absensi.',
                                'success'
                            );
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Failed!',
                                text: data.message,
                                footer: '<span style="color: red;">' + data.status + '</span>'
                            });
                        }
                    }
                });
            }
        });
    });

    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });
</script>
</body>
</html>