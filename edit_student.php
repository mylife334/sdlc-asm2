<?php
include "db_conn.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE Rollno='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['btnUpdate'])) {
    $Rollno = $_POST['Rollno'];
    $Sname = $_POST['Sname'];
    $Address = $_POST['Address'];
    $Email = $_POST['Email'];

    $sql = "UPDATE students SET Sname='$Sname', Address='$Address', Email='$Email' WHERE Rollno='$Rollno'";
    if(mysqli_query($conn, $sql)) {
        header("Location: StudentList.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            padding: 10px;
            background-color: #CCCCFF;
        }
        caption {
            font-size: 20px;
            margin-bottom: 20px;
        }
        form {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #218838; /* Màu nền xanh lá cây nhạt khi hover */
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Edit Student</h2>
    <form method="post">
        <input type="hidden" name="Rollno" value="<?php echo $row['Rollno']; ?>">
        Student Name: <input type="text" name="Sname" value="<?php echo $row['Sname']; ?>"><br><br>
        Address: <input type="text" name="Address" value="<?php echo $row['Address']; ?>"><br><br>
        Email: <input type="text" name="Email" value="<?php echo $row['Email']; ?>"><br><br>
        <input type="submit" name="btnUpdate" value="Update">
    </form>
</body>
</html>
