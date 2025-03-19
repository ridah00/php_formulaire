<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <title>Accueil</title>
</head>
<style>
    .menu {
        position: sticky;
        left: 0;
        top: 0;
        height: 100vh;
    }
    #like_button:hover{
        cursor: pointer;
    }
    .post_img {
        width: 100%;
        height: 40rem;
    }

    .profile_image {
        margin-block: 0.5rem;
        width: 3rem;
        height: 3rem;
    }

    @media (max-width: 600px) {
        .post_img {
            width: 100%;
            height: 20rem;
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
            <div class="menu d-flex flex-column justify-content-between">
                <div class="mt-3 text-center">
                    <a href="../Controller/controller-accueil.php" class="text-decoration-none text-dark">
                        <h1>𝓐𝒇𝓹𝓪𝓰𝓻𝓪𝓶</h1>
                    </a>
                </div>
                <div class="row m-2 gap-2">
                    <a href="../Controller/controller-accueil.php" class="btn btn-outline-secondary"><i class="fa-solid fa-house"></i> Accueil</a>
                    <a href="" class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i> Recherche</a>
                    <a href="../Controller/controller-cree-post.php" class="btn btn-outline-secondary"><i class="fa-solid fa-plus"></i> Créer</a>
                    <a href="../Controller/controller-profil.php" class="btn btn-outline-secondary"><i class="fa-solid fa-user"></i> Profil</a>
                </div>
                <div class="row m-2">
                    <a href="../Controller/controller-decon.php" class="btn btn-outline-danger"><i class="fa-solid fa-right-from-bracket mx-2"></i>Déconnexion</a>
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

        <div class="col-lg-10 row m-0 justify-content-center">
            <?php foreach ($allposts as $post) { ?>
                <div class="col-lg-6 mx-lg-5 mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="../Controller/controller-profil.php?id=<?= $post['user_id'] ?>"><img class="profile_image rounded-circle" src="../../assets/img/<?= $post['user_id'] ?>/avatar/<?= $_SESSION['user_avatar'] ?>" title="<?= $post['user_pseudo'] ?>" alt="<?= 'Photo de' . $post['user_id'] ?>"></a>
                            <a href="../Controller/controller-profil.php?id=<?= $post['user_id'] ?>" class="text-decoration-none text-dark">
                                <p class="m-0 mx-2 fw-bold"><?= $post['user_pseudo'] ?></p>
                            </a>
                            <p class="m-0 mx-1 "><?= $formatter->format($post['post_timestamp']) ?></p>
                        </div>

                        <?php if ($post['user_id'] == $_SESSION['user_id']) { ?>
                            <div class="">
                                <div class="btn-group">
                                    <button type="button" class="btn rounded text-center" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-bars"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item">Modifier le post</a></li>
                                        <li><a class="dropdown-item">Supprimer le post</a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <a href="../Controller/controller-post_detail.php?id=<?= $post['post_id'] ?>"><img src="../../assets/img/<?= $post['user_id'] ?>/<?= $post['pic_name'] ?>" class="card-img-top post_img" alt="<?= $post['pic_name'] ?>"></a>
                    <div class="fs-1 m-1 d-flex gap-3">
                        <div id="like_icon" class="d-flex gap-2">
                            <?php if (liked_or_not($pdo, $post['post_id'], $_SESSION['user_id'])) { ?>
                                <i data-postid='<?= $post['post_id'] ?>' id="like_button" class="fa-solid text-danger fa-heart"></i>
                            <?php } else { ?>
                                <i data-postid='<?= $post['post_id'] ?>' id="like_button" class="col fa-regular fa-heart"></i>
                            <?php  } ?>
                            <p id="like_number" class="fs-5 text-center"> <?= count_total_like($post, $pdo) ?> </p>
                        </div>
                        <div class="d-flex gap-2">
                            <i class="fa-regular fa-comment"></i>
                            <p class="fs-5 text-center"> <?= count_total_com($post, $pdo) ?> </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text fw-bold"><?= $post['post_description'] ?></p>
                    </div>



                </div>
            <?php } ?>
        </div class="my-5">
    </main>



    <script src="../../assets/js/like_post.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f9a12e2310.js" crossorigin="anonymous"></script>
</body>

</html>