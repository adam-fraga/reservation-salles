<?php
session_start();
var_dump($_SESSION);
var_dump($_GET);
include '../config/function.php';
spl_autoload_register('includeClass');
includeClass('User');
includeClass('UserManager');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/reservation.css">
    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col">
<?php if (isset($_GET)): ?>
        <h1 class="title-main">Bonjour <?= $_GET['login'] ?></h1>
        <p>Vous trouverez ci dessous un récapitulatif de votre evenement.</p>
        <div class="Event">
            <p class="main-event">Voici un recapitulatif de votre event:</p> <br>

            <p class="event-label">Titre de votre event</p>
            <span class="event-infos"><?= $_GET['title'] ?></span>
            <p class="event-label">Description de votre event</p>
            <span class="event-infos"><?= $_GET['describe'] ?></span>
            <p class="event-label">Date de debut de votre event</p>
            <span class="event-infos"><?= $_GET['begin'] ?></span>
            <p class="event-label">Date de fin de l'event</p>
            <span class="event-infos"><?= $_GET['end'] ?></span>
        </div>
<?php else:  ?>
        <h1 class="title-main">Vous devez vous connecter</h1>
        <p>Désolé mais pour pouvoir acceder à la liste des évenements vous devez d'abrod vous connecter et effetuer une reservation</p>
        <div class="Event">
            <p class="main-event">Voici un recapitulatif de votre event:</p> <br>

<?php endif; ?>

    </section>
</main>
<?php include 'footer.php' ?>
</body>
</html>


?>