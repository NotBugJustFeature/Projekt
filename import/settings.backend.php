<?php

require "connect.php";

function getExtension($name){
    $name_ext = explode(".", $name);
    return $name_ext[count($name_ext)-1];
}   

if(isset($_FILES["profile_img"]))
    if($_FILES["profile_img"]['error']){
        echo "fileUploadFailed ";
    } else {
        move_uploaded_file( $_FILES['profile_img']['tmp_name'], "uploads/profile-images/".$_SESSION["user"]["id"].".jpg");   
        echo "img success";
    }

if(isset($_POST["accountId"])){
    $pdo->exec("delete from users where id = ". $_POST["accountId"]);
    require_once "logout.php";
    echo "logout";
}
if(isset($_POST['password'])){
    //print_r($_POST);
    $ex = $pdo->prepare("update users set password = ? where id = ?" );
    $ex->execute([password_hash($_POST['password'], 1), $_POST["account_Id"]]);
    require_once "logout.php";
    echo "logout";
}
?>