<?php
$request_url = explode('/', $_SERVER['REQUEST_URI']);

session_start();
// Router
if(!isset($_SESSION["user"]) && $request_url[1] != "login") $request_url[1] = "";
switch ($request_url[1]) {
    // Login/Fooldal
    /* Normal user */
    case '':
        if(isset($_SESSION["user"]))
            include 'public/main.php';
        else
            require 'public/login.html';
        break;
    case 'terms': 
        require 'public/terms.html';
        break;
    case 'settings': 
        require 'public/settings.php';
        break;

    /* Admin */
    case 'feladatbank':
        require "public/admin/taskbank.php";
        break;
    case 'feladatkituzes':
        require "public/admin/postTask.php";
        break;
    case 'test':
        require "public/test.php";
        break;    

    /* Imports */
    case 'login':
        require 'import/login.php';
        break;  
    case 'settings_backend':
        require 'import/settings.backend.php';
        break;  
    case 'logout':
        require 'import/logout.php';
        break;  
    case 'deleteAccount':
        require 'import/delete.php';
        break;
    case "taskBankUpload":
        require "import/taskBank.backend.php";
        break;
    case "postTaskBackend":
        require "import/postTask.backend.php";
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        require 'public/404.php';
        break;
    }
?>