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
                <h1 class="title-cal title-main"></h1>
                <div class="box-controller">
                    <a href=""
                       class="btn-ctrl"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    <a href=""
                       class="btn-ctrl"><i class="fas fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
            <table class=" calendar">
            </table>
        </div>
    </section>
</main>
<?php include 'footer.php' ?>
</body>
</html>