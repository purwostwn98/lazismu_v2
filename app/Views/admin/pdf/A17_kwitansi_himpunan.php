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
$tgl = explode('-', $himpun['tanggal_himpun']);
?>

<body>
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
                            Nomor : <span style="color: red; font-size: 17px;"><b><?= $himpun['id_himpun']; ?></b></span>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70%;"><b>Dengan ini, Saya</b></td>
                        <td style="width: 5%;"></td>
                        <td style="width: 25%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Nama</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><b><?= $himpun['nama_muzaki']; ?></b></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Alamat</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= $himpun['alamat_muzaki']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">REG-ID</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= strtoupper($himpun['id_muzaki']); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">NPWP</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</td>
                    </tr>
                    <tr>
                        <td style="width: 35%;"><b>Menunaikan</b></td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= $himpun['keterangan_sub']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Via</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= mb_strtoupper($himpun['via_himpun']); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Jumlah</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><b><b>Rp. <?= number_format((float)$himpun['jumlah_himpun'], 0, ',', '.'); ?></b></b></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Terbilang</td>
                        <td style="width: 5%;">:</td>
                        <td style="background-color:antiquewhite; width: 60%;"><i><?= $terbilang; ?> rupiah</i></td>
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
                        <td style="width: 50%; text-align: center;">
                            Penerima,
                            <br>
                            <br>
                            <br>
                            (______________________) <br>
                            <i style="font-size: 10px;">nama jelas</i>
                        </td>
                        <td style="width: 50%; text-align: center;">
                            Penyetor,
                            <br>
                            <br>
                            <br>
                            (______________________)<br>
                            <i style="font-size: 10px;">nama jelas</i>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
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
                            Nomor : <span style="color: red; font-size: 17px;"><b><?= $himpun['id_himpun']; ?></b></span>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70%;"><b>Dengan ini, Saya</b></td>
                        <td style="width: 5%;"></td>
                        <td style="width: 25%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Nama</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><b><?= $himpun['nama_muzaki']; ?></b></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Alamat</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= $himpun['alamat_muzaki']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">REG-ID</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= strtoupper($himpun['id_muzaki']); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">NPWP</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</td>
                    </tr>
                    <tr>
                        <td style="width: 35%;"><b>Menunaikan</b></td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= $himpun['keterangan_sub']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Via</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><?= mb_strtoupper($himpun['via_himpun']); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Jumlah</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 60%;"><b><b>Rp. <?= number_format((float)$himpun['jumlah_himpun'], 0, ',', '.'); ?></b></b></td>
                    </tr>
                    <tr>
                        <td style="width: 35%;">Terbilang</td>
                        <td style="width: 5%;">:</td>
                        <td style="background-color:antiquewhite; width: 60%;"><i><?= $terbilang; ?> rupiah</i></td>
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
                        <td style="width: 50%; text-align: center;">
                            Penerima,
                            <br>
                            <br>
                            <br>
                            (______________________) <br>
                            <i style="font-size: 10px;">nama jelas</i>
                        </td>
                        <td style="width: 50%; text-align: center;">
                            Penyetor,
                            <br>
                            <br>
                            <br>
                            (______________________)<br>
                            <i style="font-size: 10px;">nama jelas</i>
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