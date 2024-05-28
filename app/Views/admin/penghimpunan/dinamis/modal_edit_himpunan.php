<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content border-width-0 border-t-4 brc-warning-m2 px-3">
            <div class="modal-header py-2">
                <i class="bgc-white fas fa-edit-circle mb-n4 mx-auto fa-3x text-orange-m2"></i>
            </div>
            <?= form_open("/admin/do_edit_penghimpunan", ['class' => 'formulir_edit_himpunan']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body text-center">
                <p class="text-primary-d1 text-130 mt-3">
                    Form Edit Himpunan
                </p>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Via</label>
                    </div>
                    <div class="col-sm-12">
                        <select name="via_himpun" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-11" required disabled>
                            <option <?= ($himpun['via_himpun'] == 'transfer') ? "selected" : ""; ?> value="transfer">Transfer</option>
                            <option <?= ($himpun['via_himpun'] == 'tunai') ? "selected" : ""; ?> value="tunai">Tunai</option>
                            <option <?= ($himpun['via_himpun'] == 'barang') ? "selected" : ""; ?> value="barang">Barang</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Jumlah</label>
                    </div>
                    <div class="col-sm-12">
                        <input name="jumlah_himpun" type="text" class="form-control" id="id-form-field-1" value="<?= $himpun['jumlah_himpun']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-2" class="mb-0">Tgl Setor Bank</label>
                    </div>
                    <div class="col-sm-7">
                        <input class="form-control form-sm" type="date" name="tgl_setor_bank" value="<?= $himpun['tgl_setor_bank']; ?>" id="id-form-field-2">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-3" class="mb-0">No Kwitansi Bank</label>
                    </div>
                    <div class="col-sm-7">
                        <input class="form-control form-sm" type="text" name="kwitansi_bank" value="<?= $himpun['kwitansi_bank']; ?>" id="id-form-field-3">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="perorangan/lmbg" class="mb-0">Nama Bank</label>
                    </div>
                    <div class="col-sm-7">
                        <select id="perorangan/lmbg" data-placeholder="Choose a state..." class=" form-control" name="nama_bank">
                            <option <?= ($himpun['nm_bank'] == 'BJS') ? "selected" : ""; ?> value="BJS">BJS</option>
                            <option <?= ($himpun['nm_bank'] == 'BCA') ? "selected" : ""; ?> value="BCA">BCA</option>
                            <option <?= ($himpun['nm_bank'] == 'Jateng') ? "selected" : ""; ?> value="Jateng">Bank Jateng Syariah</option>
                        </select>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id_himpun" value="<?= $himpun['id_himpun']; ?>" id="">
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