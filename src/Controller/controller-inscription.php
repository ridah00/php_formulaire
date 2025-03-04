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

    if (empty($_POST["pseudo"])) {
        $errors['pseudo'] = 'champs obligatoire';
    } elseif (!preg_match($regex_pseudo, $_POST["pseudo"])) {
        $errors['pseudo'] = 'caracteres non autorisés';
    }

    if (empty($_POST["mail"])) {
        $errors['mail'] = 'champs obligatoire';
    } elseif (!preg_match($regex_email, $_POST["mail"])) {
        $errors['mail'] = 'syntaxe autorisé = (***@**.***)';
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
    }elseif ($_POST['birthdate'] < $max_date) {
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

    if(empty($errors)){
        header('Location: controller-confirmation.php');
        exit;
    }

}
include_once('../View/view-inscription.php');