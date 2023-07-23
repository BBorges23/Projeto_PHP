<style>
    body,
    html {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #ultizador {
        height: 80vh;
        color: #22274d;
        /* Define a altura como 100% da altura da janela */
    }

    #ultizador a {
        text-decoration: none;
        color: #22274d;
    }

    #ultizador button {
        background-color: #22274d;
        color: #ffffff;
    }
</style>


<?php
$id = @$_SESSION['id_user'];
$info_utilizador = getUtilizador($id);
echo '

<section id="ultizador" class="container-fluid  ">
    <div class="row h-100">
        <div class="col-2 fundo borda mx-auto rounded-end h-100" style="background-color: #808080;">
            <div class="d-flex flex-column justify-content-around h-100 text-center">
                
                <div class="d-flex flex-column h-100  align-items-start mt-3">
                    <h3>Bem Vindo</h3> 
                    <img src="imgs/user.jpg" alt="" class="rounded-circle w-50 mx-auto p-3">
                    <h2>' . $info_utilizador['nome'] . '</h2>';

?>
    </div>
<div class="text-center d-flex flex-column h-100  gap-5 mb-5 ">

    <div class="dropdown ">
        <button class="btn btn-secondary dropdown-toggle  w-100 p-3" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
            Utilizadores
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

            <li><a class="dropdown-item" href="?main=admin&conteudo=criar_utilizadores">Criar </a></li>
            <li><a class="dropdown-item" href="?main=admin&conteudo=list_utilizadores">Editar</a></li>

        </ul>
    </div>
    <div class="dropdown ">
        <button class="btn btn-secondary dropdown-toggle  w-100 p-3" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
            Departamentos
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

            <li><a class="dropdown-item" href="?main=admin&conteudo=criar_departamento">Criar </a></li>
            <li><a class="dropdown-item" href="?main=admin&conteudo=list_departamento">Editar</a></li>

        </ul>
    </div>

    <button type="button" class="btn  w-100 p-3" onclick="window.location.href='?main=admin&conteudo=processamento'" >Processamento</button>
    <button type="button" class="btn  w-100 p-3"></button>
</div>
<div class="p-2">
    <a href="sair.php" class="mb-5"><i class="fa-solid fa-arrow-right-from-bracket fa-xl" style="color: #262a57;">
            Sair</i></a>
</div>
</div>
</div>


<div class="col-10 h-100">

    <?php
    switch (@$_GET['conteudo']) {
        case 'criar_utilizadores':
            adm_criar_utilizadores();
            if (isset($_POST['criar_perfil'])) {
                criar_perfil($_POST);
            }
            break;
        case 'list_utilizadores':
            $utilizadores = get_adm_ultilizadores();
            if (@$_GET['departamento']) {
                $filtro = $_GET['departamento'];
            } else {
                $filtro = "";
            }
            $page = (@$_GET['page']) ? $_GET['page'] : 1;

            bild_list_utilizador($utilizadores, $filtro, $page);

            if (isset($_POST['apagar_utilizador'])) {
                $id = $_POST['apagar_utilizador'];
                delete_utilizador($id);
            }
            break;
        case 'editar_utilizador':
            $id = $_GET['id'];
            $utilizador = getUtilizador($id);
            build_perfil_adm($utilizador);

            if (isset($_POST['update_user'])) {
                update_perfil_for_adm($_POST, $id);
            }
            break;
        case 'criar_departamento':
            adm_criar_departamento();
            if (isset($_POST['criar_dp']))
            {
                $nome_dp = $_POST['nome_dp'];
                criar_departamento($nome_dp);
            }
            break;
        case 'list_departamento':
            $dep = get_departamentos();
            adm_build_departamentos($dep);
            if (isset($_POST['delete_dp'])) {
                $id = $_POST['delete_dp'];
                delete_departamento($id);
            }
            break;
        case 'edit_departamento':
            if ($_GET['id']) {
                $id = $_GET['id'];
            }
            amd_build_departamentoId($id);

            break;
        case 'processamento':
            if (isset($_POST['pesquisar'])) {
                // Se o formulário foi submetido, chame a função para processar os dados enviados
                // e exibir os resultados.
                amd_build_processamento($_POST);
            } else {
                // Se o formulário ainda não foi submetido, exiba o formulário de pesquisa vazio.
                amd_build_processamento('');
            }
            if (isset($_POST['processar_mes']))
            {
                $id = $_POST['processar_mes'];
                update_mes_processar($id);
            }
        default:
            echo '';
            break;
    }
    ?>
</div>
</div>
</section>

