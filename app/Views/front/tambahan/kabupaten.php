<div class="form-group has-danger">
    <select name="kabupaten" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kab_select">
        <option value="" disabled selected>Pilih Kabupaten/Kota</option>
        <?php foreach ($kabupaten as $kab) : ?>
            <option value="<?= $kab['id_kabupaten']; ?>"><?= $kab['nama_kabupaten']; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
    $('.kab_select').change(function() {
        var id_kabupaten = $('.kab_select').val();
        // alert(id_kecamatan);
        $.ajax({
            url: "<?= site_url('dynamic/load_kecamatan'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_kabupaten: id_kabupaten
            },
            success: function(response) {
                $('.kecamatan_select').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>