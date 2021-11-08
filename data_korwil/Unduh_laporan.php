<?php
   date_default_timezone_set("Asia/Jakarta");
   $dat=date("d-m-Y H.i");
   header("Content-Type: application/force-download");
   header("Cache-Control: no-cache, must-revalidate");
   header("content-disposition: attachment;filename=Laporan Debit Air ".$dat.".xls");

    include "../data_korwil/template/header_cetak.php";   
    include "../data_korwil/template/menu.php";
    include "../data_korwil/fungsi.php";


        //Pembagian Debit Air
        $bln = date("m");
        $data1 = mysqli_query($koneksi, "SELECT a.id_laporan FROM cth_laporan a 
        
        INNER JOIN cth_hari b ON a.id_hari = b.id_hari 
        WHERE b.periode = 'Periode 3' 
        AND a.status_laporan = 'Dikonfirmasi' 
        AND a.id_daerah='$_SESSION[id_daerah]'");

        $pembagian = mysqli_num_rows($data1);


        //Debit Rata - Rata Dalam 1 Bulan
        $query1 = query("SELECT a.nama_sungai, a.nama_bendungan,

        ROUND(SUM(IF(b.periode = 'Periode 1', a.intake_kanan, NULL)/10)) AS intake_kanan1, 
        ROUND(SUM(IF(b.periode = 'Periode 1', a.intake_kiri, NULL)/10)) AS intake_kiri1,
        ROUND(SUM(IF(b.periode = 'Periode 1', a.intake_kanan + a.intake_kiri, NULL)/10)) AS jumlah_debit1,
        
        ROUND(SUM(IF(b.periode = 'Periode 2', a.intake_kanan, NULL)/10)) AS intake_kanan2, 
        ROUND(SUM(IF(b.periode = 'Periode 2', a.intake_kiri, NULL)/10)) AS intake_kiri2,
        ROUND(SUM(IF(b.periode = 'Periode 2', a.intake_kanan + a.intake_kiri, NULL)/10)) AS jumlah_debit2,
        
        ROUND(SUM(IF(b.periode = 'Periode 3', a.intake_kanan, NULL)/$pembagian)) AS intake_kanan3, 
        ROUND(SUM(IF(b.periode = 'Periode 3', a.intake_kiri, NULL)/$pembagian)) AS intake_kiri3,
        ROUND(SUM(IF(b.periode = 'Periode 3', a.intake_kanan + a.intake_kiri, NULL)/$pembagian)) AS jumlah_debit3,

        GROUP_CONCAT(a.l_total) as l_total, GROUP_CONCAT(a.l_eff) as l_eff, GROUP_CONCAT(a.status_laporan) as status_laporan
        
        FROM cth_laporan a 
        INNER JOIN cth_hari b ON a.id_hari = b.id_hari
        WHERE a.id_daerah='$_SESSION[id_daerah]'
        GROUP BY a.nama_sungai, a.nama_bendungan
        ");


?>
   <!DOCTYPE html>
    <html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
    table, th, td {
    border: 2px solid black;
    
        } 

    </style>
    </head>
    <body>

 
<div class="container-fluid">

<br>


<center> <h3>DATA DEBIT SUNGAI PADA DINAS PEKERJAAN UMUM DAN</h3> </center> 
<center> <h3>PENATAAN RUANG KABUPATEN PROBOLINGGO</h3> </center>

<p align=right><b>Laporan     : Bulanan</b>
<p align=right><b>Formulir    : 08 - O</b>
<p align=right><b>UPTD       -> Dinas</b>

<br><br><br>

<table class="table table-striped table-hover table-bordered table-align-middle" id="data">
            <thead >
                <tr align="center">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Sungai</th>
                    <th rowspan="2">Nama Bendungan</th>
                    <th rowspan="2">Keadaan</th>
                    <th colspan="3">Debit Rata - Rata 10 Harian Ke-(I/det) </th>
                    <th rowspan="2">Keterangan</th> 
                </tr>
                <tr align="center">
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                </tr>
            </thead>
                    
            <?php
                    $i = 1;
                    foreach ($query1 as $data) {
                    
            ?>
                <tr>
                        <td rowspan = "4">
                            <?= $i ?>
                        </td>
                        
                        <td rowspan = "4"><?=$data['nama_sungai']?></td>   
                        <td colspan = "1"><?=$data['nama_bendungan']?></td>  
                        <td colspan = "1"></td>
                        <td colspan = "1"></td>
                        <td colspan = "1"></td>
                        <td colspan = "1"></td>
                        <td colspan = "1">L Total Bendungan&emsp;:  
                            <?php $total = explode(',',$data['l_total']); 
                             echo $total[0] ?> 
                            m</td>
                        <tr>
                            <td colspan = "1">Intake Kanan</td>
                            <td colspan = "1">Normal Pagi</td>
                            <td colspan = "1"><?=$data['intake_kanan1']?></td>
                            <td colspan = "1"><?=$data['intake_kanan2']?></td>
                            <td colspan = "1"><?=$data['intake_kanan3']?></td>
                            <td colspan = "1">L eff. Bendung&emsp;&ensp;&nbsp;&ensp;&ensp;:   
                                <?php $leff = explode(',',$data['l_eff']); 
                                    echo $leff[0] ?> 
                                m</td>
                            <tr>
                                    <td colspan = "1">Intake Kiri</td>
                                    <td colspan = "1">Normal Pagi</td>
                                    <td colspan = "1"><?=$data['intake_kiri1']?></td>
                                    <td colspan = "1"><?=$data['intake_kiri2']?></td>
                                    <td colspan = "1"><?=$data['intake_kiri3']?></td>
                                    <td colspan = "1"></td>

                                        <tr>
                                            <td colspan = "1">Jumlah Debiet</td>
                                            <td colspan = "1">Normal Pagi</td>
                                            <td colspan = "1"><?=$data['jumlah_debit1']?></td>
                                            <td colspan = "1"><?=$data['jumlah_debit2']?></td>
                                            <td colspan = "1"><?=$data['jumlah_debit3']?></td>
                                            <td rowspan = "1"></td>
                                        </tr>
                            </tr>
                        </tr>      
                </tr>
            </tbody>
            <?php $i++; ?>
            <?php } ?>
                </table>
            </div>
        </div>


        <br><br>
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

    