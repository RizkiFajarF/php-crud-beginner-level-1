<!DOCTYPE html>
<html>
<head>
    <title>PDO-Latihan PHP CRUD</title>

    <!--Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" />
</head>
<body>

    <!--container-->
    <div class="container">
        <div class="page-header">
            <h1>Buat Produk</h1>
        </div>
    <!-- kode untuk memproses form --> 
    <?php 
    if($_POST) {
        // include database connection
        include "config/database.php";

        try{

            //insert query
            $query = "INSERT INTO products SET nama=:nama, deskripsi=:deskripsi, harga=:harga, dibuat=:dibuat";

            $stmt = $con->prepare($query);
            // posted values
            $nama=htmlspecialchars(strip_tags($_POST['nama']));
            $deskripsi=htmlspecialchars(strip_tags($_POST['deskripsi']));
            $harga=htmlspecialchars(strip_tags($_POST['harga']));

            // bind the parameters
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':deskripsi', $deskripsi);
            $stmt->bindParam(':harga', $harga);

            //menspesifikasikan kapan rekaman ini dimasukan kedalam database
            $dibuat=date('Y-m-d H:i:s');
            $stmt->bindParam(':dibuat', $dibuat);

            //eksekusi query
            if($stmt->execute()) {
                echo "<div class='alert alert-success'>Rekaman disimpan. </div>";
            } else {
                echo "<div class='alert alert-danger'>Tidak dapat menyimpan rekaman. </div>";
            }
        }
        // menampilkan error
        catch (PDOException $exception) {
            die ('ERROR: ' . $exception->getMEssage());
        }
    }
    ?>

    <!-- kode untuk memproses form selesai --> 
    <!-- html form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <table class="table table-hover table-responsive table-bordered">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" class="form-control" /></td>
            <tr>
                <td>Deskripsi</td>
                <td><textarea name="deskripsi" class="form-control"></textarea></td>
            </tr>
            <tr> 
                <td>Harga</td>
                <td><input type="text" name="harga" class="form-control" /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="simpan" class="btn btn-primary" />
                    <a href="index.php" class="btn btn-danger">Kembali untuk membaca produk</a>
                </td>
            </tr>
        </table>
    </form>
    <!-- html form end --> 
    </div>  <!-- end .container --> 

    <!-- jQuery (necessary for Bootstrap JS plugins) --> 
    <script src="jquery-3.2.1.min.js"></script>

    <!--Latest compiled and minified Bootstrap JS --> 
    <script src="bootstrap.min.js"> </script>

</body>
</html>