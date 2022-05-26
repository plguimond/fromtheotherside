<?php
include('app/Views/front/layouts/header.php');
?>
<main id="singleNews-page" class="container">
    <section id="singleNews-content">
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
        }else{
            $picture = "";
        ?>
        <div class="news-picture">
            <img src="app/Public/front/images/default.jpg" alt="Photo d'une guitare">
        </div>
        <?php 
        } ?>

        <div class="publish-date">
            <p>Publié le : <?= $this->formatDate($data['singleNews']['created_At'])?></p>
        </div>
    </section>
    <section id="singleNews-comment">
        <h2>Laissez-nous un commentaire!</h2>

        <?php  foreach($data['comments'] as $comment){?>
        <div class="comment-box">
            <div class="userComment">
                <p><?=$comment['firstname'] . " " . $comment['lastname'] ?></p>
                <p><?=$comment['content']?></p>
            </div>
            <div class="foot-comment">
                <p><?=$this->formatDate($comment['createdAt'])?></p>
                <?php if ($_SESSION){
                    if ($_SESSION['id'] === $comment['idUser'] || $_SESSION['role'] == 1){?>
                <a href="index.php?action=deleteUserComment&commentId=<?=$comment['id']?>&idUser=<?=$comment['idUser']?>&articleId=<?=$data['singleNews']['id']?>">Supprimer</a>
            
                <?php }} ?>
            </div>
        </div>
        <?php }?>



        <?php 
    if ($connect == true) { ?>
        <form action="index.php?action=postComment&id=<?=$data['singleNews']['id'];?>" method="POST">
            <p><label for="comment">Commentez cet article</label></p>
            <p><textarea name="comment" id="comment" cols="30" rows="10"></textarea></p>
            <button class="blue-button" type="submit">Envoyez votre commentaire</button>
        </form>
        <?php }
    else{ ?>
        <a class="blue-button" href="index.php?action=loginPage">Connectez-vous pour commentez</a>
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