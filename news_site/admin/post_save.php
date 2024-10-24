<?php
include("config.php");
if (isset($_FILES['fileToUpload'])) {
    $error = [];

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $tamp_name = $_FILES['fileToUpload']['tmp_name'];
    $type = $_FILES['fileToUpload']['type'];
    $extention = end(explode('.', $file_name));
    $ext = ['jpg', 'png', 'jpeg','webp'];

    if (in_array($extention, $ext) == false) {
        echo  $error = ['This extention file is not allowed, please choose a png jpg or jpeg webpp file!'];
    }

    if ($file_size > 2097152) {
        echo  $error = ['File size must be 2 mb'];
    }

    if(empty($error) === true){
        move_uploaded_file($tamp_name , "upload/".$file_name);
    } else{
        print_r($error);
        die();
    }
}

session_start();
$title = mysqli_real_escape_string($con, $_POST['post_title']);
$description = mysqli_real_escape_string($con, $_POST['postdesc']);
$selectCategory = mysqli_real_escape_string($con, $_POST['category']);
$date = date("d M , Y");
$author = $_SESSION['userid'];

$sql = "INSERT INTO post(title, description, category,post_date,author,post_img) 
VALUES('$title','$description',$selectCategory,'$date', $author,'$file_name');";
$sql .= "UPDATE category SET post = post + 1 where category_id = $selectCategory";

if(mysqli_multi_query($con , $sql)){
    header("Location: post.php");
}else{
    echo"<div class='alert alert-danger'>Query Feild!</div>";
}

?>
