<?= $this->extend("/layout/template_back.php"); ?>
<?= $this->section("konten"); ?>
<?php
$session = \Config\Services::session();
?>
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
            Berita Acara <?= $berita_acara['nomor_ajuan']; ?>
        </h1>
        <div class="div">
            <?php if ($session->get('priv_user') == 1) { ?>
                <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-plus text-110 mr-1"></i> Upload Berita Acara
                </button>
            <?php } ?>
            <?php if ($berita_acara['file_berita_acara'] != "") { ?>
                <a href="<?= base_url(); ?>/file_berita_acara/<?= $berita_acara['file_berita_acara']; ?>" class="btn btn-success waves-effect waves-light" target="_blank">
                    <i class="fa fa-file text-110 mr-1"></i> Lihat Berita Acara
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="bgc-white">
        <div class="p-3">
            <?php
            $tgl = explode('-', $berita_acara['tanggal_penyerahan']);
            ?>
            <p>
                Pada tanggal <b><?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?></b> bertempat di <b><?= $berita_acara['lokasi_penyerahan']; ?></b>
                <br>berdasarakan <b><?= $berita_acara['berdasarkan']; ?></b>
                <?php if ($berita_acara['berdasarkan'] == 'Rapat Pengurus' && $data_ajuan['status_ajuan'] >= 3 && $tanggal_rapat != 'belum rapat bos') { ?>
                    <?php
                    $waktu = explode(' ', $tanggal_rapat);
                    $tgl2 = explode('-', $waktu[0])
                    ?>
                    pada tanggal <b><?= $tgl2[2] . ' ' . $bulan[(int)$tgl2[1]] . ' ' . $tgl2[0]; ?></b>.
                <?php } ?>
                <br>
                <br>
                Telah disalurkan bantuan LAZISMU UMS selaku Pihak Pertama berupa : <b><?= $berita_acara['ket_bentuk_penyerahan']; ?></b> senilai <b>Rp. <?= number_format((float)$berita_acara['nilai_penyerahan'], 0, ',', '.'); ?></b>
                <br>
                <?php if ($berita_acara['bentuk_penyerahan'] == 2) { ?>
                    melalui rekening <b><?= $berita_acara['rekening_penyerahan']; ?></b>
                <?php } ?>
                <?php if ($berita_acara['bentuk_penyerahan'] >= 3) { ?>
                    dengan nama barang : <b><?= $berita_acara['nama_barang']; ?></b>
                <?php } ?>
                <br>
                dana dari <b><?= $berita_acara['dana_dari']; ?></b> diberikan kepada penerima dengan kategori <b><?= $berita_acara['ket_kategori_penerima']; ?></b>.
                <br>
                <br>
                Kepada pihak kedua:
            <table>
                <tr>
                    <td style="vertical-align: top; width: 200px;">Nama Pengaju</td>
                    <td style="vertical-align: top;">:</td>
                    <td style="vertical-align: top;"><b><?= $data_ajuan['nama_pemohon']; ?></b></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">NIK</td>
                    <td style="vertical-align: top;">:</td>
                    <td style="vertical-align: top;"><b><?= $data_ajuan['nik']; ?></b></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Alamat</td>
                    <td style="vertical-align: top;">:</td>
                    <td style="vertical-align: top;">
                        <b>
                            <?= $data_ajuan['alamat_detail']; ?>, <br>
                            <?= $data_ajuan['nama_kelurahan']; ?>, <?= $data_ajuan['nama_kecamatan']; ?>, <?= $data_ajuan['nama_kabupaten']; ?>, <?= $data_ajuan['nama_provinsi']; ?>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Keperuntukan dana</td>
                    <td style="vertical-align: top;">:</td>
                    <td style="vertical-align: top;"><b><?= $data_ajuan['deskripsi_ajuan']; ?></b></td>
                </tr>
                <?php if ($data_ajuan['jenis_ajuan'] == 'Lembaga') { ?>
                    <tr>
                        <td style="vertical-align: top; width: 200px;">Nama Lembaga</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;"><b><?= $data_ajuan['nama_lembaga']; ?></b></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 200px;">Alamat Lembaga</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;"><b><?= $data_ajuan['alamat_lembaga']; ?></b></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 200px;">Nomor Lembaga</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;"><b><?= $data_ajuan['nomor_lembaga']; ?></b></td>
                    </tr>
                <?php } ?>
            </table>
            <br>
            Adapun bantuan ini bersifat <b><?= $data_ajuan['sifat_bantuan']; ?></b>
            <br>
            Demikian Berita Acara ini dibuat untuk dipergunakan sebagaimana mestinya.
            </p>
            <br>
            <div class="row">
                <div class="col-4">
                    Pihak kedua / yang menerima
                    <br>
                    <br>
                    <br>
                    <br>
                    <?= $berita_acara['yang_menerima']; ?>
                </div>
                <div class="col-4"></div>
                <div class="col-4">
                    Pembuat berita acara / pihak pertama / yang menyerahkan
                    <br>
                    <br>
                    <br>
                    <br>
                    <?= $berita_acara['yang_bertandatangan']; ?>
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
                    <?php if ($session->get('priv_user') == 1) { ?>
                        <a href="/admin/pdf_berita_acara/<?= $berita_acara['id_berita_acara']; ?>/<?= $berita_acara['nomor_ajuan']; ?>" class="btn btn-danger btn-icon-split" target="_blank">
                            <span class="icon text-white-50">
                                <i class="fa fa-file-pdf"></i>
                            </span>
                            <span class="text">Cetak C1, C2, B3</span>
                        </a>
                        <!-- <a href="/admin/pdf_form_c1/<?= $berita_acara['id_berita_acara']; ?>/<?= $berita_acara['nomor_ajuan']; ?>" class="btn btn-warning btn-icon-split" target="_blank">
                            <span class="icon text-white-50">
                                <i class="fa fa-file-pdf"></i>
                            </span>
                            <span class="text">Cetak C1 Keuangan</span>
                        </a> -->
                        <a href="/admin/pdf_c17_kwitansi/<?= $berita_acara['id_berita_acara']; ?>/<?= $berita_acara['nomor_ajuan']; ?>" class="btn btn-success btn-icon-split" target="_blank">
                            <span class="icon text-white-50">
                                <i class="fa fa-file-pdf"></i>
                            </span>
                            <span class="text">Cetak C17 Kuitansi</span>
                        </a>
                    <?php } ?>
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
            <?= form_open("/admin/simpan_file_berita_acara", ['class' => 'formulir_berita_acara']); ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_berita_acara" id="" value="<?= $berita_acara['id_berita_acara']; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-12 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">File Berita Acara (pdf/jpg/png)</label>
                    </div>
                    <div class="col-md-12">
                        <input type="file" class="form-control col-sm-12  border-left-info animated--grow-in" id="file_berita_acara" name="file_berita_acara" required>
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
        $('.formulir_berita_acara').submit(function(e) {
            e.preventDefault();
            let form = $('.formulir_berita_acara')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('admin/simpan_file_berita_acara'); ?>",
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