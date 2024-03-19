<div class="modal fade modal-lg" id="editAgendaModal" tabindex="-1" role="dialog" aria-labelledby="editAgendaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bgc-secondary">
                <h5 class="modal-title text-white" id="editAgendaModalLabel">Agenda Rapat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/admin/do_simpan_edit_agenda", ['class' => 'div']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="idagenda" value="<?= $r_agenda['id']; ?>">
            <input type="hidden" name="idnotulensi" value="<?= $r_agenda['idnotulensi']; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Nama Agenda</label>
                    </div>
                    <div class="col-sm-7">
                        <input class="form-control form-sm" type="text" name="nama_agenda" id="" value="<?= $r_agenda['nama_agenda']; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="id-form-field-1" class="mb-0">Pembahasan</label>
                    </div>
                    <div class="col-12">
                        <div class="card brc-success-tp2">
                            <div class="card-body p-0">
                                <textarea name="catatan_agenda" id="summernote3"><?= $r_agenda['catatan_agenda']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary bttn_simpan_agenda">Simpan Agenda</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $('#summernote3').summernote({
        height: 250,
        minHeight: 150,
        maxHeight: 400
    });
</script>