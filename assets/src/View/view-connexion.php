<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <title>Projet 1</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="anim">
  <main>
    <section class="row m-0 justify-content-center">
      <div class="col-sm-3  mt-5">
        <form method="POST" novalidate>
          <div class="mb-3">
            <label for="mail" class="form-label">Identifiant</label>
            <input type="email" name="mail" class="form-control" id="mail" value="<?= $_POST["mail"] ?? '' ?>" aria-describedby="emailHelp">
            <span class="px-2 text-danger"><?= $errors['mail'] ?? '' ?></span>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="password" value="<?= $_POST["password"] ?? '' ?>">
            <span class="px-2 text-danger"><?= $errors['password'] ?? '' ?></span>
          </div>
          <div class="d-flex justify-content-evenly">
          <button type="submit" class="btn btn-primary">Connecter</button>
          <a href="../Controller/controller-inscription.php" class="btn btn-primary">Inscrire</a>
          </div>
        </form>
        <div class="mt-5">
          <h2>Contacter-Nous</h2>
          <a href=""><img src="assets/img/insta_link_.jpg" alt=""></a>
          <a href=""><img src="assets/img/facebook_link_.png" alt=""></a>
          <p><i class="fa-solid fa-phone"></i> 07 49 24 26 19</p>
          <p><i class="fa-solid fa-envelope"></i> mahdjoubridah00@gmail.com</p>
        </div>
      </div>
    </section>
  </main>

  <script src="https://kit.fontawesome.com/f9a12e2310.js" crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>