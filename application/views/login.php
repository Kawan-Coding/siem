<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - EM UB 2019</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/main.css">
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form id="form-login" class="login100-form validate-form">
                <div style="display: block; text-align: -webkit-center">
                    <img src="https://em.ub.ac.id/apps/img/logo2.png" alt="Logo EM UB" width="300">
                </div>
                <div class="alert alert-danger" id="error" style="display: none;"></div>
                <div class="alert alert-success" id="success" style="display: none;"></div>
                <div class="progress" style="display: none">
                    <div class="progress-bar progress-bar-info progress-bar-animated progress-bar-striped" role="progressbar" style="width: 100%"></div>
                </div>
                <br>
                <div class="wrap-input100 validate-input" data-validate="Enter Username">
                    <input class="input100" type="text" name="username">
                    <span class="focus-input100" data-placeholder="Username"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="button" onclick="login()" class="login100-form-btn">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?= base_url(); ?>vendor/animsition/js/animsition.min.js"></script>
<script src="<?= base_url(); ?>vendor/bootstrap/js/popper.js"></script>
<script src="<?= base_url(); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>vendor/select2/select2.min.js"></script>
<script src="<?= base_url(); ?>vendor/daterangepicker/moment.min.js"></script>
<script src="<?= base_url(); ?>vendor/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url(); ?>vendor/countdowntime/countdowntime.js"></script>
<script src="<?= base_url(); ?>js/main.js"></script>
<script>
    function login() {
        let data = $("#form-login").serialize();
        $("#error").hide('slow');
        $("#success").hide('slow');
        $(".progress").show('slow');
        $.ajax({
            url: 'login/login',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (r) {
                if (r.error) {
                    $(".progress").hide('slow');
                    $("#error").html(r.message);
                    $("#error").show('slow');
                } else if (!r.error) {
                    $(".progress").hide('slow');
                    $("#success").html(r.message);
                    $("#success").show('slow');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    alert('wrong');
                }
            }
        });
    }
</script>
</body>
</html>