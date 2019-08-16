<?php
    //TODO use session as well
    require_once("../source/utilities.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo "Deleting!";
        if (isset($_POST["id"])) {
            // echo "Going to delete a post with id".$_POST["uid"];
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
            //I reload the page (normal get) since NO BODY has been sent
            header("Location: add.php");
        }
    }