<div class="modal modal-lg fade" id="editDeskripsiModal" tabindex="-1" role="dialog" aria-labelledby="editDeskripsiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeskripsiModalLabel">Upload File Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/admin/do_edit_deskripsi", ['class' => 'formulir_tersalurkan']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $ajuan_row['id_ajuan']; ?>">
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Deskripsi</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea cols="60" name="deskripsi" id="" rows="7"><?= $ajuan_row['deskripsi_ajuan']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn_st">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('.formulir_tersalurkan').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('admin/do_edit_deskripsi'); ?>",
            type: "POST",
            dataType: "json",
            data: $(".formulir_tersalurkan").serialize(),
            success: function(response) {
                Swal.fire({
                    title: 'Berhasil',
                    text: "Deskripsi berhasil diedit",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    });
</script>