<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Data EM Link</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="data-table" width="100%" class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="20%">Url</th>
                <th width="30%">Tujuan</th>
                <th width="30%">Dilihat</th>
                <th width="15%">Action</th>
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
            "ajax": 'link/autoload',
            "columns": [
                {"data": "no"},
                {"data": "url"},
                {"data": "redirect"},
                {"data": "visit"},
                {"data": "action"}
            ]
        });
    });
</script>