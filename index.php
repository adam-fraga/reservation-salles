<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/global.css">
    <script src="https://kit.fontawesome.com/a95f1c7873.js" crossorigin="anonymous"></script>
    <title>Life-Path</title>
</head>
<body>
<!--HEADER SITE-->
<header class="header">
    <!--    NAVIGATION BAR-->
    <nav class="nav">
        <!--        MENU -->
        <ul class="menu container-row">
            <li class="item-menu link-user"><a href="#"><i class="fas fa-user">User</i></a>
                <!--            SOUS MENU UTILISATEUR-->
                <ul class="sous-menu sm-user">
                    <li class="item-sous-menu"><a href="site/inscription.php">Inscription</a></li>
                    <li class="item-sous-menu"><a href="site/connexion.php">Connexion</a></li>
                    <li class="item-sous-menu"><a href="site/profil.php">Mon Profil</a></li>
                </ul>
            </li>
            <li class="item-menu link-reservation"><a href="#"><i class="far fa-calendar-plus">Réservation</i></a>
                <!--            SOUS MENU RESERVATION-->
                <ul class="sous-menu sm-reservation">
                    <li class="item-sous-menu"><a href="site/planing.php">Planing</a></li>
                    <li class="item-sous-menu"><a href="site/reservation-form.php">Réserver</a></li>
                    <li class="item-sous-menu"><a href="site/reservation.php">Mes réservations</a></li>


                </ul>
            </li>
            <form action="" method="post" class="container-tools">
                <button class="button button-logout">Déconnexion</button>
            </form>
        </ul>

    </nav>
</header>
<!--Main content-->
<!--TITRE SITE-->
<h1 class="main-title">CODING SCHOOL</h1>
<main class="main">
    <!--    BANNIERE-->
    <div class="container-large banniere"></div>
    <!--    Section presentation du site-->
    <section class="presentation container-col">
        <h2 class="title">Lorem</h2>
        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, iste mollitia numquam officia quaerat
            voluptas! Alias aperiam at beatae dolor doloribus ducimus ea et ex, hic illo minus sit tempora. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit. Accusantium amet aut autem dolore doloremque ea eius harum,
            impedit incidunt iure labore magni maiores neque nostrum nulla obcaecati odit quaerat tempora.
        </p>

    </section>
    <!--    Presentation de la formation-->
    <section class="presentation-formation container-col">
        <h2 class="title">Les différentes salles</h2>
        <div class="container-card">
            <!--            CARD-->
            <div class="card ">
                <h3 class="title">Salle de Coworking</h3>
                <article class="card-content">
                    Contenue card 1 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate doloremque eius
                    illo impedit iste magni modi natus nisi perferendis rem sint, sunt vitae! Aut cupiditate hic
                    officia, possimus quae voluptates!
                </article>
            </div>
            <div class="card ">
                <h3 class="title">Black Room</h3>
                <article class="card-content">
                    Contenue card 2 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate doloremque eius
                    illo impedit iste magni modi natus nisi perferendis rem sint, sunt vitae! Aut cupiditate hic
                    officia, possimus quae voluptates!
                </article>
            </div>
            <div class="card ">
                <h3 class="title">Le Bordel</h3>
                <article class="card-content">
                    Contenue card 3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate doloremque eius
                    illo impedit iste magni modi natus nisi perferendis rem sint, sunt vitae! Aut cupiditate hic
                    officia, possimus quae voluptates!
                </article>
            </div>
        </div>
    </section>
</main>
<!--FOOTER-->
<footer class="footer container-col">
    <nav class="foot-nav">
        <ul class="footer-menu container-row">
            <li><a href="#">Me suivre sur les réseaux</a></li>
            <li><a href="#">Liens externes</a></li>
            <li><a href="#">Me contacter</a></li>
        </ul>
    </nav>
    <aside class="copyright"><small>© Adam FRAGA</small></aside>
</footer>
</body>
</html>