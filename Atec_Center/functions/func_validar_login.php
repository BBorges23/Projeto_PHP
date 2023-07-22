<?php

/**
 * Valida as credenciais de login
 *
 * @param string $log_email O email de login
 * @param string $log_password A senha de login
 * @return int|null Retorna o ID do utilizador se as credenciais de login forem válidas, caso contrário, retorna null
 */
function validar_login($log_email, $log_password)
{
    include 'connections/conn.php';

    // Proteção contra ataques de injeção de SQL usando instruções preparadas
    $stmt = $conn->prepare("SELECT email, senha, tipo_login FROM logins WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $log_email, $log_password);
    $stmt->execute();
    $result = $stmt->get_result();
    $validar = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        // As credenciais de login são válidas
        $id = null;

        // Obtenção do ID do utilizador corrigida
        $stmt = $conn->prepare("SELECT id_utilizador FROM logins WHERE email = ?");
        $stmt->bind_param("s", $log_email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id_utilizador'];
        }
        
        $_SESSION["log_type"] = $validar["tipo_login"];
        $_SESSION["login"] = $log_email;

        switch ($_SESSION["log_type"]) {
            case '1':
                echo '<meta http-equiv="refresh" content="0;url=?main=admin">';
                break;
            case '0':
                echo '<meta http-equiv="refresh" content="0;url=?main=utilizador">';
                break;
            default:
                // Código padrão
                break;
        }

        include 'connections/deconn.php';
        return $id;
    } else {
        echo '<h4>Os dados inseridos não são válidos</h4>';
        include 'connections/deconn.php';
        return null;
    }
}
?>

