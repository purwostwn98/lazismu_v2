<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-width-0 border-t-4 brc-warning-m2 px-3">
            <div class="modal-header py-2">
                <i class="bgc-white fas fa-edit-circle mb-n4 mx-auto fa-3x text-orange-m2"></i>
            </div>
            <?= form_open("/admin/do_edit_muzaki", ['class' => 'formulir_edit_muzaki']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body text-center">
                <p class="text-primary-d1 text-130 mt-3">
                    Form Edit Muzaki
                </p>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Nama Muzaki</label>
                    </div>
                    <div class="col-sm-12">
                        <input name="nama_muzaki" type="text" class="form-control" id="id-form-field-1" value="<?= $muzaki['nama_muzaki']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Alamat Lengkap</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea name="alamat_muzaki" class="form-control" id="id-textarea-autosize" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 86px;"><?= $muzaki['alamat_muzaki']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-2" class="mb-0">No. Telepon</label>
                    </div>
                    <div class="col-sm-12">
                        <input name="tlp_muzaki" type="text" class="form-control" id="id-form-field-2" value="<?= $muzaki['tlp_muzaki']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-3" class="mb-0">Email</label>
                    </div>
                    <div class="col-sm-12">
                        <input name="email_muzaki" value="<?= $muzaki['email_muzaki']; ?>" type="text" class="form-control" id="id-form-field-3" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Jenis Muzaki</label>
                    </div>
                    <div class="col-sm-12">
                        <select name="jenis_muzaki" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-11" required>
                            <option <?= ($muzaki['jenis_muzaki'] == 'Laki-laki') ? "selected" : ""; ?> value="Laki-laki">Laki-laki</option>
                            <option <?= ($muzaki['jenis_muzaki'] == 'Perempuan') ? "selected" : ""; ?> value="Perempuan">Perempuan</option>
                            <option <?= ($muzaki['jenis_muzaki'] == 'Lembaga') ? "selected" : ""; ?> value="Lembaga">Lembaga</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="form-field-select-12" class="mb-0">Apakah Dosen UMS</label>
                    </div>
                    <div class="col-sm-12">
                        <select name="is_dosen" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-12" required>
                            <option <?= ($muzaki['is_dosen'] == 0) ? "selected" : ""; ?> value="0" selected>Bukan</option>
                            <option <?= ($muzaki['is_dosen'] == 1) ? "selected" : ""; ?> value="1">Ya Dosen</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id_muzaki" value="<?= $muzaki['id_muzaki']; ?>" id="">
            <div class="modal-footer bg-white justify-content-between px-0 py-3">
                <button type="button" class="btn btn-md px-2 px-md-4 btn-light-secondary btn-h-light-warning btn-a-light-danger" data-dismiss="modal">
                    <i class="fas fa-undo-alt mr-1 text-danger-m2"></i>
                    Batal
                </button>
                <button type="submit" class="btn btn-md px-2 px-md-4 btn-light-secondary btn-h-light-success btn-a-light-success btnConfirm">
                    Simpan
                    <i class="fa fa-arrow-right ml-1 text-success-m2"></i>
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>