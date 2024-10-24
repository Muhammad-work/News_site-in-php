<?php
include("config.php");

$userid = $_GET['id'];

$sql = "DELETE FROM news_site.user WHERE user_id = '$userid' ";
$runsql = mysqli_query($con, $sql) or die("Query Field!");
header("Location: users.php");
mysqli_close($con);
?>