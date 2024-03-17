<div class="form-group has-danger">
    <select name="program" id="form-field-chosen-1" data-placeholder="Choose a state..." class="chosen-select form-control program_selects">
        <option value="" disabled selected>Pilih Program</option>
        <?php foreach ($data_program as $program) : ?>
            <option value="<?= $program['id_program']; ?>"><?= $program['nama_program']; ?></option>
        <?php endforeach; ?>
    </select>
    <p class="text-danger text-sm error_program"><i></i></p>
</div>

<script>
    $('.program_selects').change(function() {
        var id_program = $('.program_selects').val();
        $.ajax({
            url: "<?= site_url('dynamic/load_syarat_program'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_program: id_program
            },
            success: function(response) {
                $('.syarat_program').html(response.data);
                $('.download_template_formulir').html(response.data2);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>