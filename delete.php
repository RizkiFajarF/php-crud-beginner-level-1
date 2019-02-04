<?php
// include database connection
include "config/database.php";

try {
    // get record id
    // isset() is a php function used to verify
    $id=isset($_GET['id']) ? $_GET['id'] : die ('ERROR: Record ID not found.');

    // delete query
    $query = "DELETE FROM products WHERE id=?";
    $stmt=$con->prepare($query);
    $stmt->bindParam(1,$id);

    if($stmt->execute()) {
        // redirect to read record page and tell user record was deleted
        header('Location:index.php?action=deleted');
    }else {
        die('Unable to delete record.');
    }
}

// show error
catch (PDOException $exception) {
    die("ERROR: " . $exception->getMessage());
}
?>