<?php
include('app/Views/front/layouts/header.php');

?>
<main id="home-page">
    <div class="mobile-banner">
        <img src="app/Public/front/images/photoconcertsallesombre.jpg"
            alt="Groupe de musique sur scène en avec éclairage sombre">
    </div>

        <div id="slider-container" class="">
            <div id="slides">
                <?php foreach($data['slider'] as $slide){ ?>
                    <div class="slide"><img src="<?= $slide->slide ?>" alt="<?= $slide->title ?>"></div>
                <?php }?>
            </div>
        </div>
  

    <Section id="intro-home" class="container">
        <H1 class="title-h1">Du rock, du métal et plus encore!</H1>
        <div class="bloc-section">
            <div class="bloc-content">
                <div class="intro-text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu tellus pulvinar,
                        porta nulla sit amet,luctu felis. Vivamus volutpat, nulla et ultricies faucibus, eros elit
                        posuere ipsum,
                        nec tempus velit augue ut quam. Nullam est libero porta ante.
                    </p>
                    <p>sit amet, consectetur adipiscing elit. Sed eu tellus pulvinar,
                        porta nulla sit amet,luctus Nullam est libero porta ante.
                    </p>

                </div>

            </div>
            <div class="separator-picture">
                <img src="app/Public/front/images/micro-logo.png" alt="logo de guitar avevc note de musique">
            </div>
        </div>

    </Section>
    <section id="next-show" class="container">
        <h2>L'envie de nous voir en concert vous ronge de l'intérieur? Voici notre prochaine date!</h2>
        <div class="bloc-section">
            <div class="next-show-text bloc-content">
                <div class="show-info">
                    <h3><?= $data['nextShow']['title']; ?></h3>
                    <p>Adresse: <?= $data['nextShow']['location']; ?></p>
                    <p>Rendez-vous le : <?= $this->formatDate($data['nextShow']['date']); ?></p>
                    <p>Prix à partir de: <?= $data['nextShow']['price']; ?>€</p>
                </div>
                <div class="next-show-link">
                    <p>Impossible pour vous d'être parmis nous à cette date? Pas de panique, consultez nos autres dates!
                    </p>
                    <a href="index.php?action=concertsPage">Nos prochain concerts</a>
                </div>
            </div>

            <div class="separator-picture">
                <img src="app/Public/front/images/horn-hand.png" alt="logo de guitar avevc note de musique">
            </div>
        </div>
    </section>

    <section id="last-news" class="container">
        <h2>Quoi de neuf dans le monde du rock?</h2>
        <div class="bloc-section">
            <article class="card bloc-content">
                <div class="card-header">
                    <?php if ($data['lastNews']['picture1']){ ?>
                    <img src="<?= $data['lastNews']['picture1'] ?>" alt="<?= $data['lastNews']['title']; ?>">
                    <?php 
                }else{ ?>
                    <img src="app/Public/front/images/default.jpg" alt="Photo générique d'une guitare">
                    <?php } ?>
                </div>
                <div class="card-body">
                    <h3><?= $data['lastNews']['title']; ?></h3>
                    <p><?= $data['lastNews']['content'] ?></p>
                </div>
                <div class="card-footer">
                    <a href="index.php?action=singleNews&id=<?=$data['lastNews']['id'];?>">Par ici pour la suite! </a>
                </div>
            </article>


            <div class="separator-picture">
                <img src="app/Public/front/images/logo-groupe.png" alt="logo de guitar avevc note de musique">
            </div>
        </div>
    </section>

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