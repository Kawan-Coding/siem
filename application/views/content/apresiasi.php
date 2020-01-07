<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">APRESIASI KINERJA EM UB</h3>
        </button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="data-table" width="100%" class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="15%">NIM</th>
                    <th width="30%">Nama</th>
                    <th width="20%">Fakultas</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal fade" id="change">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Apresiasi</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-ubah">

                    <input type="hidden" id="id" name="id">
                    <input type="hidden" class="form-control" id="nim" name="nim" readonly>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">NAMA</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">FAKULTAS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fakultas" name="fakultas" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">KEMENTERIAN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kementerian" name="kementerian" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">APRESIASI</label>
                        <div class="col-sm-10" style="margin-left:-1em;">
                            <div class="col-sm-7">
                                <input type="text" placeholder="tulis apresiasi..." class="form-control" id="apresiasi" name="apresiasi[]">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" max="5" min="1" placeholder="0-5" class="form-control" id="star" name="star[]">
                            </div>
                            <div class="col-sm-2">
                                <input type="button" onclick="add_apresiasi()" class="btn btn-warning" value="+">
                            </div>
                            <div id="list_apresiasi"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">KESAN</label>
                        <div class="col-sm-10" style="margin-left:-1em;">
                            <div class="col-sm-10">
                                <input type="number" value="<?= $this->session->userdata('nim') ?>" id="nim_bph" name="nim_bph[]" readonly hidden style="border: none;">
                                <input type="text" value="<?= word_limiter($this->session->userdata('nama'), 3, "") ?>" id="bph" name="bph[]" readonly style="border: none;">
                                <input type="text" placeholder="tulis kesan..." class="form-control" id="kesan" name="kesan[]">
                            </div>
                            <div class="col-sm-2">
                                <input type="button" onclick="add_kesan()" class="btn btn-warning" value="+">
                            </div>
                            <div id="list_kesan"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close
                </button>
                <button type="button" class="btn btn-warning" onclick="simpan()"><i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script src="<?= base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    // let table;
    // $('.select2').select2();
    $(document).ready(function() {
        table = $('#data-table').DataTable({
            "ajax": '<?= base_url(); ?>apresiasi/autoload/<?= $id_kementerian ?>',
            "scrollX": true,
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "nim"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "fakultas"
                },
                {
                    "data": "action"
                }
            ]
        });
    });

    function hapus(id) {
        $.ajax({
            url: '<?= base_url(); ?>absensi/hapus',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function(r) {
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
            success: function(r) {
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
            url: '<?= base_url(); ?>apresiasi/getdata',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id,
            success: function(r) {
                if (r.error === false) {
                    r = r.data;
                    // $('#nama').val(r.data.nama);
                    $('#id').val(r.id_pengurus);
                    $('#nim').val(r.nim);
                    $('#nama').val(r.nama);
                    $('#fakultas').val(r.fakultas);
                    $('#kementerian').val(r.kementerian);
                    $('#list_apresiasi').html("");
                    $('#list_kesan').html("");
                    if (r.apresiasi != "") {
                        var apresiasi = JSON.parse(r.apresiasi);
                        for (let index = 0; index < apresiasi.length; index++) {
                            if (index > 0) {
                                $('#list_apresiasi').append('<div class="fieldwrapper" id="field1"><div class="col-sm-7"><input type="text" class="form-control" name="apresiasi[]" value="' + apresiasi[index]['apresiasi'] + '"></div> <div class="col-sm-3"><input type="number" max="5" min="1" placeholder="0-5" class="form-control" name="star[]" value="' + apresiasi[index]['rating'] + '"></div><div class="col-sm-2"> <input type="button" class="btn btn-warning" onclick="$(this).parent().parent().remove()" value="-"></div></div>')
                            } else {
                                $('#apresiasi').val(apresiasi[index]['apresiasi']);
                                $('#star').val(apresiasi[index]['rating']);
                            }
                        }
                    }
                    if (r.kesan != "") {
                        var kesan = JSON.parse(r.kesan);
                        for (let index = 0; index < kesan.length; index++) {
                            if (index > 0) {
                                if (kesan[index]['nim'] == '<?= $this->session->userdata('nim') ?>') {
                                    $('#list_kesan').append('<div class="fieldwrapper" id="field1"><div class="col-sm-10"><input type="number" value="' + kesan[index]['nim'] + '" id="nim_bph" name="nim_bph[]" readonly hidden style="border: none;"><input type="text" value="' + kesan[index]['nama'] + '" name="bph[]" readonly="" style="border: none;"> <input type="text" class="form-control" name="kesan[]" value="' + kesan[index]['kesan'] + '"></div><div class="col-sm-2"> <input type="button" onclick="$(this).parent().parent().remove()" class="btn btn-warning" value="-"></div></div>')
                                } else {
                                    $('#list_kesan').append('<div class="fieldwrapper" id="field1"><div class="col-sm-10"><input type="number" value="' + kesan[index]['nim'] + '" id="nim_bph" name="nim_bph[]" readonly hidden style="border: none;"><input type="text" value="' + kesan[index]['nama'] + '" name="bph[]" readonly="" style="border: none;"> <input type="text" class="form-control" name="kesan[]" value="' + kesan[index]['kesan'] + '" readonly></div></div>')
                                }
                            } else {
                                if (kesan[index]['nim'] == '<?= $this->session->userdata('nim') ?>') {
                                    $('#nim_bph').val(kesan[index]['nim']);
                                    $('#bph').val(kesan[index]['nama']);
                                    $('#kesan').val(kesan[index]['kesan']);
                                } else {
                                    $('#nim_bph').val(kesan[index]['nim']).attr('readonly', true);
                                    $('#bph').val(kesan[index]['nama']).attr('readonly', true);
                                    $('#kesan').val(kesan[index]['kesan']).attr('readonly', true);
                                }
                            }
                        }
                    }
                    $('#change').modal('show');
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Mengambil Data',
                        'error'
                    );
                }
            }
        });
    }

    function simpan() {
        const data = $('#form-ubah').serialize();
        $.ajax({
            url: '<?= base_url(); ?>apresiasi/ubahdata',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(r) {
                if (r.error === false) {
                    $('#change').modal('hide');
                    table.ajax.reload();
                    swal(
                        'Berhasil !',
                        'Berhasil Menyimpan Data',
                        'success'
                    );
                } else {
                    swal(
                        'Gagal !',
                        'Gagal Menyimpan Data',
                        'error'
                    );
                }
            }
        });
    }

    function add_apresiasi() {
        var lastField = $("#list_apresiasi div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);
        var fName = $("<div class=\"col-sm-7\"><input type=\"text\" class=\"form-control\" name=\"apresiasi[]\"/></div> <div class=\"col-sm-3\"><input type=\"number\" max=\"5\" min=\"1\" placeholder=\"star\" class=\"form-control\" name=\"star[]\"/></div>");
        var removeButton = $("<div class=\"col-sm-2\"> <input type=\"button\" class=\"btn btn-warning\" value=\"-\"></div>");
        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(removeButton);
        $("#list_apresiasi").append(fieldWrapper);
    }

    function add_kesan() {
        var lastField = $("#list_kesan div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);
        var fName = $("<div class=\"col-sm-10\"> <input type=\"number\" value=\"<?= $this->session->userdata('nim') ?>\" id=\"nim_bph\" name=\"nim_bph[]\" readonly hidden style=\"border: none;\"> <input type=\"text\" value=\"<?= word_limiter($this->session->userdata('nama'), 3, "") ?>\" name=\"bph[]\" readonly style=\"border: none;\"> <input type=\"text\" class=\"form-control\" name=\"kesan[]\"></div>");
        var removeButton = $("<div class=\"col-sm-2\"> <input type=\"button\" class=\"btn btn-warning\" value=\"-\"></div>");
        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(removeButton);
        $("#list_kesan").append(fieldWrapper);
    }
</script>