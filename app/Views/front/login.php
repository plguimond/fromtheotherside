<?php
include('app/Views/front/layouts/header.php');
?>
<main id="login-page">
    <section class="container login-content">
        <div class="login-title">
            <h1>Connexion au compte utilisateur</h1>
            <p>Saisissez votre e-mail et mot de passe pour vous connecter ou créer un nouveau compte</p>

            <?php 
            
            if (isset($data['error'])){
                
            if($data['error'] != ""){ ?>
                <p class = "login-error"><?= $data['error'] ?></p>
            <?php }} ?>
        </div>
        <div class="login-box">
            <!-- formulaire de connexion -->
            <form class="form-login" action="index.php?action=login" method="POST">
                <input type="email" name="mail" placeholder="E-mail" aria-label="Entrez votre adresse email">
               
                <input type="password" name="pwd" placeholder="Mot de passe" aria-label="Entrez votre mot de passe">
                <!-- <label for="pwd">Quelle est votre adresse e-mail</label> -->
                <button type="submit">Je me connecte</button>
            </form>
            <div class="separator">
                <span class="circle-text">OU</span>
            </div>
            <div class="login-title">
                <a class="blue-button" href="index.php?action=newAccount" title="Lien vers la page de création d'un nouveau compte">Créer un nouveau compte</a>
            </div>
        </div>
    </section>
</main>

<?php
include('app/Views/front/layouts/footer.php');
?>