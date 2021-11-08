<?php
    include "fungsi.php";
    $id = $_GET['id'];

    if (deletedaerahtugas($id) > 0) {
        echo "
            <script>
                alert('Hapus Data Daerah Tugas Sukses');
                document.location.href = 'KelolaDaerah_tugas.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus Data Daerah Tugas Gagal');
                document.location.href = 'KelolaDaerah_tugas.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
    
?>