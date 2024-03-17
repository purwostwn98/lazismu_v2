<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-width-0 border-t-4 brc-warning-m2 px-3">
            <div class="modal-header py-2">
                <i class="bgc-white fas fa-edit-circle mb-n4 mx-auto fa-3x text-orange-m2"></i>
            </div>
            <?= form_open("/admin/simpan_edit_program", ['class' => 'formulir_edit_program']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_program" value="<?= $data_program['id_program']; ?>">
            <div class="modal-body text-center">
                <p class="text-warning-d1 text-130 mt-3">
                    Edit Program
                </p>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Nama Program</label>
                    </div>
                    <div class="col-sm-12">
                        <input name="nama_program" type="text" class="form-control" id="id-form-field-1" value="<?= $data_program['nama_program']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Deskripsi Program</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea name="deskripsi_program" class="form-control" id="id-textarea-autosize" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 86px;"><?= $data_program['deskripsi_program']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Jenis Formulir</label>
                    </div>
                    <div class="col-sm-12">
                        <select name="jenis_formulir" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-11" required>
                            <option value="" disabled>Pilih formulir</option>
                            <option <?= ($data_program['jenis_formulir'] == 1) ? 'selected' : ''; ?> value="1">Formulir Individu</option>
                            <option <?= ($data_program['jenis_formulir'] == 2) ? 'selected' : ''; ?> value="2">Formulir Lembaga</option>
                            <option <?= ($data_program['jenis_formulir'] == 3) ? 'selected' : ''; ?> value="3">Formulir Umum</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Status</label>
                    </div>
                    <div class="col-sm-12">
                        <select name="status_program" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-11" required>
                            <option value="" disabled>Pilih status</option>
                            <option <?= ($data_program['status_program'] == 1) ? 'selected' : ''; ?> value="1">Aktif</option>
                            <option <?= ($data_program['status_program'] == 0) ? 'selected' : ''; ?> value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white justify-content-between px-0 py-3">
                <button type="button" class="btn btn-md px-2 px-md-4 btn-light-secondary btn-h-light-warning btn-a-light-danger" data-dismiss="modal">
                    <i class="fas fa-undo-alt mr-1 text-danger-m2"></i>
                    Batal
                </button>
                <button type="submit" class="btn btn-md px-2 px-md-4 btn-light-secondary btn-h-light-success btn-a-light-success btnConfirm">
                    Simpan
                    <i class="fa fa-arrow-right ml-1 text-success-m2"></i>
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.formulir_edit_program').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                    title: 'Are you sure?',
                    html: "Anda yakin untuk menyimpan perubahan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya yakin!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: $(".formulir_edit_program").attr('action'),
                            data: $(".formulir_edit_program").serialize(),
                            dataType: "json",
                            beforeSend: function() {
                                $('.btnConfirm').prop('disabled', true);
                                $('.btnConfirm').html('<i class="fa fa-spin fa-spinner"></i>');
                            },
                            complete: function() {
                                $('.btnConfirm').prop('disabled', false);
                                $('.btnConfirm').html("Simpan <i class = 'fa fa-arrow-right ml-1 text-success-m2'></i>");
                            },
                            success: function(response) {
                                if (response.berhasil) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: response.berhasil.pesan,
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                    // $("input[name='csrf_test_name']").val(response.error.token);
                                }
                                if (response.gagal) {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: response.gagal.pesan,
                                        icon: 'error',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            }
                        });
                        return false;
                    } else {
                        return false;
                    }
                });
        });
    });
</script>