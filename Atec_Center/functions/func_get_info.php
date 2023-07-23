<?php
#################################################################################################################################################################################################
###################################################### FUNÇOES DO ULTILIZADOR ###################################################################################################################
#################################################################################################################################################################################################

/**
 * Obtém as informações de um utilizador com base no seu ID
 *
 * @param int $id O ID do utilizador
 * @return array|null Retorna um array com as informações do utilizador ou null se o utilizador não for encontrado
 */
function getUtilizador($id){

    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    $sql = "SELECT * FROM utilizadores WHERE id = $id"; // Consulta SQL para obter as informações do utilizador com base no ID

    $result = $conn->query($sql); // Executa a consulta no banco de dados

    if ($result->num_rows > 0) {
        // Inicializa o array para armazenar as informações do utilizador
        $utilizador_info = array();

        // Obtém as informações do utilizador e guarda no array
        while ($row = $result->fetch_assoc()) {
            // Armazena as informações obtidas no array
            $utilizador_info['id'] = $row['id'];
            $utilizador_info['nome'] = $row['nome'];
            $utilizador_info['data_nascimento'] = $row['data_nascimento'];
            $utilizador_info['nif'] = $row['nif'];
            $utilizador_info['iban'] = $row['iban'];
            $utilizador_info['telm'] = $row['telm'];
            $utilizador_info['tel'] = $row['tel'];
            $utilizador_info['email'] = $row['email'];
            $utilizador_info['morada'] = $row['morada'];
            $utilizador_info['localidade'] = $row['localidade'];
            $utilizador_info['cp'] = $row['cp'];
            $utilizador_info['departamento_id'] = $row['departamento_id'];
            $utilizador_info['funcao'] = $row['funcao'];
            $utilizador_info['estado_civil'] = $row['estado_civil'];
            $utilizador_info['salario_bruto'] = $row['salario_bruto'];

        }
    }else {
        echo "Utilizador não encontrado."; // Exibe uma mensagem se o utilizador não for encontrado
    }

    include 'connections/deconn.php'; // Inclui o arquivo para fechar a conexão com o banco de dados

    return $utilizador_info; // Retorna o array com as informações do utilizador

}

/**
 * Obtém o nome de um departamento com base no seu ID
 *
 * @param int $departamento_id O ID do departamento
 * @return string Retorna o nome do departamento
 */
function obterNomeDepartamento($departamento_id) {

    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para obter o nome do departamento
    $sql = "SELECT nome FROM departamentos WHERE id = $departamento_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_departamento = $row["nome"];
    } else {
        $nome_departamento = "Departamento não encontrado";
    }

    // Fechar a conexão com o banco de dados
    include 'connections/deconn.php'; // Inclui o arquivo para fechar a conexão com o banco de dados

    return $nome_departamento;
}

/**
 * Lista os meses processados de um utilizador para um determinado ano
 *
 * @param int $utilizador_id O ID do utilizador
 * @param int $ano O ano para o qual deseja listar os meses processados
 * @return array Retorna um array contendo os meses processados do utilizador para o ano especificado
 */

function listarMesesUtilizador($utilizador_id,$ano) {
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    $meses = array(); // Array para armazenar os meses processados do utilizador

    // Consulta SQL para listar os meses processados do utilizador
    $sql = "SELECT id, mes, ano, processado, salario_recebido FROM meses_processados WHERE id_utilizador = $utilizador_id AND ano = $ano";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $mes = $row["mes"];
            $ano = $row["ano"];
            $processado = $row["processado"];
            $salario = $row['salario_recebido'];
            $id = $row["id"];

            $meses[] = ["mes" => $mes, "ano" => $ano, "processado" => $processado, 'salario_recebido' => $salario, 'id' => $id]; // Adiciona o mês, ano, processado 
        }
    } else {
        echo "Nenhum mês processado encontrado para este ano.";
    }

    include 'connections/deconn.php'; // Inclui o arquivo para fechar a conexão com o banco de dados
    return $meses; // Retorna o array com os meses processados
}

