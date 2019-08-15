<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Static HTML</title>
    <link rel="stylesheet" href="styles/font-awesome.css">
    <link rel="stylesheet" href="styles/style.login.css">
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
        // $_SESSION['uname'] = $_POST['uname'];
        if (isset($_POST['logout'])) {
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            echo "We are logged out";
            header("Location: login.php");
            //so the rest of the code should not execute here
        }
        $conn = mysqli_connect(SERVER, USER, PW, DB);
        header("Location: login.php");

        if (!$conn) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        //TODO field validation from https://www.php.net/book.filter
        if (!isset($_POST["uname"])) header("Location: login.php");
        $username = $_POST["uname"];
        $pw = $_POST['pw'];
        $stmt = $conn->prepare("SELECT id, username, pwhash FROM users WHERE username = ?");
        $stmt->bind_param("s", $username); // "sss" means the values are 3 strings (another type is "d" or "f")
        // set parameters and execute
        $stmt->execute();
        $res = $stmt->get_result();
        $conn->close();
        
        if ($res->num_rows < 1) {
            echo "Bad Login";
        }
        $row = $res->fetch_assoc();
        // var_dump($row);
        // echo $row['username'];
        // echo $row['id'];
        // echo $row['pwhash'];
        if (password_verify ($pw , $row['pwhash'])) {
            echo "Logged in";
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $username;
            echo $username."is logged in<br>";
            header("Location: add.php");
        }else {
            header("Location: login.php"); 
        }
       
        // $_SESSION['uname'] = $_POST['uname'];
          
    }
?>
<div class="log-form">
<h2>Login to your accont</h2>

<form method="POST" action="login.php">
   
<input type="text" name="uname" title="username" placeholder="username">
    
<input type="password" name="pw" class="btn" title="username" placeholder="password">
<button type="submit" id="button2"  name="login">LOGIN</button>
<a class="forgot" href="register.php">Register your accont</a>
</form>
</div>
<?php
require_once("../source/foot.php");