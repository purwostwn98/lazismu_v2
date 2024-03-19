<!-- B3 modal -->
<div class="modal fade modal-lg" id="b3Modal" tabindex="-1" role="dialog" aria-labelledby="b3ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bgc-info">
                <h5 class="modal-title" id="b3ModalLabel">Form B3</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/admin/do_simpan_b3", ['class' => 'formulir_b3']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="nomor_ajuan" id="" value="<?= $no_ajuan; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Dana dari</label>
                    </div>
                    <div class="col-sm-7">
                        <select name="dana_dari" class="form-control dana_dari" id="form-field-select-1" required onchange="loadAsnaf(this.value)">
                            <option value="" selected disabled></option>
                            <?php if (!empty($data)) { ?>
                                <option <?= ($data['dana_dari'] == 'Zakat') ? "selected" : ""; ?> value="Zakat">Zakat</option>
                                <option <?= ($data['dana_dari'] == 'Infaq Umum') ? "selected" : ""; ?> value="Infaq Umum">Infaq Umum</option>
                                <option <?= ($data['dana_dari'] == 'Amil') ? "selected" : ""; ?> value="Amil">Amil</option>
                                <option <?= ($data['dana_dari'] == 'Infaq Terikat') ? "selected" : ""; ?> value="Infaq Terikat">Infaq Terikat</option>
                                <option <?= ($data['dana_dari'] == 'DSKL') ? "selected" : ""; ?> value="DSKL">DSKL</option>
                            <?php } else { ?>
                                <option value="Zakat">Zakat</option>
                                <option value="Infaq Umum">Infaq Umum</option>
                                <option value="Amil">Amil</option>
                                <option value="Infaq Terikat">Infaq Terikat</option>
                                <option value="DSKL">DSKL</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Kategori Penerima/Asnaf</label>
                    </div>
                    <div class="col-sm-7 kategori_penerima">
                        <select name="kategori_penerima" class="form-control asnaf" id="form-field-select-1" required>
                            <?php if (empty($asnaf)) { ?>
                                <option value="" selected disabled>Pilih dana dari terlebih dahulu</option>
                            <?php  } else { ?>
                                <?php foreach ($asnaf as $key => $a) { ?>
                                    <option <?= ($a['id_kategori_penerima'] == $data['kategori_penerima']) ? "selected" : ""; ?> value="<?= $a['id_kategori_penerima']; ?>"><?= $a['ket_kategori_penerima']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Bentuk Penyerahan</label>
                    </div>
                    <div class="col-sm-7">
                        <select name="bentuk_penyerahan" class="form-control bentuk_penyerahan" id="form-field-select-1">
                            <?php if (empty($data)) { ?>
                                <option value="" selected disabled></option>
                                <?php foreach ($bentuk_bantuan as $bentuk) { ?>
                                    <option value="<?= $bentuk['id_bentuk_penyerahan']; ?>"><?= $bentuk['ket_bentuk_penyerahan']; ?></option>
                                <?php } ?>
                            <?php } else { ?>
                                <?php foreach ($bentuk_bantuan as $bentuk) { ?>
                                    <option <?= ($bentuk['id_bentuk_penyerahan'] == $data['bentuk_penyerahan']) ? "selected" : ""; ?> value="<?= $bentuk['id_bentuk_penyerahan']; ?>"><?= $bentuk['ket_bentuk_penyerahan']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="ket_bentuk">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn_simpan_b3" onclick="simpanB3()">Simpan B3</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    function loadAsnaf(params) {
        $.ajax({
            url: "<?= site_url('dynamic/load_sel_bentuk_penyerahan'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                sumber: params
            },
            success: function(response) {
                $('.asnaf').html(response.opt);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>