<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<div class="page-content container">
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-center justify-content-between">
        <h1 class="page-title text-primary-d2">
            Syarat Program
        </h1>
        <div class="col-auto">
            <button type="button" class="btn btn-secondary waves-effect waves-light" onclick="history.back()">
                <i class="fa fa-arrow-left text-110 mr-1"></i> Kembali
            </button>
            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#tambahModal">
                <i class="fa fa-plus text-110 mr-1"></i> Tambah Syarat
            </button>
        </div>
    </div>
    <div class="bgc-white p-2">
        <div class="page-tools pt-1 mt-3 mt-sm-0 mb-sm-n1"></div>
        <div class="row">
            <div class="col-md-12" style="font-size: 14px">
                <div class="table-responsive-md">
                    <table id="datatable" class="table table-border-y text-dark-m2 text-95 border-y-1 brc-secondary-l1">
                        <thead class="text-secondary-m2 text-uppercase text-85">
                            <tr>
                                <th class="border-0 bgc-h-default-l3">No.</th>
                                <th class="border-0 bgc-h-default-l3">Syarat</th>
                                <th class="border-0 bgc-h-default-l3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_syarat as $syarat) : ?>
                                <tr class="d-style bgc-h-default-l4">
                                    <td>
                                        <span class="text-105"><?= $no++; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $syarat['syarat_program']; ?></span>
                                    </td>
                                    <td class="text-grey">
                                        <div class="row">
                                            <input type="hidden" class="csrf_input" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                            <div class="col-auto">
                                                <a data-rel="tooltip" title="Edit syarat" role="button" class="edit_syarat" onclick="edit_syarat(<?= $syarat['id_syarat']; ?>)"><i class="fa fa-edit text-orange-m1 text-120"></i></a>
                                            </div>
                                            <div class="col-auto">
                                                <a data-rel="tooltip" title="Hapus syarat" role="button" class="hapus_syarat" onclick="hapus_syarat(<?= $syarat['id_syarat']; ?>)"><i class="fa fa-trash text-danger-m1 text-120"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal tambah syarat -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-width-0 border-t-4 brc-warning-m2 px-3">
            <div class="modal-header py-2">
                <i class="bgc-white fas fa-edit-circle mb-n4 mx-auto fa-3x text-orange-m2"></i>
            </div>
            <?= form_open("/admin/tambah_syarat", ['class' => 'formulir_tambah_syarat']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_program" value="<?= $id_program; ?>">
            <div class="modal-body text-center">
                <p class="text-primary-d1 text-130 mt-3">
                    Tambah Syarat
                </p>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Syarat Program</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea name="syarat_program" class="form-control" id="id-textarea-autosize" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 86px;" required></textarea>
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

<div class="modal_edit">

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">
    function edit_syarat(params) {
        $.ajax({
            url: "<?= site_url('dynamic/form_edit_syarat'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_syarat: params
            },
            success: function(response) {
                $('.modal_edit').html(response.data);
                $('#warningModal').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<script type="text/javascript">
    function hapus_syarat(params) {
        Swal.fire({
                title: 'Are you sure?',
                html: "Anda yakin menghapus syarat ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
                    var csrfHash = $('.csrf_input').val(); // CSRF hash
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('admin/hapus_syarat'); ?>",
                        data: {
                            id_syarat: params,
                            [csrfName]: csrfHash
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('.hapus_syarat').prop('disabled', true);
                            $('.hapus_syarat').html('<i class="fa fa-spin fa-spinner"></i>');
                        },
                        complete: function() {
                            $('.hapus_syarat').prop('disabled', false);
                            $('.hapus_syarat').html("<i class='fa fa-trash text-danger-m1 text-120'></i>");
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
    }
</script>

<script>
    $(document).ready(function() {
        $('.formulir_tambah_syarat').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                    title: 'Are you sure?',
                    html: "Anda yakin untuk menambah syarat?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Simpan!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: $(".formulir_tambah_syarat").attr('action'),
                            data: $(".formulir_tambah_syarat").serialize(),
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
<?= $this->endSection(); ?>