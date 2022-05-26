<?php
include('app/Views/front/layouts/header.php');
?>
<main id="login-page">
    <section class="container login-content">
        <div class="login-title">
            <h1>Compte utilisateur de <?= $_SESSION['firstname'] ?></h1>
            <p>Modifier votre mot de passe</p>

            <?php 
            if (isset($data['error'])){
            if($data['error'] != ""){ ?>
                <p class = "login-error"><?= $data['error'] ?></p>
            <?php }} ?>
            <?php 
            if (isset($data['validation'])){
            if($data['validation'] != ""){ ?>
                <p class = "login-error"><?= $data['validation'] ?></p>
            <?php }} ?>
            
        </div>
        <div class="login-box">
            <!-- Formulaire de changement de mot de passe -->
            <form class="form-login" action="index.php?action=changePwd" method="POST">
                <input type="email" name="mail" placeholder="E-mail" aria-label="Entrez votre adresse email">
               
                <input type="password" name="pwd" placeholder="Mot de passe" aria-label="Entrez votre mot de passe">
                
                <input type="password" name="newPwd" placeholder="Nouveau mot de passe" aria-label="Entrez votre nouveau mot de passe">
                <button type="submit">Modifier le mot de passe</button>
            </form>
        </div>
    </section>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>