<?php
$regex_que_lettre = "/^[a-zA-Zéèï]+$/";
$regex_pseudo = "/^[a-zA-Z0-9-_.]{5,20}$/";
$regex_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$regex_pwd_8 = "/[a-zA-Z0-9_@.]{8,30}$/";
$date = date('Y-m-d');
$c_password_value='';
$min_date = date('Y-m-d', strtotime("-18 years"));

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

    (!array_key_exists('c_password',$errors)) ?  $c_password_value = $_POST['c_password'] : '';
    if (empty($_POST["c_password"])) {
        $errors['c_password'] = 'champs obligatoire';
    } elseif ($_POST["c_password"] != $_POST["password"]) {
        $errors['c_password'] = 'Les mots de passe ne correspondent pas.';
    }

    if (empty($_POST["birthdate"])) {
        $errors['birthdate'] = 'champ obligatoire';
    } else if ($_POST['birthdate'] > $min_date) {
        $errors['birthdate'] = 'age minimum autorisé : 18 ans';
    }

    if (empty($_POST["gender"])) {
        $errors['gender'] = 'champs obligatoire';
    } elseif ($_POST["gender"] != 'homme' && $_POST["gender"] != 'femme') {
        $errors['gender'] = 'choix non autorisé';
    }
    if (!isset($_POST['condition'])) {
        $errors['condition'] = 'champs obligatoire';
    }
}







?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
    label {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>

<body class="anim">
    <div class="container mt-5 bg-secondary-subtle">
        <form method="POST" novalidate>
            <div class="row m-0 gap-3">
                <div class="col-sm p-0">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="lastname" id="nom" placeholder="Entrez votre nom" value="<?= $_POST["lastname"] ?? '' ?>" required>
                    <span class="px-2 text-danger"><?= $errors['lastname'] ?? '' ?></span>
                </div>
                <div class="col-sm p-0">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="firstname" id="prenom" placeholder="Entrez votre prénom" value="<?= $_POST["firstname"] ?? '' ?>" required>
                    <span class="px-2 text-danger"><?= $errors['firstname'] ?? '' ?></span>
                </div>
            </div>
            <div class="col-sm p-0">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo" value="<?= $_POST["pseudo"] ?? '' ?>" required>
                <span class="px-2 text-danger"><?= $errors['pseudo'] ?? '' ?></span>
            </div>
            <div>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="mail" id="email" placeholder="Entrez votre email" value="<?= $_POST["mail"] ?? '' ?>" required>
                <span class="px-2 text-danger"><?= $errors['mail'] ?? '' ?></span>
            </div>
            <div class="row m-0 gap-3">
                <div class="col-sm p-0">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="mdp" placeholder="Entrez votre mot de passe" value="<?= $_POST["password"] ?? '' ?>"
                        required>
                    <span class="px-2 text-danger"><?= $errors['password'] ?? '' ?></span>
                </div>
                <div class="col-sm p-0">
                    <label for="confirmationmdp" class="form-label">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" name="c_password" id="confirmationmdp" value="<?= $c_password_value ?>"
                        placeholder="Confirmez votre mot de passe" required>
                    <span class="px-2 text-danger"><?= $errors['c_password'] ?? '' ?></span>
                </div>
            </div>
            <div class="row m-0 gap-3">
                <div class="col-sm p-0">
                    <label for="date_naissance" class="form-label">Date de naissance</label>
                    <input type="date" max="<?= $date ?>" class="form-control" name="birthdate" id="date_naissance" value="<?= $_POST["birthdate"] ?? '' ?>" required>
                    <span class="px-2 text-danger"><?= $errors['birthdate'] ?? '' ?></span>
                </div>
                <div class="col-sm p-0">
                    <label class="form-label">Genre</label>
                    <select class="form-select" name="gender" required>
                        <option value="">Selectionnez</option>
                        <option <?= (isset(($_POST['gender'])) && ($_POST['gender']) == 'homme') ? 'selected' : '' ?> value="homme">Homme</option>
                        <option <?= (isset(($_POST['gender'])) && ($_POST['gender']) == 'femme') ? 'selected' : '' ?> value="femme">Femme</option>
                    </select>
                    <span class="px-2 text-danger"><?= $errors['gender'] ?? '' ?></span>
                </div>
            </div>
            <div class="">
                <div class="form-check align-items-center m-3 d-flex justify-content-center">
                    <input type="checkbox" name="condition" class="form-check-input" id="conditions" <?= isset(($_POST['condition'])) ? 'checked' : '' ?> required>
                    <label class="form-check-label mx-2" for="conditions">J'accepte les conditions d'utilisation</label>
                    <span class="px-2 text-danger d-block"><?= $errors['condition'] ?? '' ?></span>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary ">Inscrire</button>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>