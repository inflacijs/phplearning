<form method="POST" action="login.php" >
<button type="submit" name="logout" class="logout" onclick="onLogin()">LOGOUT</button>
        </form>
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
      
        echo'<form method="POST" action="login.php">
        
        <button type="submit" name="logout">LOGOUT</button>
        </form>';

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

        if (!isset($_SESSION['id'])) {
            header("Location: tough.php");
        }
        $mytask = ($_POST['task']);
        $stmt = $conn->prepare("INSERT INTO todo (task, uid) VALUES (?, ?)");
        $stmt->bind_param("sd", $mytask, $_SESSION['id']);
        $stmt->execute();
        $conn->close();
        //I reload the page (normal get) since NO BODY has been sent
        header("Location: add.php");
    }

    require_once("../source/head.php");
    if (isset($_SESSION['username'])) {
        echo "Hello".$_SESSION['username']."<br>";
        echo "Your ID".$_SESSION['id']."<br>";
    }
    if (isset($_SESSION["id"])) {
        $qry = "SELECT * FROM todo WHERE uid = ".$_SESSION["id"].";"; 
    } else {
        //maybe you dont want to show anything when not logged in
        $qry = "SELECT *FROM todo"; 
    }
   

 
   
    printTable(getRows($qry), "mytablestyle");


    require_once("../source/foot.php");