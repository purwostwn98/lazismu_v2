<div class="form-group row">
    <div class="col-sm-5 col-form-label text-sm-left pr-0">
        <label for="id-form-field-1" class="mb-0">Alamat</label>
    </div>
    <div class="col-sm-7">
        <input class="form-control form-sm" type="text" name="alamat_muzaki" id="" value="<?= $dt['alamat_muzaki']; ?>" readonly>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-5 col-form-label text-sm-left pr-0">
        <label for="id-form-field-1" class="mb-0">Telp/Wa</label>
    </div>
    <div class="col-sm-5">
        <input class="form-control form-sm" type="text" name="telp_muzaki" id="" value="<?= $dt['tlp_muzaki']; ?>" readonly>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-5 col-form-label text-sm-left pr-0">
        <label for="id-form-field-1" class="mb-0">Email</label>
    </div>
    <div class="col-sm-5">
        <input class="form-control form-sm" type="text" name="email_muzaki" id="" value="<?= $dt['email_muzaki']; ?>" readonly>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-5 col-form-label text-sm-left pr-0">
        <label for="perorangan/lmbg" class="mb-0">Perorangan/lembaga</label>
    </div>
    <div class="col-sm-5">
        <select id="perorangan/lmbg" data-placeholder="Choose a state..." class=" form-control jMuzaki" name="jenis_muzaki" disabled required>
            <option <?= ($dt['jenis_muzaki'] == null) ? 'selected' : ''; ?> value=""></option>
            <option <?= ($dt['jenis_muzaki'] == 'Laki-laki') ? 'selected' : ''; ?> value="Laki-laki">Laki-laki</option>
            <option <?= ($dt['jenis_muzaki'] == 'Perempuan') ? 'selected' : ''; ?> value="Perempuan">Perempuan</option>
            <option <?= ($dt['jenis_muzaki'] == 'Lembaga') ? 'selected' : ''; ?> value="Lembaga">Lembaga</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-5 col-form-label text-sm-left pr-0">
        <label for="dsn" class="mb-0">Dosen UMS</label>
    </div>
    <div class="col-sm-5">
        <select id="dsn" data-placeholder="Choose a state..." class=" form-control isdsn" name="is_dosen" disabled required>
            <option <?= ($dt['is_dosen'] == 0) ? 'selected' : ''; ?> value="0">Tidak</option>
            <option <?= ($dt['is_dosen'] == 1) ? 'selected' : ''; ?> value="1">Ya</option>
        </select>
    </div>
</div>