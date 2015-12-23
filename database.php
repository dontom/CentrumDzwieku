<?php
$server = 'coachseadlcd.mysql.db';
$user = 'coachseadlcd';
$password = 'Eg2Rnqxrsvt7';
$db = "coachseadlcd";
$connect = new mysqli($server, $user, $password, $db);

// check connection
if ($connect->connect_error) {
    trigger_error('Database connection failed: '  . $connect->connect_error, E_USER_ERROR);
}
?>