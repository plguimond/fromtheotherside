<?php
include('app/Views/front/layouts/header.php');
?>
<main id="concerts-page">
   <h1>Concerts</h1>

   <section>
<?php 
foreach($data['concerts'] as $concert){?>
   <div>
      <p class="concertDate"><?= $concert['date'] ?></p>
      <p class="concertTitle"><?= $concert['title'] ?></p>
   </div>
   <div>
      <p><?= $concert['location'] ?></p>
      <p>A partir de: <?= $concert['price'] ?> €</p>
   </div>
<?php }?>


</section>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>