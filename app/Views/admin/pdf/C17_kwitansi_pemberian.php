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
    <br>
    <table border="1px solid black" style="width:100%">
        <tr>
            <td align="center" style="text-align: center;" rowspan="2" style="width: 25%;">
                <br>
                <img align="center" width="100px" src="/assets/favicon.png" alt="">
                <br>
                <span style="text-align: center; font-size: 10px;">Lembaga Amil Zakat Nasional <br> SK. Menteri Agama RI <br> No. 730 Tahun 216 <br> Tanggal 14 Desember 2016
                </span>
            </td>
            <td style="width: 75%; text-align: right; font-size: 30px;">
                KUITANSI
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-size: 14px;">
                <br>

                <table cellpadding="4" style="width: 100%; font-size: 13px;">
                    <tr>
                        <td colspan="3">
                            Nomor Reff : <span style="color: red; font-size: 17px;"><b>C17 - <?= $data_ajuan['nomor_ajuan']; ?></b></span>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Telah Dibayarkan Kepada</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><b><?= $berita_acara['yang_menerima']; ?></b></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Uang Sejumlah</td>
                        <td style="width: 5%;">:</td>
                        <td style="background-color:antiquewhite; width: 60%;"><i><?= $terbilang; ?> rupiah</i></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Untuk Pembayaran</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= $data_ajuan['deskripsi_ajuan']; ?><br></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Via</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;">
                            <?= $berita_acara['ket_bentuk_penyerahan']; ?>
                            <?php if ($berita_acara['bentuk_penyerahan'] == 2) { ?>
                                , melalui rekening <b><?= $berita_acara['rekening_penyerahan']; ?></b>
                            <?php } ?>
                            <?php if ($berita_acara['bentuk_penyerahan'] >= 3) { ?>
                                berupa : <b><?= $berita_acara['nama_barang']; ?></b>
                            <?php } ?>
                            <br>
                            <span style="background-color: antiquewhite; padding: 20px;"><b style="font-size: 20px;">Rp. <?= number_format((float)$berita_acara['nilai_penyerahan'], 0, ',', '.'); ?></b></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width: 50%;">
                        </td>
                        <td style="width: 50%;">
                            <br>
                            <br>
                            <span>Surakarta, <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <br>
                <span style="text-align: center; font-size: 10px;">
                    Gedung A Lt. 1 (Kampus 1) <br>
                    Jl. A. Yani Tromol Pos I 57102 <br>
                    Telp. (0271) 717417 ext.2282 <br>
                    HP / WA 085363766667 <br>
                    web: lazismu.ums.ac.id <br>
                    email: lazismu@ums.ac.id
                </span>
            </td>
            <td>
                <table style="width: 100%; font-size: 13px">
                    <tr>
                        <td style="width: 50%;">
                            Penerima,
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            (______________________) <br>
                            <i style="font-size: 10px;">nama jelas</i>
                        </td>
                        <td style="width: 50%;">
                            Keuangan,
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            (______________________)
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <table border="1px solid black" style="width:100%">
        <tr>
            <td align="center" style="text-align: center;" rowspan="2" style="width: 25%;">
                <br>
                <img align="center" width="100px" src="/assets/favicon.png" alt="">
                <span style="text-align: center; font-size: 10px;">Lembaga Amil Zakat Nasional <br> SK. Menteri Agama RI <br> No. 730 Tahun 216 <br> Tanggal 14 Desember 2016
                </span>
            </td>
            <td style="width: 75%; text-align: right; font-size: 30px;">
                KUITANSI
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-size: 14px;">
                <br>

                <table cellpadding="4" style="width: 100%; font-size: 13px;">
                    <tr>
                        <td colspan="3">Nomor Reff : <span style="color: red; font-size: 17px;"><b>C17 - <?= $data_ajuan['nomor_ajuan']; ?></b></span>
                            <br>
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 35%;">Telah Dibayarkan Kepada</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><b><?= $berita_acara['yang_menerima']; ?></b></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Uang Sejumlah</td>
                        <td style="width: 5%;">:</td>
                        <td style="background-color:antiquewhite; width: 60%;"><i><?= $terbilang; ?> rupiah</i></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Untuk Pembayaran</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= $data_ajuan['deskripsi_ajuan']; ?><br></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Via</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;">
                            <?= $berita_acara['ket_bentuk_penyerahan']; ?>
                            <?php if ($berita_acara['bentuk_penyerahan'] == 2) { ?>
                                , melalui rekening <b><?= $berita_acara['rekening_penyerahan']; ?></b>
                            <?php } ?>
                            <?php if ($berita_acara['bentuk_penyerahan'] >= 3) { ?>
                                berupa : <b><?= $berita_acara['nama_barang']; ?></b>
                            <?php } ?>
                            <br>
                            <span style="background-color: antiquewhite; padding: 20px;"><b style="font-size: 20px;">Rp. <?= number_format((float)$berita_acara['nilai_penyerahan'], 0, ',', '.'); ?></b></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width: 50%;">
                        </td>
                        <td style="width: 50%;">
                            <br>
                            <br>
                            <span>Surakarta, <?= $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0]; ?></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <br>
                <span style="text-align: center; font-size: 10px;">
                    Gedung A Lt. 1 (Kampus 1) <br>
                    Jl. A. Yani Tromol Pos I 57102 <br>
                    Telp. (0271) 717417 ext.2282 <br>
                    HP / WA 085363766667 <br>
                    web: lazismu.ums.ac.id <br>
                    email: lazismu@ums.ac.id
                </span>
            </td>
            <td>
                <table style="width: 100%; font-size: 13px">
                    <tr>
                        <td style="width: 50%;">
                            Penerima,
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            (______________________) <br>
                            <i style="font-size: 10px;">nama jelas</i>
                        </td>
                        <td style="width: 50%;">
                            Keuangan,
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            (______________________)
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
<!-- 1. hari, $$tgl
2. Jam 
3. pemimpim rapat 
4. Agenda pokok bhasan
5. Pembahasan dan keputusan free text 
6.  -->