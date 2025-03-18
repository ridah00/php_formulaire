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

    main {
        gap: 20rem;
    }

    .post_img {
        width: 100%;
        height: 40rem;
        background: #e0e0e0;
    }

    .profile_image {
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

        <div class="col-lg-5 p-0">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center ">
                    <a href="../Controller/controller-profil.php?id=<?= $post_detail[0]['user_id'] ?>"><img class="profile_image rounded-circle" src="../../assets/img/<?= $post_detail[0]['user_id'] ?>/avatar/<?= $post_detail[0]['user_avatar'] ?>" title="<?= $post_detail[0]['user_pseudo'] ?>" alt="<?= 'Photo de ' . $post_detail[0]['user_pseudo'] ?>"></a>
                    <a class="text-decoration-none text-dark" href="../Controller/controller-profil.php?id=<?= $post_detail[0]['user_id'] ?>">
                        <p class="m-0 mx-2 fw-bold"><?= $post_detail[0]['user_pseudo'] ?></p>
                    </a>
                    <p class="m-0 mx-1 "><?= $formatter->format($post_detail[0]['post_timestamp']) ?></p>
                </div>
                <?php if ($post_detail[0]['user_id'] == $_SESSION['user_id']) { ?>
                    <div class="">
                        <div class="btn-group">
                            <button type="button" class="btn rounded text-center" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a href="#" class="dropdown-item">Modifier le post</a></li>
                                <li><a href="#" class="dropdown-item">Supprimer le post</a></li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div>
                <img class="post_img" src="<?= "../../assets/img/" . $post_detail[0]['user_id'] . "/" . $post_detail[0]['pic_name'] ?>" alt="<?= $post_detail[0]['pic_name'] ?>">
            </div>


            <div>
                <div class="fs-1 m-1 d-flex gap-3">
                    <div class="d-flex gap-2">
                        <?= ($liked) ? '<i class="fa-solid text-danger fa-heart"></i>' : '<i class="col fa-regular fa-heart"></i>' ?>
                        <p class="fs-5 text-center"> <?= $likes_total ?> </p>
                    </div>
                    <div class="d-flex gap-2">
                        <i class="fa-regular fa-comment"></i>
                        <p class="fs-5 text-center"> <?= $comments_total ?> </p>
                    </div>
                </div>
                <div class="mb-2">
                    <p class="card-text fw-bold"><?= $post_detail[0]['post_description'] ?></p>
                </div>
                <?php foreach ($post_comments as $comment) { ?>
                    <div class="d-flex align-items-center gap-2">
                        <a href="../Controller/controller-profil.php?id=<?= $comment['user_id'] ?>"><img class="profile_image" src="<?= '../../assets/img/' . $comment['user_id'] . '/avatar/' . $comment['user_avatar'] ?>" title="<?= $comment['user_pseudo'] ?>" alt="<?= 'Photo de ' . $comment['user_pseudo'] ?>"></a>
                        <div>
                            <a class="text-decoration-none text-dark fs-5" href="../Controller/controller-profil.php?id=<?= $comment['user_id'] ?>"><?= $comment['user_pseudo'] ?></a>
                            <p class="m-0 border rounded p-2"><?= $comment['com_text'] ?></p>
                        </div>
                        <div>
                            <?php if ($comment['user_id'] == $_SESSION['user_id']) { ?>
                                <a href="" class="text-dark">Modifier</a>
                                <a href="" class="text-dark">Supprimer</a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <form action="" method="POST">
                    <div class="col-md p-0">
                        <input type="text" class="col-12 my-2 p-2 rounded" name="commentaire" placeholder="Ajouter un commentaire ...">
                        <span class="text-danger"><?= $com_errors ?? '' ?></span>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary border-2 border-dark float-end">Commenter</button>
                </form>

            </div>
        </div>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f9a12e2310.js" crossorigin="anonymous"></script>
</body>

</html>