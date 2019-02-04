<!DOCTYPE html>
<html>
<head>
    <title>PDO-Update rekaman - PHP CRUD TUTORIAL</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Update Produk</h1>
        </div>
    <!-- kode php untuk membaca rekaman dari id ditaruh disini --> 

    <?php
    //mendapat parameter value, disini maksudnya id
    //isset() adalah fungsi php yang berguna untuk memverifikasi jika value ditemukan atau tidak
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    include "config/database.php";

    //read current record data
    try {
        // prepare select query
        $query = "SELECT id, nama, deskripsi, harga FROM products WHERE id=? LIMIT 0,1";
        $stmt=$con->prepare($query);

        //this is rhe first question mark
        $stmt->bindParam(1,$sid);

        //execute our query
        $stmt->execute();

        //store retrieved row to a variable
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        //value to fill up form
        $nama=$row['nama'];
        $deskripsi=$row['deskripsi'];
        $harga=$row['harga'];
    }

    //show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
?>
    <!--kode php untuk update rekaman ditaruh disini --> 
    <?php
    //cek apakah form telah disubmit
    if($_POST){
        try {

            //write update query
            // in this case, it seemed like we have so many fields to pass and 
            // it is better to label them and not use question marks
            $query = "UPDATE products
                        SET nama=:nama, deskripsi=:deskripsi, harga=:harga
                        WHERE id= :id";

            // prepare query for execution
            $stmt = $con->prepare($query);

            //posted values
            $nama=htmlspecialchars(strip_tags($_POST['nama']));
            $deskripsi=htmlspecialchars(strip_tags($_POST['deskripsi']));
            $harga=htmlspecialchars(strip_tags($_POST['harga']));

            //bind the parameters
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':deskripsi', $deskripsi);
            $stmt->bindParam(':harga', $harga);
            $stmt->bindParam(':id',$id);

            //execute the query
            if($stmt->execute()){
                echo "<div class='alert alert-success'> Record was updated. </div>";
            } else {
                echo "<div class='alert alert-danger'> Unable to update record. Please try again. </div>";
            }

        }
    

    //show errors
    catch (PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
    ?>


    <!-- html form untuk update rekaman akan ditaruh disini --> 
    <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]. "?id={$id}");?>" method="POST">
        <Table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo htmlspecialchars($nama, ENT_QUOTES); ?>" class="form-control" /></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><textarea name="deskripsi" class="form-control" value="<?php echo htmlspecialchars($deskripsi, ENT_QUOTES);?>"> </textarea></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><input type="text" name="harga" value="<?php echo htmlspecialchars($harga,ENT_QUOTES); ?>" class="form-control" /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="simpan perubahan" class="btn btn-primary" />
                    <a href="index.php" class="btn btn-danger"> Kembali untuk baca produk</a>
                </td>
            </tr>
        </table>
    </form>
    </div> <!-- end container --> 

    <script src="jquery-3.2.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
</body>
</html>
