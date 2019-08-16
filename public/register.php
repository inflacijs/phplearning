<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Static HTML</title>
    <link rel="stylesheet" href="styles/font-awesome.css">
    <link rel="stylesheet" href="styles/style3.css">
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="scripts/main.js" defer></script>
</head>
<body>
<?php
    session_start();
    require_once("../source/utilities.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect(SERVER, USER, PW, DB);
        if (!$conn) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        $username = $_POST["uname"] ;
        $lastname = "";
        if(isset($_POST["lastname"])) $lastname = $_POST["lastname"];
        $email = "";
        if(isset($_POST["email"])) $email = $_POST["email"];
        $pwhash = "BadHash";
        if ($_POST["pw"] == $_POST["pw2"] ) {
            $pwhash = password_hash($_POST["pw"], PASSWORD_DEFAULT);
        } else {
            header("Location: register.php");
        }
        
        $stmt = $conn->prepare("INSERT INTO users (username, lastname, email, pwhash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $lastname, $email, $pwhash); // "sss" means the values are 3 strings (another type is "d" or "f")
        // set parameters and execute
        $stmt->execute();
        $conn->close();
        echo 
        header("Location: login.php");
    }
?>
<div class="log-form">
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <div class="reg-div">UserName<input name="uname" required ></div>
        <div class="reg-div">Password<input name="pw" type="password" required></div>
        <div class="reg-div">Password(repeat)<input type="password" name="pw2" required></div>
        <div class="reg-div">Last Name (optional)<input name="lastname" placeholder=""></div>
        <div class="reg-div">E-mail<input name="email" type="email" ></div>

        <button type="submit">SUBMIT</button>
    </form> 
</div>
<?php
    require_once("../source/foot.php");