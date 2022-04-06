<?php
include('app/Views/front/layouts/header.php');

?>
<main>
    <div class="mobile-banner">
        <img src="app/Public/front/images/photoconcertsallesombre.jpg"
            alt="Groupe de musique sur scène en avec éclairage sombre">
    </div>
    <div class=slider-banner>

    </div>
    <Section id="intro-home" class="container">
        <H1 class="title-h1">Du rock, du métal et plus encore!</H1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu tellus pulvinar, porta nulla sit amet, luctus
            felis. Vivamus volutpat, nulla et ultricies faucibus, eros elit posuere ipsum,
            nec tempus velit augue ut quam. Nullam est libero porta ante.</p>

    </Section>
    <div class=separator-picture>
        <img src="app/Public/front/images/micro-logo.png" alt="logo de guitar avevc note de musique">
    </div>
    <section id="next-show" class="container">
        <h2>L'envie de nous voir en concert vous ronge de l'intérieur? Voici notre prochaine date!</h2>
        <div id="next-show-text">
            <h3><?= $data['nextShow']['title']; ?></h3>
            <p>Adresse: <?= $data['nextShow']['location']; ?></p>
            <p>Rendez-vous le : <?= $data['nextShow']['date']; ?></p>
            <p>Prix à partir de: <?= $data['nextShow']['price']; ?>€</p>

            <p>Impossible pour vous d'être parmis nous à cette date? Pas de panique, consultez nos autres dates!</p>
        </div>
        <a href="index.php?action=concertsPage">Nos prochain concerts</a>

    </section>

    <div class=separator-picture>
        <img src="app/Public/front/images/horn-hand.png" alt="logo de guitar avevc note de musique">
    </div>
    <section id="last-news" class="container">
        
        <h2><?= $data['lastNews']['title']; ?></h2>
        <?php if ($data['lastNews']['picture1']){ ?>
            <img src="<?= $data['lastNews']['picture1'] ?>" alt="<?= $data['lastNews']['title']; ?>">
        <?php 
        }else{ ?>
            <img src="app/Public/front/images/default.jpg" alt="Photo générique d'une guitare">
        <?php } ?>
        
        <div id="last-news-text">
            <p><?= $data['lastNews']['content'] ?></p>
        </div>
        <a href="index.php?action=singleNews&id=<?=$data['lastNews']['id'];?>">Par ici pour la suite! </a>

    </section>
    <div class=separator-picture>
        <img src="app/Public/front/images/logo-groupe.png" alt="logo de guitar avevc note de musique">
    </div>

    <section id="band-members" class="container">

        <h2>Les membres du groupe</h2>

        <div id="band-pictures">
            <?php foreach ($data['members'] as $member) { ?>
            <div class="band-cards">
                <div class="band-picture">
                    <img class="band-pic" src="<?= $member->picture; ?>" alt="photo du chanteur">
                    <div class='member-info'>
                        <p><?= $member->firstname; ?></p>
                        <p><?= $member->type; ?></p>
                    </div>
                </div>
                <p><?= $member->excerpt; ?></p>
            </div>
            <?php } ?>

        </div>
    </section>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>