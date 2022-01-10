<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sql Trening</title>
</head>
<body>
    <?php   
        require "import/nav.php"; 
        require "import/connect.php";
    ?>
    <div class="contents row row-cols-1 row-col s-md-3 row-cols-lg-4 g-4 ">
        <?php
                $query=$pdo->query("select username from trainers inner join users using(id) ");
        
                while($row=$query->fetch()){
                    echo "
                        <div class='card'>
                        <img src='/uploads/profile-images/{$_SESSION["user"]["id"]}.jpg' class='' alt=''>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row["username"]}</h5>
                            </div>
                        </div>
                    
                    ";
                }
        ?>
    </div>
</body>
</html>