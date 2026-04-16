<?php
// http://localhost/ATE-Login/script/crypt_pass.php
echo 'WORK';

// 1. recuperer tous les users aux password non crypt
// 2. pour chaque user, 
//      - crypter le mdp
//      - s'assurer que le resultat de la query sera fonctionnel
//      - mettre a jour l'enregistrement dans la db

require_once __DIR__ . '../../connexion.php';

try {
    $sql = "select operator_id, password from Operator;";
    $prstmt = $conn->query($sql);
    $users = $prstmt->fetchAll();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}


try {
    foreach ($users as $user) {  
        if ($user['password'] && password_get_info($user['password'])['algo'] == 0) {
            printf('<br>System : User %d password is not hashed : %s', $user['operator_id'], $user['password']);
            
            $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);

            if (password_verify($user['password'], $hashedPassword)) {
                printf('<br>System : User %d password is the same as the hashed password : %s', $user['operator_id'], $hashedPassword);
                $updateSql = "update Operator set password = :password where operator_id = :operator_id";
                $updateStmt = $conn->prepare($updateSql);
                $updateSuccess = $updateStmt->execute(['password' => $hashedPassword, 'operator_id' => $user['operator_id']]);

                if ($updateSuccess) {
                    $checkSql = "select password from Operator where operator_id = :operator_id";
                    $checkStmt = $conn->prepare($checkSql);
                    $checkStmt->execute(['operator_id' => $user['operator_id']]);
                    $storedPassword = $checkStmt->fetchColumn();

                    if ($storedPassword && password_verify($user['password'], $storedPassword)) 
                        printf('<br>Database : User %d password update is functional.', $user['operator_id']);
                    else 
                        printf('<br>Database : User %d password update executed but verification failed.', $user['operator_id']);  
                } else 
                    printf('<br>Database : User %d password update query failed to execute.', $user['operator_id']);    
            } else 
                printf('<br>System : User %d password is not the same as the hashed password : %s', $user['operator_id'], $hashedPassword);                        
        } if (!$user['password'])
            printf('<br>System : User %d password isn\'t present.', $user['operator_id']);
        else 
            printf('<br>System : User %d password is already hashed : %s', $user['operator_id'], $user['password']);
    }

} catch (PDOException $e) {
    echo "Operation failed: " . $e->getMessage();
    die();
}

                    