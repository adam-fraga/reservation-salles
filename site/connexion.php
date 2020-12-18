<!--PHP-->
<?php
session_start();
//inclusion db
require '../config/db/db.php';
//Inclusion class utilisateur
require '../config/class/class.php';
if (isset($_POST['submit'])) {
    $user = new User();
    $message = $user->connect($_POST['login'], $_POST['password']);
    $_SESSION['UserId'] = $user->getId();
    $_SESSION['UserLogin'] = $user->getLogin();
}
?>

<!--HTML-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/connexion.css">

    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col">
        <h1 class="title-main">Connectez vous et reserver votre creneau</h1>
        <p>Connectez vous à l'aide du formulaire ci dessous pour acceder au creneaux de reservation
        </p>
    </section>
    <section class="container-col decoration-bloc bloc-connexion">
        <h2 class="title-main font-light">Formulaire de connexion</h2>
        <form action="" method="post" class="form-connexion container-col ">
            <label for="login" class="label font-light">Identifiant de connexion</label>
            <input type="text" name="login" id="login" placeholder="Entrez votre identifiant">
            <label for="password" class="label font-light">Mot de passe</label>
            <input type="password" name="password" id="password" value="password">
            <button class="button" name="submit" type="submit">Connexion</button>
        </form>
    </section>
</main>

<?php include 'footer.php' ?>
</body>
</html>