<?php 

function criar_perfil($perfil)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados
    
    if (!empty($perfil))
    {
        $nome = $perfil['nome'];
        $data_nascimento = $perfil['data_nascimento'];
        $nif = $perfil['nif'];        
        $iban = $perfil['iban'];
        $telm = $perfil['telm'];
        $tel = $perfil['tel'];
        $email = $perfil['email'];
        $morada = $perfil['morada'];
        $localidade = $perfil['localidade'];
        $cp = $perfil['cp'];
        $departamento_id = $perfil['departamento_id'];
        $funcao = $perfil['funcao'];
        $estado_civil = $perfil['estado_civil'];
        $salario_bruto = $perfil['salario']; 
        
        $senha = $perfil['senha'];
        $tipo = $perfil['tipo'];
        
        echo $salario_bruto;
        $query = "INSERT INTO utilizadores (nome, data_nascimento, nif, iban, telm, tel, email, morada, localidade, cp, departamento_id, funcao, estado_civil, salario_bruto) 
                  VALUES ('$nome', '$data_nascimento', '$nif', '$iban', '$telm', '$tel', '$email', '$morada', '$localidade', '$cp', '$departamento_id', '$funcao', '$estado_civil', '$salario_bruto')";
        
        if (mysqli_query($conn, $query)) {
            $idInserido = mysqli_insert_id($conn);
            $query = "INSERT INTO logins (email, senha, id_utilizador, tipo_login) VALUES ('$email', '$senha', $idInserido, '$tipo')";
            if (mysqli_query($conn, $query)) {
                echo '<script>alert("Perfil criado com sucesso!");</script>';
            } else {
                echo "Erro ao criar login: " . mysqli_error($conn);
            }
        } else {
            echo "Erro ao criar perfil: " . mysqli_error($conn);
        }
       
    }

    include 'connections/deconn.php'; // Inclui o arquivo para fechar a conexão com o banco de dados
}


?>