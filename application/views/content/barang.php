<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Data Barang EM UB</h3>
        <button class="btn bg-orange btn-sm pull-right" data-toggle="modal" data-target="#add"><i
                    class="fa fa-plus"></i>
        </button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="data-table" width="100%" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Nama Barang</th>
                <th width="15%">Status</th>
                <th width="10%">Stok</th>
                <th width="15%">Action</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Barang</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4 col-xs-12">
                        <img id="view-gambar" class="img-responsive">
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <h4 style="margin-top: 0" id="view-judul"></h4>
                        <p id="view-stok"></p>
                        <hr>
                        Desc :
                        <div id="view-desc"></div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Barang</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-tambah">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Barang</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga Barang</label>

                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="harga">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Post</label>

                        <div class="col-sm-9">
                            <select name="jenis" class="form-control">
                                <option value="JUAL">Dijual</option>
                                <option value="PINJAM">Pinjam</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status Post</label>

                        <div class="col-sm-9">
                            <select name="status" class="form-control">
                                <option value="DRAFT">DRAFT</option>
                                <option value="PUBLIC">PUBLIC</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Stok Barang</label>

                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="stok">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Link Gambar</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="link">
                            <i>*upload di imgur.com, kemudian tambahkan ekstensi file ketika memasukkan link, contoh: https://imgur.com/xc2RGwC.jpg</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kontak Barang</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kontak">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterangan</label>

                        <div class="col-sm-9">
                            <textarea id="keterangan" name="keterangan" rows="8"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close
                </button>
                <button type="button" class="btn btn-warning" onclick="tambah()"><i class="fa fa-check"></i> Tambah
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
                <h4 class="modal-title">Ubah Data Barang</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-ubah">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Barang</label>

                        <div class="col-sm-9">
                            <input type="hidden" id="id" name="id-barang">
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Harga Barang</label>

                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="harga" id="harga">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Post</label>

                        <div class="col-sm-9">
                            <select name="jenis" class="form-control" id="jenis">
                                <option value="JUAL">Dijual</option>
                                <option value="PINJAM">Pinjam</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status Post</label>

                        <div class="col-sm-9">
                            <select name="status" class="form-control" id="status">
                                <option value="DRAFT">DRAFT</option>
                                <option value="PUBLIC">PUBLIC</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Stok Barang</label>

                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="stok" id="stok">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Link Gambar</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="link" id="link">
                            <i>*upload di imgur.com, kemudian tambahkan ekstensi file ketika memasukkan link, contoh: https://imgur.com/xc2RGwC.jpg</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kontak Barang</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kontak" id="kontak">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterangan</label>

                        <div class="col-sm-9">
                            <textarea id="keterangan-2" name="keterangan" rows="8"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close
                </button>
                <button type="button" class="btn btn-warning" onclick="simpan()"><i class="fa fa-check"></i> Ubah
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<script type="text/javascript">
    let keterangan, keterangan2;
    ClassicEditor
        .create(document.querySelector('#keterangan'))
        .then(newEditor => {
            keterangan = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#keterangan-2'))
        .then(newEditor => {
            keterangan2 = newEditor;
        })
        .catch(error => {
            console.error(error);
        });

    let table;
    $(document).ready(function () {
        table = $('#data-table').DataTable({
            "ajax": '<?= base_url(); ?>barang/autoload',
            "columns": [
                {"data": "no"},
                {"data": "nama_barang"},
                {"data": "jenis_barang"},
                {"data": "stok_barang"},
                {"data": "action"}
            ]
        });
    });

    function hapus(id) {
        $.ajax({
            url: '<?= base_url(); ?>barang/hapus',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function (r) {
                if (r.error === false) {
                    swal(
                        'Berhasil !',
                        'Berhasil Menghapus Data Barang',
                        'success'
                    );
                    table.ajax.reload();
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menghapus Data Barang',
                        'error'
                    );
                }
            }
        });
    }

    function tambah() {
        const ket = keterangan.getData();
        const data = $('#form-tambah').serialize() + '&keterangan=' + ket;
        $.ajax({
            url: '<?= base_url(); ?>barang/tambah',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (r) {
                if (r.error === false) {
                    swal(
                        'Berhasil !',
                        'Berhasil Menambah Data Barang',
                        'success'
                    );
                    $('#form-tambah')[0].reset();
                    table.ajax.reload();
                    $('#add').modal('hide');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menambah Data Barang',
                        'error'
                    );
                }
            }
        });
    }

    function view(id) {
        $.ajax({
            url: '<?= base_url(); ?>barang/getdata',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function (r) {
                if (r.error === false) {
                    $('#view-judul').html(r.data.nama + " ─ " + new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(r.data.harga));
                    $('#view-desc').html(r.data.keterangan);
                    $('#view-stok').html("<i class=\"fa fa-cube margin-r5\"></i> Stok Barang : " + r.data.stok);
                    $('#view-gambar').attr('src', r.data.link);
                    $('#view').modal('show');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Mengambil Data Barang',
                        'error'
                    );
                }
            }
        });
    }

    function ubah(id) {
        $('#form-ubah')[0].reset();
        $.ajax({
            url: '<?= base_url(); ?>barang/getdata',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function (r) {
                if (r.error === false) {
                    $('#id').val(id);
                    $('#nama').val(r.data.nama);
                    $('#status').val(r.data.status);
                    $('#harga').val(r.data.harga);
                    $('#link').val(r.data.link);
                    $('#stok').val(r.data.stok);
                    $('#jenis').val(r.data.jenis);
                    $('#keterangan-2').val(r.data.keterangan);
                    $('#kontak').val(r.data.kontak);
                    keterangan2.setData(r.data.keterangan);
                    $('#change').modal('show');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Mengambil Data Barang',
                        'error'
                    );
                }
            }
        });
    }

    function simpan() {
        const ket = keterangan2.getData();
        const data = $('#form-ubah').serialize() + '&keterangan=' + ket;
        $.ajax({
            url: '<?= base_url(); ?>barang/ubahdata',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (r) {
                if (r.error === false) {
                    $('#change').modal('hide');
                    table.ajax.reload();
                    swal(
                        'Berhasil !',
                        'Berhasil Menyimpan Data Barang',
                        'success'
                    );
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menyimpan Data Barang',
                        'error'
                    );
                }
            }
        });
    }
</script>