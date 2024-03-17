<select name="kategori_penerima" class="form-control kategori_penerima" id="form-field-select-1" required>
    <option value="" selected disabled></option>
    <?php foreach ($ktg_penerima as $ktg) { ?>
        <option value="<?= $ktg['id_kategori_penerima']; ?>"><?= $ktg['ket_kategori_penerima']; ?></option>
    <?php } ?>
</select>