/**
 * Obtém detalhes de um determinado mês, como salário líquido, Segurança Social, IRS e alimentação
 *
 * @param float $valor O valor do salário recebido
 * @param int $mes O mês para o qual deseja calcular os detalhes
 * @return array Retorna um array contendo os detalhes calculados (salário líquido, Segurança Social, IRS e alimentação)
 */
function get_detail_mes($valor, $mes)
{
    // Obtém o número de dias do mês
    $dias = get_dias_do_mes($mes);

    // Calcula o valor da Segurança Social (ss)
    $ss = $valor * (11 / 100);

    // Calcula o valor da alimentação baseado em um valor fixo por dia multiplicado pelos dias do mês
    $alimentacao = 5.25 * $dias;

    $irs = 0;
    // Calcula o valor do IRS (Imposto sobre o Rendimento de Singular) com base no valor recebido ($valor)
    if ($valor <= 1000) {
        $irs = $valor * (9 / 100);
    } elseif ($valor > 1000  &&  $valor <= 1750) {
        $irs = $valor * (13 / 100);
    } elseif ($valor > 1750) {
        $irs = $valor * (16 / 100);
    }

    // Calcula o valor do salário líquido subtraindo os descontos (ss e irs) e adicionando o valor da alimentação
    $salario_liquido = $valor - $ss + $alimentacao - $irs;

    // Cria um array com os dados calculados
    $dados = array(
        'liquido' => $salario_liquido,
        'segsocial' => $ss,
        'irs' => $irs,
        'alimentacao' => $alimentacao
    );

    // Retorna o array com os dados
    return $dados;
}

/**
 * Obtém o número de dias em um determinado mês
 *
 * @param int $mes O mês para o qual deseja obter o número de dias
 * @return int Retorna o número de dias no mês especificado
 */
function get_dias_do_mes($mes) {
    $mesesCom31Dias = array(1, 3, 5, 7, 8, 10, 12);

    if (in_array($mes, $mesesCom31Dias)) {
        return 23;
    } elseif ($mes == 2) {
        return 18; // Fevereiro tem 28 ou 29 dias, dependendo do ano bissexto
    } else {
        return 20;
    }
}

/**
 * Obtém as informações de mês e salário para um determinado ID de utilizador
 *
 * @param mixed $id O ID do utilizador
 * @return array Retorna um array contendo os meses e salários processados do utilizador
 */
function get_info_mes($id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    $meses = array(); // Array para armazenar os meses e salários processados do utilizador

    $sql = "SELECT mes, salario_recebido FROM meses_processados WHERE id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $mes = $row['mes'];
            $salario = $row['salario_recebido'];
            $meses[] = ['mes' => $mes, 'salario' => $salario];
        }
    }


    include 'connections/deconn.php'; // Inclui o arquivo para fechar a conexão com o banco de dados
    return $meses; // Retorna o array com os meses e salários processados
}

/**
 * Obtém os anos de salário de um usuário
 * @param mixed $id recebe o id do ultilizador
 * @return array retorna um array com anos
 */
function get_anos_processado($id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    $query = "SELECT DISTINCT ano FROM meses_processados WHERE id_utilizador = $id ";
    $resultado = mysqli_query($conn, $query);

    $anos = array();
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $anos[] = $linha['ano'];
    }

    include 'connections/deconn.php'; // Inclui o arquivo para fechar a conexão com o banco de dados
    return $anos; // Retorna o array com os meses e salários processados
}

#################################################################################################################################################################################################
###################################################### FUNÇOES DO ADMINISTRATOR #################################################################################################################
#################################################################################################################################################################################################


