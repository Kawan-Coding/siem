<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Bara Akan Tetap Membara</title>
    <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>css/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>css/member.css" />
</head>

<body>
    <div class="jumbo-ava"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="avacard">
                    <img src="<?= $data->data->FOTO ?>" class="avacard-img h-100" alt="" />
                </div>
            </div>
            <?php
            $i = 0;
            $rating = 0.0;
            foreach ($data->data->APRESIASI as $apresiasi) {
                $i++;
                $rating += (float) $apresiasi->rating;
            }
            if ($i > 0) {
                $rating = $rating / $i;
            }
            ?>
            <div clas="col-md-8">
                <div class="container mt-3 ml-3">
                    <h4><?= $data->data->NAMA_LENGKAP ?></h4>
                    <h4><?= $data->data->KEMENTERIAN ?></h4>
                    <h4><?= round($rating, 2) ?> / 5.0</h4>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card-mem">
                    <img src="<?= base_url() ?>img/logoputih.png" class="card-mem-img" alt="" />
                    <h6>Mendapatkan</h6>
                    <h3 class="font-weight-bold"><?= count($data->data->APRESIASI) ?></h3>
                    <h3>Apresiasi</h3>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card-mem2">
                    <img src="<?= base_url() ?>img/logoputih.png" class="card-mem-img" alt="" />
                    <!-- <h6>Mendapatkan</h6> -->
                    <?php
                    $i = 1;
                    foreach ($data->data->APRESIASI as $apresiasi) {
                        ?>
                        <div class="row">
                            <div class="col-1">
                                <p class="font-weight-bold"><?= $i ?>.</p>
                            </div>
                            <div class="col-10">
                                <h6 class="mb-0"><?= $apresiasi->apresiasi ?></h6>
                                <p class="mb-0"><?= $apresiasi->rating ?> / 5.0</p>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="kesan-wrap">
            <?php
            foreach ($data->data->KESAN as $kesan) {
                ?>

                <div class="card-mem3">
                    <div class="card-mem3-content">
                        <p><?= $kesan->kesan ?></p>
                    </div>
                    <h6 class="text-right w-100">-<?= $kesan->nama ?></h6>
                </div>
            <?php
            }
            ?>
        </div>
        <!-- <div class="owl-carousel">
        <div class="item"></div>
      </div> -->
    </div>
    <script src="<?= base_url() ?>js/jquery.min.js"></script>
    <script src="<?= base_url() ?>js/owl.carousel.min.js"></script>
</body>

</html>