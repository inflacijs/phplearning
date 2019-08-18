<?php
    
    require_once("../source/utilities.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if (isset($_POST["id"])) {
            
            $conn = mysqli_connect(SERVER, USER, PW, DB);
            if (!$conn) {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                exit;
            }
            if (isset($_POST["content"])) {
                $content = $_POST["content"];
            } else {
                $content = "EMPTY!";
            }
            $stmt = $conn->prepare("UPDATE todo SET task = ? WHERE id = ?;");
            $stmt->bind_param("ss",  $content, $_POST["id"]); // "sss" means the values are 3 strings (another type is "d" or "f")
            // set parameters and execute
            $stmt->execute();
            $conn->close();
            header("Location: add.php");
        }
    }