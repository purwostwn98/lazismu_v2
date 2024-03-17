<div class="form-group has-danger">
    <select name="kategori_program" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control kategori_selects">
        <option value="" disabled selected>Pilih Kategori Program</option>
        <?php foreach ($data_kategori as $program) : ?>
            <option value="<?= $program['id_kategori_program']; ?>"><?= $program['nama_kategori']; ?></option>
        <?php endforeach; ?>
    </select>
    <p class="text-danger text-sm error_kategori"><i></i></p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('.kategori_selects').change(function() {
        var id_kategori = $('.kategori_selects').val();
        $.ajax({
            url: "<?= site_url('dynamic/select_program'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_kategori: id_kategori
            },
            success: function(response) {
                $('.select_program').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>