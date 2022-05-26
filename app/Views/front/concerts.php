<?php
include('app/Views/front/layouts/header.php');
?>
<main id="concerts-page" class="container">
   <h1>Concerts</h1>

   <section>
      <?php 
      // boucle sur tous les concerts
foreach($data['concerts'] as $concert){?>
      
      <div class="next-show-text bloc-content">
         <div class="show-info">
            <h3><?= $concert['title']; ?></h3>
            <p>Adresse: <?= $concert['location']; ?></p>
            <p>Rendez-vous le : <?= $this->formatDate($concert['date']); ?></p>
            <p>Prix à partir de: <?= $concert['price']; ?>€</p>
         </div>
      </div>
      <?php }?>


   </section>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>