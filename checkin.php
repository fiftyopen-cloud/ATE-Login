<?php
session_start();

require_once 'connexion.php';

$sql = "select password from login_system where active = 1 and username = :admin";
$prstmt = $conn->prepare($sql);
$prstmt->execute(['admin' => $_POST['username']]);
$user = $prstmt->fetch();

var_dump($sql);
var_dump($user);

password_hash($_POST['password'], PASSWORD_DEFAULT);
password_verify($_POST['password'], $user['password']);

if ($user && $_POST['password'] === $user['password']) {
    $_SESSION['is_logged'] = $_POST['username'];
    // echo "Connexion réussie !";
    header("Location: dashboard.php");
} else {
    // echo "Nom d'utilisateur ou mot de passe incorrect.";
    header("Location: login.php?error=1");
}   

exit();
?>