<?php
 require_once("../source/utilities.php");
    require_once("../source/head.php");

    echo "<hr>";
    printTable(getRows("SELECT * FROM todo"), "mytablestyle");
    require_once("../source/foot.php");