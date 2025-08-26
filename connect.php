<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "it-exam"; // <== ต้องแก้เป็นชื่อฐานข้อมูลจริง

$con = mysqli_connect($host, $user, $password, $dbname);


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>