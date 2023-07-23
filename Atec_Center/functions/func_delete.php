<?php

/**
 * Função para apagar um usuário da tabela "utilizadores" com base no ID fornecido.
 *
 * @param $id - O ID do usuário que se deseja apagar.
 * @return void
 */
function delete_utilizador($id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    // Monta a instrução SQL para apagar o usuário com o ID fornecido
    $query = "DELETE FROM utilizadores WHERE id = $id;";

    // Executa a instrução SQL para apagar o usuário com o ID fornecido.
    // Verifica se a execução foi bem sucedida e exibe uma mensagem de sucesso ou erro
    if (mysqli_query($conn, $query))
    {
        echo  '<script>alert("Apagado com sucesso");</script>'; // Exibe uma mensagem de sucesso caso o usuário seja apagado com sucesso
    }else
    {
        echo  '<script>alert("Erro ao apagar ");</script>'; // Exibe uma mensagem de erro caso ocorra algum problema ao apagar o usuário
    }

    // Monta a instrução SQL para apagar o login do usuário com o ID fornecido na tabela "logins"
    $query = "DELETE FROM logins WHERE id_utilizador = $id;";
    if (!mysqli_query($conn, $query))
    {
        echo  '<script>alert("Erro ao apagar login ");</script>'; // Exibe uma mensagem de erro caso ocorra algum problema ao apagar o login do usuário
    }

    include 'connections/deconn.php'; // Fecha a conexão com o banco de dados

    // Redireciona o usuário para a página de listagem de utilizadores após a exclusão bem sucedida
    echo '<meta http-equiv="refresh" content="0;url=?main=admin&conteudo=list_utilizadores">';
}


/**
 * Deleta um departamento do banco de dados pelo ID.
 *
 * Esta função remove um departamento do banco de dados com base no ID fornecido.
 *
 * @param int $id O ID do departamento a ser deletado.
 * @return void
 */
function delete_departamento($id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    // Monta a consulta SQL para deletar o departamento pelo ID
    $query = "DELETE FROM `departamentos` WHERE id = $id;";

    // Executa a consulta e verifica se foi bem-sucedida
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Apagado com sucesso");</script>'; // Exibe uma mensagem de sucesso caso o departamento seja apagado com sucesso
    } else {
        echo '<script>alert("Erro ao apagar ");</script>'; // Exibe uma mensagem de erro caso ocorra algum problema ao apagar o departamento
    }

    include 'connections/deconn.php'; // Fecha a conexão com o banco de dados

    // Redireciona para a página de listagem de departamentos após a conclusão
    echo '<meta http-equiv="refresh" content="0;url=?main=admin&conteudo=list_departamento">';
}
?>

