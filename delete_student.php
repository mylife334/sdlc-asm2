<?php
include "db_conn.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE Rollno='$id'";
    if(mysqli_query($conn, $sql)) {
        header("Location: StudentList.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
