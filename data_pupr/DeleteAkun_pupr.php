<?php
    include "fungsi.php";
    $id = $_GET['id'];

    if (deleteakunpegawai($id) > 0) {
        echo "
            <script>
                alert('Hapus Akun Pegawai Dinas PUPR Berhasil');
                document.location.href = 'KelolaAkun_pupr.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus Akun Pegawai Dinas PUPR Gagal');
                document.location.href = 'KelolaAkun_pupr.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
    
?>