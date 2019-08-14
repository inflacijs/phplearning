<?php
require_once("../config/config.php");


function printTable($result, $classesCSS) {
    $items=$result->fetch_all();
    $columns=$result->fetch_fields();
    $currentDateTime = date('Y-m-d ');
    echo "<div class='container'>";
    
    echo "<div class='header'>
          <div id='date'>$currentDateTime</div>   
    </div>";
   if(!empty($items)) : 
    echo "<ul class=$classesCSS id='list'>";

    

    
    foreach ($items as  $key => $item) {
        // var_dump($item[0]);
        echo "<li class='item'>
        
            <span class='text'>$item[1]</span>
            <div class='a-container'>
            <a href='mark.php?as=done&item=".$item[0]."' id='a-check'><input id='c".$item[0]."' type='checkbox' class='check'><label for='c".$item[0]."'></label></a>
            </div>
            <a href=''>
            <i class='fa fa-trash-o de' job='delete' id='0' value=".$item[0]." name='uid'>
            </i>
            </a>
              </li>";
       
    }
    echo "</ul>";
else:
    echo "<p>To do list is empty / day off of to does!</p>";
endif; 
echo "<form class='add-item' action='add.php' method='POST'>
        <input name='task' class='inputTask' placeholder='type your todo' required>
        <button type='submit'  value='add' class='submit'>ADD</button>
    </form>" ;
    echo "</div>";
}




function getRows($sql) {
    $conn = mysqli_connect(SERVER, USER, PW, DB);

    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    // echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    // echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;
    // echo "<br>";
    $result = $conn->query($sql);
    mysqli_close($conn);

    return $result;
}