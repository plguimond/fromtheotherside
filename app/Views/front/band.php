<?php
include('app/Views/front/layouts/header.php');
?>
<main id="band-page">
   <h1>The band</h1>
   <section>
      <?php 
      
   foreach($data as $member){
   
   ?>
         <div class="card">
            <div class="card-header">
               <img src="<?= $member->picture?>" alt="Photo du <?= $member->type ?>">
            </div>
            <div class="card-body">
               <h2><?= $member->firstname . " " . $member->lastname;?></h2>
               <p><?= $member->excerpt;?></p>
            </div>
            <div class="card-footer">
               <a href="">Mais encore? </a>
              
            </div>
         </div>
      
      <?php }?>
   </section>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>