
<?php 
include "database.php";

if (isset($_POST['submit'])) {
    $school_name = $_POST['school-name'];
    $school_location = $_POST['school-location'];
    
    $sql = "INSERT INTO `school`(`schname`, `location`) VALUES ('$school_name', '$school_location')";
    $result = $conn->query($sql);
    
//     if ($result === TRUE) {
//         echo "Added";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
//     $conn->close();
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>School Registeration</h1>
    <div class="container">
    <div> 
        <form action="index.php" method="post">
            <label for="school-name">School name</label>
            <input type="text" name="school-name" id="school-name" required>
            <br>
            <label for="school-location">Location</label>
            <input type="text" name="school-location" id="school-location" required>  
            <br>
            <input type="submit" name="submit" class="login-btn" value="Add"> 
        </form>
    </div>
    </div>
    <a href="staff.php">Go to staff section</a><br>
    <a href="student.php">Go to student section</a>
    <?php 
    include "displayschool.php";
    ?>
</body>
</html>
