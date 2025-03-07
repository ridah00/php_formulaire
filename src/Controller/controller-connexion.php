<?php

require_once('../../config.php');
$regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$regex_pseudo = "/^[a-zA-Z0-9-_.]{5,20}$/";
$regex_pwd_8 = "/[a-zA-Z0-9_@.]{8,30}$/";
$errors = [];

if (isset($_SESSION)) {
    header('Location: controller-profil.php');
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * from `76_users` where user_mail = :mail OR user_pseudo = :mail ;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
    $stmt->execute();



    if (empty($_POST["password"])) {
        $errors['password'] = 'champs obligatoire';
    }


    if (empty($_POST["mail"])) {
        $errors['mail'] = 'champs obligatoire';
    } else if ($stmt->rowCount() == 0) {
        $errors['mail'] = "utilisateur n'existe pas pensez bien a vous inscrire";
    }


    if (empty($errors)) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($_POST['password'], $user['user_password'])) {
            session_start();
            $_SESSION = $user;
            unset($_SESSION['user_password']);
            
            header('Location: controller-accueil.php');
        } else {
            $errors['password'] = 'password incorrecte';

        }
    }
    $pdo = null;
}


include_once('../View/view-connexion.php');
