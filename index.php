<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "rrsdatabase";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak dapat terhubung");
}
$nisn        = "";
$nama        = "";
$kelas       = "";
$wali        = "";
$telpon      = "";
$sukses      = "";
$error       = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from siswa where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Data Terhapus";
    }else{
        $error  = "Gagal Menghapus Data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from siswa where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nisn       = $r1['nisn'];
    $nama       = $r1['nama'];
    $kelas      = $r1['kelas'];
    $wali       = $r1['wali'];
    $telpon     = $r1['telpon'];

    if ($nisn == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { 
    $nisn        = $_POST['nisn'];
    $nama        = $_POST['nama'];
    $kelas       = $_POST['kelas'];
    $wali        = $_POST['wali'];
    $telpon      = $_POST['telpon'];

    if ($nisn && $nama && $kelas && $wali && $telpon) {
        if ($op == 'edit') { 
            $sql1       = "update siswa set nisn = '$nisn',nama='$nama',kelas = '$kelas',wali = '$wali',telpon = '$telpon' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasi Terupdate";
            } else {
                $error  = "Gagal Diupdate";
            }
        } else { 
            $sql1   = "insert into siswa(nisn,nama,kelas,wali,telpon) values ('$nisn','$nama','$kelas','$wali','$telpon')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Data Tersimpan";
            } else {
                $error      = "Data tidak tersimpan";
            }
        }
    } else {
        $error = "Data belum lengkap. Input dengan benar!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRS | Update Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body style="background-image: linear-gradient(to right, #bb73e0, #ff8ddb); padding: 0 10px;">
    <div style="border: none ; outline:none; max-width: 600px; border-radius: 10px; 
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.125); height: 100%; background: #fff; margin: 50px auto;" class="mx-auto">
        <div class="card">
            <div class="card-header">
            <h5 style="padding-top: 30px; color: #ff8ddb; text-align: center; font-size: 24px;"
            >UPDATE DATA SISWA</h5>
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:4;url=index.php");
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:4;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">

                    <input placeholder="NISN" style="border: 1px solid #ff8ddb; border-radius: 8px; outline: none; height: 50px;
                        text-align: left; padding-left: 20px;  width: 75%; margin: 5px 50px; "
                        type="number" id="nisn" name="nisn" value="<?php echo $nisn ?>">
                     
                     <input placeholder="Nama Siswa" style="border: 1px solid #ff8ddb; border-radius: 8px; outline: none; height: 50px;
                        text-align: left; padding-left: 20px;  width: 75%; margin: 5px 50px; "
                        type="text" id="nama" name="nama" value="<?php echo $nama ?>">

                    <input placeholder="Kelas" style="border: 1px solid #ff8ddb; border-radius: 8px; outline: none; height: 50px;
                        text-align: left; padding-left: 20px;  width: 75%; margin: 5px 50px; "
                        type="text" id="kelas" name="kelas" value="<?php echo $kelas ?>">                      
                    
                    <input placeholder="Wali" style="border: 1px solid #ff8ddb; border-radius: 8px; outline: none; height: 50px;
                        text-align: left; padding-left: 20px;  width: 75%; margin: 5px 50px; "
                        type="text" id="wali" name="wali" value="<?php echo $wali ?>">
                        
                    <input placeholder="Telpon" style="border: 1px solid #ff8ddb; border-radius: 8px; outline: none; height: 50px;
                        text-align: left; padding-left: 20px;  width: 75%; margin: 5px 50px; "
                        type="number" id="telpon" name="telpon" value="<?php echo $telpon ?>">                      
                              
                        
                        
                    <br><br><br>
                     <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white bg-secondary">
                DATA SISWA
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Wali</th>
                            <th scope="col">Telpon</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from siswa order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id          = $r2['id'];
                            $nisn        = $r2['nisn'];
                            $nama        = $r2['nama'];
                            $kelas       = $r2['kelas'];
                            $wali        = $r2['wali'];
                            $telpon      = $r2['telpon'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nisn ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $kelas ?></td>
                                <td scope="row"><?php echo $wali ?></td>
                                <td scope="row"><?php echo $telpon ?></td> 
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Hapus Data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>
