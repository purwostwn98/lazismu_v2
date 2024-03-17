<div class="form-group has-danger">
    <select name="kecamatan" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kec_select">
        <option value="" disabled selected>Pilih Kecamatan</option>
        <?php foreach ($kecamatan as $kab) : ?>
            <option value="<?= $kab['id_kecamatan']; ?>"><?= $kab['nama_kecamatan']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
    $('.kec_select').change(function() {
        var id_kecamatan = $('.kec_select').val();
        // alert(id_kecamatan);
        $.ajax({
            url: "<?= site_url('dynamic/load_kelurahan'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_kecamatan: id_kecamatan
            },
            success: function(response) {
                $('.kelurahan_select').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>