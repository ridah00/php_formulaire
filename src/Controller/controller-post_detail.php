<?php
require_once('../../config.php');
session_start();
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
var_dump($_SESSION);

if (!isset($_GET['commantaire'])) {

    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            where (a.post_id = ".$_GET['id']." && a.user_id=". $_SESSION['user_id'] .");";
    $stmt = $pdo->query($sql);
    $liked_or_not = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $liked = count($liked_or_not)==1 ? true : false ;
} else {
}






include_once('../View/view-post_detail.php');
