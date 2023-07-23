<?php

#################################################################################################################################################################################################
###################################################### FUNÇOES DO ULTILIZADOR ###################################################################################################################
#################################################################################################################################################################################################
/**
 * Cria o formulário de perfil do utilizador para utilizador
 *
 * @param array $utilizador O array contendo os dados do utilizador
 * @return void
 */

function build_perfil_utilizador($utilizador)
{
    // Esta função constrói um formulário de perfil de usuário com os dados fornecidos em $ultilizador.

    echo '<div class="container mt-5 mx-auto" >
    <form  action="" method="POST" class="h-75 id="form" >
        <div class="row" >
            <div class="col-sm-6 ">
                <div class="form-group h-25">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" value="' . $utilizador['nome'] . '" readonly>
                </div>

                <div class="form-group h-25">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="' . $utilizador['data_nascimento'] . '" readonly >
                </div>

                <div class="form-group h-25">
                    <label for="nif">NIF:</label>
                    <input type="text" class="form-control" name="nif" id="nif" value="' . $utilizador['nif'] . '" readonly>
                </div>

                <div class="form-group h-25">
                    <label for="iban">IBAN:</label>
                    <input type="text" class="form-control" name="iban" id="iban" value="' . $utilizador['iban'] . '" required>
                </div>

                <div class="form-group h-25">
                    <label for="telm">Telefone Móvel:</label>
                    <input type="text" class="form-control" name="telm" id="telm" value="' . $utilizador['telm'] . '" required>
                </div>
                	
                <div class="form-group h-25">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="' . $utilizador['email'] . '" readonly>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group h-25">
                    <label for="morada">Morada:</label>
                    <input type="text" class="form-control" name="morada" id="morada" value="' . $utilizador['morada'] . '" required>
                </div>

                <div class="form-group h-25">
                    <label for="localidade">Localidade:</label>
                    <input type="text" class="form-control" name="localidade" id="localidade"  value="' . $utilizador['localidade'] . '" required>
                </div>

                <div class="form-group h-25">
                    <label for="cp">Código Postal:</label>
                    <input type="text" class="form-control" name="cp" id="cp" value="' . $utilizador['cp'] . '" required>
                </div>

                <div class="form-group h-25">
                    <label for="departamento">Departamento:</label>
                    <input type="text" class="form-control" name="departamento" id="departamento"  value="' . obterNomeDepartamento($utilizador['departamento_id']) . '" readonly >
                </div>

                <div class="form-group h-25">
                    <label for="funcao">Função:</label>
                    <input type="text" class="form-control" name="funcao" id="funcao" value="' . $utilizador['funcao'] . '" required>
                </div>

                <div class="form-group h-25">
                    <label for="estado_civil">Estado Civil:</label>
                    <select class="form-control" name="estado_civil" id="estado_civil" required>
                        <option value="solteiro"' . ($utilizador['estado_civil'] === 'solteiro' ? ' selected' : '') . '>Solteiro</option>
                        <option value="casado"' . ($utilizador['estado_civil'] === 'casado' ? ' selected' : '') . '>Casado</option>
                        <option value="divorciado"' . ($utilizador['estado_civil'] === 'divorciado' ? ' selected' : '') . '>Divorciado</option>
                        <option value="viuvo"' . ($utilizador['estado_civil'] === 'viuvo' ? ' selected' : '') . '>Viúvo</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end pt-2">
                <button type="submit" class="btn btn-primary ml-auto" name="update_perfil">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>';
}

/**
 * Converte um número em um nome de mês correspondente
 *
 * @param int $numero O número do mês
 * @return string Retorna o nome do mês correspondente ao número
 */
function numeroParaMes($numero)
{
    $meses = array(
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
    );

    if (isset($meses[$numero])) {
        return $meses[$numero];
    }

    return 'Mês inválido';
}

/**
 * Cria uma tabela com os meses processados de um utilizador em um determinado ano
 *
 * Esta função recebe o ID de um utilizador e um ano específico para listar os meses processados desse utilizador nesse ano.
 * Em seguida, ela constrói uma tabela exibindo os meses, o status de processamento e um botão para visualizar detalhes de cada mês.
 *
 * @param int $utilizador_id O ID do utilizador.
 * @param int $ano O ano para o qual se deseja listar os meses processados.
 * @return void
 */
