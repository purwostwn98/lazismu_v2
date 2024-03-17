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
                Detail Notulensi
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
                Jumat, 19 Januari 2024
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Jam mulai</label>
            </div>
            <div class="col-md-6">
                15.00 WIB
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Pemimpin Rapat</label>
            </div>
            <div class="col-md-6">
                Dr. Mahasri Shobahiya, M.Ag
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="/admin/detail_notulensi" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#b3Modal"><i class="fa fa-plus"></i> | Tambah Agenda</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <p class="text-center"><b>Daftar Agenda</b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-2">
                    <div class="card-header d-sm-flex align-items-center justify-content-between bgc-secondary">
                        <h6 class="m-0 font-weight-bold text-white p-0">1. Proposal Masuk</h6>
                        <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#b3Modal">
                            <i class="fa fa-plus text-110 mr-1 p-0"></i> Tambah data ajuan
                        </button>
                    </div>
                    <div class="card-body" style="font-size: 13px;">
                        <div class="row">
                            <div class="col-12">
                                <table id="simple-table" class="table table-bordered table-bordered-x table-hover text-dark-m2">
                                    <thead class="text-dark-m3 bgc-grey-l4">
                                        <tr>
                                            <th class="text-center">No Ajuan</th>
                                            <th class="text-center">Mustahik</th>
                                            <th class="text-center">Keputusan</th>
                                            <th class="text-center">Nominal</th>
                                            <th class="text-center">Sumber Dana</th>
                                            <th class="text-center">Asnaf/Kategori</th>
                                            <th class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>37774492</td>
                                        <td>SDN Ngemplak Mojosongo Jebres</td>
                                        <td>Diterima</td>
                                        <td>Rp 10.000.000,-</td>
                                        <td>Zakat</td>
                                        <td>Fakir</td>
                                        <td>Uang Tunai</td>
                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-2">
                    <div class="card-header d-sm-flex align-items-center justify-content-between bgc-secondary">
                        <h6 class="m-0 font-weight-bold text-white p-0">2. Beras UMS</h6>
                        <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#b3Modal">
                            <i class="fa fa-edit text-110 mr-1 p-0"></i> Edit Agenda
                        </button>
                    </div>
                    <div class="card-body" style="font-size: 13px;">
                        <div class="row">
                            <div class="col-12">
                                Karena pengurus yang ikut hanya 9 orang, maka Kendaraan dari BUS diganti Hi Ace
                                Keperluan keberangkatan
                                <ol>
                                    <li>Souvenir/vandel (Benchmarking KL LAZISMU Universitas Muhammadiyah Surakarta, tanggal 17 Januari 2024 - logo dan slogan)</li>
                                    <li>Oleh Oleh Khas Solo Seharga Rp. 500.000,-</li>
                                    <li>Susunan Acara</li>
                                </ol>
                            </div><!-- /.col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <input type="time" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_lembaga" id="namaLbg" value="">
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
                                        <textarea id="summernote" name="editordata"></textarea>
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
                                    <input type="text" class="form-control col-sm-12  border-left-info animated--grow-in" name="nama_lembaga" id="namaLbg" value="">
                                    <p class="text-danger text-sm error_nama_lembaga"><i></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-auto">
                                <a href="/admin/detail_notulensi" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> | Simpan Notulensi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            <?= form_open("/admin/b3", ['class' => 'formulir_surat_tugas']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-5 col-form-label text-sm-left pr-0">
                        <label for="id-form-field-1" class="mb-0">Nama Agenda</label>
                    </div>
                    <div class="col-sm-7">
                        <input class="form-control form-sm" type="text" name="" id="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="id-form-field-1" class="mb-0">Pembahasan</label>
                    </div>
                    <div class="col-12">
                        <div class="card brc-success-tp2">
                            <div class="card-body p-0">
                                <textarea id="summernote2" name="editordata2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn_st">Simpan Agenda</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?= $this->endSection(); ?>