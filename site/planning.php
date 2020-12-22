<?php
include '../config/class/class.php';
session_start();
//Une page permettant de voir le planning de la salle (planning.php) :
//Sur cette page on voit le planning de la semaine avec l’ensemble des
//réservations effectuées. Le planning se présente sous la forme d’un
//tableau avec les jours de la semaine en cours. Dans ce tableau, il y a en
//colonne les jours et les horaires en ligne. Sur chaque réservation, il est
//écrit le nom de la personne ayant réservé la salle ainsi que le titre. Si un
//utilisateur clique sur une réservation, il est amené sur une page dédiée.
//
//Les réservations se font du lundi au vendredi et de 8h et 19h. Les créneaux
//ont une durée fixe d’une heure.
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
            <!--                        Essaie de recup le mois passé en get-->
            <?php try {
                $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
//                si pas possible prend le mois en cours
            } catch (Exception $e) {
                $month = new Month();
            }
            $start = $month->getFirstDay()->modify('last monday');
            ?>
            <div class="box-cal">
                <h1 class="title-cal title-main"><?php echo $month->toString(); ?></h1>
                <div class="box-controller">
                    <a href="planning.php?month=<?= $month->previousMonth()->_month;?>&year=<?= $month->previousMonth()->_year; ?>"
                       class="btn-ctrl"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    <a href="planning.php?month=<?= $month->nextMonth()->_month;?>&year=<?= $month->nextMonth()->_year; ?>" class="btn-ctrl"><i class="fas fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
            <?php var_dump($month->getWeeks()); ?>
            <table class=" calendar">
                <?php for ($i = 0; $i < $month->getWeeks(); $i++): ?>
                    <tr>
                        <?php
                        foreach ($month->_day as $k => $day):
                            $date = (clone $start)->modify("+" . ($k + $i * 7) . "days"); ?>
                            <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>">
                                <?php if ($i === 0): ?>
                                    <div class="calendar__weekday"><?= $day; ?></div>
                                <?php endif; ?>
                                <div class="calendar__day"><?= $date->format('d'); ?></div>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endfor; ?>
            </table>

        </div>
    </section>
</main>
<?php include 'footer.php' ?>
</body>
</html>