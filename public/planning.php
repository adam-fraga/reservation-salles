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
//Initialisation du jour (modele de base pour semaine)
$day = new DateTime('This week Monday 8:00');
//Clone jour pour affichage th
$Upday = (clone $day)->modify('+1 Day');
//Variable d'affichage colonne heure
$hourDisplay = 8;
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
        <h1 class="title-main">Le planning de la semaine</h1>
        <p>Voici les evenements de la semaine courante. N'hesitez pas à cliqué sur l'evenement que vous voulez inspecter
            pour avoir plus d'informations quand à sa description son heure de début,son heure de fin etc....</p>
    </section>
    <section class="container-col">
        <h2 class="title-main">Les reservations</h2>
        <div class="container-tab">
            <div class="box-cal">
                <!--Affiche le mois en cours (Lui passer en param le mois du datetime recup) -->
                <h1 class="title-cal title-main"><?= $day->format('F') . '/' . $day->format('Y') ?></h1>
            </div>
            <!--            TABLEAU PLANING PHP-->
            <table class="calendar">

                <tr>
                    <!--Affiche case Planing pour pouvoir placer heure en colonne-->
                    <th class="th-day">Planning</th>
                    <!--Affiche le lundi independement pour pouvoir incrementer reste de la semaine sans l'ecraser -->
                    <th class="th-day"><?php echo $day->format('l');; ?><br><?php echo $day->format('d');; ?></th>
                    <!--Boucle les jours restant et les formate pour afficher jour + num jour -->
                    <?php for ($th = 0; $th < 6; $th++): ?>
                        <?php
                        echo "<th class='th-day'>{$Upday->format('l')}<br>{$Upday->format('d')}</th>";
                        $Upday->modify('+1 day');
                        ?>
                    <?php endfor; ?>
                </tr>
                <?php
                //Pour 10 creneaux
                for ($tr = 0; $tr <= 10; $tr++):
                    //Affiche l'heure et incremente hour 10 fois
                    echo '<tr><td class="td-hour">' . $hourDisplay . 'h</td>';
                    $hourDisplay++;
                    for ($td = 0; $td <= 6; $td++):
                        $event = $Manager->pullEvents($day);
                        //Si event existe Affiche Event sinon Affiche Creneau disponible + passage des info contenu dans chaque tableau event si existant en get sur la page Resa.
                        if ($event) {
                            echo '<td><a class="event" href="reservation.php?login=' . $event['login'] . '&title=' . $event['titre'] . '&describe=' . $event['description'] . '&begin=' . $event['debut'] . '&end=' . $event['fin'] . '">' . '<span class="event-login">' . ucfirst($event['login']) . '</span>' . '<br>' . '<span class="event-title">' . $event['titre'] . '</span>' . '</a></td>';
                        } else {
                            echo '<td>' . ' ' . '</td>';
                        }
                        //increment un jour
                        $day->modify('+1 Day');
                    endfor;
                    //Incremente d'une heure par ligne
                    $day->modify('+1 Hour');
                    //Retire 7 jour pour retourné au jour de debut de semaine
                    $day->modify('-7 Day');
                endfor;
                ?>
            </table>
        </div>
    </section>
</main>
<?php include 'footer.php' ?>
</body>
</html>