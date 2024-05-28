<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten");
$session = \Config\Services::session();
?>
<div class="page-content container">
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-sm-center justify-align-between">
        <h1 class="page-title text-primary-d2">
            Data Muzaki
        </h1>
        <div class="div">
            <a href="/admin/sinkron_dosen" class="btn btn-warning"> <i class="fas fa-cloud-download-alt"></i> Sinkronkan Dosen</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"> <i class="fas fa-plus"></i> Tambah Muzaki</button>
        </div>

    </div>
    <div class="bgc-white p-2">
        <div class="page-tools pt-1 mt-3 mt-sm-0 mb-sm-n1"></div>
        <div class="row">
            <div class="col-6">
                <?php if ($session->getFlashdata('gagal')) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $session->getFlashdata('gagal'); ?>
                    </div>
                <?php } elseif ($session->getFlashdata('berhasil')) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= $session->getFlashdata('berhasil'); ?>
                    </div>
                <?php  } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="font-size: 14px">
                <div class="table-responsive-md">
                    <table id="datatable" class="table table-border-y text-dark-m2 text-95 border-y-1 brc-secondary-l1">
                        <thead class="text-secondary-m2 text-uppercase text-85">
                            <tr>
                                <th class="border-0 bgc-h-default-l3">No.</th>
                                <th class="border-0 bgc-h-default-l3">ID</th>
                                <th class="border-0 bgc-h-default-l3">Nama</th>
                                <th class="border-0 bgc-h-default-l3">Alamat</th>
                                <th class="border-0 bgc-h-default-l3">No. Telp</th>
                                <th class="border-0 bgc-h-default-l3">Email</th>
                                <th class="border-0 bgc-h-default-l3">Perorangan/Lembaga</th>
                                <th class="border-0 bgc-h-default-l3">Dosen</th>
                                <th class="border-0 bgc-h-default-l3">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($muzaki as $i => $m) : ?>
                                <tr class="d-style bgc-h-default-l4">
                                    <td>
                                        <span class="text-105"><?= $i + 1; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $m['id_muzaki']; ?></span>
                                    </td>
                                    <td>
                                        <span class="text-105"><?= $m['nama_muzaki']; ?></span>
                                    </td>
                                    <td class="text-grey"><?= $m['alamat_muzaki']; ?></td>
                                    <td class="text-grey"><?= $m['tlp_muzaki']; ?></td>
                                    <td class="text-grey"><?= $m['email_muzaki']; ?></td>
                                    <td class="text-grey"><?= $m['jenis_muzaki']; ?></td>
                                    <td class="text-grey"><?= $m['is_dosen']; ?></td>
                                    <td class="text-grey">
                                        <button class="btn btn-sm text-primary" data-rel="tooltip" title="Edit" onclick="edit('<?= $m['id_muzaki']; ?>')"><i class="fa fa-edit text-blue-m1 text-120"></i></button>
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

<!-- Modal tambah muzaki -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-width-0 border-t-4 brc-warning-m2 px-3">
            <div class="modal-header py-2">
                <i class="bgc-white fas fa-edit-circle mb-n4 mx-auto fa-3x text-orange-m2"></i>
            </div>
            <?= form_open("/admin/do_tambah_muzaki", ['class' => 'formulir_tambah_muzaki']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body text-center">
                <p class="text-primary-d1 text-130 mt-3">
                    Tambah Data Muzaki
                </p>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Nama Muzaki</label>
                    </div>
                    <div class="col-sm-12">
                        <input name="nama_muzaki" type="text" class="form-control" id="id-form-field-1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Alamat Lengkap</label>
                    </div>
                    <div class="col-sm-12">
                        <textarea name="alamat_muzaki" class="form-control" id="id-textarea-autosize" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 86px;"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-2" class="mb-0">No. Telepon</label>
                    </div>
                    <div class="col-sm-12">
                        <input name="tlp_muzaki" type="text" class="form-control" id="id-form-field-2" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-3" class="mb-0">Email</label>
                    </div>
                    <div class="col-sm-12">
                        <input name="email_muzaki" type="text" class="form-control" id="id-form-field-3" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Jenis Muzaki</label>
                    </div>
                    <div class="col-sm-12">
                        <select name="jenis_muzaki" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-11" required>
                            <option value="" selected disabled>Pilih Jenis</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Lembaga">Lembaga</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label text-sm-left pr-0">
                        <label for="form-field-select-12" class="mb-0">Apakah Dosen UMS</label>
                    </div>
                    <div class="col-sm-12">
                        <select name="is_dosen" class="ace-select text-dark-m1 bgc-default-l5 bgc-h-warning-l3  brc-default-m3 brc-h-warning-m1 ini_status" id="form-field-select-12" required>
                            <option value="0" selected>Bukan</option>
                            <option value="1">Ya Dosen</option>
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
<!-- modal edit muzaki -->
<div class="modal-edit">
</div>
<input type="hidden" class="csrf_input" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    //Menghilangkan Alert
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $('#peringatan').css('display', 'none');
        });
    }, 5000);
</script>

<script>
    function edit(id) {
        $.ajax({
            url: "<?= site_url('dynamic/load_modal_edit_muzaki'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function(response) {
                $(".modal-edit").html(response.modal);
                $("#editModal").modal("show");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // function Doedit(id) {
    //     var csrfName = $('.csrf_input').attr('name'); // CSRF Token name
    //     var csrfHash = $('.csrf_input').val(); // CSRF hash
    //     $.ajax({
    //         url: "<?= site_url('dynamic/load_select_subktg_himpun'); ?>",
    //         type: "POST",
    //         dataType: "json",
    //         data: {
    //             id: id,
    //             [csrfName]: csrfHash
    //         },
    //         success: function(response) {
    //             $(".subktg").html(response.data);
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //         }
    //     });
    // }
</script>
<?= $this->endSection(); ?>