function criarTabelaMesesProcessados($utilizador_id, $ano)
{
    // Obtém os meses processados do utilizador para o ano específico.
    $meses = listarMesesUtilizador($utilizador_id, $ano);

    // Verifica se existem meses processados.
    if (!$meses) {
        // Caso não haja meses processados, exibe um alerta informando que os dados não foram encontrados.
        echo '<script type="text/javascript">';
        echo 'alert("Dados não encontrados ");';
        echo '</script>';
    } else {
        // Início da seção com a classe Bootstrap para estilização.
        echo '<section class="container mt-4">';
        echo '<h1>Ano ' . $ano . '</h1>';

        // Início da tabela com a classe Bootstrap para estilização.
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Mês</th>';
        echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Status</th>';
        echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Detalhes</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Loop para cada mês processado.
        foreach ($meses as $mes) {
            $mes_numero = $mes["mes"];
            $ano = $mes["ano"];
            $processado = $mes["processado"] ? 'Processado' : 'Não Processado';
            $salario = $mes["salario_recebido"];
            $id = $mes['id'];

            // Início da linha da tabela para cada mês processado.
            echo '<tr>';

            // Coluna "Mês" com o nome do mês e o ano.
            echo '<td class="border">Mês ' . numeroParaMes($mes_numero) . ' ' . $ano . '</td>';

            // Coluna "Status" com o status do processamento (Processado ou Não Processado).
            echo '<td class="border text-center">' . $processado . '</td>';

            // Coluna "Detalhes" com um botão que redireciona para uma página específica de detalhes do mês (usando o ID do mês).
            echo '<td class="border text-center"><button onclick="window.location.href=\'?main=utilizador&conteudo=info_salario&salario=' . $id . '\';">Ver detalhes</button></td>';

            // Fim da linha da tabela para o mês atual.
            echo '</tr>';
        }

        // Fim da tabela e da seção.
        echo '</tbody>';
        echo '</table>';
        echo '</section>';
    }
}


/**
 * Cria as informações de salário para um determinado utilizador
 *
 * @param mixed $id O ID do utilizador
 * @return void
 */
function criar_info_salario($id)
{

    $meses = get_info_mes($id);

    foreach ($meses as $mes) {
        $mes_numero = $mes["mes"];
        $salario = $mes["salario"];
    }
    $info = get_detail_mes($salario, $mes_numero);

    echo '<div class="container mt-4">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <td>Mês</td>
                <th scope="col">Parcela Bruto</th>
                <th scope="col">Parcela Líquida</th>
                <th scope="col">Retenção (irs) </th>
                <th scope="col">Segurança Social</th>
                <th scope="col">Alimentação</th>
            </tr>
        </thead>';
    echo '<tbody>

                <tr>
                    <td>' . numeroParaMes($mes_numero) . '</td>
                    <td> € ' . $salario . '</td>
                    <td> € ' . $info['liquido'] . '</td>
                    <td> € ' . $info['irs'] . '</td>
                    <td> € ' . $info['segsocial'] . '</td>
                    <td> €  ' . $info['alimentacao'] . '</td>
                </tr>
    </tbody>
    </table>
</div';
}

#################################################################################################################################################################################################
###################################################### FUNÇOES DO ADMINISTRATOR #################################################################################################################
#################################################################################################################################################################################################

/**
 * Constrói uma lista de utilizadores em forma de tabela
 *
 * Esta função recebe um array contendo os dados de vários utilizadores e constrói uma tabela
 * com informações específicas de cada utilizador, como nome, NIF, departamento e tipo de utilizador.
 *
 * @param array $ultilizadores Um array contendo os dados dos utilizadores.
 *                             Espera-se que cada elemento do array seja um array associativo com os seguintes campos:
 *                             - 'id': ID do utilizador.
 *                             - 'nome': Nome do utilizador.
 *                             - 'nif': Número de Identificação Fiscal do utilizador.
 *                             - 'departamento_id': ID do departamento do utilizador.
 *
 * @return void
 */
