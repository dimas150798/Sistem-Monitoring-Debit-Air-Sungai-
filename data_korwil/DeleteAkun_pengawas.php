<?php
    include "fungsi.php";
    $id = $_GET['id'];

    if (deleteakunpengawas($id) > 0) {
        echo "
            <script>
                alert('Hapus Akun Pegawai Pengawas Lapangan Berhasil');
                document.location.href = 'KelolaAkun_pengawas.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Hapus Akun Pegawai Pengawas Lapangan Gagal');
                document.location.href = 'KelolaAkun_pengawas.php';
            </script>
        ";
        echo("<br>");
        echo mysqli_error($koneksi);
    }
    
?>