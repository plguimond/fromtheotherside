<?php
include('app/Views/front/layouts/header.php');
?>
<main id="contact-page" class="container">
   <h1>Vous cherchez à nous joindre? Remplissez ce formulaire.</h1>

   <?php  
      if (isset($data['error'])){ 
         if($data['error'] != ""){ ?>
            <p class = "login-error"><?= $data['error'] ?></p>
   <?php }} ?>
   <?php  
      if (isset($data['message'])){ 
         if($data['message'] != ""){ ?>
            <p class = "validate"><?= $data['message'] ?></p>
   <?php }} ?>
   
   <form class="contact-form" action="index.php?action=contactForm" method="post" id="contactForm">
   
      <input aria-label="Entrez votre nom de famille" type="text" name="lastname" id="lastname" placeholder="Votre nom *" value="<?php if(isset($_POST["lastname"])) echo htmlspecialchars($_POST["lastname"]) ?>">
      <input aria-label="Entrez votre prénom" type="text" name="firstname" id="firstname" placeholder="Votre prénom *" value="<?php if(isset($_POST["firstname"])) echo htmlspecialchars($_POST["firstname"]) ?>">
      <input aria-label="Entrez votre email" type="email" name="mail" id="mail" placeholder="mail@exemple.com *" value="<?php if(isset($_POST["mail"])) echo htmlspecialchars($_POST["mail"]) ?>">
      <input aria-label="Entrez votre numéro de téléphone si vous le souhaitez" type="tel" name="phone" id="phone" placeholder="06 01 02 03 04" value="<?php if(isset($_POST["phone"])) echo  htmlspecialchars($_POST["phone"]) ?>">
      <input aria-label="Entrez l'objet du message" type="text" name="subject" id="subject" placeholder="Objet du message" value="<?php if(isset($_POST["subject"])) echo  htmlspecialchars($_POST["subject"]) ?>">
      
      <textarea aria-label="Entrez votre message" placeholder="Votre message *" name="content" id="content" cols="37" rows="8"><?php if(isset($_POST["content"])) echo  htmlspecialchars($_POST["content"]) ?></textarea></p>
      <!--  bouton envoyer et annuler  -->
      <p>
         <input type="checkbox" name="rgpd" id="rgpd">
         <label for="rgpd" class="petit_texte">J'accepte les <a class="underline" href="#">conditions générales.</a></label>
      </p>
      <p>
         <button type="submit" id = "sendForm" class="hidden ">Envoyer</button>
         <button type="reset" id="cancelForm" class="">Annuler</button>
      </p>
      <p class="petit_texte">* Les champs marqués d'une étoile sont obligatoire.</p>
   </form>

</main>

<?php
include('app/Views/front/layouts/footer.php');
?>