function bild_list_utilizador($utilizadores, $filtro = "", $pagina_atual = 1)
{
    $itens_por_pagina = 5;
    $total_utilizadores = count($utilizadores);
    $total_paginas = ceil($total_utilizadores / $itens_por_pagina);

    // Verifica se a página atual é válida
    if ($pagina_atual < 1 || $pagina_atual > $total_paginas) {
        $pagina_atual = 1;
    }

    // Define o índice de início e fim dos itens a serem exibidos
    $inicio = ($pagina_atual - 1) * $itens_por_pagina;
    $fim = $inicio + $itens_por_pagina;

    // Filtra os utilizadores conforme a página atual e o filtro por departamento
    $utilizadores_exibidos = array();
    foreach ($utilizadores as $value) {
        $departamento = obterNomeDepartamento($value['departamento_id']);

        // Verifica o filtro por departamento
        if ($filtro === "" || $filtro == $departamento) {
            $utilizadores_exibidos[] = $value;
        }
    }

    // Início da tabela com a classe Bootstrap para estilização.
    echo '<div class="container"><table class="table mt-3">';
    echo '<div class="d-flex justify-content-between mt-3">
        <h1>Utilizadores</h1>
        <div class="dropdown ">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Departamentos
            </button>
            <ul class="dropdown-menu">';

    // Obter os nomes dos departamentos usando a função get_nome_departmentos().
    echo '<li><a class="dropdown-item" href="?main=admin&conteudo=list_utilizadores&departamento=">Todos</a></li>';
    foreach (get_nome_departmentos() as $departamento) {
        // Gerar links para filtrar por departamento usando JavaScript (seu código JavaScript não está presente aqui).
        echo '<li><a class="dropdown-item" href="?main=admin&conteudo=list_utilizadores&departamento=' . $departamento . '">' . $departamento . '</a></li>';
    }

    echo '
            </ul>
        </div>
    </div>';

    // Cabeçalho da tabela com os títulos das colunas.
    echo '<thead>';
    echo '<tr>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;">Nome</th>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Nif</th>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Departamento</th>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Tipo</th>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Delete</th>';

    echo '</tr>';
    echo '</thead>';

    // Corpo da tabela com os dados dos utilizadores.
    echo '<tbody>';

    for ($i = $inicio; $i < $fim; $i++) {
        if (isset($utilizadores_exibidos[$i])) {
            $value = $utilizadores_exibidos[$i];
            $departamento = obterNomeDepartamento($value['departamento_id']);

            // Início da linha da tabela para cada utilizador.
            echo '<tr>';

            // Coluna "Nome" contendo o nome do utilizador com um link para editar o perfil.
            echo '<td class="border text-primary"><a href="?main=admin&conteudo=editar_ultilizador&id=' . $value['id'] . '">' . $value['nome'] . '</a></td>';

            // Coluna "NIF" contendo o NIF do utilizador.
            echo '<td class="border text-center">' . $value['nif'] . '</td>';

            // Coluna "Departamento" contendo o nome do departamento obtido pela função obterNomeDepartamento().
            echo '<td class="border text-center">' . $departamento . '</td>';

            // Coluna "Tipo" exibindo o tipo de utilizador como "ADM" para administradores ou "Utilizador" para outros tipos de utilizadores.
            echo '<td class="border text-center">' . (get_tipo_utilizador($value['id']) > 0 ? "ADM" : "Utilizador") . '</td>';

            echo '<form method="POST">';
            echo '<td class="border text-center">
            <button type="submit" class="btn btn-danger" name="apagar_utilizador" onclick="return confirm(\'Tem certeza de que deseja apagar este utilizador?\')" value="' . $value['id'] . '">
            X
            </button>
            </td>';
            echo '</form>';
            // Fim da linha da tabela para o utilizador atual.
            echo '</tr>';
        }
    }

    // Fim da tabela e do container.
    echo '</tbody>';
    echo '</table></div>';

    // Navegação de página
    echo '<div class="container d-flex justify-content-end">';
    echo '<ul class="pagination">';
    // Link para página anterior (se aplicável)
    if ($pagina_atual > 1) {
        echo '<li class="page-item"><a class="page-link" href="?main=admin&conteudo=list_utilizadores&departamento=' . $filtro . '&page=' . ($pagina_atual - 1) . '">Anterior</a></li>';
    }
    // Links para as páginas numeradas
    for ($i = 1; $i <= $total_paginas; $i++) {
        // Adicione a classe "active" ao link da página atual.
        $classe_ativa = ($i === $pagina_atual) ? ' active' : '';
        echo '<li class="page-item' . $classe_ativa . '"><a class="page-link" href="?main=admin&conteudo=list_utilizadores&departamento=' . $filtro . '&page=' . $i . '">' . $i . '</a></li>';
    }
    // Link para próxima página (se aplicável)
    if ($pagina_atual < $total_paginas) {
        echo '<li class="page-item"><a class="page-link" href="?main=admin&conteudo=list_utilizadores&departamento=' . $filtro . '&page=' . ($pagina_atual + 1) . '">Próxima</a></li>';
    }
    echo '</ul>';
    echo '</div>';
}


