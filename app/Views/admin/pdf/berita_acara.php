<html>

<head>
    <style>
        .pernyataan th {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .pernyataan td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 12px;
        }

        .body_table td {
            font-size: 12px;
        }

        p {
            font-size: 12px;
        }
    </style>
</head>
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

<?php
$tgl = explode('-', $berita_acara['tanggal_penyerahan']);
?>

<body>
    <br>
    <table cellpadding="1" style="width:100%">
        <tr>
            <td style="text-align: left;" rowspan="3" style="width: 20%;">
                <img width="100px" src="/assets/favicon.png" alt="">
            </td>
            <td style="width: 80%; text-align: left; font-size: 14px;"><strong>LAZISMU</strong></td>
        </tr>
        <tr>
            <td style="font-size: 14px; text-align: left;"><strong>UNIVERSITAS MUHAMMADIYAH SURAKARTA</strong></td>
        </tr>
        <tr>
            <td style="font-size: 10px; text-align: left;">Gedung A Lt 1 (Kampus 1 UMS) Jl. A. Yani Tromol Pos1, Pabelan, Kartasura, Sukoharjo <br>email: lazismu@ums.ac.id Telp. (0271) 717417 ext. 2282, Hp/Wa: 085363766667 <br>
            </td>
        </tr>
    </table>
    <hr style="margin-top: 1px;">

    <!-- C1 -->
    <table class="judul" style="width: 100%;">
        <tr>
            <td rowspan="2" style="width: 20%;"></td>
            <td style="text-align: center; font-size: 14px; width:60%;"><br><br><strong>PERMOHONAN PENCAIRAN DANA</strong></td>
            <td rowspan="2" style="text-align: right; width: 20%; font-size: 11px"><b>C1</b></td>
        </tr>
    </table>
    <br>
    <br>

    <table class="body_table" cellpadding="2" style="width:100%">
        <tr>
            <td style="width: 15%;">No. Pengaju</td>
            <td style="width: 2%">:</td>
            <td style="width: 33%;"><?= $data_ajuan['nomor_ajuan']; ?></td>
            <td style="width: 15%;">Nama Mustahik</td>
            <td style="width: 2%">:</td>
            <td style="width: 33%;"><?= $berita_acara['yang_menerima']; ?></td>
        </tr>
    </table>
    <br>
    <table border="1px solid black" style="width: 100%; font-size: 12px; margin: 0px;">
        <tr>
            <th style="width: 10%;"><b>No</b></th>
            <th style="width: 65%;"><b>Keterangan</b></th>
            <th style="width: 25%;"><b>Jumlah</b></th>
        </tr>
        <tr>
            <td style="width: 10%;">1</td>
            <td style="width: 65%;"><?= $data_ajuan['deskripsi_ajuan']; ?></td>
            <td style="width: 25%;">Rp. <?= number_format((float)$berita_acara['nilai_penyerahan'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th align="center" colspan="2"><b>Total</b></th>
            <th style="width: 25%;"><b>Rp. <?= number_format((float)$berita_acara['nilai_penyerahan'], 0, ',', '.'); ?></b></th>
        </tr>
        <tr>
            <th colspan="3">Terbilang: <i><?= $terbilang; ?> rupiah</i></th>
        </tr>
    </table>
    <span style="font-size: 12px;" class="p-0 m-0">Pencairan Dana: <b><?= $berita_acara['yang_menerima']; ?></b> | Golongan Asnaf: <b><?= $berita_acara['ket_kategori_penerima']; ?></b> | Sumber Dana: <b><?= $berita_acara['dana_dari']; ?></b></span>
    <p style="text-align: right;">Surakarta, <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?></p>
    <table style="font-size: 12px;">
        <tr>
            <td style="width: 33%; text-align:center">Disetujui,</td>
            <td style="width: 33%; text-align:center">Diperiksa</td>
            <td style="width: 33%; text-align: center;">Pemohon,</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">..........................<br>Manajer
            </td>
            <td style="text-align: center;">..........................<br>Keuangan
            </td>
            <td style="text-align: center;">..........................<br>____________
            </td>
        </tr>
    </table>
    <p>
        <b>Catatan lain - lain:</b><br>
        <?php if ($berita_acara['bentuk_penyerahan'] == 2) { ?>
            Pembayaran ditransfer melalui rekening <b><?= $berita_acara['rekening_penyerahan']; ?></b>
        <?php } ?>
        <?php if ($berita_acara['bentuk_penyerahan'] >= 3) { ?>
            Nama barang yang diserahkan : <b><?= $berita_acara['nama_barang']; ?></b>
        <?php } ?>
    </p>
    <hr>



    <!-- berita acara -->
    <table class="judul" style="width: 100%;">
        <tr>
            <td rowspan="2" style="width: 20%;"></td>
            <td style="text-align: center; font-size: 14px; width:60%;"><br><br><strong>BERITA ACARA <br> DAN <br> PENETAPAN KATEGORI BANTUAN</strong></td>
            <td rowspan="2" style="text-align: right; width: 20%; font-size: 11px"><b>B3, C2</b></td>
        </tr>
        <tr>
            <td style="font-size: 11px; text-align: center;  width:60%;">Nomor Ajuan: <?= $data_ajuan['nomor_ajuan']; ?></td>
        </tr>
    </table>
    <p style="font-size: 12px" align="justify">Pada tanggal <b><?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?></b> bertempat di <b><?= $berita_acara['lokasi_penyerahan']; ?></b>
        berdasarakan <b><?= $berita_acara['berdasarkan']; ?></b>
        <?php if ($berita_acara['berdasarkan'] == 'Rapat Pengurus' && $data_ajuan['status_ajuan'] >= 3) { ?>
            <?php
            $waktu = explode(' ', $tanggal_rapat);
            $tgl2 = explode('-', $waktu[0])
            ?>
            pada tanggal <b><?= $tgl2[2] . ' ' . $bulan[(int)$tgl2[1]] . ' ' . $tgl2[0]; ?></b>.
        <?php } ?>
        <br>Telah disalurkan bantuan LAZISMU UMS selaku Pihak Pertama berupa <b><?= $berita_acara['ket_bentuk_penyerahan']; ?></b><br>senilai <b>Rp. <?= number_format((float)$berita_acara['nilai_penyerahan'], 0, ',', '.'); ?></b>
        <?php if ($berita_acara['bentuk_penyerahan'] == 2) { ?>
            melalui rekening <b><?= $berita_acara['rekening_penyerahan']; ?></b>
        <?php } ?>
        <?php if ($berita_acara['bentuk_penyerahan'] >= 3) { ?>
            dengan nama barang : <b><?= $berita_acara['nama_barang']; ?></b>
        <?php } ?>
        dana dari <b><?= $berita_acara['dana_dari']; ?></b> diberikan kepada penerima dengan kategori <b><?= $berita_acara['ket_kategori_penerima']; ?></b>.
        <br>Kepada pihak kedua:
    </p>
    <table class="body_table" cellpadding="2" style="width:100%">
        <tr>
            <td style="width: 30%;">Nama Pengaju</td>
            <td style="width: 2%">:</td>
            <td style="width: 69%;"><?= $data_ajuan['nama_pemohon']; ?></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td><?= $data_ajuan['nik']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $data_ajuan['alamat_detail']; ?>, <br><?= $data_ajuan['nama_kelurahan']; ?>, <?= $data_ajuan['nama_kecamatan']; ?>, <?= $data_ajuan['nama_kabupaten']; ?>, <?= $data_ajuan['nama_provinsi']; ?></td>
        </tr>
        <tr>
            <td>Keperuntukan dana</td>
            <td>:</td>
            <td><?= $data_ajuan['deskripsi_ajuan']; ?></td>
        </tr>
        <?php if ($data_ajuan['jenis_ajuan'] == 'Lembaga') { ?>
            <tr>
                <td>Nama Lembaga</td>
                <td>:</td>
                <td><?= $data_ajuan['nama_lembaga']; ?></td>
            </tr>
            <tr>
                <td>Alamat Lembaga</td>
                <td>:</td>
                <td><?= $data_ajuan['alamat_lembaga']; ?></td>
            </tr>
            <tr>
                <td>Nomor Lembaga</td>
                <td>:</td>
                <td><?= $data_ajuan['nomor_lembaga']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <p>Adapun bantuan ini bersifat <b><?= $data_ajuan['sifat_bantuan']; ?></b> dan pihak kedua / yang menerima berkewajiban membuat laporan pertanggunjawaban (LPJ) sesuai ketentuan.
        Demikian Berita Acara ini dibuat untuk dipergunakan sebagaimana mestinya.
    </p>
    <br>
    <table style="font-size: 12px;">
        <tr>
            <td style="width: 40%; text-align:center">Pihak Kedua / Yang Menerima</td>
            <td style="width: 20%;"></td>
            <td style="width: 40%; text-align: center;">Pihak Pertama / Yang Menyerahkan</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;"><?= $berita_acara['yang_menerima']; ?></td>
            <td></td>
            <td style="text-align: center;"><?= $berita_acara['yang_bertandatangan']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <br>
                <br>
                <br>
            </td>
        </tr>
    </table>
</body>

</html>