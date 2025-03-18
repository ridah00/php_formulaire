<?php
require_once('../../config.php');
session_start();
$regex_no_empty = "/[^\s]+$/";
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT post_id FROM 76_posts where post_id = " . $_GET['id'] . ";";
$stmt = $pdo->query($sql);
$post_exist = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($post_exist) == 1) {

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        if (preg_match($regex_no_empty, $_POST['commentaire'])) {
            $sql = "INSERT INTO 76_comments(com_text,post_id,user_id) values (:com_text,:post_id,:user_id);";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':com_text', $_POST['commentaire'], PDO::PARAM_STR);
            $stmt->bindValue(':post_id', $_GET['id'], PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    $sql = "SELECT * from `76_posts` a 
        join `76_users` b on a.user_id = b.user_id
        join `76_pictures` c on a.post_id = c.post_id
        where a.post_id = " . $_GET['id'] . ";";
    $stmt = $pdo->query($sql);

    $post_detail = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $sql = "SELECT * from `76_likes` a 
        join `76_users` b on a.user_id = b.user_id 
        where a.post_id = " . $_GET['id'] . ";";
    $stmt = $pdo->query($sql);

    $post_likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $likes_total = count($post_likes);



    $sql = "SELECT * from `76_comments` a 
        join `76_users` b on a.user_id = b.user_id 
        where a.post_id = " . $_GET['id'] . ";";
    $stmt = $pdo->query($sql);

    $post_comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $comments_total = count($post_comments);

    $sql = "SELECT * from `76_likes` a 
            join `76_users` b on a.user_id = b.user_id 
            where (a.post_id = " . $_GET['id'] . " && a.user_id=" . $_SESSION['user_id'] . ");";
    $stmt = $pdo->query($sql);
    $liked_or_not = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $liked = count($liked_or_not) == 1 ? true : false;




    include_once('../View/view-post_detail.php');
} else {
    echo " post n'existe pas !!!!! ". ' <a href="controller-accueil.php">==> Retour <== </a> ';
}
