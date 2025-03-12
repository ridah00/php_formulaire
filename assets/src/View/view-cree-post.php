<?php include_once('../../templates/head.php') ?>
<!DOCTYPE html>
<html lang="en">


<body class="anim">
    <div class="container mt-5 bg-secondary-subtle">
        <form action="" method="POST" enctype="multipart/form-data" novalidate>
            <div class="col-md p-0">
                <label for="nom" class="form-label">Insérer une image *</label>
                <input type="file" class="form-control" name="post_photo" id="nom" required>
                <span class="px-2 text-danger"><?= $errors['post_photo'] ?? '' ?></span>
            </div>
            <div class="col-md p-0">
                <label for="nom" class="form-label">Description</label>
                <input type="text" class="form-control" name="description" id="nom" placeholder="Entrez votre nom" required>
                <span class="px-2 text-danger"></span>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary m-2">Publier</button>
                <a href="../Controller/controller-accueil.php" class="btn btn-danger m-2">Annuler</a>
            </div>
            <span class="text-danger">(*) champs obligatoires</span>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>