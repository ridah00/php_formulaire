<?php
session_start();
require('../../config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public');
} else {
    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        if ($_FILES['post_photo']['error'] == 4) {
            $errors['post_photo'] = 'champs obligatoire';
        } elseif ($_FILES['post_photo']['type'] != "image/png" && $_FILES['post_photo']['type'] != "image/jpeg") {
            $errors['post_photo'] = 'type non autorisé';
        }
        if (empty($errors)) {
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "insert into 76_posts (post_description,user_id,post_timestamp) values (:description,:user_id,:post_time);";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':description', htmlspecialchars($_POST['description']), PDO::PARAM_STR);
            $stmt->bindValue(':user_id', htmlspecialchars($_SESSION['user_id']), PDO::PARAM_STR);
            $stmt->bindValue(':post_time', time(), PDO::PARAM_STR);
            $stmt->execute();


            $last_post_id = $pdo->lastInsertId();

            $sql_1 = "insert into 76_pictures (pic_name,post_id) values (:pic_name,:post_id);";
            $stmt = $pdo->prepare($sql_1);
            $stmt->bindValue(':pic_name',    htmlspecialchars($_FILES['post_photo']['name']), PDO::PARAM_STR);
            $stmt->bindValue(':post_id',   $last_post_id, PDO::PARAM_STR);

            $imagetemp = $_FILES['post_photo']['tmp_name'];
            $imagePath = '../../assets/img/' . $_SESSION['user_id'] . '/';
            $imagename = $_FILES['post_photo']['name'];

            if (is_uploaded_file($imagetemp) && $stmt->execute()) {
                if (move_uploaded_file($imagetemp, $imagePath . $imagename)) {
                    header('Location: controller-profil.php');
                }
            }

            
        }
    }
}




include_once('../View/view-cree-post.php');
