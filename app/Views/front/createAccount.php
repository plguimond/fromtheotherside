<?php
include('app/Views/front/layouts/header.php');
?>
<main id="newAccount-page">
    <section class="container" id="login-content">
        <div class="login-title">
            <h1>Création d'un nouveau compte utilisateur</h1>
            <p>Veuillez remplir toutes les informations pour créer un nouveau compte</p>
            <?php 
            if (isset($error)){
            if($error != ""){?>
                <p class = "login-error"><?= $error ?></p>
            <?php }} ?>
        </div>
        <div class="login-box">
            <form class="form-login" action="index.php?action=createAccount" method="POST">
                <input type="text" name="firstname" placeholder="Prénom">    
                <input type="text" name="lastname" placeholder="Nom de famille">    
                <input type="email" name="mail" placeholder="E-mail">
                <!-- <label for="mail">Quelle est votre adresse e-mail</label> -->
                <input type="password" name="pwd" placeholder="Mot de passe">
                <!-- <label for="pwd">Quelle est votre adresse e-mail</label> -->
                <button type="submit">Création du compte</button>
            </form>
        </div>
    </section>


</main>

<?php
include('app/Views/front/layouts/footer.php');
?>