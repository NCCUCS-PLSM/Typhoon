<?php
    $dbhost = "localhost";
    $dbuser = "typhoon";
    $dbpass = "*";
    $dbname = "weka_typhoon";
    $connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Error with MySQL conntection.");
    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
?>
