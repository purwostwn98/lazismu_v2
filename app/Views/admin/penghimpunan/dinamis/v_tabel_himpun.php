<?php if (empty($data)) {
    echo ("Tidak ada data");
} else { ?>
    <table style="font-size: 11px;" class="table table-responsive">
        <thead class="bgc-primary text-white">
            <th>No</th>
            <th>Hari, tanggal</th>
            <th>No Kwitansi</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Hp/Wa</th>
            <th>Email</th>
            <th>Perorangan/Lembaga</th>
            <th>Kategori</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
            <th>Via</th>
            <th>Tgl Setor Bank</th>
            <th>No Kwitansi Bank</th>
            <th>Bank</th>
            <th>#</th>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $d) { ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $d['tanggal_himpun']; ?></td>
                    <td><?= $d['id_himpun']; ?></td>
                    <td><?= $d['nama_muzaki']; ?></td>
                    <td><?= $d['alamat_muzaki']; ?></td>
                    <td><?= $d['tlp_muzaki']; ?></td>
                    <td><?= $d['email_muzaki']; ?></td>
                    <td><?= $d['jenis_muzaki']; ?></td>
                    <td><?= $d['keterangan_ktg']; ?></td>
                    <td><?= $d['keterangan_sub']; ?></td>
                    <td>Rp <?= number_format((float)$d['jumlah_himpun'], 0, ',', '.'); ?></td>
                    <td><?= $d['via_himpun']; ?></td>
                    <td><?= $d['tgl_setor_bank']; ?></td>
                    <td><?= $d['kwitansi_bank']; ?></td>
                    <td><?= $d['nm_bank']; ?></td>
                    <td><button class="btn btn-info btn-sm">edit</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>