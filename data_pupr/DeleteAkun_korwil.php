<?php
    include "fungsi.php";
    $id = $_GET['id'];

    if (deleteakunpegawai($id) > 0) {
        echo "
            <script>
                alert('Hapus Akun Pegawai Kordinator Wilayah Sukses');
                document.location.href = 'KelolaAkun_korwil.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus Akun Pegawai Kordinator Wilayah Gagal');
                document.location.href = 'KelolaAkun_korwil.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
    
?>