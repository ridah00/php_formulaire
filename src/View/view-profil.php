<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <title>Document</title>
</head>
<style>
    .post_img {
        width: 100%;
        height: 30rem;
        background: #e0e0e0;
    }

    .profile_image {
        width: 10rem;
        height: 10rem;
    }

    @media (max-width: 600px) {
        .post_img {
            width: 100%;
            height: 10rem;
        }
    }
</style>

<body>
    <div class="container mt-5">
        <div class="d-flex align-items-center justify-content-evenly gap-lg-5 gap-2">
            <img src="../../assets/img/<?= $_SESSION['user_id'] ?>/balade.jpg" class="profile_image rounded-circle" alt="photo_profil">
            <div>
                <div class="d-flex align-items-center gap-3">
                    <p class="fs-1 m-0"><?= $_SESSION['user_pseudo'] ?></p>
                    <a href="../Controller/controller-decon.php" class="btn btn-outline-secondary ">Déconnexion</a>

                </div>
                <div class="mt-2 stats">
                    <span><?= $post_number ?></span> publications · <span><?= $followers_number ?></span> followers · <span><?= $follows_number ?></span> suivi(e)s
                </div>
                <p class="mt-2"><?= $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] ?><br>SIUU Subscribe to my Youtube Channel!</p>
            </div>
        </div>
        <div class="row m-lg-4 gap-lg-5 justify-content-evenly my-4">
            <button class="col-lg-3 col-5 btn btn-outline-secondary px-0">Créer un post</button>
            <button class="col-lg-3 col-5 btn btn-outline-secondary px-0">Modifier mon profil</button>
        </div>
    </div>

    <div class="row m-0 justify-content-center">
        <div class="col-sm-8 row m-0 p-0">
            <?php for ($i = 0; $i < count($posts); $i++) { ?>
                <div class="col-4 p-1 position-relative">
                    <img src="../../assets/img/<?= $posts[$i]['user_id'] ?>/<?= $posts[$i]['pic_name'] ?>" class="post_img" alt="">
                    <span class="px-3 text-light fw-bold fs-sm-4 position-absolute bottom-0 end-0">
                        <?= $posts[$i]['nombre_like'] ?> <i class="fa-solid fa-heart"></i>
                        <?= $posts[$i]['nombre_com'] ?> <i class="fa-solid fa-comment"></i>
                    </span>
                </div>
            <?php } ?>
        </div>
    </div>






    <script src="https://kit.fontawesome.com/f9a12e2310.js" crossorigin="anonymous"></script>
</body>

</html>