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
            font-size: 13px;
        }

        .body_table td {
            font-size: 13px;
        }

        p {
            font-size: 13px;
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
            <td style="text-align: left;" rowspan="3" style="width: 25%;">
                <img width="100px" src="/assets/favicon.png" alt="">
            </td>
            <td style="width: 75%; text-align: right; font-size: 15px;">
                <img width="200px" src="/assets/header_kanan_c1.png" alt="">
            </td>
        </tr>
        <!-- <tr>
            <td style="font-size: 15px; text-align: left;"><strong>UNIVERSITAS MUHAMMADIYAH SURAKARTA</strong></td>
        </tr>
        <tr>
            <td style="font-size: 10px; text-align: left;">Gedung A Lt 1 (Kampus 1 UMS) Jl. A. Yani Tromol Pos1, Pabelan, Kartasura, Sukoharjo <br>email: lazismu@ums.ac.id Telp. (0271) 717417 ext. 2282, Hp/Wa: 085363766667 <br>
            </td>
        </tr> -->
    </table>
    <br>
    <hr style="margin-top: 10px;">
    <table class="judul" style="width: 100%;">
        <tr>
            <td style="text-align: center; font-size: 14px;"><br><br><strong>PERMOHONAN PENCAIRAN DANA</strong></td>
        </tr>
        <tr>
            <td style="font-size: 14px; text-align: center;">PERIODE 2024</td>
        </tr>
    </table>
    <br>
    <br>
    <br>

    <table class="body_table" cellpadding="2" style="width:100%">
        <tr>
            <td style="width: 15%;">Pemohon</td>
            <td style="width: 2%">:</td>
            <td style="width: 33%;"><?= $data_ajuan['nama_pemohon']; ?></td>
            <td style="width: 15%;">No. Pengaju</td>
            <td style="width: 2%">:</td>
            <td style="width: 33%;"><?= $data_ajuan['nomor_ajuan']; ?></td>
        </tr>
        <tr>
            <td style="width: 15%;">Divisi</td>
            <td style="width: 2%">:</td>
            <td style="width: 33%;"></td>
            <td style="width: 15%;">Nama Mustahik</td>
            <td style="width: 2%">:</td>
            <td style="width: 33%;"><?= $berita_acara['yang_menerima']; ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table border="1px solid black" style="width: 100%; font-size: 13px;">
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
    </table>
    <p>Terbilang: <i><?= $terbilang; ?> rupiah</i>
    </p>
    <br>
    <table style="font-size: 13px;">
        <tr>
            <td style="width: 20%;"><b>Pencairan Dana</b></td>
            <td style="width: 2%">:</td>
            <td style="width: 78%;"><?= $berita_acara['yang_menerima']; ?></td>
        </tr>
        <tr>
            <td style="width: 20%;">Golongan Asnaf</td>
            <td style="width: 2%">:</td>
            <td style="width: 78%;"><?= $berita_acara['ket_kategori_penerima']; ?></td>
        </tr>
        <tr>
            <td style="width: 20%;">Sumber Dana</td>
            <td style="width: 2%">:</td>
            <td style="width: 78%;"><?= $berita_acara['dana_dari']; ?></td>
        </tr>
    </table>
    <br>
    <br>
    <p>Surakarta, <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?></p>
    <table style="font-size: 13px;">
        <tr>
            <td style="width: 33%; text-align:left">Disetujui,</td>
            <td style="width: 33%; text-align:left">Diperiksa</td>
            <td style="width: 33%; text-align: left;">Pemohon,</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <br>
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="text-align: left;">..........................<br>Manajer
            </td>
            <td style="text-align: left;">..........................<br>Keuangan
            </td>
            <td style="text-align: left;">..........................<br>____________
            </td>
        </tr>
    </table>
    <br>
    <br>
    <p>
        <b>Catatan lain - lain:</b><br>
        <?php if ($berita_acara['bentuk_penyerahan'] == 2) { ?>
            Pembayaran ditransfer melalui rekening <b><?= $berita_acara['rekening_penyerahan']; ?></b>
        <?php } ?>
        <?php if ($berita_acara['bentuk_penyerahan'] >= 3) { ?>
            Nama barang yang diserahkan : <b><?= $berita_acara['nama_barang']; ?></b>
        <?php } ?>
    </p>
</body>

</html>
<!-- 1. hari, $$tgl
2. Jam 
3. pemimpim rapat 
4. Agenda pokok bhasan
5. Pembahasan dan keputusan free text 
6.  -->