/**
 * Obtém todos os utilizadores do banco de dados
 *
 * Esta função realiza uma consulta ao banco de dados para recuperar todos os utilizadores cadastrados.
 * Em seguida, ela armazena os dados dos utilizadores em um array associativo e retorna esse array.
 *
 * @return array Um array contendo os dados de todos os utilizadores cadastrados no banco de dados.
 *               Cada elemento do array é um array associativo com os campos do utilizador como chaves.
 */
function get_adm_ultilizadores()
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    $query = "SELECT * FROM utilizadores";
    $resultado = mysqli_query($conn, $query);

    $utilizadores = array();
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $utilizadores[] = $linha;
    }

    include 'connections/deconn.php'; // Inclui o arquivo para fechar a conexão com o banco de dados
    return $utilizadores; // Retorna o array de utilizadores contendo todos os utilizadores do banco de dados
}


/**
 * Obtém o tipo de utilizador associado a um determinado ID de utilizador no banco de dados.
 *
 * Esta função utiliza uma consulta preparada para buscar o tipo de login associado ao ID de utilizador fornecido.
 * O resultado da consulta é retornado como uma string contendo o tipo de utilizador.
 *
 * @param int $id O ID do utilizador para o qual se deseja obter o tipo.
 * @return string|false Retorna uma string contendo o tipo de utilizador se o ID for encontrado e a consulta retornar resultados.
 *                        Caso contrário, retorna false se o ID não for encontrado ou não houver resultados.
 */
function get_tipo_utilizador($id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    // Utilize uma consulta preparada para evitar problemas de segurança
    $query = "SELECT tipo_login FROM logins WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Verifique se a consulta retornou resultados
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Obtenha o tipo de usuário a partir do resultado da consulta
        $row = mysqli_fetch_assoc($resultado);
        $tipo_usuario = $row['tipo_login'];

        // Feche a conexão com o banco de dados
        mysqli_stmt_close($stmt);
        include 'connections/deconn.php';

        // Retorna o tipo de usuário
        return $tipo_usuario;
    } else {
        // Caso o ID não seja encontrado ou não existam resultados
        // Feche a conexão com o banco de dados
        mysqli_stmt_close($stmt);
        include 'connections/deconn.php';

        // Retorne false indicando que o ID não foi encontrado ou não há resultados.
        return false;
    }
}

/**
 * Obtém os nomes dos departamentos do banco de dados.
 *
 * Esta função se conecta ao banco de dados, executa uma consulta SQL para obter os nomes dos departamentos
 * e retorna um array contendo os nomes dos departamentos.
 *
 * @return array Retorna um array contendo os nomes dos departamentos.
 */
function get_nome_departmentos()
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    // Verificar a conexão
    if (!$conn)
    {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Etapa 2: Executar a consulta SQL para obter os nomes dos departamentos
    $query = "SELECT nome FROM `departamentos`";
    $result = mysqli_query($conn, $query);

    // Etapa 3: Obter os resultados e armazená-los em um array
    $dados = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Adiciona cada nome de departamento ao array $dados
            $dados[] = $row['nome'];
        }
    }

    // Etapa 4: Fechar a conexão com o banco de dados
    include 'connections/deconn.php';

    // Retorna o array contendo os nomes dos departamentos
    return $dados;
}

/**
 * @return array
 */
function get_departamentos()
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    $query = "SELECT * FROM `departamentos` WHERE 1";
    $result = mysqli_query($conn, $query);
    $dados = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Adiciona cada departamento como um elemento no array $dados
            $dados[] = array(
                'id' => $row['id'],
                'nome' => $row['nome']
            );
        }
    }
    include 'connections/deconn.php'; // Fecha a conexão com o banco de dados
    return $dados;
}

/**
 * Função para obter informações de um departamento específico com base no ID fornecido.
 *
 * @param $id - O ID do departamento que se deseja obter informações.
 * @return array - Um array contendo as informações do departamento.
 */