/**
 * Cria o formulário de perfil do utilizador para o administrator
 *
 * @param array $utilizador O array contendo os dados do utilizador
 * @return void
 */
function build_perfil_adm($utilizador)
{
    echo '<div class="container mt-5 mx-auto">
        <form action="" method="POST" id="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group p-2">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control p-2" name="nome" id="nome" maxlength="50" value="' . $utilizador['nome'] . '" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="data_nascimento">Data de Nascimento:</label>
                        <input type="date" class="form-control p-2" name="data_nascimento" id="data_nascimento" value="' . $utilizador['data_nascimento'] . '" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="nif">NIF:</label>
                        <input type="text" class="form-control p-2" name="nif" id="nif" maxlength="9"  value="' . $utilizador['nif'] . '" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="iban">IBAN:</label>
                        <input type="text" class="form-control p-2" name="iban" id="iban"  maxlength="25"  value="' . $utilizador['iban'] . '" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="tel">Telefone Móvel:</label>
                        <input type="text" class="form-control p-2" name="tel" id="tel" maxlength="13"  value="' . $utilizador['tel'] . '"  required>
                    </div>
                    <div class="form-group p-2">
                        <label for="telm">Telefone:</label>
                        <input type="text" class="form-control p-2" name="telm" id="telm"  maxlength="13"  value="' . $utilizador['telm'] . '" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control p-2" name="email" id="email"  maxlength="30"  value="' . $utilizador['email'] . '" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="salario">Salario bruto:</label>
                        <input type="float" class="form-control p-2" name="salario" id="salario"  value="' . $utilizador['salario_bruto'] . '" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group p-2">
                        <label for="morada">Morada:</label>
                        <input type="text" class="form-control p-2" name="morada" id="morada"   maxlength="255" value="' . $utilizador['morada'] . '" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="localidade">Localidade:</label>
                        <input type="text" class="form-control p-2" name="localidade" id="localidade"  maxlength="20"  value="' . $utilizador['localidade'] . '" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="cp">Código Postal:</label>
                        <input type="text" class="form-control p-2" name="cp" id="cp"  maxlength="8" value="' . $utilizador['cp'] . '" required>
                    </div>
                    <div class="form-group p-2">
                        <label for="departamento_id">Departamento:</label>
                        <input type="number" class="form-control p-2" name="departamento_id" id="departamento_id"  maxlength="10"  value="' . $utilizador['departamento_id'] . '"  required>
                    </div>
                    <div class="form-group p-2">
                        <label for="funcao">Função:</label>
                        <input type="text" class="form-control p-2" name="funcao" id="funcao" maxlength="30" value="' . $utilizador['funcao'] . '" required>
                    </div>
                    <div class="form-group p-2 ">
                        <label for="estado_civil">Estado Civil:</label>
                        <select class="form-control" name="estado_civil" id="estado_civil" >
                            <option value="solteiro"' . ($utilizador['estado_civil'] === 'solteiro' ? ' selected' : '') . '>Solteiro</option>
                            <option value="casado"' . ($utilizador['estado_civil'] === 'casado' ? ' selected' : '') . '>Casado</option>
                            <option value="divorciado"' . ($utilizador['estado_civil'] === 'divorciado' ? ' selected' : '') . '>Divorciado</option>
                            <option value="viuvo"' . ($utilizador['estado_civil'] === 'viuvo' ? ' selected' : '') . '>Viúvo</option>
                        </select>
                    </div>
                    <div class="form-group p-2">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control p-2" name="senha" id="senha" placeholder="****" >
                    </div>
                    <div class="form-group p-2">
                        <label for="tipo">Tipo usuario:</label>
                        <input type="text" class="form-control p-2" name="tipo" id="tipo" value="' . (get_tipo_utilizador($utilizador['id']) == 1 ? 'ADM' : "Utilizador") . '" readonly>
                    </div>
                    <div class="d-flex justify-content-end pt-2">
                        <button type="submit" class="btn btn-primary ml-auto" name="update_user">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>';
}

