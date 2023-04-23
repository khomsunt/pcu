<?php
$config = include "../include/config.ini.php";
try {
    $con = new PDO('mysql:host=' . $config['hostname'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
