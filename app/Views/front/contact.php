<?php
include('app/Views/front/layouts/header.php');
?>
<main id="contact-page">
   <h1>Vous cherchez à nous joindre? Remplissez ce formulaire.</h1>

   <?php  
      if (isset($data['error'])){ 
         if($data['error'] != ""){ ?>
            <p class = "login-error"><?= $data['error'] ?></p>
   <?php }} ?>
   <div class="">
      <form class="" action="index.php?action=contactForm" method="post" id="contactForm">
            <p>
               <label for="lastname">Votre nom *</label>
               <input type="text" name="lastname" id="lastname" placeholder="Votre nom" value="<?php if(isset($_POST["lastname"])) echo htmlspecialchars($_POST["lastname"]) ?>">
            </p>
            <p>
               <label for="lastname">Votre prénom *</label>
               <input type="text" name="firstname" id="firstname" placeholder="Votre prénom" value="<?php if(isset($_POST["firstname"])) echo htmlspecialchars($_POST["firstname"]) ?>">
            </p>
            <p>
               <label for="mail">Votre email *</label>
               <input type="email" name="mail" id="mail" placeholder="mail@exemple.com" value="<?php if(isset($_POST["mail"])) echo htmlspecialchars($_POST["mail"]) ?>">
            </p>
            <p>
                <label for="phone">Votre téléphone</label>
                <input type="tel" name="phone" id="phone" placeholder="06 01 02 03 04" value="<?php if(isset($_POST["phone"])) echo  htmlspecialchars($_POST["phone"]) ?>">
            </p>
            <p>
                <label for="subject">Objet du message</label>
                <input type="text" name="subject" id="subject" placeholder="Objet du message" value="<?php if(isset($_POST["subject"])) echo  htmlspecialchars($_POST["subject"]) ?>">
            </p>
              <!-- textarea pour saisir son message -->
            <p><label for="content">Votre message *</label> </p>
            <p><textarea name="content" id="content" cols="37" rows="8"><?php if(isset($_POST["content"])) echo  htmlspecialchars($_POST["content"]) ?></textarea></p>
            <!--  bouton envoyer et annuler  -->
            <p>
                <input type="checkbox" name="rgpd" id="rgpd">
                <label for="rgpd" class="petit_texte">J'accepte les <a href="#">conditions générales.</a></label>
            </p>
            <p>
                <input type="submit" value="Envoyer" id = "sendForm" class="hidden">
                <input type="reset" value="Annuler" id="cancelForm">
            </p>
            <p class="petit_texte">* Les champs marqués d'une étoile sont obligatoire.</p>
      </form>
      <?php  
      if (isset($data['message'])){ 
         if($data['message'] != ""){ ?>
            <p class = ""><?= $data['message'] ?></p>
   <?php }} ?>
   </div>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>