function get_info_departamento($id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    $query = "SELECT * FROM `departamentos` WHERE id = $id;";
    $result = mysqli_query($conn, $query);
    $dados = array();

    if (mysqli_num_rows($result) > 0) {
        // O código entra em um loop apenas se houver resultados da consulta.
        while ($row = mysqli_fetch_assoc($result)) {
            // Adiciona cada departamento como um elemento no array $dados.
            // O loop pode ser desnecessário aqui, pois a consulta só deve retornar um único registro,
            // mas isso dependerá do seu caso específico.
            $dados = [
                'id' => $row['id'],
                'nome' => $row['nome']
            ];
        }
    }

    include 'connections/deconn.php'; // Fecha a conexão com o banco de dados
    return $dados;
}


/**
 * Função para obter informações adicionais de um departamento específico com base no ID fornecido.
 *
 * @param $id - O ID do departamento para o qual se deseja obter informações adicionais.
 * @return array - Um array contendo as informações adicionais do departamento.
 */
function get_infoadd_departamento($id)
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados
    $query = "SELECT
          COUNT(*) AS total_salarios_somados,
          FORMAT(SUM(salario_bruto), 2) AS total_salarios
          FROM utilizadores
          WHERE departamento_id = $id;";

    $result = mysqli_query($conn, $query);
    $dados = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Adiciona cada departamento como um elemento no array $dados
            $dados = [
                'funcionarios' => $row['total_salarios_somados'],
                'valortotal' => $row['total_salarios']
            ] ;
        }
    }

    include 'connections/deconn.php'; // Fecha a conexão com o banco de dados
    return $dados;
}

/**
 * Obtém todos os anos distintos armazenados na tabela meses_processados.
 *
 * Esta função realiza uma consulta SQL para obter todos os anos distintos que estão armazenados na tabela meses_processados.
 *
 * @return array Um array contendo os anos distintos obtidos da tabela meses_processados.
 */
function get_todos_anos()
{
    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    $query = "SELECT DISTINCT ano FROM meses_processados;";
    $result = mysqli_query($conn, $query);
    $dados = array();

    // Verifica se há resultados da consulta
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Adiciona cada ano como um elemento no array $dados
            $dados[] = $row['ano'];
        }
    }

    include 'connections/deconn.php'; // Fecha a conexão com o banco de dados

    return $dados;
}


/**
 * Obtém o salário recebido de um determinado mês e ano para um utilizador específico.
 *
 * Esta função realiza uma consulta SQL para obter o salário recebido de um mês e ano específicos
 * para um determinado utilizador.
 *
 * @param array $dados Um array contendo as informações do mês, ano e ID do utilizador.
 * @return array|false Retorna um array associativo com o valor do salário recebido e o campo "processado"
 *                      ou false em caso de erro.
 * @throws Exception Lança uma exceção em caso de erro na consulta.
 */
function get_salario_for_processamento($dados)
{
    $mes = $dados['mes'];
    $ano = $dados['ano'];
    $id_user = $dados['id'];

    include 'connections/conn.php'; // Inclui o arquivo de conexão com o banco de dados

    // Consulta SQL usando prepared statements para evitar ataques de injeção de SQL
    $query = "SELECT  id, salario_recebido, processado FROM `meses_processados` 
              WHERE ano = ? AND id_utilizador = ? AND mes = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iii", $ano, $id_user, $mes);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        // Lança uma exceção em caso de erro na consulta
        throw new Exception("Erro ao executar a consulta: " . mysqli_error($conn));
    }

    // Verifica se o resultado contém pelo menos uma linha e obtém o valor do salário recebido
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $salario_recebido = $row['salario_recebido'];
        $processado = $row['processado'];
        $id = $row['id'];
        // Retorna um array associativo com o valor do salário recebido e o campo "processado"
        return array(
            'id' => $id,
            'salario_recebido' => $salario_recebido,
            'processado' => $processado
        );
    } else {
        // Retorna false caso nenhum registro seja encontrado
        return false;
    }

    include 'connections/deconn.php'; // Fecha a conexão com o banco de dados
}


?>



