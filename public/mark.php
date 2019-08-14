<?php
    require_once("../source/utilities.php");
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $conn = mysqli_connect(SERVER, USER, PW, DB);

        if (!$conn) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        } 
        
    if(isset($_GET['as'], $_GET['item'])) {
        $as = $_GET['as'];
        $item = $_GET['item'];
       
        switch($as) {
            case 'done':
            
               $doneQuery = $conn->prepare("
               UPDATE todo
               SET done = 1
               WHERE id = $item
               ");

               $doneQuery->execute();
            break;
            case 'notdone':
            $doneQuery = $conn->prepare("
               UPDATE todo
               SET done = 0
               WHERE id = $item
               ");

               $doneQuery->execute();

        }
    } else {
        var_dump($item);
    }
   
}

    header('Location: add.php');