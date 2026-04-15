<?php
// http://localhost/ATE-Login/script/crypt_pass.php
echo 'WORK';

// 1. recuperer tous les users aux password non crypt
// 2. pour chaque user, 
//      - crypter le mdp
//      - s'assurer que le resultat de la query sera fonctionnel
//      - mettre a jour l'enregistrement dans la db

require_once __DIR__ . '../../connexion.php';

$sql = "select operator_id, password from Operator;";
$prstmt = $conn->query($sql);
$users = $prstmt->fetchAll();

foreach ($users as $user) {
    // var_dump(password_get_info($user['password'])['algo']);

    if (password_get_info($user['password'])['algo'] === null) {
        // var_dump(password_get_info($user['password'])['algo']);
        $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
        $updateSql = "update Operator set password = :password where operator_id = :operator_id";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->execute(['password' => $hashedPassword, 'operator_id' => $user['operator_id']]);    
    } else {    
        printf('<br>User %d has a hashed password : %s', $user['operator_id'], $user['password']);
    }
}
