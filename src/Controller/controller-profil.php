<?php

session_start();
require_once('../../config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public');
    
} else {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * from `76_favorites` where user_id = " . $_SESSION['user_id']. ";";
    $stmt=$pdo->query($sql);

    $follows_number = $stmt->rowCount();

    $sql = "SELECT * from `76_favorites` where fav_id = " . $_SESSION['user_id']. " ;";
    $stmt=$pdo->query($sql);
    $followers_number = $stmt->rowCount();

    $sql = "SELECT * from `76_posts` where user_id = " . $_SESSION['user_id']. " ;";
    
    $stmt=$pdo->query($sql);

    $post_number = $stmt->rowCount();

    $sql = "SELECT a.post_id,b.pic_name,a.user_id,count(distinct c.com_id) as nombre_com,count(distinct d.like_id) as nombre_like
            from `76_posts` as a 
            join `76_pictures` as b on a.post_id = b.post_id
            join `76_comments` as c on a.post_id = c.post_id
            join `76_likes` as d on a.post_id = d.post_id
            where  a.user_id = " . $_SESSION['user_id']. "
            group by a.post_id,b.pic_name,a.user_id;";

    $stmt=$pdo->query($sql);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}






include_once('../View/view-profil.php');
