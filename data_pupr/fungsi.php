<?php
    include "../koneksi/koneksi.php";
    
    function query($query_kedua){
        global $koneksi;

        $result = mysqli_query($koneksi, $query_kedua);
        $rows = [];
        while ($data = mysqli_fetch_assoc($result)) {
            $rows[] = $data;
        }
        return $rows;
    }
    
     //Kode korwil
     function kodekorwil(){
        global $koneksi;

        $query = mysqli_query($koneksi, "SELECT max(id_user) AS maxkode FROM db_user WHERE id_user LIKE 'RAK%'");
        $data = mysqli_fetch_array($query);
        $kodekorwil = $data['maxkode'];
        $nourut = (int)substr($kodekorwil,3, 3);
        $nourut++;
        $char = "RAK";
        $kodekorwil = $char.sprintf("%03s",$nourut);
        return $kodekorwil;
    }

     //Kode Dinas PUPR
     function kodepupr(){
        global $koneksi;

        $query = mysqli_query($koneksi, "SELECT max(id_user) AS maxkode FROM db_user WHERE id_user LIKE 'RAD%'");
        $data = mysqli_fetch_array($query);
        $kodepupr = $data['maxkode'];
        $nourut = (int)substr($kodepupr,3, 3);
        $nourut++;
        $char = "RAD";
        $kodepupr = $char.sprintf("%03s",$nourut);
        return $kodepupr;
    }    

    //Kode Daerah Tugas
     function kodedaerahtugas(){ 
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_daerah) as maxkode from daerah_tugas ");
        $data = mysqli_fetch_array($query);
        $kodedaerah = $data['maxkode'];
        $nourut = (int)substr($kodedaerah,3, 3);
        $nourut++;
        $char = "DT";
        $kodedaerah = $char.sprintf("%03s", $nourut);
        return $kodedaerah;
    }

    //Tambah Daerah Tugas
    function tambahdaerahtugas($data){
        global $koneksi;

        $id_daerah = htmlspecialchars($data['id_daerah']);
        $daerah_tugas = htmlspecialchars($data['daerah_tugas']);
        

        $query = "INSERT INTO daerah_tugas VALUES ('$id_daerah', '$daerah_tugas')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }

    //Tambah Akun Korwil
    function tambahakunkorwil($data){
        global $koneksi;

        $id_user = htmlspecialchars($data['id_user']);
        $nip_user = htmlspecialchars($data['nip_user']);
        $nama_user = htmlspecialchars($data['nama_user']);
        $username = htmlspecialchars($data['username']);
        $password = $data['password1'];
        $tgl_lahir_user = htmlspecialchars($data['tgl_lahir_user']); 
        $alamat_user = htmlspecialchars($data['alamat_user']);
        
        $id_daerah = htmlspecialchars($data['id_daerah']);
        
        //mengecek username
        $query1 = mysqli_query($koneksi, "SELECT username FROM db_user WHERE username='$username' ");
    
        if (mysqli_fetch_assoc($query1)) {
            echo "
                <script>
                    alert('Username sudah ada');
                    window.location = 'registrasi_korwil.php';
                </script>
                    ";
                    return false;
        }

        //enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);

        //tambah data
        $query = "INSERT INTO db_user VALUES ('$id_user', '$nip_user', '$nama_user', '$username', '$password', '$tgl_lahir_user', '$alamat_user', '2', '$id_daerah')";
        $data = mysqli_query($koneksi, $query);
        
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }

   //Tambah Akun Dinas PUPR
   function tambahakunpupr($data){
    global $koneksi;

    $id_user = htmlspecialchars($data['id_user']);
    $nip_user = htmlspecialchars($data['nip_user']);
    $nama_user = htmlspecialchars($data['nama_user']);
    $username = htmlspecialchars($data['username']);
    $password = $data['password1'];
    $tgl_lahir_user = htmlspecialchars($data['tgl_lahir_user']); 
    $alamat_user = htmlspecialchars($data['alamat_user']);
    
    $id_daerah = htmlspecialchars($data['id_daerah']);
    
    //mengecek username
    $query1 = mysqli_query($koneksi, "SELECT username FROM db_user WHERE username='$username' ");

    if (mysqli_fetch_assoc($query1)) {
        echo "
            <script>
                alert('Username sudah ada');
                window.location = 'registrasi_korwil.php';
            </script>
                ";
                return false;
    }

    //enkripsi password
    $password3 = password_hash($password,PASSWORD_DEFAULT);

    //tambah data
    $query = "INSERT INTO db_user VALUES ('$id_user', '$nip_user', '$nama_user', '$username', '$password3', '$tgl_lahir_user', '$alamat_user', '1', NULL)";
    $data = mysqli_query($koneksi, $query);
    
    // var_dump($data);
    return mysqli_affected_rows($koneksi);
}    

    //Edit Daerah Tugas
    function editdaerahtugas($data){
        global $koneksi;

        $id_daerah = htmlspecialchars($data['id_daerah']);
        $daerah_tugas = htmlspecialchars($data['daerah_tugas']);
        $daerah_pengawas = htmlspecialchars($data['daerah_pengawas']);

        $query = "UPDATE daerah_tugas SET
            daerah_tugas = '$daerah_tugas'
            WHERE id_daerah = '$id_daerah'";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Edit Akun Pengawas
    function editakunpengawas($data){
        global $koneksi;

        $id_user = htmlspecialchars($data['id_user']);
        $nip_user = htmlspecialchars($data['nip_user']);
        $nama_user = htmlspecialchars($data['nama_user']);
        $username = htmlspecialchars($data['username']);
        $password = $data['password1'];
        $tgl_lahir_user = htmlspecialchars($data['tgl_lahir_user']); 
        $alamat_user = htmlspecialchars($data['alamat_user']);
        $id_akses = htmlspecialchars($data['id_akses']);
        $id_daerah = htmlspecialchars($data['id_daerah']);

        //enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);

        //update data user
        $query = "UPDATE db_user SET
            nip_user = '$nip_user',
            nama_user = '$nama_user',
            username = '$username',
            password = '$password',
            tgl_lahir_user = '$tgl_lahir_user',
            alamat_user = '$alamat_user',
            id_akses = '$id_akses',
            id_daerah = '$id_daerah'
            WHERE id_user = '$id_user' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }
    

    //Edit Akun Kordinator Wilayah
    function editakunkorwil($data){
        global $koneksi;

        $id_user = htmlspecialchars($data['id_user']);
        $nip_user = htmlspecialchars($data['nip_user']);
        $nama_user = htmlspecialchars($data['nama_user']);
        $username = htmlspecialchars($data['username']);
        $password = $data['password1'];
        $tgl_lahir_user = htmlspecialchars($data['tgl_lahir_user']); 
        $alamat_user = htmlspecialchars($data['alamat_user']);
        
        $id_daerah = htmlspecialchars($data['id_daerah']); 

        //enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);
        
        //update data user
        $query = "UPDATE db_user SET
            nip_user = '$nip_user',
            nama_user = '$nama_user',
            username = '$username',
            password = '$password',
            tgl_lahir_user = '$tgl_lahir_user',
            alamat_user = '$alamat_user',
            id_akses = '2',
            id_daerah = '$id_daerah'
            WHERE id_user = '$id_user' ";
        
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Edit Akun Dinas PUPR
    function editakunpupr($data){
        global $koneksi;

        $id_user = htmlspecialchars($data['id_user']);
        $nip_user = htmlspecialchars($data['nip_user']);
        $nama_user = htmlspecialchars($data['nama_user']);
        $username = htmlspecialchars($data['username']);
        $password = $data['password1'];
        $tgl_lahir_user = htmlspecialchars($data['tgl_lahir_user']); 
        $alamat_user = htmlspecialchars($data['alamat_user']);
        $id_akses = htmlspecialchars($data['id_akses']);
        $id_daerah = htmlspecialchars($data['id_daerah']);

        //enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);

        //update data user
        $query = "UPDATE db_user SET
            nip_user = '$nip_user',
            nama_user = '$nama_user',
            username = '$username',
            password = '$password',
            tgl_lahir_user = '$tgl_lahir_user',
            alamat_user = '$alamat_user',
            id_akses = '1',
            id_daerah = NULL
            WHERE id_user = '$id_user' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }    

    //Edit Akun 
    function editpassword($data){
        global $koneksi;
        
        $id_user = htmlspecialchars($_SESSION[id_user]);
        $password = $data['password1'];

        //enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);

        //update data user
        $query = "UPDATE db_user SET
            password = '$password'
            WHERE id_user = '$_SESSION[id_user]' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    } 
     
  
    
    //Delete Daerah Tugas
    function deletedaerahtugas($id){
        global $koneksi;

        $query = "DELETE from daerah_tugas where id_daerah = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Delete Akun Kordinator Wilayah
    function deleteakunpegawai($id){
        global $koneksi;

        $query = "DELETE from db_user where id_user = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }






    //Kode unit
    function kodeunit(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_unit_kerja) as maxkode from unit_kerja ");
        $data = mysqli_fetch_array($query);
        $kodebarang = $data['maxkode'];
        $nourut = (int)substr($kodebarang,3, 3);
        $nourut++;
        $char = "UK";
        $kodebarang = $char.sprintf("%03s", $nourut);
        return $kodebarang;
    }

    //Kode mutasi
    function kodemutasi(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_mutasi) as maxkode from m_mutasi ");
        $data = mysqli_fetch_array($query);
        $kodemutasi = $data['maxkode'];
        $nourut = (int)substr($kodemutasi,3, 3);
        $nourut++;
        $char = "DM";
        $kodemutasi = $char.sprintf("%03s", $nourut);
        return $kodemutasi;
    }

    //Tambah data unit
    function tambahunit($data){
        global $koneksi;
        $id = htmlspecialchars($data['id_unit_kerja']);
        $unitkerja = htmlspecialchars($data['unit_kerja']);
        $gaji_pokok = $data['gaji_pokok'];
        
        $query = "INSERT INTO unit_kerja VALUES ('$id', '$unitkerja', '$gaji_pokok')";
        $data = mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Hapus data unit
    function hapusunit($id){
        global $koneksi;
        $query = "DELETE from unit_kerja where id_unit_kerja = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Edit data unit
    function editunit($data){
        global $koneksi;
        $id = $data['id_unit_kerja'];
        $unitkerja = htmlspecialchars($data['unit_kerja']);
        $gaji_pokok = $data['gaji_pokok'];
        
        $query = "UPDATE unit_kerja SET
            unit_kerja = '$unitkerja',
            gaji_pokok = '$gaji_pokok'
            WHERE id_unit_kerja = '$id' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Kode jenis
    function kodejenis(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_jenis_barang) as maxkode from jenis_barang");
        $data = mysqli_fetch_array($query);
        $kodebarang = $data['maxkode'];
        $nourut = (int)substr($kodebarang,3, 3);
        $nourut++;
        $char = "JB";
        $kodebarang = $char.sprintf("%03s", $nourut);
        return $kodebarang;
    }

    //Tambah data jenis
    function tambahjenis($data){
        global $koneksi;
        $id = htmlspecialchars($data['id_jenis_barang']);
        $jenis = htmlspecialchars($data['jenis']);
        
        $query = "INSERT INTO jenis_barang VALUES ('$id', '$jenis')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }

    //Hapus data unit
    function hapusjenis($id){
        global $koneksi;
        $query = "DELETE from jenis_barang where id_jenis_barang = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Edit data unit
    function editjenis($data){
        global $koneksi;
        $id = $data['id_jenis_barang'];
        $jenis = htmlspecialchars($data['jenis']);
        
        $query = "UPDATE jenis_barang SET
            jenis = '$jenis'
            WHERE id_jenis_barang = '$id' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }



         //Kode Penjualan
     function kodejual(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_jual) as maxkode from data_jual ");
        $data = mysqli_fetch_array($query);
        $kodejual = $data['maxkode'];
        $nourut = (int)substr($kodejual,3, 3);
        $nourut++;
        $char = "DL";
        $kodejual = $char.sprintf("%03s", $nourut);
        return $kodejual;
    }

     //Kode pelanggan
     function kodepelanggan(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_pelanggan) as maxkode from data_pelanggan ");
        $data = mysqli_fetch_array($query);
        $kodepelanggan = $data['maxkode'];
        $nourut = (int)substr($kodepelanggan,3, 3);
        $nourut++;
        $char = "PL";
        $kodepelanggan = $char.sprintf("%03s", $nourut);
        return $kodepelanggan;
    }

     //Kode supplier
     function kodesupplier(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_supplier) as maxkode from m_supplier ");
        $data = mysqli_fetch_array($query);
        $kodesupplier = $data['maxkode'];
        $nourut = (int)substr($kodesupplier,3, 3);
        $nourut++;
        $char = "SP";
        $kodesupplier = $char.sprintf("%03s", $nourut);
        return $kodesupplier;
    }



    //Tambah mutasi
    function tambahmutasi($data){
        global $koneksi;

        $id_jual = ($data['id_jual']);
        $id_pelanggan = ($data['id_pelanggan']);
        $id_barang = ($data['id_barang']);
        $jumlah = $data['jumlah'];
        $tanggal = $data['tanggal'];
        $sub_total = $data['sub_total'];

        $query = "INSERT INTO data_jual VALUES ('$id_jual', '$id_pelanggan', '$id_barang', '$jumlah', '$sub_total', '$tanggal')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }


    //Tambah penjualan
    function tambahpenjualan($data){
        global $koneksi;

        $id_jual = ($data['id_jual']);
        $id_pelanggan = ($data['id_pelanggan']);
        $id_barang = ($data['id_barang']);
        $jumlah = $data['jumlah'];
        $sub_total = $data['sub_total'];


        $query = "INSERT INTO data_jual VALUES ('$id_jual', '$id_pelanggan', '$id_barang', '$jumlah', '$sub_total')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }

    // Tambah pelanggan
    function tambahpelanggan($data){
        global $koneksi;

        $id_pelanggan = ($data['id_pelanggan']);
        $nama_pelanggan = ($data['nama_pelanggan']);
        $kota = ($data['kota']);
        $alamat = $data['alamat'];
        $telepon = $data['telepon'];
        $tanggal = $data['tanggal'];


        $query = "INSERT INTO data_pelanggan VALUES ('$id_pelanggan', '$nama_pelanggan', '$kota', '$alamat', '$telepon', '$tanggal')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }

    // Tambah supplier
    function tambahsupplier($data){
        global $koneksi;

        $id_supplier = ($data['id_supplier']);
        $nama_supplier = ($data['nama_supplier']);
        $kontak_supplier = ($data['kontak_supplier']);
        $alamat_supplier = ($data['alamat_supplier']);



        $query = "INSERT INTO m_supplier VALUES ('$id_supplier', '$nama_supplier', '$kontak_supplier', '$alamat_supplier')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    } 

    function tambahkategori($data){
        global $koneksi;

        $id_jenis_barang = ($data['id_jenis_barang']);
        $jenis = $data['jenis'];

        $query = "INSERT INTO barang VALUES ('$id_jenis_barang', '$jenis')";
        $data = mysqli_query($koneksi, $query);
        // var_dump($data);
        return mysqli_affected_rows($koneksi);
    }
    


//    Edit pelanggan
function editpelanggan($data){
    global $koneksi;

    $id_pelanggan = ($data['id_pelanggan']);
    $nama_pelanggan = ($data['nama_pelanggan']);
    $kota = ($data['kota']);
    $alamat = $data['alamat'];
    $telepon = $data['telepon'];
    $tanggal = $data['tanggal'];

    $query = "UPDATE data_pelanggan SET
        id_pelanggan = '$id_pelanggan',
        nama_pelanggan = '$nama_pelanggan',
        kota = '$kota',
        alamat = '$alamat',
        telepon = '$telepon',
        tanggal = '$tanggal'
        WHERE id_pelanggan = '$id_pelanggan' ";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}   
 //    Edit pelanggan
    function editsupplier($data){
    global $koneksi;

    $id_supplier = ($data['id_supplier']);
    $nama_supplier = ($data['nama_supplier']);
    $kontak_supplier = ($data['kontak_supplier']);
    $alamat_supplier = ($data['alamat_supplier']);

    $query = "UPDATE m_supplier SET
        id_supplier = '$id_supplier',
        nama_supplier = '$nama_supplier',
        kontak_supplier = '$kontak_supplier',
        alamat_supplier = '$alamat_supplier'
        WHERE id_supplier = '$id_supplier'";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}    


    // Hapus data pelanggan
    function hapuspelanggan($id){
        global $koneksi;

        $query = "DELETE from data_pelanggan where id_pelanggan = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    // Hapus data supplier
    function hapussupplier($id){
        global $koneksi;

        $query = "DELETE from m_supplier where id_supplier = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //cari data barang
    function caribarang($cari){
        $query = "SELECT * FROM m_barang b inner join jenis_barang j on b.id_jenis_barang = j.id_jenis_barang WHERE
                nama_barang like '%$cari%' ";
        
        return query($query);
    }

    //Upload file gambar barang
    function uploadbarang(){
        $nama_file = $_FILES['gambar']['name'];
        $ukuran_file = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $file_tmp = $_FILES['gambar']['tmp_name'];

        if ($error === 4) { 
            echo "
            <script>
                alert('Tidak ada gambar yang diupload');
            </script>
            ";
            return false;
        }

        $jenis_gambar = ['jpg', 'jpeg', 'png', 'gif','JPG']; //jenis gambar yang boleh diinputkan
        $pecah_gambar = explode(".", $nama_file); //Memecah nama file dengan jenis gambar
        $pecah_gambar = strtolower(end($pecah_gambar)); //mengambil data array paling belakang
        if (!in_array($pecah_gambar, $jenis_gambar)) {
            echo "
                <script>
                    alert('Yang anda upload bukan file gambar');
                </script>
            ";
            return false;
        }
        //cek kapasitas file yang diupload dala bentuk byte 1 MB = 1000000 Byte
        if ($ukuran_file > 10000000) {
            echo"
                <script>
                    alert('Ukuran file terlalu besar');
                </script>
            ";
            return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= ".";
        $namafilebaru .= $pecah_gambar;

        move_uploaded_file($file_tmp, '../img/barang/'.$namafilebaru);

        //mereturn nama file agar masuk ke $gambar == upload()
        return $namafilebaru;
    }

    //Kode

     //Kode Anggota
     function kodeanggota(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_anggota) as maxkode from anggota ");
        $data = mysqli_fetch_array($query);
        $kodebarang = $data['maxkode'];
        $nourut = (int)substr($kodebarang,3, 3);
        $nourut++;
        $char = "AG";
        $kodebarang = $char.sprintf("%03s", $nourut);
        return $kodebarang;
    }

    //Tambah barang
    function tambahanggota($data){
        global $koneksi;

        $id_anggota = htmlspecialchars($data['id_anggota']);
        $nama = htmlspecialchars($data['nama']);
        $unit = $data['unit'];
        $npp = htmlspecialchars($data['npp']);
        $tempat = htmlspecialchars($data['tempat']);
        $tanggal = $data['tgl_lahir'];
        $jk = $data['jeniskelamin'];
        $alamat = htmlspecialchars($data['alamat']);
        $jadianggota = $data['jadianggota'];
        
        $gambar = uploadanggota();
        if (!$gambar) {
            return false;
        }


        $query = "INSERT INTO anggota VALUES ('$id_anggota', '$unit', '$npp', '$nama', '$tempat', '$tanggal', '$jk', '$alamat', '$jadianggota', '$gambar')";
        $data = mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Edit Anggota
    function editanggota($data){
        global $koneksi;

        $id_anggota = $data['id_anggota'];
        $nama = htmlspecialchars($data['nama']);
        $unit = $data['unit'];
        $npp = htmlspecialchars($data['npp']);
        $tempat = htmlspecialchars($data['tempat']);
        $tanggal = $data['tgl_lahir'];
        $jk = $data['jeniskelamin'];
        $alamat = htmlspecialchars($data['alamat']);
        $gambarlama = htmlspecialchars($data['gambarlama']);
        
        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarlama;
        } else {
            $gambar = uploadanggota();
        }
        

        $query = "UPDATE anggota SET
            id_unit_kerja = '$unit',
            npp = '$npp',
            nama = '$nama',
            tempat = '$tempat',
            tgl_lahir = '$tanggal', 
            jenis_kelamin = '$jk', 
            alamat = '$alamat', 
            gambar = '$gambar' 
            WHERE id_anggota = '$id_anggota' ";

        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //Hapus data barang
    function hapusanggota($id){
        global $koneksi;

        $query = "DELETE from anggota where id_anggota = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //cari data barang
    function carianggota($cari){
        $query = "SELECT * FROM anggota a inner join unit_kerja u on a.id_unit_kerja = u.id_unit_kerja WHERE
                nama like '%$cari%' ";
        
        return query($query);
    }

    //Upload file gambar anggota
    function uploadanggota(){
        $nama_file = $_FILES['gambar']['name'];
        $ukuran_file = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $file_tmp = $_FILES['gambar']['tmp_name'];

        if ($error === 4) { 
            echo "
            <script>
                alert('Tidak ada gambar yang diupload');
            </script>
            ";
            return false;
    }

        $jenis_gambar = ['jpg', 'jpeg', 'png', 'gif']; //jenis gambar yang boleh diinputkan
        $pecah_gambar = explode(".", $nama_file); //Memecah nama file dengan jenis gambar
        $pecah_gambar = strtolower(end($pecah_gambar)); //mengambil data array paling belakang
        if (!in_array($pecah_gambar, $jenis_gambar)) {
            echo "
                <script>
                    alert('Yang anda upload bukan file gambar');
                </script>
            ";
            return false;
        }
        //cek kapasitas file yang diupload dala bentuk byte 1 MB = 1000000 Byte
        if ($ukuran_file > 10000000) {
            echo"
                <script>
                    alert('Ukuran file terlalu besar');
                </script>
            ";
            return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= ".";
        $namafilebaru .= $pecah_gambar;

        move_uploaded_file($file_tmp, '../img/anggota/'.$namafilebaru);

        //mereturn nama file agar masuk ke $gambar == upload()
        return $namafilebaru;
    }

    //Kode Anggota
    function kodeuser(){
        global $koneksi;

        $query = mysqli_query($koneksi, "select max(id_user) as maxkode from user ");
        $data = mysqli_fetch_array($query);
        $kodeuser = $data['maxkode'];
        $nourut = (int)substr($kodeuser,3, 3);
        $nourut++;
        $char = "US";
        $kodeuser = $char.sprintf("%03s", $nourut);
        return $kodeuser;
    }

    //Hapus user
    function hapususer($id){
        global $koneksi;

        $query = "DELETE from user where id_user = '$id' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    //cari data barang
    function cariuser($cari){
        $query = "SELECT * FROM user where nama like '%$cari%' ";
        
        return query($query);
    }

    function registrasi($data){
        global $koneksi;
        
        $id = htmlspecialchars($data['id_user']);
        $nama = htmlspecialchars($data['nama']);
        $akses = $data['akses'];
        $username = strtolower(stripcslashes($data['username']));

        $password = mysqli_real_escape_string($koneksi, $data['password']);
        $password2 = mysqli_real_escape_string($koneksi, $data['password2']);
        
        //mengecek username
        $query = mysqli_query($koneksi, "SELECT username FROM user WHERE username='$username' ");
    
        if (mysqli_fetch_assoc($query)) {
            echo "
                <script>
                    alert('Username sudah ada');
                    window.location = 'registrasi.php';
                </script>
                    ";
                    return false;
        }
        //cek informasi password
        if ($password !== $password2) {
                    echo "
                    <script>
                        alert('Harap memasukan password dengan benar');
                        // window.location = 'registrasi.php';
                    </script>
            ";
            die();
            return false;
        }

        //enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);

        //tambah data
        mysqli_query($koneksi, "INSERT INTO user VALUES ('$id', '$nama', '$username', '$password','$akses')");   

        return mysqli_affected_rows($koneksi);
    }

    function tambahstok($data){
        global $koneksi;
        $id_brng = $data['id_barang'];
        $stokawal = $data['stokawal'];
        $jumlah_tambah = $data['jumlah'];
        $total = $stokawal + $jumlah_tambah;

        $query = "UPDATE barang SET stok = '$total' WHERE id_barang = '$id_brng' ";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }
?>