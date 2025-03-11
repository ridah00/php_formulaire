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
    .menu {
        position: sticky;
        left: 0;
        top: 0;
        height: 100vh;
    }

    .post_img {
        width: 100%;
        height: 20rem;
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

        main {
            flex-direction: column;
        }

        .menu_mobile {
            z-index: 2;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .menu_mobile_ {
            display: grid;
            grid-template-columns: repeat(5, 1fr);

        }
    }
</style>

<body>
    <main class="row m-0">
        <div class="col-2 d-none d-lg-block">
            <div class="menu d-flex flex-column justify-content-evenly">
                <div class="row m-2">
                    <a href="../Controller/controller-accueil.php" class="btn btn-outline-secondary"><i class="fa-solid fa-house"></i> Accueil</a>
                    <a href="" class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i> Recherche</a>
                    <a href="../Controller/controller-cree-post.php" class="btn btn-outline-secondary"><i class="fa-solid fa-plus"></i> Créer</a>
                    <a href="../Controller/controller-profil.php" class="btn btn-outline-secondary"><i class="fa-solid fa-user"></i> Profil</a>
                </div>
                <div class="row m-2">
                    <a href="../Controller/controller-decon.php" class="btn btn-outline-danger "><i class="fa-solid fa-right-from-bracket mx-2"></i> Déconnexion</a>
                </div>
            </div>

        </div>
        <div class="col-2 menu_mobile bg-dark d-block d-lg-none p-0">
            <div class="menu_mobile_ p-2">
                <a href="../Controller/controller-accueil.php" class="fs-3 text-center text-light"><i class="fa-solid fa-house"></i> </a>
                <a href="" class="fs-3 text-center text-light"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="../Controller/controller-cree-post.php" class="fs-3 text-center text-light"><i class="fa-solid fa-plus"></i> </a>
                <a href="../Controller/controller-profil.php" class="fs-3 text-center text-light"><i class="fa-solid fa-user"></i> </a>
                <a href="../Controller/controller-decon.php" class="fs-3 text-center text-danger"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>

        <div class="col-lg-10 p-0">
            <div class="mt-5">
                <div class="d-flex align-items-center justify-content-evenly gap-lg-5 gap-2 mb-5">
                    <img src="<?= '../../assets/img/'.$_SESSION['user_id'].'/avatar/'.$_SESSION['user_avatar'] ?>" class="profile_image rounded-circle" title="<?=$_SESSION['user_pseudo']?>" alt="<?= 'Photo de'.$_SESSION['user_id']?>">
                    <div>
                        <div class="d-flex align-items-center gap-3">
                            <p class="fs-1 m-0"><?= $_SESSION['user_pseudo'] ?></p>
                            <a class="btn btn-outline-secondary">Modifier mon profil</a>

                        </div>
                        <div class="mt-2 stats">
                            <span><b><?= $post_number ?></b></span> publications · <span><b><?= $followers_number ?></b></span> followers · <span><b><?= $follows_number ?></b></span> suivi(e)s
                        </div>
                        <p class="mt-2"><?= $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] ?><br>Subscribe to my Youtube Channel!</p>
                    </div>
                </div>
            </div>

            <div class="row m-0 justify-content-center">
                <div class="col-sm-9 row m-0 p-0">
                    <?php for ($i = 0; $i < count($posts); $i++) { ?>
                        <div class="col-4 p-1 position-relative">
                        <a href="../Controller/controller-post_detail.php?id=<?= $posts[$i]['post_id'] ?>"><img src="../../assets/img/<?= $posts[$i]['user_id'] ?>/<?= $posts[$i]['pic_name'] ?>" class="post_img" alt=""></a>
                            <span class="px-3 text-light fw-bold fs-sm-4 position-absolute bottom-0 end-0">
                                <?= $posts[$i]['nombre_like'] ?> <i class="fa-solid fa-heart"></i>
                                <?= $posts[$i]['nombre_com'] ?> <i class="fa-solid fa-comment"></i>
                            </span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>





    <script src="https://kit.fontawesome.com/f9a12e2310.js" crossorigin="anonymous"></script>
</body>

</html>