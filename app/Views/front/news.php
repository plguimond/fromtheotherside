<?php
include('app/Views/front/layouts/header.php');
?>
<main id="news-page">
   <h1>Les News</h1>
   <section>
      <?php 
      
   foreach($data["articles"] as $article){
    
      if ($article['picture1']){
         $picture = $article['picture1'];
      }else{
         $picture = "app/Public/front/images/default.jpg";
      }
   ?>
      
         <div class="card">
            <div class="card-header">
               <img src="<?= $picture ?>" alt="<?= $article['title'];?>">
            </div>
            <div class="card-body">
               <h2><?= $article['title'];?></h2>
               <p><?= $article['content'];?></p>
            </div>
            <div class="card-footer">
               <a href="index.php?action=singleNews&id=<?=$article['id'];?>">Par ici pour la suite! </a>
               <p><?= $article['created_At'];?></p>
            </div>
         </div>
      
      <?php }?>
   </section>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>