<?php include_once('../../templates/head.php') ?>
<!DOCTYPE html>
<html lang="fr">

<body class="anim">
    <div class="container mt-5 bg-secondary-subtle">
        <form action="" method="POST" novalidate>
            <div class="row m-0 gap-3">
                <div class="col-md p-0">
                    <label for="nom" class="form-label">Nom *</label>
                    <input type="text" class="form-control" name="lastname" id="nom" placeholder="Entrez votre nom" value="<?= $_POST["lastname"] ?? '' ?>" required>
                    <span class="px-2 text-danger"><?= $errors['lastname'] ?? '' ?></span>
                </div>
                <div class="col-md p-0">
                    <label for="prenom" class="form-label">Prénom *</label>
                    <input type="text" class="form-control" name="firstname" id="prenom" placeholder="Entrez votre prénom" value="<?= $_POST["firstname"] ?? '' ?>" required>
                    <span class="px-2 text-danger"><?= $errors['firstname'] ?? '' ?></span>
                </div>
            </div>
            <div class="col-md p-0">
                <label for="pseudo" class="form-label">Pseudo *</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo" value="<?= $_POST["pseudo"] ?? '' ?>" required>
                <span class="px-2 text-danger"><?= $errors['pseudo'] ?? '' ?></span>
            </div>
            <div>
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" name="mail" id="email" placeholder="Entrez votre email" value="<?= $_POST["mail"] ?? '' ?>" required>
                <span class="px-2 text-danger"><?= $errors['mail'] ?? '' ?></span>
            </div>
            <div class="row m-0 gap-3">
                <div class="col-md p-0">
                    <label for="mdp" class="form-label">Mot de passe *</label>
                    <input type="password" class="form-control" name="password" id="mdp" placeholder="Entrez votre mot de passe" value="<?= $_POST["password"] ?? '' ?>"
                        required>
                    <span class="px-2 text-danger"><?= $errors['password'] ?? '' ?></span>
                </div>
                <div class="col-md p-0">
                    <label for="confirmationmdp" class="form-label">Confirmation du mot de passe *</label>
                    <input type="password" class="form-control" name="c_password" id="confirmationmdp" value="<?= $c_password_value ?>"
                        placeholder="Confirmez votre mot de passe" required>
                    <span class="px-2 text-danger"><?= $errors['c_password'] ?? '' ?></span>
                </div>
            </div>
            <div class="row m-0 gap-3">
                <div class="col-md p-0">
                    <label for="date_naissance" class="form-label">Date de naissance *</label>
                    <input type="date" max="<?= $date ?>" class="form-control" name="birthdate" id="date_naissance" value="<?= $_POST["birthdate"] ?? '' ?>" required>
                    <span class="px-2 text-danger"><?= $errors['birthdate'] ?? '' ?></span>
                </div>
                <div class="col-md p-0">
                    <label class="form-label">Genre *</label>
                    <select class="form-select" name="gender" required>
                        <option value="">Selectionnez</option>
                        <option <?= (isset(($_POST['gender'])) && ($_POST['gender']) == 'homme') ? 'selected' : '' ?> value="homme">Homme</option>
                        <option <?= (isset(($_POST['gender'])) && ($_POST['gender']) == 'femme') ? 'selected' : '' ?> value="femme">Femme</option>
                    </select>
                    <span class="px-2 text-danger"><?= $errors['gender'] ?? '' ?></span>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center">
                <div class="form-check align-items-center m-3 d-flex justify-content-center">
                    <input type="checkbox" name="condition" class="form-check-input" id="conditions" required>
                    <label class="form-check-label mx-2 d-block" for="conditions">J'accepte les conditions d'utilisation *</label>
                </div>
                <div>
                    <span class="text-danger"><?= $errors['condition'] ?? '' ?></span>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary m-2">Inscrire</button>
            </div>
            <span class="text-danger" >(*) champs obligatoires</span>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>