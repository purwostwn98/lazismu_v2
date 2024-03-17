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
$time = explode(' ', $tanggal);
$tgl = explode('-', $time[0]);
$tanggal = $tgl[2] . ' ' . $bulan[intval($tgl[1])] . ' ' . $tgl[0] . ' ' . $time[1]

?>

<body>
    <br>
    <table cellpadding="1" style="width:100%">
        <tr>
            <td style="text-align: left;" rowspan="3" style="width: 20%;">
                <img width="100px" src="/assets/favicon.png" alt="">
            </td>
            <td style="width: 80%; text-align: left; font-size: 15px;"><strong>LAZISMU</strong></td>
        </tr>
        <tr>
            <td style="font-size: 15px; text-align: left;"><strong>UNIVERSITAS MUHAMMADIYAH SURAKARTA</strong></td>
        </tr>
        <tr>
            <td style="font-size: 10px; text-align: left;">Gedung A Lt 1 (Kampus 1 UMS) Jl. A. Yani Tromol Pos1, Pabelan, Kartasura, Sukoharjo <br>email: lazismu@ums.ac.id Telp. (0271) 717417 ext. 2282, Hp/Wa: 085363766667 <br>
            </td>
        </tr>
    </table>
    <hr style="margin-top: 2px;">
    <table class="judul" style="width: 100%;">
        <!-- <tr>
            <td style="font-size: 12px; text-align: right;"><?= $tanggal; ?></td>
        </tr> -->
        <tr>
            <td style="text-align: center; font-size: 17px;"><br><br><strong>Nomor Ajuan : <?= $data_ajuan['nomor_ajuan']; ?></strong></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="body_table" cellpadding="2" style="width:100%; margin-top: 2px;">
        <tr>
            <td style="width: 30%;">Tanggal Ajuan</td>
            <td style="width: 2%">:</td>
            <td style="width: 69%;"><?= $data_ajuan['tgl_diajukan']; ?></td>
        </tr>
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
        <tr>
            <td>Program bantuan</td>
            <td>:</td>
            <td><?= $data_ajuan['nama_program']; ?></td>
        </tr>
        <!-- <tr>
            <td>Keperuntukan dana</td>
            <td>:</td>
            <td><?= $data_ajuan['deskripsi_ajuan']; ?></td>
        </tr> -->
    </table>

    <p style="font-size: 12px;"><strong><i>Simpan nomor ajuan ini! Nomor ajuan ini digunakan untuk melihat status ajuan Anda melalui halaman cek ajuan dengan memasukkan NIK dan Nomor Ajuan.</i></strong></p>
</body>

</html>