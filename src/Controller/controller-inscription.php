<?php
$regex_que_lettre = "/^[a-zA-Zéèï]+$/";
$regex_pseudo = "/^[a-zA-Z0-9-_.]{5,20}$/";
$regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$regex_pwd_8 = "/[a-zA-Z0-9_@.]{8,30}$/";
$date = date('Y-m-d');
$c_password_value = '';
$min_date = date('Y-m-d', strtotime("-10 years"));
$max_date = date('Y-m-d', strtotime("-110 years"));
$errors = [];
function safe_input($string): string
{
    $string = trim($string);
    $string = htmlspecialchars($string);
    return $string;
}

require_once('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (empty($_POST["lastname"])) {
        $errors['lastname'] = 'champs obligatoire';
    } elseif (!preg_match($regex_que_lettre, $_POST["lastname"])) {
        $errors['lastname'] = 'caracteres non autorisés';
    }


    if (empty($_POST["firstname"])) {
        $errors['firstname'] = 'champs obligatoire';
    } elseif (!preg_match($regex_que_lettre, $_POST["firstname"])) {
        $errors['firstname'] = 'caracteres non autorisés';
    }


    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * from `76_users` where user_pseudo = :pseudo;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $stmt->execute();
    $pdo=null;

    if (empty($_POST["pseudo"])) {
        $errors['pseudo'] = 'champs obligatoire';
    }elseif (!preg_match($regex_pseudo, $_POST["pseudo"])) {
        $errors['pseudo'] = 'caracteres non autorisés';
    }elseif ($stmt->rowCount()==1) {
        $errors['pseudo'] = 'Ce pseudo est déja utilisé';
    }

    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * from `76_users` where user_mail = :mail;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
    $stmt->execute();
    $pdo=null;




    if (empty($_POST["mail"])) {
        $errors['mail'] = 'champs obligatoire';
    } elseif (!preg_match($regex_email, $_POST["mail"])) {
        $errors['mail'] = 'syntaxe autorisé = (***@**.***)';
    }elseif ($stmt->rowCount()==1) {
        $errors['mail'] = 'Ce mail est déja utilisé';
    }

    if (empty($_POST["password"])) {
        $errors['password'] = 'champs obligatoire';
    } elseif (!preg_match($regex_pwd_8, $_POST["password"])) {
        $errors['password'] = 'au moins 8 caracteres';
    }

    (!array_key_exists('c_password', $errors)) ?  $c_password_value = $_POST['c_password'] : '';

    if (empty($_POST["c_password"])) {
        $errors['c_password'] = 'champs obligatoire';
    } elseif ($_POST["c_password"] != $_POST["password"]) {
        $errors['c_password'] = 'Les mots de passe ne correspondent pas.';
    }

    if (empty($_POST["birthdate"])) {
        $errors['birthdate'] = 'champ obligatoire';
    } else if ($_POST['birthdate'] > $min_date) {
        $errors['birthdate'] = 'age minimum autorisé : 10 ans';
    } elseif ($_POST['birthdate'] < $max_date) {
        $errors['birthdate'] = 'age maximum autorisé : 110 ans';
    }

    if (empty($_POST["gender"])) {
        $errors['gender'] = 'champs obligatoire';
    } elseif ($_POST["gender"] != 'homme' && $_POST["gender"] != 'femme') {
        $errors['gender'] = 'choix non autorisé';
    }
    if (!isset($_POST['condition'])) {
        $errors['condition'] = 'champs obligatoire';
    }

    if (empty($errors)) {

        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        var_dump($pdo);
        $sql = "INSERT INTO `76_users` (user_lastname,user_firstname,user_pseudo,user_birthdate,user_mail,user_password,user_gender) 
                VALUES (:lastname,:firstname,:pseudo,:birthdate,:mail,:password,:gender);";

        $stmt = $pdo->prepare($sql);


        $stmt->bindValue(':lastname',  safe_input($_POST['lastname']), PDO::PARAM_STR);
        $stmt->bindValue(':firstname', safe_input($_POST['firstname']), PDO::PARAM_STR);
        $stmt->bindValue(':pseudo',    safe_input($_POST['pseudo']), PDO::PARAM_STR);
        $stmt->bindValue(':birthdate', safe_input($_POST['birthdate']), PDO::PARAM_STR);
        $stmt->bindValue(':mail',      safe_input($_POST['mail']), PDO::PARAM_STR);
        $stmt->bindValue(':password',  password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue(':gender',    safe_input($_POST['gender']), PDO::PARAM_STR);

        if ($stmt->execute()) {
            header('Location: controller-confirmation.php');
            exit();
        };
        $pdo = null;
    }
}
include_once('../View/view-inscription.php');
