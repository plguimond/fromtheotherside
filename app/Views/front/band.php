<?php
include('app/Views/front/layouts/header.php');
?>
<main id="band-page" class="container">
   <h1>The band</h1>
   
   <section id="band-cards">
   
   <?php  
   // boucle sur tous les mbmres et affichage dans une card
   foreach($data as $member){
   ?>
      <article class="card member-card">
         <div class="card-header">
            <img src="<?= $member->picture?>" alt="Photo du <?= $member->type ?>">
         </div>
         <div class="card-body">
            <h2><?= $member->firstname . " " . $member->lastname;?></h2>
            
            <p><?= $member->info;?></p>
         </div>

      </article>

      <?php }?>
   </section>

</main>

<?php
include('app/Views/front/layouts/footer.php');
?>