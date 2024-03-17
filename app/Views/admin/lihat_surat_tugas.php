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
    <div class="page-header pb-2 flex-column flex-sm-row align-items-start align-items-center justify-content-between">
        <h1 class="page-title text-primary-d2">
            Surat Tugas <?= $surat_tugas['nomor_ajuan']; ?>
        </h1>
        <div class="div">
            <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus text-110 mr-1"></i> Upload Surat Tugas
            </button>
            <?php if ($surat_tugas['file_surat_tugas'] != "") { ?>
                <a href="<?= base_url(); ?>/file_surat_tugas/<?= $surat_tugas['file_surat_tugas']; ?>" class="btn btn-success waves-effect waves-light" target="_blank">
                    <i class="fa fa-file text-110 mr-1"></i> Lihat Surat Tugas
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="bgc-white">
        <div class="p-3">
            <div class="row py-1">
                <div class="col-6">
                    Nama yang bertanda tangan
                </div>
                <div class="col-6">
                    : <?= $surat_tugas['nama_penanggung_jawab']; ?>
                </div>
            </div>

            <div class="row py-1">
                <div class="col-6">
                    Jabatan
                </div>
                <div class="col-6">
                    : <?= $surat_tugas['jabatan']; ?>
                </div>
            </div>

            <div class="row py-1">
                <div class="col-6">
                    Berdasarkan
                </div>
                <div class="col-6">
                    : <?= $surat_tugas['berdasarkan']; ?>
                    <?php if ($surat_tugas['berdasarkan'] == 'Rapat Pengurus' && $data_ajuan['status_ajuan'] >= 3 && $tanggal_rapat != 'belum rapat bos') { ?>
                        <?php
                        $waktu = explode(' ', $tanggal_rapat);
                        $tgl = explode('-', $waktu[0])
                        ?>
                        pada tanggal <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?>
                    <?php } ?>
                </div>
            </div>

            <div class="row py-1">
                <div class="col-6">
                    Memberikan tugas Kepada
                </div>
                <div class="col-6">
                    <?php foreach ($nama_delegasi as $d => $dlg) { ?>
                        : <?= $d + 1 . '. ' . $dlg['nama_delegasi']; ?><br>
                    <?php } ?>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-6">
                    Agenda
                </div>
                <div class="col-6">
                    : <?= $surat_tugas['agenda']; ?>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-6">
                    Tanggal Mulai
                </div>
                <div class="col-6">
                    <?php $tgl_ml = explode('-', $surat_tugas['tanggal_mulai']); ?>
                    : <?= $tgl_ml[2] . ' ' . $bulan[(int)$tgl_ml[1]] . ' ' . $tgl_ml[0]; ?>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-6">
                    Tanggal Selesai
                </div>
                <div class="col-6">
                    <?php $tgl_sl = explode('-', $surat_tugas['tanggal_selesai']); ?>
                    : <?= $tgl_sl[2] . ' ' . $bulan[(int)$tgl_sl[1]] . ' ' . $tgl_sl[0]; ?>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-6">
                    Tempat/Lokasi
                </div>
                <div class="col-6">
                    : <?= $surat_tugas['lokasi']; ?>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col text-center">
                    <button onclick="history.back()" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-arrow-left"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </button>
                    <a href="/admin/pdf_surat_tugas/<?= $surat_tugas['id_surat_tugas']; ?>" class="btn btn-danger btn-icon-split" target="_blank">
                        <span class="icon text-white-50">
                            <i class="fa fa-file-pdf"></i>
                        </span>
                        <span class="text">Cetak Surat Tugas</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Upload Surat Tugas -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open("/admin/simpan_file_surat_tugas", ['class' => 'formulir_surat_tugas']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_surat_tugas" id="" value="<?= $surat_tugas['id_surat_tugas']; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">File Surat Tugas (pdf/jpg/png)</label>
                    </div>
                    <div class="col-md-12">
                        <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_surat_tugas" name="file_surat_tugas" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn_st">Submit</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.formulir_surat_tugas').submit(function(e) {
            e.preventDefault();
            let form = $('.formulir_surat_tugas')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('admin/simpan_file_surat_tugas'); ?>",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btn_st').prop('disabled', true);
                    $('.btn_st').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn_st').prop('disabled', false);
                    $('.btn_st').html("Submit");
                },
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.error.file_surat_tugas,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("input[name='csrf_test_name']").val(response.error.token);
                            }
                        });
                    }
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
                    } else if (response.gagal) {
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
        });
    });
</script>

<?= $this->endSection(); ?>