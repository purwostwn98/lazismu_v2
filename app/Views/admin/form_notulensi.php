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
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between">
        <div class="col-auto">
            <h1 class="page-title text-dark">
                Buat Notulensi Baru
            </h1>
        </div>
        <div class="col-auto">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <label for="">Hari/Tanggal</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <input type="date" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_lembaga" id="namaLbg" value="">
                    <p class="text-danger text-sm error_nama_lembaga"><i></i></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Jam mulai</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <input type="time" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_lembaga" id="namaLbg" value="">
                    <p class="text-danger text-sm error_nama_lembaga"><i></i></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Pemimpin Rapat</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_lembaga" id="namaLbg" value="">
                    <p class="text-danger text-sm error_nama_lembaga"><i></i></p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <a href="/admin/detail_notulensi" class="btn btn-sm btn-warning"><i class="fa fa-save"></i> | Simpan</a>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>