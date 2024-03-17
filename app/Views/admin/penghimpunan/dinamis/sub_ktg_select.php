<div class="col-sm-5 col-form-label text-sm-left pr-0">
    <label for="subktgid" class="mb-0">Keterangan</label>
</div>
<div class="col-sm-5">
    <select id="subktgid" data-placeholder="Choose a state..." class=" form-control" name="subktg_himpun" required>
        <option value="" disabled></option>
        <?php foreach ($dt as $key => $v) { ?>
            <option value="<?= $v['id_sub_ktg']; ?>"><?= $v['keterangan_sub']; ?></option>
        <?php  } ?>
    </select>
</div>