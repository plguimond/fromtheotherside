<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>From The Other Side - Groupe de musique rock en Bretagne</title>
</head>
<body>
    <a href="index.php?action=testUser">Voir utilisateur (test)</a>

    <div>
        <?php if(isset($users)) { ?>
        <?php foreach ($users as $user) { ?>
        <p><?= $user['lastname'];?></p>
        <p><?= $user['firstname'];?></p>
        <p><?= $user['mail'];?></p>
    </div>

    <?php } }?>
</body>
</html>