/**
 * @return void
 */
function adm_criar_utilizadores()
{
    echo '<div class="container mt-5 mx-auto">
    <form action="" method="POST" id="form">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group p-2">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control p-2" name="nome" id="nome" maxlength="50" required>
                </div>
                <div class="form-group p-2">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" class="form-control p-2" name="data_nascimento" id="data_nascimento"  required>
                </div>
                <div class="form-group p-2">
                    <label for="nif">NIF:</label>
                    <input type="text" class="form-control p-2" name="nif" id="nif" maxlength="9" required>
                </div>
                <div class="form-group p-2">
                    <label for="iban">IBAN:</label>
                    <input type="text" class="form-control p-2" name="iban" id="iban"  maxlength="25"required>
                </div>
                <div class="form-group p-2">
                    <label for="tel">Telefone Móvel:</label>
                    <input type="text" class="form-control p-2" name="tel" id="tel" maxlength="13" required>
                </div>
                <div class="form-group p-2">
                    <label for="telm">Telefone:</label>
                    <input type="text" class="form-control p-2" name="telm" id="telm"  maxlength="13" required>
                </div>
                <div class="form-group p-2">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control p-2" name="email" id="email"  maxlength="30" required>
                </div>
                <div class="form-group p-2">
                    <label for="salario">Salario bruto:</label>
                    <input type="text" class="form-control p-2" name="salario" id="salario"  required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group p-2">
                    <label for="morada">Morada:</label>
                    <input type="text" class="form-control p-2" name="morada" id="morada"   maxlength="255" required>
                </div>
                <div class="form-group p-2">
                    <label for="localidade">Localidade:</label>
                    <input type="text" class="form-control p-2" name="localidade" id="localidade"  maxlength="20" required>
                </div>
                <div class="form-group p-2">
                    <label for="cp">Código Postal:</label>
                    <input type="text" class="form-control p-2" name="cp" id="cp"  maxlength="8" required>
                </div>
                <div class="form-group p-2">
                    <label for="departamento_id">Departamento:</label>
                    <input type="number" class="form-control p-2" name="departamento_id" id="departamento_id"  maxlength="10" required>
                </div>
                <div class="form-group p-2">
                    <label for="funcao">Função:</label>
                    <input type="text" class="form-control p-2" name="funcao" id="funcao" maxlength="30" required>
                </div>
                <div class="form-group p-2">
                    <label for="estado_civil">Estado Civil:</label>
                    <select class="form-control p-2" name="estado_civil" id="estado_civil" required>
                        <option value="solteiro">Solteiro</option>
                        <option value="casado">Casado</option>
                        <option value="divorciado">Divorciado</option>
                        <option value="viuvo">Viúvo</option>
                    </select>
                </div>
                <div class="form-group p-2">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control p-2" name="senha" id="senha" required>
                </div>
                <div class="form-group p-2">
                <label for="tipo">Tipo usuario:</label>
                <select class="form-control p-2" name="tipo" id="tipo" required>
                    <option value="1">Admin</option>
                    <option value="0">Usuario</option>
                </select>
            </div>
                <div class="d-flex justify-content-end pt-2">
                    <button type="submit" class="btn btn-primary ml-auto" name="criar_perfil">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
';
}

