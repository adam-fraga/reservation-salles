<?php
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
    <link rel="stylesheet" href="../style/reservation-form.css">

    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col ">
        <h1 class="title-main">Choisissez un creneau pour votre reservation</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet explicabo perferendis qui similique. Adipisci
            blanditiis commodi est fugiat labore quae qui voluptatem? Ad laudantium molestiae quam quidem quod
            repudiandae
            tempora.</p>
    </section>
    <section class="container-col decoration-bloc bloc-resa">
        <h2 class="title-main font-light">Formulaire de reservation</h2>
        <form action="" method="post" class="form-connexion container-col form-resa">
            <label for="title" class="label font-light">Votre évenement</label>
            <input type="text" name="titre" id="title" placeholder="Entrez votre évenement">
            <label for="describ" class="label font-light">Description</label>
            <textarea name="description" id="describ" placeholder="Déscription de votre évenement" cols="20" rows="8"></textarea>

            <label for="date-debut" class="label font-light">Date et heure de début</label>
            <input type="datetime-local" name="date-debut" id="date-debut" value="2020-01-12T19:30">

            <label for="date-fin" class="label font-light">Date et heure de fin</label>
            <input type="datetime-local" name="date-fin" id="date-fin" value="2020-01-12T19:30">
            <button class="button">Envoyer</button>
        </form>
    </section>
</main>
<?php include 'footer.php' ?>
</body>