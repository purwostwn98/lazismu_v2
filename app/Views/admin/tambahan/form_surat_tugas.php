<?php for ($i = 0; $i < $jumlah; $i++) { ?>
    <div class="form-group row">
        <div class="col-sm-5 col-form-label text-sm-left pr-0">
            <label for="id-form-field-1" class="mb-0">Nama delegasi <?= $i + 1; ?></label>
        </div>
        <div class="col-sm-7">
            <input name="nama_delegasi[]" type="text" class="form-control" id="id-form-field-1">
        </div>
    </div>
<?php } ?>