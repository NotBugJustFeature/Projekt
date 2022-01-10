<?php
define("HOSTNAME", "localhost:3306");
define("DB_CHARSET", "utf8");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "dusza");

try{
    $pdo = new PDO(
        "mysql:host=".HOSTNAME.";dbname=".DB_NAME.";charset=".DB_CHARSET,
        DB_USERNAME, DB_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) { 
    exit($ex->getMessage()); 
}
?>