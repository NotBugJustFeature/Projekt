<?php
    class Users {
        private $pdo = null;
        private $query = null;
        public $error = null;
        function __construct () {
            try {
                $this->pdo = new PDO(
                    "mysql:host=".HOSTNAME.";dbname=".DB_NAME.";charset=".DB_CHARSET,
                    DB_USERNAME, DB_PASSWORD
                );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $ex) { 
                exit($ex->getMessage()); 
            }
        }

        // Adatbazis kapcsolat bezarasa
        function __destruct () {
            $this->query = null;
            $this->pdo = null;
        }
        function getPermission($email){
            $sql = "SELECT users.id from users inner join trainers USING(id) where email = '{$email}';";
            $this->query = $this->pdo->prepare($sql);
            $this->query->execute();
            $res = $this->query->fetch();
            $_SESSION["isAdmin"] = ($res == "" ) ? false : true;
        }
        // Felhasznalo kikerese id alapjan
        function get ($id) {
            $sql = sprintf("SELECT * FROM `users` WHERE `%s`=?",is_numeric($id) ? "id" : "email");
            $this->query = $this->pdo->prepare($sql);
            $this->query->execute([$id]);
            return $this->query->fetch();
        }

        //Bejelentkezes
        function login ($email, $password) {
            
            $this->getPermission($email);
            //be van-e jelentkezve
            if (isset($_SESSION["user"])) { return true; }

            // felhasznalo kikerese adatbazisbol
            $user = $this->get($email);
            if (!is_array($user)) { return false; }

            // felhasznalo hitelesitese
            if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = [];
            foreach ($user as $i=>$b) {
                if ($i!="user_password") $_SESSION["user"][$i] = $b;
            }
            return true;
            }
            return false;
        }

        // Felhasznalo beirasa adatbazisba
        function save ($username, $email, $password, $id=null) {
            $pass = password_hash($password, 1);
            if ($id===null) {
                $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)";
                $data = [$username, $email, $pass];
            }/*
            $sql = "UPDATE `users` SET `user_name`=?, `user_email`=?, `user_password`=? WHERE `user_id`=?";
            $data = [$name, $email, password_hash($pass, 1), $id];*/

            try {
                $this->query = $this->pdo->prepare($sql);
                $this->query->execute($data);
            } catch (Exception $ex) {
                $this->error = $ex->getMessage();
                return false;
            }
            $this->login($email, $password);
            return true;
        }
    }
?>