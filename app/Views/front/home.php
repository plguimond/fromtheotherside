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
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu tellus pulvinar, porta nulla sit amet, luctus felis. Vivamus volutpat, nulla et ultricies faucibus, eros elit posuere ipsum,
             nec tempus velit augue ut quam. Nullam est libero porta ante.</p>

    </Section>
    <section id=next-show class="container">

    </section>
    <section id=last-news class="container">

    </section>
    <section id="band-members" class="container">
        <h2>Les membres du groupe</h2>
       

        <div id="band-pictures">
            <?php foreach($members as $member){ ?>
            <div class="band-cards">
                <div class="band-picture">
                    <img class="band-pic" src="<?= $member['picture']; ?>" alt="photo du chanteur">
                    <div class='member-info'>
                        <p><?= $member['firstname']; ?></p>
                        <p><?= $member['type']; ?></p>
                    </div>
                    
                </div>
                <p><?= $member['excerpt'];?></p>
            </div>
            <?php } ?>

        </div>
    </section>
</main>

<?php
    include('app/Views/front/layouts/footer.php');
?>