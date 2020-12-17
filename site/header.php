<!--HEADER SITE-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a95f1c7873.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<header class="header">
    <!--    NAVIGATION BAR-->
    <nav class="nav">
        <!--        MENU -->
        <ul class="menu container-row">
            <li class="item-menu link-user"><a href="../index.php">Accueil</a>
            <li class="item-menu link-user"><a href="#">User</a>
                <!--            SOUS MENU UTILISATEUR-->
                <ul class="sous-menu sm-user">

                    <li class="item-sous-menu"><a href="inscription.php">Inscription</a></li>
                    <li class="item-sous-menu"><a href="connexion.php">Connexion</a></li>
                    <li class="item-sous-menu"><a href="profil.php">Mon Profil</a></li>
                </ul>
            </li>
            <li class="item-menu link-reservation"><a href="#">Reservation</a>
                <!--            SOUS MENU RESERVATION-->
                <ul class="sous-menu sm-reservation">
                    <li class="item-sous-menu"><a href="planing.php">Planing</a></li>
                    <li class="item-sous-menu"><a href="reservation-form.php">Reserver</a>
                    <li class="item-sous-menu"><a href="reservation-form.php">Mes reservations</a></li>
                </ul>
            </li>
            <form action="" method="post" class="container-tools">
                <button class="button-logout"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        </ul>

    </nav>
</header>
</body>
</html>