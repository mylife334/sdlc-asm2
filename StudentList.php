<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #C0C0C0;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fff
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #CCCCFF;
        }
        caption {
            font-size: 20px;
            margin-bottom: 20px;
        }
        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff; 
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="submit"], input[type="reset"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="reset"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #0056b3;
        }
        input[type="submit"]:focus, input[type="reset"]:focus {
            outline: none;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
    <?php
    include "db_conn.php";
    $sql = "select * from students";
    //Executing query
    $result = mysqli_query($conn,$sql);
    ?>

    <table align="center" border="1px" cellpadding="0" cellspacing="0">
    <caption align="center">Student List</caption>
    <tr>
        <th>Rollno</th>
        <th>Student Fullname</th>
        <th>Address</th>
        <th>Email</th>
        <th>Action</th> <!-- New Column for Action Buttons -->
    </tr>

    <?php
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {        
    ?>
    <tr>
        <td><?php echo $row['Rollno']; ?></td>
        <td><?php echo $row['Sname']; ?></td>
        <td><?php echo $row['Address']; ?></td>
        <td><?php echo $row['Email']; ?></td>
        <td class="action-buttons">
            <a href="edit_student.php?id=<?php echo $row['Rollno']; ?>">Edit</a>
            <a href="delete_student.php?id=<?php echo $row['Rollno']; ?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
        </td> <!-- Edit and Delete Buttons -->
    </tr>
    <?php
        }
    ?>
    </table>
    
    <!-- Add student -->
    <?php
    include "db_conn.php";
    if(isset($_POST['btnAdd']))
    {
        //Get data from student form
        $Rollno = $_POST['Rollno'];
        $Sname = $_POST['Sname'];
        $Address = $_POST['Address'];
        $Email = $_POST['Email'];
        if($Rollno=="" || $Sname=="" || $Address=="" || $Email=="")
        {
            echo "(*) is not empty";
        }
        else
        {
            //Retrieving data from table
            $sql = "select Rollno from students where Rollno='$Rollno'";
            //Executing query
            $result = mysqli_query($conn,$sql);
            //Testing exist data and then insert into table
            if(mysqli_num_rows($result)==0)
            {
                $sql = "INSERT INTO students VALUES ('$Rollno', '$Sname', '$Address', '$Email')";
                mysqli_query($conn,$sql);
                echo '<meta http-equiv="refresh" content="0; URL=StudentList.php"';
            }
            else
            {
                echo "Existed student in list";
            }

        }
    }
    ?>

    <form action="logout.php" method="port">
        <button type="submit">Logout</button>
        <a href="index.php" class="ca"></a>
    </form>

    <div class="add-student-form">
        <form method="post">
           <caption><b>Adding Student</b></caption> 
           <div>
                <label for="Rollno">Rollno:</label>
                <input type="text" name="Rollno" id="Rollno" required/>
           </div>

           <div>
                <label for="Sname">Student Name:</label>
                <input type="text" name="Sname" id="Sname" required/>
           </div>

           <div>
                <label for="Address">Student Address:</label>
                <input type="text" name="Address" id="Address" required/>
           </div>

           <div>
                <label for="Email">Student Email:</label>
                <input type="text" name="Email" id="Email" required/>
           </div>

           <div>
                <input type="submit" value="Add" name="btnAdd"/>
                <input type="reset" value="Cancel" name="btnCancel"/>
           </div>
        </form>
    </div>

</body>
</html>
