<?php
if(!empty($_POST)){
    include 'database.php';
    $sql = 'INSERT INTO `operator` (`username`, `password`) VALUES (?,?);';
    $statement = $pdo->prepare($sql);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $statement->execute([$_POST['username'], $password]);
}
else{
    echo 'Vous avez pas soumis';

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Inscription</h1>
    <form method="POST" action="register.php">
        <label for="username">Nom d'utilisateur</label>
        <input id="username" name="username" value="" required>

        <label for="password">Mot de passe</label>
        <input id="password" name="password" value="" type="password" required>

        <button type="submit">Creer</button>
    </form>
</body>
</html>