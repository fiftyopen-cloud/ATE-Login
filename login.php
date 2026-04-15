<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Connexion</h1>
    
    <?php
    if (isset($_GET['error'])) {
        echo '<p>ahahah You didn\'t say the magic word!</p>';
    }
    ?>

    <form method="POST" action="checkin.php">
        <label for="username">Nom d'utilisateur</label>
        <input id="username" name="username" required>

        <label for="password">Mot de passe</label>
        <input id="password" name="password" type="password" required>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>