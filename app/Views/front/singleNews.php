<?php
include('app/Views/front/layouts/header.php');
?>
<main id="singleNews-page">
    <section id="singleNews-content"></section>
    <h1 id="singleNews-title"><?= $data['singleNews']['title']?></h1>
    <div id="singleNews-text">
        <p><?= $data['singleNews']['content']?></p>
    </div>
    <?php 
        if($data['singleNews']['picture1']){
        ?>
    <div class="news-picture">
        <img src="<?= $data['singleNews']['picture1']?>" alt="<?= $data['singleNews']['title']?>">
    </div>
    <?php 
        }
        if($data['singleNews']['picture2']){
        ?>
    <div class="news-picture">
        <img src="<?= $data['singleNews']['picture2']?>" alt="<?= $data['singleNews']['title']?>">
    </div>
    <?php 
        } 
        if($data['singleNews']['picture3']){
        ?>
    <div class="news-picture">
        <img src="<?= $data['singleNews']['picture3']?>" alt="<?= $data['singleNews']['title']?>">
    </div>
    <?php } ?>

    <div>
        <p>Publié le : <?= $data['singleNews']['created_At']?></p>
    </div>
    </section>
    <section id="singleNews-comment">
        <!-- A MODIFIER POUR AFFICHER COMMENTAIRE DE LA NEWS -->
        <?php foreach($data['comments'] as $comment) { ?>
        <p><?=$comment->content?></p>

        <?php }?>



        <?php 
    if ($connect == true) { ?>
        <form action="index.php?action=postComment&id=<?=$data['singleNews']['id'];?>" method="POST">
            <p><label for="comment">Commentez cet article</label></p>
            <p><textarea name="comment" id="comment" cols="30" rows="10"></textarea></p>
            <button type="submit">Envoyez votre commentaire</button>
        </form>
        <?php }
    else{ ?>
        <li><a href="index.php?action=loginPage">Connectez-vous pour commentez</a></li>
        <?php } ?>
        <?php 
    if (isset($data['error'])){ ?>
        <p><?= $data['error'] ?></p>
        <?php } ?>
    </section>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>