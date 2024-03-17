<?php if ($bentuk == 2) { ?>
    <div class="form-group row">
        <div class="col-sm-5 col-form-label text-sm-left pr-0">
            <label for="id-form-field-1" class="mb-0">Rekening Penerima</label>
        </div>
        <div class="col-sm-7">
            <input name="rekening_penyerahan" type="text" class="form-control" id="id-form-field-1" required>
        </div>
    </div>
<?php } elseif ($bentuk >= 3) { ?>
    <div class="form-group row">
        <div class="col-sm-5 col-form-label text-sm-left pr-0">
            <label for="id-form-field-1" class="mb-0">Nama Barang</label>
        </div>
        <div class="col-sm-7">
            <input name="nama_barang" type="text" class="form-control" id="id-form-field-1" required>
        </div>
    </div>
<?php } ?>
<div class="form-group row">
    <div class="col-sm-5 col-form-label text-sm-left pr-0">
        <label for="id-form-field-1" class="mb-0">Nilai bantuan (dalam Rp)</label>
    </div>
    <div class="col-sm-7">
        <input type="text" class="form-control" name="nilai_penyerahan" id="inputku" placeholder="-" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
    </div>
</div>


<script type="text/javascript" src="<?= base_url(); ?>/application/js/ribuanNominal.js"></script>