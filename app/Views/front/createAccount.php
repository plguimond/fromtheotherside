<?php
include('app/Views/front/layouts/header.php');
?>
<main id="newAccount-page">
    <section class="container login-content">
        <div class="login-title">
            <h1>Création d'un nouveau compte utilisateur</h1>
            <p>Veuillez remplir toutes les informations pour créer un nouveau compte</p>
            <?php 
            if (isset($data['error'])){
            if($data['error'] != ""){?>
                <p class = "login-error"><?= $data['error'] ?></p>
            <?php }} ?>
        </div>
        <div class="login-box">
            <form class="form-login" action="index.php?action=createAccount" method="POST">
                <input type="text" name="firstname" placeholder="Prénom" aria-label="Entrez votre prénom">    
                <input type="text" name="lastname" placeholder="Nom de famille" aria-label="Entrez votre nom de famille">     
                <input type="email" name="mail" placeholder="E-mail" aria-label="Entrez votre adresse email">
                <input type="password" name="pwd" placeholder="Mot de passe" aria-label="Entrez votre mot de passe">
             
                <button type="submit">Création du compte</button>
            </form>
        </div>
    </section>


</main>

<?php
include('app/Views/front/layouts/footer.php');
?>