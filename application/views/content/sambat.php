<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Data Sambat EM Apps</h3>
        <button class="btn bg-orange btn-sm pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>
        </button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="data-table" width="100%" class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="25%">Kategori</th>
                    <th width="25%">Sambatan</th>
                    <th width="25%">Progres</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Wordpress</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-tambah">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategori</label>

                        <div class="col-sm-10">
                            <select name="kategori" class="form-control">
                                <option value="">Pilih Opsi</option>
                                <option value="Info Beasiswa">Info Beasiswa</option>
                                <option value="UB Juara">UB Juara</option>
                                <option value="Seputar Brawijaya">Seputar Brawijaya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul Informasi</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" placeholder="Judul Informasi ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Url Gambar</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="url_gambar" placeholder="Url Gambar ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Url Wordpress</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="url_wordpress" placeholder="Url Wordpress ...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close
                </button>
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
                <h4 class="modal-title">Ubah Data Wordpress</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-ubah">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategori</label>

                        <div class="col-sm-10">
                            <input type="hidden" id="id" name="id">
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">Pilih Opsi</option>
                                <option value="Info Beasiswa">Info Beasiswa</option>
                                <option value="UB Juara">UB Juara</option>
                                <option value="Seputar Brawijaya">Seputar Brawijaya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Judul Informasi</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Judul Informasi ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Url Gambar</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="url_gambar" id="url_gambar" placeholder="Url Gambar ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Url Wordpress</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="url_wordpress" id="url_wordpress" placeholder="Url Wordpress ...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close
                </button>
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
    $(document).ready(function() {
        table = $('#data-table').DataTable({
            "ajax": '<?= base_url(); ?>sambat/autoload',
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "kategori"
                },
                {
                    "data": "sambatan"
                },
                {
                    "data": "progres"
                },
                {
                    "data": "action"
                }
            ]
        });
    });

    function hapus(id) {
        $.ajax({
            url: '<?= base_url(); ?>sambat/hapus',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function(r) {
                if (r.error === false) {
                    swal(
                        'Berhasil !',
                        'Berhasil Menghapus Data Wordpress',
                        'success'
                    );
                    table.ajax.reload();
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menghapus Data Wordpress',
                        'error'
                    );
                }
            }
        });
    }

    function tambah() {
        var data = $('#form-tambah').serialize();
        $.ajax({
            url: '<?= base_url(); ?>sambat/tambah',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(r) {
                if (r.error === false) {
                    swal(
                        'Berhasil !',
                        'Berhasil Menambah Data Wordpress',
                        'success'
                    );
                    $('#form-tambah')[0].reset();
                    table.ajax.reload();
                    $('#add').modal('hide');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menambah Data Wordpress',
                        'error'
                    );
                }
            }
        });
    }

    function hapus(id) {
        var data = id;
        $.ajax({
            url: '<?= base_url(); ?>sambat/hapus',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(r) {
                if (r.error === false) {
                    swal(
                        'Berhasil !',
                        'Berhasil menghapus data sambat',
                        'success'
                    );
                    $('#form-tambah')[0].reset();
                    table.ajax.reload();
                    $('#add').modal('hide');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal menghapus data sambat',
                        'error'
                    );
                }
            }
        });
    }

    function ubah(id) {
        $('#form-ubah')[0].reset();
        $.ajax({
            url: '<?= base_url(); ?>sambat/getdata',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function(r) {
                if (r.error === false) {
                    $('#nama').val(r.data.nama);
                    $('#id').val(id);
                    $('#kategori').val(r.data.kategori);
                    $('#url_gambar').val(r.data.gambar);
                    $('#url_wordpress').val(r.data.url);
                    $('#change').modal('show');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Mengambil Data Wordpress',
                        'error'
                    );
                }
            }
        });
    }

    function simpan() {
        var data = $('#form-ubah').serialize();
        $.ajax({
            url: '<?= base_url(); ?>informasi/ubahdata',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(r) {
                if (r.error === false) {
                    $('#change').modal('hide');
                    table.ajax.reload();
                    swal(
                        'Berhasil !',
                        'Berhasil Menyimpan Data Wordpress',
                        'success'
                    );
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menyimpan Data Wordpress',
                        'error'
                    );
                }
            }
        });
    }
</script>