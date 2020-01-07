<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title"><button class="btn" onclick="refresh()"><i class="fa fa-refresh"></i></button> <?= $data->nama_absensi; ?></h3>
        <a href="<?= base_url('user/absen/' . $data->id . '/' . substr(sha1($data->berakhir), 0, 10)); ?>"
           target="_blank" class="btn bg-orange btn-sm pull-right"><i class="fa fa-send"></i></a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="data-table" width="100%" class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="20%">NIM</th>
                <th width="25%">Nama Lengkap</th>
                <th width="25%">Kementrian</th>
                <th width="15%">Jam</th>
                <th width="10%">Status</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    let table;
    $(document).ready(function () {
        table = $('#data-table').DataTable({
            "ajax": '<?php echo base_url("absensi/get/$data->id"); ?>',
            "columns": [
                {"data": "no"},
                {"data": "nim"},
                {"data": "nama"},
                {"data": "kementrian"},
                {"data": "jam"},
                {"data": "status"}
            ]
        });
    });

    function refresh() {
        table.ajax.reload();
    }
</script>