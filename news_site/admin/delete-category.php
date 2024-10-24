<?php
include("config.php");
$userid = $_GET['id'];

$sql = "DELETE FROM news_site.category WHERE category_id = $userid";
$runsql = mysqli_query($con, $sql) or die("Query Field!");
header("Location: category.php");
mysqli_close($con);
