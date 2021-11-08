    <div class="h">
         <p align=right><b>Probolinggo,  <?php echo  date("d - m - Y"); ?></b>   
        <p align=right><b>Kordinator Pengelola Jalan dan SDA</b>
        <?php $ambildataer=mysqli_query($koneksi, "SELECT daerah_tugas FROM daerah_tugas WHERE id_daerah='$_SESSION[id_daerah]'");
        while($ac=mysqli_fetch_array($ambildataer)){?>
        <p align=right><b><?=$ac['daerah_tugas']?></b>
        <?php } ?>
        <br><br><br><br>
        <p align=right><b><?=$_SESSION['nama_user']?></b>




        <?php
            //ambil data dari tb_admin di database
            $ambildata=mysqli_query($koneksi, "SELECT nip_user FROM db_user  WHERE username='$_SESSION[username]'");
            while($a=mysqli_fetch_array($ambildata)){
            ?>
                <p align=right><b>NIP : <?=$a['nip_user']?></b>
                                </div>
                            <?php
                        }   
                    ?>
    </div>
  