<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body class="text-center anim">
    <h1>Merci de votre inscription <span class="text-danger"> <?= $_POST['firstname'] ?? '' ?> </span> ! Vous pouvez
        dorénavant vous <a href="connexion.html"> connecter.</a> <span>😊</span> </h1>
</body>
</html>