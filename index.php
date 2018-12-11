<?php
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
$fichier = 'https://www.lequipe.fr/rss/actu_rss_Auto-Moto.xml';
$xml = simplexml_load_file($fichier);
$i = 0;

function right() {
    global $i;
    if ($i == 0) {
        echo '';
        $i = 1;
    } else {
        echo 'order-last';
        $i = 0;
    }
}

function dateFr($dateArticle) {
    $dateCreate = date_create($dateArticle);
    $date = date_format($dateCreate, 'D, d M Y H:i:s  O');
    echo strftime('%A %d %B %G à %H:%M', strtotime($date));
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <!-- Material Design Bootsrap -->
        <link rel="stylesheet" href="assets/css/mdb.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Flux RSS :<?= $xml->channel->title; ?></title>
    </head>
    <body>
        <div class="container">
            <section class="my-5">
                <h2 class="h1-responsive font-weight-bold text-center my-5"><?= $xml->channel->title; ?></h2>
                <p class="text-center w-responsive mx-auto mb-5"><?= $xml->channel->description; ?></p>
                <?php foreach ($xml->channel->item as $items) { ?>
                    <div class="row">
                        <div class="col-lg-5 <?= right(); ?>">
                            <div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
                                <img class="img-fluid" src="<?= $items->enclosure['url']; ?>" alt="<?= $xml->channel->title; ?>" />
                                <a><div class="mask rgba-white-slight"></div></a>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <a href="#!" class="green-text"><h1 class="h6 font-weight-bold mb-3"><i class="fa fa-car pr-2"></i>Auto - <i class="fa fa-motorcycle pr-2"></i>Moto<span class="float-right small"><i class="fa fa-calendar pr-2"></i><?= dateFr($items->pubDate); ?></span></h1></a>
                            <a href="<?= $items->link; ?>"><h2 class="h5 font-weight-bold mb-3"><strong><?= $items->title; ?></strong></h2></a>
                            <p><?= $items->description; ?></p>
                            <a href="<?= $items->guid; ?>" class="btn btn-success btn-md">Voir l'article</a>
                        </div>
                    </div>
                    <hr class="my-5">
                <?php } ?>
            </section>
        </div>
        <!-- jQuery -->
        <script src="./assets/js/jquery-3.3.1.min.js"></script>
        <!-- Boostrap tooltops -->
        <script src="./assets/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script src="./assets/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script src="./assets/js/mdb.min.js"></script>
        <!-- Me JQuery -->
        <script src="./assets/js/script.js"></script>
    </body>
</html>
