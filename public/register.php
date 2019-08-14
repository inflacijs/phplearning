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
        if(isset($_POST["email"])) $lastname = $_POST["email"];
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
        header("Location: register.php");
    }
?>
    <form action="register.php" method="POST">
        <div>UserName<input name="uname" required placeholder="Enter User Name"></div>
        <div>Password<input name="pw" type="password" required></div>
        <div>Password(repeat)<input name="pw2" required></div>
        <div>Last Name (optional)<input name="lastname" placeholder=""></div>
        <div>E-mail<input name="email" type="email" ></div>

        <button type="submit">SUBMIT</button>
    </form> 