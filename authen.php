<?php 
include "database.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // User-entered password

    $sql = "SELECT username, password, userrole FROM tbluser WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            if (password_verify($password, $hashed_password)) {
                if ($user['userrole'] == 1) {
                    header("Location: index.php"); 
                    exit();
                } elseif ($user['userrole'] == 2) {
                    header("Location: student.php"); // User page
                    exit();
                } 
            } else {
                echo "Invalid username or password!";
            }
        } else {
            echo "Invalid username or password!";
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="authen.css">
</head>
<body>
    <div class="container">
        <div id="box">
            <form action="authen.php" method="post">
                <label for="username">Username</label><br>
                <input type="text" name="username" placeholder="Enter your name" required/><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" placeholder="Enter your password" required/><br>
                <button type="submit" name="submit">Log in</button>
            </form>
        </div>
    </div>
</body>
</html>
