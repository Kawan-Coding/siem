<div class="row">
    <div class="col-xs-12">
        <div class="alert bg-orange">
            <div style="display: block; text-align: -webkit-center">
                <img src="https://em.ub.ac.id/apps/img/logo2.png" alt="Logo EM UB" width="300">
            </div>

            <h3 class="text-center">Selamat datang <b><?php echo word_limiter($this->session->userdata('nama'), 2, ""); ?></b> di Sistem
                Informasi Eksekutif Mahasiswa Universistas Brawijaya 2019</h3>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>