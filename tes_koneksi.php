<?php

require_once "koneksi.php";

$versi_server = mysqli_get_server_info($koneksi);
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tes koneksi database</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        .sukses { background: #e6f4ea; border-left: 5px solid #27ae60; padding: 10px; }
        td { padding: 4px 16px 4px 0; }
    </style>
</head>
<body>
    <h1>Tes koneksi database</h1>
    <p class="sukses">Koneksi ke mySQL berhasil.</p>

    <table>
        <tr>
            <td>Host</td>
            <td>: <?php echo htmlspecialchars($host); ?></td>
        </tr>
        <tr>
            <td>Host</td>
            <td>: <?php echo htmlspecialchars($database); ?></td>
        </tr>
        <tr>
            <td>Host</td>
            <td>: <?php echo htmlspecialchars($versi_server); ?></td>
        </tr>
    </table>
</body>
</html>