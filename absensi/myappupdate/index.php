<?php

use Master\absensi;
use Master\Menu;

include('autoload.php');
include('Config/Database.php');

$menu = new Menu();
$absensi = new absensi($dataKoneksi);
//$absensi ->tambah()
$target = @$_GET['target'];
$act = @$_GET['act']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">waktu kehadiran pegawai</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        foreach ($menu->topMenu() as $r) {
                        ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['link']; ?>" class="nav-link">
                                    <?php echo $r['text']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>

            <?php
            if (!isset($target) or $target == "Home") {
                echo "Hello, Welcome in Dashboard";
                //====start content absensi====
            } elseif ($target == "absensi") {
                if ($act == "tambah_absensi") {
                    echo $absensi->tambah();
                } elseif ($act == "simpan_absensi") {
                    if ($absensi->simpan()) {
                        echo "<script>
                        alert ('Data Tersimpan')
                        window.location.href = '?target=absensi'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Tersimpan')
                        window.location.href = '?target=absensi'
                        </script>";
                    }
                } elseif ($act == "edit_absensi") {
                    $id = $_GET['id'];
                    echo $absensi->edit($id);
                } elseif ($act == "update_absensi") {
                    if ($absensi->update()) {
                        echo "<script>
                        alert ('Data Diupdate')
                        window.location.href = '?target=absensi'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Diupdate')
                        window.location.href = '?target=absensi'
                        </script>";
                    }
                } elseif ($act == "delete_absensi") {
                    $id = $_GET['id'];
                    if ($absensi->delete($id)) {
                        echo "<script>
                        alert ('Data Dihapus')
                        window.location.href = '?target=absensi'
                        </script>";
                    } else {
                        echo "<script>
                        alert ('Data Gagal Dihapus')
                        window.location.href = '?target=absensi'
                        </script>";
                    }
                } else {
                    echo $absensi->index();
                }
                //====And Content absensi====
            } elseif ($target == "absensi") {
                echo "Ini adalah content absensi";
            } elseif ($target == "tpi") {
                echo "Ini adalah content tpi";
            } else {
                echo "Page 404 Not found";
            }
            ?>
        </div>
    </div>
</body>

</html>