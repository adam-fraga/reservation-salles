<?php
include '../config/function.php';
spl_autoload_register('includeClass');
includeClass('User');
includeClass('UserManager');
session_start();
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
        <?php if (isset($_GET['login']) && isset($_GET['title']) && isset($_GET['describe']) && isset($_GET['begin']) && isset($_GET['end'])): ?>
            <?php
            $_GET['login'] = htmlspecialchars($_GET['login']);
            $_GET['title'] = htmlspecialchars($_GET['title']);
            $_GET['describe'] = htmlspecialchars($_GET['describe']);
            $_GET['begin'] = htmlspecialchars($_GET['begin']);
            $_GET['end'] = htmlspecialchars($_GET['end']);
            ?>
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
        <?php endif; ?>
        <?php if (empty($_GET['title']) || empty($_GET['describe']) || empty($_GET['begin']) || empty($_GET['end'])): ?>
            <div class="Event">
                <h1 class="title-main">Vos event</h1>
                <p >Vous devez vous rendre sur le <a href="planning.php">Planning</a> pour consulter vos évenement</p>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php include 'footer.php' ?>
</body>
</html>


?>