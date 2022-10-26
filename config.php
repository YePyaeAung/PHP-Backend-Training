<?php

define('MYSQL_HOST', "localhost");
define('MYSQL_DBNAME', "phpmysql");
define('MYSQL_USER', "root");
define('MYSQL_PASSWORD', "Aaa123!@");

// $pdo = new PDO('mysql:host=localhost;dbname=phpmysql', 'root', 'Aaa123!@');

$pdo = new PDO('mysql:host=' . MYSQL_HOST .';dbname=' . MYSQL_DBNAME, MYSQL_USER, MYSQL_PASSWORD);
