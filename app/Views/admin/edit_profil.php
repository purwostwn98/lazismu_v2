<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<?php
$session = \Config\Services::session();
?>
<div class="row container container-plus mx-auto mt-0 mb-4 justify-content-center">
    <div class="d-sm-flex col-12 align-items-center justify-content-center mb-3 mt-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Profil</h1>
    </div>
    <?= form_open("/admin/do_edit_user", ['class' => 'form_biodata col-md-9']); ?>
    <?= csrf_field(); ?>
    <input type="hidden" name="iduser" value="<?= $data_user['iduser']; ?>">
    <!-- Form Ajuan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-md-4">
                    <label for="">Nama</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <input type="text" class="form-control col-sm-12 col-md-12  border-left-info animated--grow-in" name="nama" id="nama" value="<?= $data_user['nama_user']; ?>">
                        <?php if ($session->getFlashdata('errorNama')) { ?>
                            <p class="text-danger text-sm error_nama"><i><?= $session->getFlashdata('errorNama'); ?></i></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-md-4">
                    <label for="">Username</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <input type="text" class="form-control col-sm-12 col-md-12  border-left-info animated--grow-in" name="username" id="username" value="<?= $data_user['username']; ?>" required>
                        <?php if ($session->getFlashdata('errorUsername')) { ?>
                            <p class="text-danger text-sm error_Username"><i><?= $session->getFlashdata('errorUsername'); ?></i></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-md-4">
                    <label for="">Password</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <input type="password" class="form-control col-sm-12 col-md-12  border-left-info animated--grow-in" name="password" id="password" required>
                        <?php if ($session->getFlashdata('errorPass01')) { ?>
                            <p class="text-danger text-sm error_nama"><i><?= $session->getFlashdata('errorPass01'); ?></i></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-md-4">
                    <label for="">Ulangi Password</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <input type="password" class="form-control col-sm-12 col-md-12  border-left-info animated--grow-in" name="password2" id="password2" required>
                        <?php if ($session->getFlashdata('errorPass02')) { ?>
                            <p class="text-danger text-sm error_nama"><i><?= $session->getFlashdata('errorPass02'); ?></i></p>
                        <?php } ?>
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
                <button type="submit" class=" pt-15 pb-2 active radius-round btn btn-md btn-outline-warning btn-h-light-warning btn-a-warning btndaftar" role="button" aria-selected="true">
                    <span class="icon text-white-50"> <i class="fas fa-check"></i> </span> Simpan
                </button>
            </p>
        </div>
    </div>
    <?= form_close(); ?>
</div>
<?= $this->endSection(); ?>