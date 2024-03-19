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
        <div class="col-6">
            <?php if (session()->getFlashdata('gagal')) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('gagal'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?= form_open("/admin/simpan_init_notulensi", ['class' => 'form_biodata col-md-9']); ?>
    <?= csrf_field(); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <label for="">Hari/Tanggal</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <input type="date" class="form-control col-sm-12  border-left-info animated--grow-in" name="tgl_rapat" id="namaLbg" value="" required>
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
                    <input type="time" class="form-control col-sm-12  border-left-info animated--grow-in" name="jam_mulai" id="namaLbg" value="" required>
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
                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="pemimpin_rapat" id="namaLbg" value="" required>
                    <p class="text-danger text-sm error_nama_lembaga"><i></i></p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-warning text-dark"><i class="fa fa-save"></i> | Simpan</button>
            </div>
        </div>
    </div>
    <?= form_close(); ?>

</div>


<?= $this->endSection(); ?>