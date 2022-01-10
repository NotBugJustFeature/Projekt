<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sql Trening</title>
    <style>
        .hide-a { 
            color: inherit !important;
            text-decoration: inherit !important;
        }
    </style>
</head>
<body>
    <?php   
        require "import/nav.php"; 
        require "import/connect.php";

        if($_SESSION['isAdmin']){
            foreach($pdo->query("select id, username, email from users order by username") as $res){
                echo $res[0]." ".$res[1]." ".$res[2]."<br>";
                //print_r($res);
            }
        }
    ?>
</body>
</html>