function adm_criar_departamento()
{
    echo '<div class="p-3"> <h2>Criar Departamento</h2> </div>';
    echo '<div class="container col-8"><table class="table mt-3 ">';

    // Início do cabeçalho da tabela.
    echo '<thead>';
    echo '<tr>';
    // Colunas do cabeçalho com os títulos "Departamento", "Total funcionários" e "Gasto mensal".
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-start col-4" >Nome </th>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center col-2"  >Criar</th>';
    echo '</tr>';

    echo '</thead>';
    // Fim do cabeçalho da tabela.

    // Abre o corpo da tabela para conter os dados do departamento.
    echo '<tbody>';
    // Exibe o nome do departamento na coluna "Departamento".
    echo '<form method="POST">
            <td class="border  ">
                <input type="text" maxlength="50" placeholder="ex Markting"  name="nome_dp" >
            </td>';
    echo '
            <td class="border text-center ">
                <button type="submit" name="criar_dp" value="">Save</button>
            </td></form>';


    echo '</tbody>';
    echo '</table>';
}

/**
 * Função para construir uma tabela de departamentos com informações e opções de exclusão.
 *
 * @param $departamentos - Um array contendo os departamentos e suas informações.
 * @return void
 */
function adm_build_departamentos($departamentos)
{
    // Cria um bloco de cabeçalho com o título "Departamentos".
    echo '<div class="p-3"><h1>Departamentos</h1></div>';

    // Abre uma div para conter a tabela e define algumas classes para formatação.
    echo '<div class="container"><table class="table mt-3">';

    // Início do cabeçalho da tabela.
    echo '<thead>';
    echo '<tr>';
    // Colunas do cabeçalho com os títulos "Id", "Nome" e "Delete".
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; " class="text-center">Id</th>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Nome</th>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Delete</th>';
    echo '</tr>';
    echo '</thead>';
    // Fim do cabeçalho da tabela.

    // Abre o corpo da tabela para conter os dados dos departamentos.
    echo '<tbody>';
    foreach ($departamentos as $key => $value) {
        // Início da linha da tabela para cada departamento.
        echo '<tr>';

        echo '<form method="POST" action="" style="margin-left: 10px;">';
        // Coluna do id do departamento.
        echo '<td class="border  text-center">' . $value['id'] . '</td>';
        // Coluna do nome do departamento com um link para editar suas informações.
        echo '<td class="border text-primary text-center"><a href="?main=admin&conteudo=edit_departamento&id=' . $value['id'] . '">' . $value['nome'] . '</a></td>';

        // Coluna para exclusão do departamento usando um formulário com um botão "X".

        echo '<td class="border text-primary text-center">
        <button type="submit" class="btn btn-danger" name="delete_dp" value=" ' . $value['id'] . '"  onclick="return confirm(\'Tem certeza de que deseja apagar esta tabela?\')">
        X
        </button>
         </td>';
        echo '</tr>';
        echo '</form>';
    }
    // Fim do corpo da tabela.

    // Fecha a tabela e a div que a contém.
    echo '</tbody>';
    echo '</table></div>';
}

/**
 * Função para construir a visualização detalhada de um departamento específico com base no ID fornecido.
 *
 * @param $id - O ID do departamento que se deseja visualizar.
 * @return void
 */
function amd_build_departamentoId($id)
{
    // Obtém as informações detalhadas do departamento com base no ID fornecido.
    $departamento = get_info_departamento($id);

    // Exibe o nome do departamento como um título principal.
    echo '<h1>' . $departamento['nome'] . '</h1>';

    // Abre uma div para conter a tabela e define algumas classes para formatação.
    echo '<div class="container"><table class="table mt-3">';

    // Início do cabeçalho da tabela.
    echo '<thead>';
    echo '<tr>';
    // Colunas do cabeçalho com os títulos "Departamento", "Total funcionários" e "Gasto mensal".
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; " class="text-center">Departamento</th>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Total funcionários</th>';
    echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Gasto mensal</th>';
    echo '</tr>';
    echo '</thead>';
    // Fim do cabeçalho da tabela.

    // Abre o corpo da tabela para conter os dados do departamento.
    echo '<tbody>';
    // Exibe o nome do departamento na coluna "Departamento".
    echo '<td class="border  text-center">' . $departamento['nome'] . '</td>';

    // Obtém informações adicionais do departamento usando a função get_infoadd_departamento().
    $info = get_infoadd_departamento($id);

    // Exibe o número total de funcionários na coluna "Total funcionários".
    echo '<td class="border  text-center">' . $info['funcionarios'] . '</td>';

    // Exibe o gasto mensal com o símbolo € na coluna "Gasto mensal".
    echo '<td class="border  text-center"> € ' . $info['valortotal'] . '</td>';

    echo '</tbody>';
    echo '</table>';
}

