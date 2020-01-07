<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Data Iklan EM Apps</h3>
        <button class="btn bg-orange btn-sm pull-right" data-toggle="modal" data-target="#add"><i
                    class="fa fa-plus"></i>
        </button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="data-table" width="100%" class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="40%">Nama Iklan</th>
                <th width="15%">Viewers Sekarang</th>
                <th width="15%">Target Viewers</th>
                <th width="25%">Action</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Iklan</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-tambah">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Iklan</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Iklan ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Url Gambar</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="url_gambar" placeholder="Url Gambar ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Target Views</label>

                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="target"
                                   placeholder="XX">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close
                </button>
                <a href="https://imgur.com/upload" target="_blank" class="btn btn-danger"><i class="fa fa-upload"></i></a>
                <button type="button" class="btn btn-warning" onclick="tambah()"><i class="fa fa-plus"></i> Tambah
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="change">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Iklan</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-ubah">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Iklan</label>

                        <div class="col-sm-9">
                            <input type="hidden" id="id" name="id">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Iklan ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Url Gambar</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="url" name="url_gambar" placeholder="Url Gambar ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Target Views</label>

                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="target" name="target" placeholder="XX">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close
                </button>
                <a href="https://imgur.com/upload" target="_blank" class="btn btn-danger"><i class="fa fa-upload"></i></a>
                <button type="button" class="btn btn-warning" onclick="simpan()"><i class="fa fa-save"></i> Ubah
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    let table;
    $(document).ready(function () {
        table = $('#data-table').DataTable({
            "ajax": '<?= base_url(); ?>iklan/autoload',
            "columns": [
                {"data": "no"},
                {"data": "pemilik"},
                {"data": "view"},
                {"data": "target"},
                {"data": "action"}
            ]
        });
    });

    function hapus(id) {
        $.ajax({
            url: '<?= base_url(); ?>iklan/hapus',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function (r) {
                if (r.error === false) {
                    swal(
                        'Berhasil !',
                        'Berhasil Menghapus Data Iklan',
                        'success'
                    );
                    table.ajax.reload();
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menghapus Data Iklan',
                        'error'
                    );
                }
            }
        });
    }

    function tambah() {
        const data = $('#form-tambah').serialize();
        $.ajax({
            url: '<?= base_url(); ?>iklan/tambah',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (r) {
                if (r.error === false) {
                    swal(
                        'Berhasil !',
                        'Berhasil Menambah Data Iklan',
                        'success'
                    );
                    $('#form-tambah')[0].reset();
                    table.ajax.reload();
                    $('#add').modal('hide');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menambah Data Iklan',
                        'error'
                    );
                }
            }
        });
    }

    function ubah(id) {
        $('#form-ubah')[0].reset();
        $.ajax({
            url: '<?= base_url(); ?>iklan/getdata',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function (r) {
                if (r.error === false) {
                    $('#nama').val(r.data.nama);
                    $('#id').val(id);
                    $('#target').val(r.data.target);
                    $('#url').val(r.data.url);
                    $('#change').modal('show');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Mengambil Data Iklan',
                        'error'
                    );
                }
            }
        });
    }

    function simpan() {
        const data = $('#form-ubah').serialize();
        $.ajax({
            url: '<?= base_url(); ?>iklan/ubahdata',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (r) {
                if (r.error === false) {
                    $('#change').modal('hide');
                    table.ajax.reload();
                    swal(
                        'Berhasil !',
                        'Berhasil Menyimpan Data Iklan',
                        'success'
                    );
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menyimpan Data Iklan',
                        'error'
                    );
                }
            }
        });
    }
</script>