<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include "connect.php";
$dev_id = $_GET['dev_id'];
$sql = "DELETE FROM device WHERE dev_id=$dev_id";
mysqli_query($con, $sql);
header("Location: showDev.php");
?>
