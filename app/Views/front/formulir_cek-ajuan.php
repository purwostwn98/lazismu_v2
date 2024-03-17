<?= $this->extend("/layout/template_front.php"); ?>
<?= $this->section("konten"); ?>
<div class="row container container-plus mx-auto mt-0 mb-4 justify-content-center">
    <!-- <div class="d-sm-flex col-12 align-items-center justify-content-center mb-3 mt-4">
        <h1 class="h3 mb-0 text-gray-800">Formulir Biodata</h1>
    </div> -->
    <?= form_open("/pemohon/proses_cekajuan", ['class' => 'cek_ajuan col-md-9 mt-4']); ?>
    <?= csrf_field(); ?>
    <!-- Form Ajuan -->
    <div class="card shadow mb-4 mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cek Ajuan</h6>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-warning" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="">Nomor Induk Kependudukan</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-group has-danger">
                        <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nik" id="namaLbg" value="">
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for="">Nomor Ajuan</label>
                </div>
                <div class="col-sm-6">
                    <div class="form-group has-danger">
                        <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nomor_ajuan" id="namaLbg" value="">
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                    <label for=""><?= $text; ?></label>
                </div>
                <div class="col-sm-6">
                    <div class="form-group has-danger">
                        <input type="number" class="form-control col-sm-12  border-left-info animated--grow-in" name="jawabCpt" id="jawaban" value="">
                        <input type="hidden" name="hslbenar" class="form-control" value="<?= md5($hasil); ?>">
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 justify-content-right">
            <p class="text-right pt-2">
                <a href="/" class=" pt-15 pb-2 radius-round active btn btn-md btn-outline-secondary btn-h-light-secondary btn-a-secondary" role="button" aria-selected="true">
                    <span class="icon text-white-50"> <i class="fas fa-times"></i> </span> Batal
                </a>
                <button type="submit" href="/front/formulir_ajuan" class=" pt-15 pb-2 active radius-round btn btn-md btn-outline-warning btn-h-light-warning btn-a-warning" role="button" aria-selected="true">
                    <span class="icon text-white-50"> <i class="fas fa-check"></i> </span> Masuk
                </button>
            </p>
        </div>
    </div>
    <?= form_close(); ?>
</div>
<?= $this->endSection(); ?>