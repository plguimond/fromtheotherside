<?php
include('app/Views/front/layouts/header.php');
?>
<main id="login-page">
    <section class="container" id="login-content">
        <div class="login-title">
            <h1>Création d'un nouveau compte utilisateur</h1>
            <p>Veuillez remplir toutes les informations pour créer un nouveau compte</p>
        </div>
        <div id="login-box">
            <form id="form-login" action="indexAdmin.php?action=login" method="POST">
                <input type="text" name="mail" placeholder="E-mail">
                <!-- <label for="mail">Quelle est votre adresse e-mail</label> -->
                <input type="password" name="pwd" placeholder="Mot de passe">
                <!-- <label for="pwd">Quelle est votre adresse e-mail</label> -->
                <button type="submit">Je me connecte</button>
            </form>
            <div class="separator">
                <span class="circle-text">OU</span>
            </div>
            <div class="login-title">
                <a class="blue-button" href="indexAdmin.php?action=createAccount">Créer un nouveau compte</a>
            </div>


        </div>
    </section>


</main>

<?php
include('app/Views/front/layouts/footer.php');
?>