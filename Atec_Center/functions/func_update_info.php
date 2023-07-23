<?php
#################################################################################################################################################################################################
###################################################### FUNÇOES DO ULTILIZADOR ###################################################################################################################
#################################################################################################################################################################################################

/**
 * Atualiza o perfil de um utilizador no banco de dados
 *
 * @param array $perfil Um array contendo os dados do perfil a serem atualizados
 * @param int $id O ID do utilizador
 * @return void
 */
function update_perfil_utilizador($perfil, $id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    if (!empty($perfil)) {
        $iban = $perfil['iban'];
        $telm = $perfil['telm'];
        $email = $perfil['email'];
        $morada = $perfil['morada'];
        $localidade = $perfil['localidade'];
        $cp = $perfil['cp'];
        $funcao = $perfil['funcao'];
        $estado_civel = $perfil['estado_civil'];

        $query = "UPDATE utilizadores SET iban = '$iban', telm = '$telm', email = '$email', morada = '$morada', localidade = '$localidade', cp = '$cp',  funcao = '$funcao', estado_civil = '$estado_civel' WHERE id = '$id'";
        mysqli_query($conn, $query);
        echo '<script>alert("Dados Atualizados com sucesso");</script>';
    }
   
    include 'connections/deconn.php'; // Inclui o arquivo para fechar a conexão com o banco de dados
    echo '<meta http-equiv="refresh" content="0;url=?main=utilizador&conteudo=perfil">';
}
#################################################################################################################################################################################################
###################################################### FUNÇOES DO ADMINISTRATOR #################################################################################################################
#################################################################################################################################################################################################

/**
 * Atualiza o perfil de um utilizador para um administrador
 *
 * Esta função recebe um array `$perfil` contendo os dados do utilizador a serem atualizados.
 * Os dados incluem informações pessoais, como nome, data de nascimento, nif, entre outros.
 * Caso a senha do utilizador também seja fornecida, ela também é atualizada no banco de dados.
 * Após realizar as atualizações, a função redireciona para uma página específica.
 *
 * @param array $perfil Um array contendo os dados do utilizador a serem atualizados.
 * @return void
 */
function update_perfil_for_adm($perfil,$id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    // Verifica se o array $perfil não está vazio
    if (!empty($perfil)) {
        // Extrai os dados do array $perfil para variáveis individuais
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
       
        // Monta a consulta SQL para atualizar os dados do utilizador na tabela "utilizadores"
        $query = "UPDATE utilizadores SET nome = '$nome', data_nascimento = '$data_nascimento', nif = '$nif', iban = '$iban', 
        telm = '$telm', tel = '$tel', email = '$email', morada = '$morada', localidade = '$localidade', cp = '$cp', 
        departamento_id = '$departamento_id', funcao = '$funcao', estado_civil = '$estado_civil', salario_bruto = '$salario_bruto'
        WHERE id = '$id'";

        // Executa a consulta SQL para atualizar os dados do utilizador
        if (mysqli_query($conn, $query)) {
            // Exibe uma mensagem de alerta informando que os dados foram atualizados com sucesso
            print_r($perfil);
            echo '<script>alert("Dados Atualizados com sucesso");</script>';
        }
        
    }

    // Verifica se a nova senha foi fornecida no array $perfil
    if ($perfil['senha']) {
        // Extrai a nova senha do array $perfil
        $senha = $perfil['senha'];

        // Monta a consulta SQL para atualizar a senha do utilizador na tabela "logins"
        $query = "UPDATE logins SET senha = '$senha' WHERE id_utilizador = '$id';";

        // Executa a consulta SQL para atualizar a senha do utilizador
        mysqli_query($conn, $query);
    }

    // Inclui o arquivo para fechar a conexão com o banco de dados
    include 'connections/deconn.php';

    // Redireciona para a página que lista os utilizadores após as atualizações
    echo '<meta http-equiv="refresh" content="0;url=?main=admin&conteudo=list_utilizadores">';
}

/**
 * Atualiza o status de processamento de um mês na tabela "meses_processados".
 *
 * Esta função realiza uma consulta SQL para atualizar o status de processamento de um mês
 * para o valor "1" (processado) na tabela "meses_processados".
 *
 * @param int $id O ID do mês a ser marcado como processado.
 * @return void
 */
function update_mes_processar($id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    // Consulta SQL para atualizar o status de processamento do mês
    $query = "UPDATE meses_processados SET processado = 1 WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Processado com sucesso");</script>'; // Exibe uma mensagem de sucesso
    } else {
        echo '<script>alert("Erro ao processar");</script>'; // Exibe uma mensagem de erro
    }

    include 'connections/deconn.php'; // Fecha a conexão com o banco de dados
    echo '<meta http-equiv="refresh"'; // Atualiza a página após o processamento
}

?>

