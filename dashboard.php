<?php
session_start();
if (!isset($_SESSION['is_logged'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p><?= $_SESSION['is_logged'] ?> bienvenue sur votre dashboard !</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>