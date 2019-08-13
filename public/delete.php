<?php
    require_once("../source/utilities.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo "Deleting!";
        if (isset($_POST["uid"])) {
            // echo "Going to delete a post with id".$_POST["uid"];
            $conn = mysqli_connect(SERVER, USER, PW, DB);
            if (!$conn) {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                exit;
            }
            $stmt = $conn->prepare("DELETE FROM todo WHERE id = ?");
            $stmt->bind_param("s", $_POST["uid"]); // "sss" means the values are 3 strings (another type is "d" or "f")
            // set parameters and execute
            $stmt->execute();
            $conn->close();
            //I reload the page (normal get) since NO BODY has been sent
            header("Location: add.php");
        }
    }