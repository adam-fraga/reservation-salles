<?php
include '../config/function.php';
spl_autoload_register('includeClass');
includeClass('User');
includeClass('UserManager');
includeClass('Event');
includeClass('EventManager');
session_start();
//Nouvelle instance de Manager
$Manager = new EventManager(new PDO('mysql:dbname=reservationsalles;host=localhost', 'root', ''));
//Recupere les Events de la semaine en corus en db
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/planning.css">
    <title>Document</title>
</head>
<body>
<?php include 'header.php' ?>
<main class="main">
    <section class="pesentation container-col">
        <h1 class="title-main">Ici vous pouvez verifier crenaux disponibles!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet explicabo perferendis qui similique. Adipisci
            blanditiis commodi est fugiat labore quae qui voluptatem? Ad laudantium molestiae quam quidem quod
            repudiandae
            tempora.</p>
    </section>
    <section class="container-col">
        <h2 class="title-main">Planning des reservations</h2>
        <div class="container-tab">
            <div class="box-cal">
                <!--Affiche le mois en cours (Lui passer en param le mois du datetime recup) -->
                <h1 class="title-cal title-main">Mois?</h1>
                <div class="box-controller">
                    <a href="planning.php?prevWeek="
                       class="btn-ctrl"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    <a href="planning.php?nextWeek="
                       class="btn-ctrl"><i class="fas fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
            <!--            TABLEAU PLANING PHP-->
            <table class="calendar">
                <tr>
                    <th class="th-day">Planning</th>

            </table>
        </div>
    </section>
</main>
<?php include 'footer.php' ?>
</body>
</html>