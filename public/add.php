<?php
    require_once("../source/utilities.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect(SERVER, USER, PW, DB);

        if (!$conn) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
      
        //    Adding information to data base
        if(isset($_POST['task'])) {
            $task = trim($_POST['task']);

            if(!empty($task)){
                $addedQuery = $conn->prepare("
                INSERT INTO todo (task, done, created) 
                VALUES (?, 0, NOW())
                ");
                $addedQuery->bind_param("s", $task);

                $addedQuery->execute();
            }
        }

        $conn->close();
        //I reload the page (normal get) since NO BODY has been sent
        header("Location: add.php");
    }

    require_once("../source/head.php");

   

 
    
    $qry = "SELECT * FROM todo"; 
    printTable(getRows($qry), "mytablestyle");
    ?>
    
     <form class="add-item" action="add.php" method="POST">
        <input name="task" class="inputTask" placeholder="type your todo" required>
        <!-- <input name="artist" placeholder="Enter artist">
        <input name="album" value="Back in Black"> -->
        <button type="submit"  value="add" class="submit">SUBMIT</button>
    </form>

    <?php

    require_once("../source/foot.php");