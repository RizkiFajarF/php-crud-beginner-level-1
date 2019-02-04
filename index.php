<!DOCTYPE html>
<html>
<head>
    <title>PDO-Latihan PHP CRUD</title>

    <link rel="stylesheet" href="bootstrap.min.css" />

    <!-- custom css -->
    <style>
    .m-r-lem{margin-right:lem;}
    .m-b-lem{margin-bottom:lem;}
    .m-l-lem{margin-left:lem;}
    .mt0{margin-top:0;}
    </style>
</head>
<body>
    <!--container--> 
    <div class="container">
        <div class="page-header">
            <h1>Baca Produk</h1>
        </div>

        <!-- Ketikan kode PHP untuk membaca rekaman tulis disini --> 
        <?php
        //include database connection

        include "config/database.php";

        //delete message prompt will be here
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        // if it was redirected from delete.php
        if($action=='deleted'){
            echo "<div class='alert alert-success'>Rekaman berhasil dihapus.</div>";
        }

        //select all data
        $query="SELECT id, nama, deskripsi, harga FROM products ORDER BY id DESC";
        $stmt=$con->prepare($query);
        $stmt->execute();

        //this is how to get number of rows returned
        $num=$stmt->rowCount();

        //link to create record form
        echo "<a href='create.php' class='btn btn-primary m-b-lem'>Buat Produk Baru </a>";
        
        //check if more than 0 record found
        if($num>0){
            // data from database will be here
            echo "<table class='table table-hover table-responsive table-bordered'>"; //mulai tabel

            //buat tabel heading
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nama</th>";
                echo "<th>Deskripsi</th>";
                echo "<th>Harga</th>";
                echo "<th>Tindakan</th>";
            echo "</tr>";

            // table body taruh disini

            //retrieve our table contents
            //fetch() is faster than fetchAll()
            //http:http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop

            while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                //extract row
                //this will make $row['firstname] to
                //just $firstname only
                extract($row);

                //creating new table row per record
                echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$nama}</td>";
                    echo "<td>{$deskripsi}</td>";
                    echo "<td>&#36;{$harga}</td>";
                    echo "<td>";

                        //read one record
                        echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-lem'>Read </a>";

                        // kita akan menggunakan link pada part lanjutan dari post ini
                        echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-lem'>Edit</a>";

                        //kita akan menggunakan link ini pada part lanjutan dari post ini
                        echo "<a href='#' onclick='delete_user({$id});' class='btn btn-danger'>Hapus</a>";

                    echo "</td>";
                echo "</tr>";
            }


            //akhir tabel
        echo "</table>";
        }
        // if no record found
        else {
            echo "<div class='alert alert-danger'>Tidak ada rekaman yang ditemukan.</div>";
        }
        ?>

    
    

    </div> <!-- end .container --> 
<!-- jquery (diperlukan untuk Bootstrap JS plugins) --> 
<script src="jquery-3.2.1.min.js"></script>

<!-- latest compiled and minified bootstrap JS --> 
<script src="bootstrap.min.js"></script>

<!-- konfirmasi hapus akan ada disini --> 
<script type="text/javascript">
//confirm record deletion
function delete_user(id) {

    var answer=confirm ('Are you sure');
    if(answer) {
        // if user clicked ok
        //pass the id to delete.php and execute the delete query
        window.location='delete.php?id=' +id;
    }
}
</script>

</body>
</html>