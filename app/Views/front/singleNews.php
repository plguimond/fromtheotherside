<?php
include('app/Views/front/layouts/header.php');
?>
<main id="singleNews-page">
    <h1 id="singleNews-title"><?= $data['singleNews']['title']?></h1>
    <div id="singleNews-text">
        <p><?= $data['singleNews']['content']?></p>
    </div>
    <?php 
    if($data['singleNews']['picture1']){
    ?>
        <div class="news-picture">
            <img  src="<?= $data['singleNews']['picture1']?>" alt="<?= $data['singleNews']['title']?>">
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
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>