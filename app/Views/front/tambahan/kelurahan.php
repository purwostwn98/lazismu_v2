<div class="form-group has-danger">
    <select name="kelurahan" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kel_select">
        <option value="" disabled selected>Pilih Kelurahan/Desa</option>
        <?php foreach ($kelurahan as $kab) : ?>
            <option value="<?= $kab['id_kelurahan']; ?>"><?= $kab['nama_kelurahan']; ?></option>
        <?php endforeach; ?>
    </select>
</div>