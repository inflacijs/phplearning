<?php
 require_once("../source/utilities.php");
    require_once("../source/head.php");
    // $myres = getRows("SELECT * FROM tracks");
    // printTable($myres, "mytablestyle");
    //printHTMLHeader
    // echo $_GET["name"];
    // echo $_GET["artist"];
    echo "<hr>";
    printTable(getRows("SELECT * FROM todo"), "mytablestyle");
    require_once("../source/foot.php");