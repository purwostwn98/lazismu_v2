<!-- Add Mustahik B1 modal -->
<div class="modal fade modal-lg" id="addMustahikModal" tabindex="-1" role="dialog" aria-labelledby="addMustahikModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bgc-info">
                <h5 class="modal-title" id="addMustahikModalLabel">Form B1 (Calon Mustahik)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart("/admin/addMustahik", ['class' => 'formulir_add_mustahik']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="ajuan_mustahik" id="" value="<?= $nomor_ajuan; ?>">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <label for=""><b>NIK</b></label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" class="form-control nik_individu" id="form-field-mask-1" inputmode="text" name="nik_mustahik" required>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" id="cariMustahik" type="button"><i class="fa fa-calendar mr-1"></i> Cari!</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
                <div class="form_mustahik"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn_st">Simpan Calon Mustahik</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>
    $("#cariMustahik").on("click", function() {
        var nik = $('.nik_individu').val();
        $.ajax({
            url: "<?= site_url('dynamic/cek_form_mustahik'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                nik_mustahik: nik
            },
            success: function(response) {
                $('.form_mustahik').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

    })

    $('.prov_select').change(function() {
        var id_provinsi = $('.prov_select').val();
        // alert(id_provinsi);
        $.ajax({
            url: "<?= site_url('dynamic/load_kabupaten'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_provinsi: id_provinsi
            },
            success: function(response) {
                $('.kabupaten_select').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>