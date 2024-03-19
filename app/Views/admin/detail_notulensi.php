<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<?php
$bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
?>
<div class="page-content container">
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between bgc-info">
        <div class="col-auto">
            <h1 class="page-title text-dark">
                <b>Detail Notulensi</b>
            </h1>
        </div>
        <div class="col-auto">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <label for="">Hari/Tanggal</label>
            </div>
            <div class="col-md-6">
                <?= $nama_hari . ", " . $tgl_mulai; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Jam mulai</label>
            </div>
            <div class="col-md-6">
                <?= $r_notulensi['jam_mulai']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Pemimpin Rapat</label>
            </div>
            <div class="col-md-6">
                <?= $r_notulensi['pemimpin_rapat']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="/admin/detail_notulensi" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#b3Modal"><i class="fa fa-plus"></i> | Tambah Agenda</a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <?php if (session()->getFlashdata('gagal')) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('gagal'); ?>
                    </div>
                <?php } elseif (session()->getFlashdata('berhasil')) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('berhasil'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <hr>
        <input type="hidden" name="" id="idnotulensi" value="<?= $r_notulensi['id']; ?>">
        <div class="row">
            <div class="col-12">
                <p class="text-center"><b>Daftar Agenda</b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-2">
                    <div class="card-header d-sm-flex align-items-center justify-content-between bgc-primary">
                        <h6 class="m-0 font-weight-bold text-white p-0">1. Proposal Masuk</h6>
                        <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modalPilihAjuan">
                            <i class="fa fa-plus text-110 mr-1 p-0"></i> Tambah data ajuan
                        </button>
                    </div>
                    <div class="card-body" style="font-size: 13px;">
                        <div class="row">
                            <div class="col-12">
                                <table id="simple-table" class="table table-bordered table-bordered-x table-responsive text-dark-m2">
                                    <thead class="text-dark-m3 bgc-grey-l4">
                                        <tr>
                                            <th class="text-center">No Ajuan</th>
                                            <th class="text-center">Tgl Ajaun</th>
                                            <th class="text-center">Mustahik</th>
                                            <th class="text-center">Keputusan</th>
                                            <th class="text-center">Nominal</th>
                                            <th class="text-center">Sumber Dana</th>
                                            <th class="text-center">Asnaf/Kategori</th>
                                            <th class="text-center">Via</th>
                                            <th class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bdAjuan">
                                        <tr>
                                            <td class="text-center"><a href="#">37774492</a></td>
                                            <td>SDN Ngemplak Mojosongo Jebres</td>
                                            <td class="text-center">Diterima</td>
                                            <td>Rp 10.000.000,-</td>
                                            <td class="text-center">Zakat</td>
                                            <td class="text-center">Fakir</td>
                                            <td>Uang Tunai</td>
                                            <td>Uang Tunai</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (empty($agenda)) { ?>
            <div class="row">
                <div class="col-12">
                    <p class="text-center">Belum ada agenda rapat tersimpan</p>
                </div>
            </div>
        <?php  } else { ?>
            <?php foreach ($agenda as $key => $v) { ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-2">
                            <div class="card-header d-sm-flex align-items-center justify-content-between bgc-secondary">
                                <h6 class="m-0 font-weight-bold text-white p-0"><?= $key + 2 . ". " . $v['nama_agenda']; ?></h6>
                                <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" onclick="editAgenda('<?= $v['id']; ?>')">
                                    <i class="fa fa-edit text-110 mr-1 p-0"></i> Edit Agenda
                                </button>
                            </div>
                            <div class="card-body" style="font-size: 13px;">
                                <div class="row">
                                    <div class="col-12">
                                        <?= $v['catatan_agenda']; ?>
                                    </div><!-- /.col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
        <?= form_open("/admin/do_simpan_update_notulensi", ['class' => 'div']); ?>
        <?= csrf_field(); ?>
        <input type="hidden" name="idnotulensi" value="<?= $r_notulensi['id']; ?>">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Jam selesai</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <?php if ($r_notulensi['jam_selesai'] != null) {
                                        $explode = explode(":", $r_notulensi['jam_selesai']);
                                        $jam_selesai = $explode[0] . ":" . $explode[1];
                                    } ?>
                                    <input type="time" class="form-control col-sm-12  border-left-info animated--grow-in" name="jam_selesai" id="jam_selesai" value="<?= ($r_notulensi['jam_selesai'] != null) ? $jam_selesai : ""; ?>">
                                    <p class="text-danger text-sm error_nama_lembaga"><i></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="">Catatan</label>
                            </div>
                            <div class="col-md-9">
                                <div class="card brc-success-tp2">
                                    <div class="card-body p-0">
                                        <textarea id="summernote" name="catatan_notulensi"><?= ($r_notulensi['catatan_rapat'] != null) ? $r_notulensi['catatan_rapat'] : ""; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Notulen</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="notulen" id="notulen" value="<?= ($r_notulensi['notulen'] != null) ? $r_notulensi['notulen'] : ""; ?>">
                                    <p class="text-danger text-sm error_nama_lembaga"><i></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> | Simpan Notulensi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<!-- Agenda Modal -->
<div class="modal fade modal-lg" id="b3Modal" tabindex="-1" role="dialog" aria-labelledby="b3ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bgc-secondary">
                <h5 class="modal-title text-white" id="b3ModalLabel">Agenda Rapat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/admin/do_simpan_agenda", ['class' => 'div']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="idnotulensi" value="<?= $r_notulensi['id']; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Nama Agenda</label>
                    </div>
                    <div class="col-sm-7">
                        <input class="form-control form-sm" type="text" name="nama_agenda" id="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="id-form-field-1" class="mb-0">Pembahasan</label>
                    </div>
                    <div class="col-12">
                        <div class="card brc-success-tp2">
                            <div class="card-body p-0">
                                <textarea name="catatan_agenda" id="summernote2" name="editordata2"></textarea>
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

<!-- Modal Pilih Ajuan -->
<div class="modal fade modal-lg" id="modalPilihAjuan" tabindex="-1" role="dialog" aria-labelledby="modalPilihAjuanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bgc-warning">
                <h5 class="modal-title text-white" id="modalPilihAjuanLabel">Pilih Ajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Cari berdasarkan nomor ajuan</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="input-group mb-3">
                            <input type="text" id="inp_nomor_ajuan" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" onclick="cariAjuan()" id="button-addon2">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table style="font-size: 13px;" class="table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>No. Ajuan</th>
                                    <th>Tgl. Diajukan</th>
                                    <th>Pengaju</th>
                                    <th>Program</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="bAjuanCari">
                                <tr>
                                    <td colspan="4"> ... </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closePilihAjuan" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="mdlEditAgend"></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(window).on("load", readyFn);

    function readyFn(jQuery) {
        $(document).ready(function() {
            loadTabelAjuan();
        });
    }
</script>

<script>
    function loadTabelAjuan() {
        $.ajax({
            url: "<?= site_url('dynamic/load_tr_ajuan_notulensi'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                idnotulensi: $("#idnotulensi").val()
            },
            beforeSend: function() {
                $("#bdAjuan").html(`<tr><td colspan="8">Loading ...</td></tr>`)
            },
            success: function(response) {
                $("#bdAjuan").html(response.tr);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }

    function cariAjuan() {
        var nomor_ajuan = $("#inp_nomor_ajuan").val();
        if (nomor_ajuan == "") {
            $("#inp_nomor_ajuan").focus();
        } else {
            $.ajax({
                url: "<?= site_url('dynamic/load_tr_cari_ajuan'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    nomor_ajuan: nomor_ajuan
                },
                beforeSend: function() {
                    $("#bAjuanCari").html(`<tr><td colspan="4">Loading ...</td></tr>`)
                },
                success: function(response) {
                    $("#bAjuanCari").html(response.tr);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
        return false;
    }

    function PilihAjuan(nomor_ajuan) {
        var idnotulensi = $("#idnotulensi").val()
        $.ajax({
            url: "<?= site_url('dynamic/do_pilih_ajuan_notulensi'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                nomor_ajuan: nomor_ajuan,
                idnotulensi: idnotulensi,
            },
            beforeSend: function() {
                $(".pilih_" + nomor_ajuan).html(`<i class="fa fa-spin fa-spinner"></i>`)
            },
            success: function(response) {
                if (response.status == true) {
                    $(".pilih_" + nomor_ajuan).html(`Pilih`)
                    $(".closePilihAjuan").click();
                    loadTabelAjuan();
                } else {
                    alert("Gagal simpan");
                    $(".closePilihAjuan").click();
                    loadTabelAjuan();
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }
</script>

<script>
    function editAgenda(idagenda) {
        $.ajax({
            url: "<?= site_url('dynamic/load_modal_edit_agenda_notulensi'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                idagenda: idagenda
            },
            beforeSend: function() {
                $("#bAjuanCari").html(`<tr><td colspan="4">Loading ...</td></tr>`)
            },
            success: function(response) {
                $(".mdlEditAgend").html(response.modal);
                $("#editAgendaModal").modal("show");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }
</script>

<script>
    //Menghilangkan Alert
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $('#peringatan').css('display', 'none');
        });
    }, 10000);
</script>
<?= $this->endSection(); ?>