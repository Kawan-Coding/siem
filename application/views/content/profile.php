<div class="box box-primary">
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle"
             src="https://em.ub.ac.id/wp-content/uploads/2019/03/logo-no-text-01.png" alt="User profile picture">

        <h3 class="profile-username text-center"><?= $this->session->userdata('nama'); ?></h3>

        <p class="text-muted text-center"><?= $this->session->userdata('role'); ?></p>
        <hr>
        <div class="text-center">
            <img id="qrcode" style="margin: 0 auto;" width="300" height="300">
            <h4>Scan untuk Presensi Kehadiran</h4>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>