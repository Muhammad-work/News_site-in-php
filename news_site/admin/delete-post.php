<?php 
include("config.php");

$post_id = $_GET['id'];
$category_id = $_GET['cat_id'];

$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$category_id}";

if(mysqli_multi_query($con , $sql)){
    header("Location: post.php");
}else{
    echo "Query Failed!";
};
?>