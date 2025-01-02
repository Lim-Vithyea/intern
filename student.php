<?php
include "database.php"; 
$sql = "SELECT stufid, stufname FROM staff";
$info = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="student.css">
</head>

<body>
    <h1>Add Student</h1>
    <form action="student.php" method="post">
        <div class="text-field">
            <?php 
                if (isset($_POST['submit'])) {
                    $student_name = $_POST['student-name']; 
                    $student_age = (int)$_POST['student-age'];
                    $gender = $_POST['gender'];
                    $teacher = $_POST['teacher-id'];

                    // Make sure to use prepared statements to avoid SQL injection
                    $sql = "INSERT INTO student (name, age, gender, teacherid) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("siss", $student_name, $student_age, $gender, $teacher);

                    if ($stmt->execute()) {
                        echo "Added successfully";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                }
            ?>
            <label for="student-name">Student Name</label>
            <input type="text" name="student-name" id="student-name" required>
            <label for="student-age">Student Age</label>
            <input type="number" name="student-age" id="student-age" required>
            <div class="button">
                <label for="gender">Male</label>
                <input type="radio" name="gender" id="gender-male" value="male" required>
                <label for="gender">Female</label>
                <input type="radio" name="gender" id="gender-female" value="female" required><br>

                <select name="teacher-id" id="teacher-id" required>
                    <option value="">Select teacher</option>
                    <?php while ($row = $info->fetch_assoc()) { ?>
                    <option value="<?php echo htmlspecialchars($row['stufid']); ?>">
                        <?php echo htmlspecialchars($row['stufname']); ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <input type="submit" name="submit" value="Add">
            
        </div>
    </form>
    <?php include"displaystudent.php" ?>
    <a href="authen.php" id="logout">Logout</a>
</body>

</html>
