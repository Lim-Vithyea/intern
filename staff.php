<?php
include "database.php"; 

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";


$sql = "SELECT schoolid, schname FROM school";
$info = $conn->query($sql);

// if (!$info) {
//     die("Error fetching schools: " . $conn->error);
// }
// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Form</title>
    <link rel="stylesheet" href="staff.css">
</head>
<body>
<h1>Add Staff</h1>
<div>
    <form action="" method="post">
        <?php 
        if (isset($_POST['submit'])) {
            $staff_name =$_POST['staff-name']; 
            $staff_age = (int)$_POST['staff-age']; 
            $address = $_POST['address'];
            $position =$_POST['position'];
            $gender = $_POST['gender'];
            $school = $_POST['school-id'];
            $sql = "INSERT INTO staff (stufname, age, position, `address` , gender, schlid) 
                    VALUES ('$staff_name', $staff_age, '$position','$address', '$gender', '$school')";
            if ($conn->query($sql) === TRUE) {
                echo "Added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>
        <div class="text-field">
            <label for="staff-name">Staff name</label>
            <input type="text" name="staff-name" id="" required>
            <label for="staff-age">Staff age</label>
            <input type="number" name="staff-age" required>
            <label for="position">Position</label>
            <input type="text" name="position" required>
            <label for="address">Address</label>
            <input type="text" name="address" required>
        </div>
        <div class="button">
            <label for="gender">Male</label>
            <input type="radio" name="gender" id="" value="male" required>
            <label for="gender">Female</label>
            <input type="radio" name="gender" id="" value="female" required><br>
            <!-- <label for="school-id">School</label> -->
            <select name="school-id" id="" required>
                <option value="">Select School..</option>
                <?php while ($row = $info->fetch_assoc()) { ?>
                    <option value="<?php echo htmlspecialchars($row['schoolid']); ?>">
                        <?php echo htmlspecialchars($row['schname']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" name="submit" class="" value="Add"><br>
    </form>
    <a href="index.php">Go to school section</a><br>
</div>
<?php 
 include "displayteacher.php"
?>
<a href="authen.php" id="logout">LogOut</a> 
</body>
</html>
