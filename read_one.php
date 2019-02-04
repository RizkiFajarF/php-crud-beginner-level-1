<!DOCTYPE! html>
<html>
<head>
    <title>PDO - MEMBACA SATU REKAMAN- PHP CRUD TUTORIAL</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
</head>
<body>

    <!-- container --> 
    <div class="container">

        <div class="page-header">
            <h1>Membaca Produk</h1>
        </div>

        <!-- Kode php untuk membaca satu rekaman akan ditaruh disini --> 
        <?php
        // mendapat nilai parameter, kasus disini adalah id
        // isset() adalah fungsi untuk memverifikasi apakah nilai ada atau tidak
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        // include database connection
        include "config/database.php";

        // read current record data
        try {
            // prepare select query
            $query="SELECT id, nama, deskripsi, harga FROM products WHERE id = ? LIMIT 0,1";
            $stmt= $con->prepare( $query);

            //this is the first question mark
            $stmt->bindParam(1, $id);

            //execute our query
            $stmt->execute();

            //store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //values to fill up our form
            $nama=$row['nama'];
            $deskripsi=$row['deskripsi'];
            $harga = $row['harga'];
        }

        //show error
        catch(PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>
```
        <!-- kode html untuk membaca satu rekaman tabel akan ditaruh disini --> 
        <!-- tabel html tempat rekaman ditampilkan --> 
        <table class="table table-hover table-responsive table-bordered">
            <tr>
                <td>Nama</td>
                <td><?php echo htmlspecialchars($nama, ENT_QUOTES); ?> </td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><?php echo htmlspecialchars($deskripsi, ENT_QUOTES); ?> </td>
            </tr>
            <tr>
                <td>Harga</td>
                <td><?php echo htmlspecialchars($harga, ENT_QUOTES); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="index.php" class="btn btn-danger"> Kembali Lihat produk </a>
                </td>
            </tr>
        </table>



    </div> <!-- end .container --> 

<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>

</body>
</html>