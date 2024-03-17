<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<?php
$bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
?>
<div class="page-content container">
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between bgc-info">
        <div class="col-auto">
            <h1 class="page-title text-dark">
                Formulir Penghimpunan
            </h1>
        </div>
        <div class="col-auto">
            <a target="_blank" href="/admin/excel_penghimpunan" class="btn btn-success btn-sm"><i class="fa fa-download"></i> | Template Excel</a>
            <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-primary btn-sm">Import dari Excel</button>
        </div>
    </div>
    <?= form_open("/admin/do_simpan_himpun_form", ['class' => 'form_himpunan']); ?>
    <?= csrf_field(); ?>
    <div class="container">
        <div class="form-group row">
            <div class="col-sm-5 col-form-label text-sm-left pr-0">
                <label for="id-form-field-1" class="mb-0">Tanggal</label>
            </div>
            <div class="col-sm-5">
                <input class="form-control form-sm" type="date" name="tanggal_himpun" id="" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5 col-form-label text-sm-left pr-0">
                <label for="form-field-chosen-1">Penyetor</label>
            </div>
            <div class="col-sm-5">
                <select id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control cMuzaki" onchange="sMuzaki()" name="email_muzaki" required>
                    <option value="" selected></option>
                    <?php foreach ($muzaki as $key => $m) { ?>
                        <option value="<?= $m['email_muzaki']; ?>"><?= $m['id_muzaki'] . ' - ' . $m['nama_muzaki']; ?></option>
                    <?php  } ?>
                </select>
            </div>
        </div>
        <div class="dt_muzaki">

        </div>
        <div class="form-group row">
            <div class="col-sm-5 col-form-label text-sm-left pr-0">
                <label for="perorangan/lmbg" class="mb-0">Kategori</label>
            </div>
            <div class="col-sm-5">
                <select id="perorangan/lmbg" data-placeholder="Choose a state..." class=" form-control ktgHimpun" name="kategori_himpun" onchange="sKategori()" required>
                    <option value=""></option>
                    <?php foreach ($kategori as $key => $k) { ?>
                        <option value="<?= $k['id_ktg']; ?>"><?= $k['keterangan_ktg']; ?></option>
                    <?php  } ?>
                </select>
            </div>
        </div>
        <div class="form-group row subktg">
            <div class="div"></div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5 col-form-label text-sm-left pr-0">
                <label for="id-form-field-1" class="mb-0">Jumlah</label>
            </div>
            <div class="col-sm-5">
                <input class="form-control form-sm" type="number" name="jumlah_himpun" id="" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5 col-form-label text-sm-left pr-0">
                <label for="via" class="mb-0">Via</label>
            </div>
            <div class="col-sm-5">
                <select id="via" data-placeholder="Choose a state..." class=" form-control" name="via_himpun" required>
                    <option value=""></option>
                    <option value="transfer">Transfer</option>
                    <option value="tunai">Tunai</option>
                    <option value="barang">Barang</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5 col-form-label text-sm-left pr-0">
                <label for="id-form-field-1" class="mb-0">Tgl Setor Bank</label>
            </div>
            <div class="col-sm-5">
                <input class="form-control form-sm" type="date" name="tgl_setor_bank" id="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5 col-form-label text-sm-left pr-0">
                <label for="id-form-field-1" class="mb-0">No Kwitansi Bank</label>
            </div>
            <div class="col-sm-5">
                <input class="form-control form-sm" type="text" name="no_kwitansi_bank" id="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5 col-form-label text-sm-left pr-0">
                <label for="id-form-field-1" class="mb-0">Nama Bank</label>
            </div>
            <div class="col-sm-5">
                <select id="perorangan/lmbg" data-placeholder="Choose a state..." class=" form-control" name="nama_bank">
                    <option value=""></option>
                    <option value="BJS">BJS</option>
                    <option value="BCA">BCA</option>
                    <option value="Jateng">Bank Jateng Syariah</option>
                </select>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> | Simpan</button>
    </div>
    <?= form_close(); ?>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open_multipart("", ['class' => 'formUnggahExcel']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body bdmdl">
                <p>Pilih file excel</p>
                <input type="file" class="form-control" name="file_excel">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnAjukan">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    function sMuzaki() {
        var idMuzaki = $(".cMuzaki").val();
        $.ajax({
            url: "<?= site_url('dynamic/load_dt_muzaki'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                email: idMuzaki
            },
            success: function(response) {
                $(".dt_muzaki").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Load slect sub kategori
    function sKategori() {
        var id = $(".ktgHimpun").val();
        $.ajax({
            url: "<?= site_url('dynamic/load_select_subktg_himpun'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function(response) {
                $(".subktg").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('.formUnggahExcel').submit(function(e) {
            e.preventDefault();
            let form = $('.formUnggahExcel')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('admin/do_simpan_himpun_excel'); ?>",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.bdmdl').html('<p><i class="fa fa-spin fa-spinner"></i> Proses mengunggah file...</p>');
                    $('.btnAjukan').prop('disabled', true);
                    $('.btnAjukan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {

                },
                success: function(response) {
                    if (response.success == true) {
                        iziToast.success({
                            title: 'Berhasil!',
                            message: response.pesan,
                            position: 'topRight'
                        });
                        // loadTabel($(".mk").val(), $(".p").val());
                    } else {
                        iziToast.error({
                            title: 'Gagal!',
                            message: response.pesan,
                            position: 'topRight'
                        });
                    }

                    $('.btnAjukan').prop('disabled', false);
                    $('.btnAjukan').html("Simpan");
                    $('.bdmdl').html(`<p>Pilih file excel</p><input type="file" class="form-control flupload" name="file_excel">`);
                    $("input[name='csrf_test_name']").val(response.token);
                    $("#exampleModal").modal('hide');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>

<?= $this->endSection(); ?>