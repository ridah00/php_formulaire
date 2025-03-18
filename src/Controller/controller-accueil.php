<?php

session_start();
require_once('../../config.php');

$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);


if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public');
} else {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT a.post_id,a.user_id,post_description,post_timestamp,post_private,b.user_pseudo,user_avatar,pic_name
            FROM 76_posts as a
            natural join 76_users b
            natural join 76_pictures
            WHERE a.user_id = " . $_SESSION['user_id'] . "
            OR a.user_id IN (SELECT fav_id FROM 76_favorites as c WHERE c.user_id = " . $_SESSION['user_id'] . ")
            ORDER BY post_timestamp DESC ;";

    $stmt = $pdo->query($sql);
    $allposts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql_1 = "SELECT *
              from 76_comments a
              join 76_users b on a.user_id = b.user_id ";

    $stmt = $pdo->query($sql_1);
    $post_comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql_2 = "SELECT * 
              from 76_likes a
              join 76_users b on a.user_id = b.user_id
              ;";

    $stmt = $pdo->query($sql_2);
    $post_likes = $stmt->fetchAll(PDO::FETCH_ASSOC);

       /**
         * calculer le nombre des commntrs ou les likes 
         *
         */
    function count_total_com($tab_1, $pdo)
    {
           $sum = 0;
            $sql = "SELECT com_id FROM 76_comments where post_id = " . $tab_1['post_id'] . ";";
            $stmt = $pdo->query($sql);
            $post_com = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $sum = count($post_com);
        return $sum;
    }
    function count_total_like($tab_1, $pdo) 
    {
        $sum = 0;
        $sql = "SELECT like_id FROM 76_likes where post_id = " . $tab_1['post_id'] . ";";
        $stmt = $pdo->query($sql);
        $like_com = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sum = count($like_com);
        
        return $sum;
    }
    function likes_pseudos($tab_1, $pdo): string { 
        $list = '';
        $sql = "SELECT user_pseudo from 76_likes a natural join 76_users b  where a.post_id =" . $tab_1['post_id'] . ";";
        $stmt = $pdo->query($sql);
        $post_likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($post_likes as $value) {
            $list .= $value['user_pseudo'] ;
        }
        return $list;
    }



    function liked_or_not($pdo, $idpost, $iduser): bool
    {
        $sql = "SELECT * from `76_likes` a 
            join `76_users` b on a.user_id = b.user_id 
            where (a.post_id = " . $idpost . " && a.user_id=" . $iduser . ");";
        $stmt = $pdo->query($sql);
        $post_user_likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $liked = count($post_user_likes) == 1 ? true : false;
        return $liked;
    }
}

include_once('../View/view-accueil.php');
