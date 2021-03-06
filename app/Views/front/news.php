<?php
include('app/Views/front/layouts/header.php');

?>
<main id="news-page" class="container">
   <h1>Les News</h1>
   <section id="news-cards">
      <?php 
      //Boule sur tous les articles
   foreach($data["articles"] as $article){
    
      if ($article['picture1']){
         $picture = $article['picture1'];
      }else{
         $picture = "app/Public/front/images/default.jpg";
      }
   ?>
         <!-- Affichage des articles sous forme de cards avec photo -->
         <article class="card">
            <div class="card-header">
               <img src="<?= $picture ?>" alt="<?= $article['title'];?>">
            </div>
            <div class="card-body">
               <h2><?= $article['title'];?></h2>
               <p><?= $article['content'];?></p>
            </div>
            <div class="card-footer">
               <a href="index.php?action=singleNews&id=<?=$article['id'];?>" title="Lien vers l'article complet">Par ici pour la suite! </a>
               <p><?= $this->formatDate($article['created_At']);?></p>
            </div>
         </article>
      
      <?php }?>
   </section>
   <!-- Menu de pagination -->
   <nav class="menu-pagination">
    <ul class="pagination">
        <!-- Lien vers la page précédente  -->
        <li class="<?= ($data['currentPage'] == 1) ? "hide" : "" ?>">
            <a href="index.php?action=newsPage&page=<?= $data['currentPage']- 1 ?>" class="pagination-link" title="Page précédente" >Précédente</a>
        </li>
        <?php
            if ($data['pages'] > 1){ 
               for($page = 1; $page <= $data['pages']; $page++){ ?>
               <!-- Lien vers chacune des pages -->
               <li class="<?= ($data['currentPage'] == $page) ? "active" : "" ?>">
                  <a href="index.php?action=newsPage&page=<?= $page ?>" class="pagination-link" title="Numérotation des pages"><?= $page ?></a>
               </li>
        <?php }} ?>
            <!-- Lien vers la page suivante -->
            <li class="<?= ($data['currentPage'] == $data['pages']) ? "hide" : "" ?>">
            <a href="index.php?action=newsPage&page=<?= $data['currentPage'] + 1 ?>" class="pagination-link" title="Page suivante">Suivante</a>
        </li>
    </ul>
</nav>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>