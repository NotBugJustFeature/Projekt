<?php
require "import/connect.php";
require "import/user.class.php";

$USR = new Users();
if( $_POST["formName"] == "signin" ){
    echo $USR->login($_POST['email'], $_POST['password'])? "success" : "failed";
}else{
    if($_POST["formName"] == "signup"){
        if($USR->get($_POST['email']) != ""){
            echo "failed";
        }else{
            echo $USR->save($_POST['username'], $_POST['email'], $_POST['password'])? "success" : "failed";
        }
    }
}
?>