<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi EM UB 2019</title>
    <link rel="shortcut icon" href="https://em.ub.ac.id/wp-content/uploads/2019/03/logo-no-text-01.png" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/styling.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/skins/skin-black.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <a class="logo">
                <span class="logo-mini"><b>EM</b></span>
                <span class="logo-lg"><b>EM</b> UB 2019</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="messages-menu">
                            <a style="color: #fff; border: none; background: #ff8500 !important" class="Timer">
                                <i class="fa fa-clock-o"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image image-ava">
                        <img src="<?php echo $this->session->userdata('foto'); ?>" class="image-child" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo word_limiter($this->session->userdata('nama'), 2, ""); ?></p>
                        <a><?php echo $this->session->userdata('singkatan'); ?></a>
                    </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <li><a href="<?php echo base_url(); ?>profile"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                    <li class="header">ADMINISTRASI</li>
                        <li><a href="<?php echo base_url(); ?>absensi"><i class="fa fa-check"></i><span>Presensi Kehadiran</span></a>
                    </li>
                    <?php if ($this->session->userdata('access') == 'DEV') : ?>
                        <li class="header">PUSKOMINFO</li>
                        <li><a href="<?php echo base_url(); ?>informasi"><i class="fa fa-info-circle"></i>
                                <span>Data Informasi</span></a></li>
                        <li><a href="<?php echo base_url(); ?>iklan"><i class="fa fa-info-circle"></i>
                                <span>Data Iklan</span></a></li>
                        <li><a href="<?php echo base_url(); ?>shortlink"><i class="fa fa-link"></i>
                                <span>Data Shortlink</span></a>
                        </li>
                        <li class="header">ADVOKESMA</li>
                        <li><a href="<?php echo base_url(); ?>sambat"><i class="fa fa-envelope-o"></i>
                                <span>Brawijaya Sambat</span></a></li>
                        <li class="header">EKONOMI KREATIF</li>
                        <li><a href="<?php echo base_url(); ?>transaksi"><i class="fa fa-shopping-cart"></i>
                                <span>Pembelian</span></a></li>
                        <li><a href="<?php echo base_url(); ?>barang"><i class="fa fa-archive"></i> <span>Data Barang</span></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('access') != 'USER') : ?>
                        <li class="header">APRESIASI</li>
                        <li id="list_kementerian"></li>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('id_role') == 6 && ($this->session->userdata('access') == 'USER' || $this->session->userdata('access') == 'ADMIN')) : ?>
                        <li class="header">PUSKOMINFO</li>
                        <li><a href="<?php echo base_url(); ?>informasi"><i class="fa fa-info-circle"></i>
                                <span>Data Informasi</span></a></li>
                        <li><a href="<?php echo base_url(); ?>iklan"><i class="fa fa-info-circle"></i>
                                <span>Data Iklan</span></a></li>
                        <li><a href="<?php echo base_url(); ?>shortlink"><i class="fa fa-link"></i>
                                <span>Data Shortlink</span></a>
                        </li>
                    <?php elseif ($this->session->userdata('id_role') == 8 && ($this->session->userdata('access') == 'USER' || $this->session->userdata('access') == 'ADMIN')) : ?>
                        <li class="header">ADVOKESMA</li>
                        <li><a href="<?php echo base_url(); ?>sambat"><i class="fa fa-envelope-o"></i>
                                <span>Brawijaya Sambat</span></a></li>
                    <?php elseif ($this->session->userdata('id_role') == 4 && ($this->session->userdata('access') == 'USER' || $this->session->userdata('access') == 'ADMIN')) : ?>
                        <li class="header">EKONOMI KREATIF</li>
                        <li><a href="<?php echo base_url(); ?>transaksi"><i class="fa fa-shopping-cart"></i>
                                <span>Pembelian</span></a></li>
                        <li><a href="<?php echo base_url(); ?>barang"><i class="fa fa-archive"></i> <span>Data Barang</span></a>
                        </li>
                    <?php endif; ?>
                    <li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Sistem Informasi
                    <small>EM UB 2019</small>
                </h1>
            </section>

            <section class="content">
                <!--            <div class="row">-->
                <!--                <div class="col-lg-4 col-md-12 col-xs-12">-->
                <!--                    <div class="small-box bg-black-gradient">-->
                <!--                        <div class="inner">-->
                <!--                            <h3>--><?php //echo $barang; 
                                                        ?>
                <!--</h3>-->
                <!--                            <p>TOTAL BARANG</p>-->
                <!--                        </div>-->
                <!--                        <div class="icon">-->
                <!--                            <i class="fa fa-archive"></i>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                <div class="col-lg-4 col-md-12 col-xs-12">-->
                <!--                    <div class="small-box bg-yellow-gradient">-->
                <!--                        <div class="inner">-->
                <!--                            <h3>--><?php //echo $pinjaman; 
                                                        ?>
                <!--</h3>-->
                <!--                            <p>TOTAL PEMINJAMAN</p>-->
                <!--                        </div>-->
                <!--                        <div class="icon">-->
                <!--                            <i class="fa fa-exchange"></i>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                <div class="col-lg-4 col-md-12 col-xs-12">-->
                <!--                    <div class="small-box bg-red-gradient">-->
                <!--                        <div class="inner">-->
                <!--                            <h3>--><?php //echo $informasi; 
                                                        ?>
                <!--</h3>-->
                <!--                            <p>TOTAL INFORMASI</p>-->
                <!--                        </div>-->
                <!--                        <div class="icon">-->
                <!--                            <i class="fa fa-info"></i>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <?php $this->load->view($view); ?>
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.13
            </div>
            <strong>Copyright &copy; <?= date("Y"); ?> Eksekutif Mahasiswa.</strong> All rights reserved. Made with <i class="fa fa-love"></i> by <a href="https://instagram.com/grinaldiwisnu">Me</a>
        </footer>
    </div>

    <script src="<?php echo base_url(); ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>dist/bootstrap-clockpicker.min.js"></script>
    <script src="<?php echo base_url(); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>dist/js/adminlte.min.js"></script>
    <script>
        $('.clockpicker').clockpicker({
            donetext: 'Set'
        });
        var list = "";
        $(document).ready(function() {
            showTime();
            $.ajax({
                url: '<?= base_url(); ?>apresiasi/get_kementerian',
                dataType: 'json',
                success: function(r) {
                    kementerian(r.data);
                }
            });
        });

        function kementerian(params) {
            params.forEach(element => {
                list += '<li><a href="<?php echo base_url(); ?>apresiasi/kementerian/' + element.ID_KEMENTERIAN + '"><i class="fa fa-users"></i><span>' + element.SINGKAT + '</span></a>';
            });
            $('#list_kementerian').html(list);
            $('#list_kementerian').contents().unwrap();
        }

        function showTime() {
            const date = new Date();
            let h = date.getHours(); // 0 - 23
            let m = date.getMinutes(); // 0 - 59
            let s = date.getSeconds(); // 0 - 59
            let session = "AM";

            if (h == 0) {
                h = 12;
            }

            if (h > 12) {
                h = h - 12;
                session = "PM";
            }

            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;

            const time = h + ":" + m + ":" + s + " " + session;
            $('.Timer').html(time);

            setTimeout(showTime, 1000);
        }
    </script>
    <script type="text/javascript" src="js/require.js"></script>
    <script>
        let __awesome_qr_base_path = "js";

        require([__awesome_qr_base_path + '/awesome-qr'], function(AwesomeQR) {
            const logo = new Image();
            logo.crossOrigin = "Anonymous";
            logo.src = "https://em.ub.ac.id/siem/js/logo-qr.png";
            AwesomeQR.create({
                text: `{"id": "<?= $this->session->userdata('id'); ?>", "nama": "<?= $this->session->userdata('nama'); ?>"}`,
                size: 800,
                margin: 0,
                bindElement: 'qrcode',
                logoImage: logo,
                logoScale: 1,
                dotScale: 1,
                whiteMargin: true,
                colorDark: "#851730",
                colorLight: "#ffffff",
                // autoColor: true,
                maskedDots: false,
                logoMargin: 1,
                logoCornerRadius: 75,
            });
        });
    </script>
</body>

</html>