/**
 * Exibe o formulário de processamento de salários para selecionar o ano, mês e utilizador.
 * Após a submissão do formulário, mostra as informações do salário para o utilizador selecionado.
 *
 * @param array $dados_utilizador Um array contendo as informações do utilizador selecionado (ano, mês e ID).
 * @return void
 */
function amd_build_processamento($dados_utilizador)
{
    $anos = get_todos_anos();
    echo "<div class='p-3'><h1>Processamento de Salário</h1></div>";
    echo '<div class="container">';
    echo '<form method="post" class="d-flex mt-2 gap-2"> ';

    // Dropdown para selecionar o ano
    echo '<select class="form-select" aria-label="Default select example" name="ano" required>';
    echo '<option value="" selected disabled>Escolha o ano</option>';
    foreach ($anos as $ano) {
        echo '<option value="' . $ano . '">' . $ano . '</option>';
    }
    echo '</select>';

    // Dropdown para selecionar o mês
    echo '<select class="form-select" aria-label="Default select example" name="mes" required>';
    echo '<option value="" selected disabled>Escolha o mês</option>';
    for ($i = 1; $i <= 12; $i++) {
        echo '<option value="' . $i . '">' . numeroParaMes($i) . '</option>';
    }
    echo '</select>';

    // Dropdown para selecionar o utilizador
    echo '<select class="form-select" aria-label="Default select example" name="id" required>';
    echo '<option value="" selected disabled>Escolha o utilizador</option>';
    $utilizadores = get_adm_ultilizadores();
    foreach ($utilizadores as $utilizador) {
        echo '<option value="' . $utilizador['id'] . '">' . $utilizador['nome'] . '</option>';
    }
    echo '</select>';

    // Botão de submissão para pesquisar
    echo '<button type="submit" class="btn btn-primary ml-auto" name="pesquisar">Pesquisar</button>';
    echo '</form></div>';

    if ($dados_utilizador) {
        $nome = "";
        foreach ($utilizadores as $utilizador) {
            if ($dados_utilizador['id'] == $utilizador['id']) {
                $nome = $utilizador['nome'];
            }
        }
        $salario_info = get_salario_for_processamento($dados_utilizador);
        if ($salario_info == false) {
            // Caso não haja registro de salário para o mês e ano selecionados
            echo '<div class="container pt-5">';
            echo '<td style="border: 1px solid #ddd; padding: 8px;" colspan="2" class="text-center">Nenhum salário encontrado</td></div>';
        } else {

            echo '<div class="container"><table class="table mt-5">';
            echo '<thead>';
            echo '<tr>';
            echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2; " class="text-center">Nome</th>';
            echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Ano</th>';
            echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Mês</th>';
            echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Salário</th>';
            echo '<th style="border: 1px solid #ddd; padding: 8px; background-color: #f2f2f2;" class="text-center">Processamento</th>';
            echo '</tr>';
            echo '</thead>';

            echo '<tbody>';
            echo '<tr>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;" class="text-center">' . $nome . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;" class="text-center">' . $dados_utilizador['ano'] . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;" class="text-center">' . numeroParaMes($dados_utilizador['mes']) . '</td>';


            echo '<td style="border: 1px solid #ddd; padding: 8px;" class="text-center">€ ' . $salario_info['salario_recebido'] . '</td>';
            if ($salario_info['processado'] != 1) {
                echo '<form method="post">';
                echo '<td style="border: 1px solid #ddd; padding: 8px;" class="text-center">
                <button type="submit" name="processar_mes" value="' . $salario_info['id'] . '" onclick="return confirm(\'Tem certeza ?\')">Processar ?</button></td>';
                echo '</form>';
            } else {
                echo '<td style="border: 1px solid #ddd; padding: 8px;" class="text-center">Processado</td>';
            }


            echo '</tr>';
            echo '</tbody>';

            echo '</table></div>';
        }
    }
}


?>