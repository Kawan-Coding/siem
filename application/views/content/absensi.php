<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Data Absensi EM UB</h3>
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
                <th width="30%">Nama Absensi</th>
                <th width="15%">Mulai</th>
                <th width="15%">Berakhir</th>
                <th width="15%">Tanggal</th>
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
                <h4 class="modal-title">Tambah Form Absensi</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-tambah">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Form</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Absensi ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Pelaksanaan</label>

                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal">
                        </div>
                    </div>
                    <div class="form-group clockpicker">
                        <label class="col-sm-2 control-label">Waktu Mulai</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="mulai">
                        </div>
                    </div>
                    <div class="form-group clockpicker">
                        <label class="col-sm-2 control-label">Waktu Selesai</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="selesai">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kategori</label>

                        <div class="col-sm-10">
                            <select class="form-control" data-placeholder="Select a State"
                                    style="width: 100%;">
                                    <?php if($_SESSION['access']!='USER') echo 
                                    '<option value="RAPAT">RAPAT</option>
                                <option value="AGENDA EM">AGENDA EM</option>
                                <option value="KAJIAN">KAJIAN</option>
                                    <option value="PIKET">PIKET</option>'?>
                                
                                <option value="LAIN-LAIN">LAIN-LAIN</option>

                            </select>
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
                <h4 class="modal-title">Ubah Form Absensi</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-ubah">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Form</label>

                        <div class="col-sm-10">
                            <input type="hidden" id="id" name="id">
                            <input type="text" class="form-control" id="nama" name="nama"
                                   placeholder="Nama Absensi ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Pelaksanaan</label>

                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                    </div>
                    <div class="form-group clockpicker">
                        <label class="col-sm-2 control-label">Waktu Mulai</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mulai" name="mulai">
                        </div>
                    </div>
                    <div class="form-group clockpicker">
                        <label class="col-sm-2 control-label">Waktu Selesai</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="selesai" name="selesai">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kementrian</label>

                        <div class="col-sm-10">
                            <select class="form-control select2" id="kementrian" multiple="multiple" data-placeholder="Select a State"
                                    style="width: 100%;">
                                <?php foreach ($kementrian as $key): ?>
                                    <option value="<?= $key->ID_KEMENTERIAN; ?>"><?= $key->NAMA; ?></option>
                                <?php endforeach; ?>
                            </select>
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
<script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
    let table;
    // $('.select2').select2();
    $(document).ready(function () {
        table = $('#data-table').DataTable({
            "ajax": '<?= base_url(); ?>absensi/autoload',
            "columns": [
                {"data": "no"},
                {"data": "title"},
                {"data": "mulai"},
                {"data": "selesai"},
                {"data": "tanggal"},
                {"data": "action"}
            ]
        });
    });

    function hapus(id) {
        $.ajax({
            url: '<?= base_url(); ?>absensi/hapus',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function (r) {
                if (r.error === false) {
                    swal(
                        'Berhasil !',
                        'Berhasil Menghapus Form Absensi',
                        'success'
                    );
                    table.ajax.reload();
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menghapus Form Absensi',
                        'error'
                    );
                }
            }
        });
    }

    function tambah() {
        const data = $('#form-tambah').serialize() + '&kementrian=' + $('.select2').val();
        $.ajax({
            url: '<?= base_url(); ?>absensi/tambah',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (r) {
                if (r.error === false) {
                    swal(
                        'Berhasil !',
                        'Berhasil Menambah Form Absensi',
                        'success'
                    );
                    $('#form-tambah')[0].reset();
                    table.ajax.reload();
                    $('#add').modal('hide');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menambah Form Absensi',
                        'error'
                    );
                }
            }
        });
    }

    function ubah(id) {
        $('#form-ubah')[0].reset();
        $.ajax({
            url: '<?= base_url(); ?>absensi/getdata',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function (r) {
                if (r.error === false) {
                    $('#nama').val(r.data.nama);
                    $('#id').val(id);
                    $('#mulai').val(r.data.mulai);
                    $('#kementrian').select2().val(r.data.kementrian.split(",")).trigger('change');
                    $('#selesai').val(r.data.selesai);
                    $('#tanggal').val(r.data.tanggal);
                    $('#change').modal('show');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Mengambil Form Absensi',
                        'error'
                    );
                }
            }
        });
    }

    function simpan() {
        const data = $('#form-ubah').serialize() + '&kementrian=' + $('#kementrian').val();
        $.ajax({
            url: '<?= base_url(); ?>absensi/ubahdata',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (r) {
                if (r.error === false) {
                    $('#change').modal('hide');
                    table.ajax.reload();
                    swal(
                        'Berhasil !',
                        'Berhasil Menyimpan Form Absensi',
                        'success'
                    );
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menyimpan Form Absensi',
                        'error'
                    );
                }
            }
        });
    }
</script>