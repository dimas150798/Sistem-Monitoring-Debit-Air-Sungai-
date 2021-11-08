<?php
    $lokasi1 = "";
    $lokasi2 = "";
    $lokasi3 = "";
    $linklokasi2 = "";
    $linklokasi3 = "";

    include "../data_korwil/template/header.php";   
    include "../data_korwil/template/menu.php";
    include "../data_korwil/fungsi.php";

        //Pembagian Debit Air
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
div.d {
    position: absolute; 
        left: 1360px;
        width: 340px;
        height: 280px;

}
div.g {
    position: absolute; 
        left: 1140px;
        width: 345px;
        height: 20px;
        top:1150px;
}
div.h {
    position: absolute; 
        left: 1140px;
        width: 345px;
        height: 20px;
        top:1090px;
}
div.i {
    position: absolute; 
        left: 1140px;
        width: 345px;
        height: 20px;
        top:1350px;
}
div.j {
    position: absolute; 
        left: 1140px;
        width: 345px;
        height: 20px;
        top:1400px;
}
</style>
</head>
<body>   

    <div class="d">
        <br>
        <h4>Laporan     : Bulanan</h4>
        <h4>Formulir    : 08 - 0</h4>
        <h4>UPTD        : Dinas</h4>
    </div>

<div class="container-fluid">

    <br>
    <center> <h3>DATA DEBIT SUNGAI PADA DINAS PEKERJAAN UMUM DAN</h3> </center>
    <center> <h3>PENATAAN RUANG KABUPATEN PROBOLINGGO</h3> </center>
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
                            <td rowspan = "4"><?=$i++?>.</td>
                            <td rowspan = "4"><?=$data['nama_sungai']?></td>   
                            <td colspan = "1"><?=$data['nama_bendungan']?></td>  
                            <td colspan = "1"></td>
                            <td colspan = "1"></td>
                            <td colspan = "1"></td>
                            <td colspan = "1"></td>
                            <td colspan = "1">L Total Bendung&emsp;:  
                             <?php $total = explode(',',$data['l_total']); 
                             echo $total[0]
                             ?> 
                             <!--echo $total[count($total)-1] -->
                            m</td>
                            <tr>
                                <td colspan = "1">Intake Kanan</td>
                                <td colspan = "1">Normal Pagi</td>
                                <td colspan = "1"><?=$data['intake_kanan1']?></td>
                                <td colspan = "1"><?=$data['intake_kanan2']?></td>
                                <td colspan = "1"><?=$data['intake_kanan3']?></td>
                                <td colspan = "1">L eff. Bendung&emsp;&ensp;&nbsp;:  
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
                <?php } ?>
                    </table>
                </div>
            </div>
        </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
    include "template/footer_cetak.php";
?>

<script>
		window.print();
</script>