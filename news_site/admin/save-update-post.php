<?php
include("config.php");

if (empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old-image'];
} else {
    $error = [];

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $tamp_name = $_FILES['new-image']['tmp_name'];
    $type = $_FILES['new-image']['type'];
    $extention = end(explode('.', $file_name));
    $ext = ['jpg', 'png', 'jpeg', 'webp'];

    if (in_array($extention, $ext) == false) {
        echo  $error = ['This extention file is not allowed, please choose a png jpg or jpeg webpp file!'];
    }

    if ($file_size > 2097152) {
        echo  $error = ['File size must be 2 mb'];
    }

    if (empty($error) === true) {
        move_uploaded_file($tamp_name, "upload/" . $file_name);
    } else {
        print_r($error);
        die();
    }
}


$sql = "UPDATE post SET title = '{$_POST['post_title']}', description = '{$_POST['postdesc']}', category = {$_POST['category']}, post_img = '$file_name'
WHERE post_id = {$_POST['post_id']} ";

$runsql = mysqli_query($con , $sql);

if($runsql){
 header("Location: post.php");
}else{
    echo "Query Failed!";
}