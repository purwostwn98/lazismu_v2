<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<div class="page-content container">
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-center justify-content-between">
        <h1 class="page-title text-primary-d2">
            Program
        </h1>
        <div class="col-auto">
            <button type="button" class="btn btn-secondary waves-effect waves-light" onclick="history.back()">
                <i class="fa fa-arrow-left text-110 mr-1"></i> Kembali
            </button>
            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#tambahModal">
                <i class="fa fa-plus text-110 mr-1"></i> Tambah Program
            </button>
        </div>
    </div>
    <div class="bgc-white p-2">
        <div class="page-tools pt-1 mt-3 mt-sm-0 mb-sm-n1"></div>
        <div class="row">
            <div class="col-md-12" style="font-size: 13px">
                <div class="table-responsive-md">
                    <table id="datatable" class="table table-border-y text-dark-m2 text-95 border-y-1 brc-secondary-l1">
                        <thead class="text-secondary-m2 text-uppercase text-85">
                            <tr>
                                <th class="border-0 bgc-h-default-l3">No.</th>
                                <th class="border-0 bgc-h-default-l3">Nama Program</th>
                                <th class="border-0 bgc-h-default-l3">Deskripsi Program</th>
                                <th class="border-0 bgc-h-default-l3">Jenis Formulir</th>
                                <th class="border-0 bgc-h-default-l3">Status</th>
                                <th class="border-0 bgc-h-default-l3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_program as $program) : ?>
                                <tr class="d-style bgc-h-default-l4">
                                    <td>
                                        <span class="text-105"><?= $no++; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $program['nama_program']; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $program['deskripsi_program']; ?></span>
                                    </td>
                                    <?php
                                    if ($program['jenis_formulir'] == 1) {
                                        $jenis_formulir = 'Individu';
                                    } elseif ($program['jenis_formulir'] == 2) {
                                        $jenis_formulir = 'Sekolah';
                                    } elseif ($program['jenis_formulir'] == 3) {
                                        $jenis_formulir = 'Usaha';
                                    } elseif ($program['jenis_formulir'] == 4) {
                                        $jenis_formulir = 'Masjid';
                                    } elseif ($program['jenis_formulir'] == 0) {
                                        $jenis_formulir = 'Lainnya (upload mandiri)';
                                    }
                                    ?>
                                    <td>
                                        <span class="text-105"><?= $jenis_formulir; ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge <?= ($program['status_program'] == 1) ? 'badge-success' : 'badge-secondary'; ?> arrowed-in radius-0" class="text-105"><?= ($program['status_program'] == 1) ? 'Aktif' : 'Tidak Aktif'; ?></span>
                                    </td>
                                    <td class="text-grey">
                                        <div class="row">
                                            <div class="col-auto">
                                                <a data-rel="tooltip" title="Lihat Syarat" href="/admin/halaman_syarat/<?= $program['id_program']; ?>"><i class="fa fa-eye text-blue-m1 text-120"></i></a>
                                            </div>
                                            <div class="col-auto">
                                                <input type="hidden" class="csrf_input" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                <a data-rel="tooltip" title="Edit program" role="button" class="edit_program" onclick="edit_program(<?= $program['id_program']; ?>)"><i class="fa fa-edit text-orange-m1 text-120"></i></a>
                                                <a data-rel="tooltip" title="Hapus program" role="button" class="hapus_program" onclick="hapus_program(<?= $program['id_program']; ?>)"><i class="fa fa-trash text-danger-m1 text-120"></i></a>
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
<!-- Modal tambah program -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-width-0 border-t-4 brc-warning-m2 px-3">
            <div class="modal-header py-2">
                <i class="bgc-white fas fa-edit-circle mb-n4 mx-auto fa-3x text-orange-m2"></i>
            </div>
            <?= form_open("/admin/tambah_program", ['class' => 'formulir_tambah_program']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_kategori" value="<?= $id_kategori; ?>">
            <div class="modal-body text-center">
                <p class="text-primary-d1 text-130 mt-3">
                    Tambah Program
                </p>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Nama Program</label>
                    </div>
                    <div class="col-sm-12">
                        <input name="nama_program" type="text" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Deskripsi Program</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea name="deskripsi_program" class="form-control" id="id-textarea-autosize" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 86px;"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Jenis Formulir</label>
                    </div>
                    <div class="col-sm-12">
                        <select name="jenis_formulir" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-11" required>
                            <option value="" selected disabled>Pilih formulir</option>
                            <option value="1">Formulir Individu</option>
                            <option value="2">Formulir Sekolah</option>
                            <option value="3">Formulir Usaha</option>
                            <option value="4">Formulir Masjid</option>
                            <option value="0">Formulir Lainnya (upload sendiri)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Status</label>
                    </div>
                    <div class="col-sm-12">
                        <select name="status_program" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-11" required>
                            <option value="" selected disabled>Pilih status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
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

<div class="modal_edit">

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">
    function edit_program(params) {
        $.ajax({
            url: "<?= site_url('dynamic/form_edit_program'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id_program: params
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
    function hapus_program(params) {
        Swal.fire({
                title: 'Are you sure?',
                html: "Anda yakin menghapus program ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan!'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
                    var csrfHash = $('.csrf_input').val(); // CSRF hash
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('admin/hapus_program'); ?>",
                        data: {
                            id_program: params,
                            [csrfName]: csrfHash
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('.hapus_program').prop('disabled', true);
                            $('.hapus_program').html('<i class="fa fa-spin fa-spinner"></i>');
                        },
                        complete: function() {
                            $('.hapus_program').prop('disabled', false);
                            $('.hapus_program').html("<i class='fa fa-trash text-danger-m1 text-120'></i>");
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
        $('.formulir_tambah_program').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                    title: 'Are you sure?',
                    html: "Anda yakin untuk menyimpan perubahan?",
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
                            url: $(".formulir_tambah_program").attr('action'),
                            data: $(".formulir_tambah_program").serialize(),
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