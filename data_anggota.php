<?php
require_once "koneksi.php";

$sql   = "SELECT * FROM anggota ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $sql);


if (!$hasil) {
    $pesan_error = mysqli_error($koneksi);
    mysqli_close($koneksi);
    die("Query gagal: " . htmlspecialchars($pesan_error));
}

// Pesan notifikasi dari hapus.php
$status = isset($_POST["status"]) ? $_POST["status"] : "";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Perpustakaan</title>
    <style>
        body { font-family:Arial, Helvetica, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        label { display: inline-block; width: 150px; margin-bottom: 10px; }
        input[type="text"], input[type="email"], select, textarea { width: 300px; padding: 5px; }
        button { margin-top: 10px; padding: 8px 16px; }
    </style>
</head>

<body>
    <h1>Data Anggota Perpustakaan</h1>

    <?php if ($status === "hapus_sukses") { ?>
        <p class="sukses">Data anggota berhasil dihapus.</p>
    <?php } elseif ($status === "hapus_gagal") { ?>
        <p class="gagal">Data anggota gagal dihapus atau tidak ditemukan.</p>
    <?php } ?>

    <table border="1" class="tabel">
        <tr>
            <th>No.</th>
            <th>No. Anggota</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>No. HP</th>
            <th>Jenis Anggota</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php if (mysqli_num_rows($hasil) === 0) { ?>
            <tr>
                <td colspan="8">Belum ada data anggota.</td>
            </tr>
        <?php } ?>

        <?php $no = 1;
        while ($baris = mysqli_fetch_assoc($hasil)) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($baris["no_anggota"]); ?></td>
                <td><?php echo htmlspecialchars($baris["nama_lengkap"]); ?></td>
                <td><?php echo htmlspecialchars($baris["email"]); ?></td>
                <td><?php echo htmlspecialchars($baris["no_hp"]); ?></td>
                <td><?php echo htmlspecialchars($baris["jenis_anggota"]); ?></td>
                <td><?php echo htmlspecialchars($baris["alamat"]); ?></td>
                <td>
                    <a href="edit_anggota.php?id=<?php echo (int) $baris["id"]; ?>">Edit</a>
                    <form class="inline" action="hapus.php" method="post"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        <input type="hidden" name="id" value="<?php echo (int) $baris["id"]; ?>">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <p><a href="form_anggota.php">Isi Data Anggota</a></p>

</body>

</html>