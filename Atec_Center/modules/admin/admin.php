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
$id = $_SESSION['id_user'];
$info_utilizador = getUltilizador($id);
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
  <button class="btn btn-secondary dropdown-toggle  w-100 p-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  Utilizadores
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    
    <li><a class="dropdown-item" href="?main=admin&conteudo=criar_utilizadores">Criar </a></li>
    <li><a class="dropdown-item" href="?main=admin&conteudo=list_utilizadores">Editar</a></li>

  </ul>
</div>
    <button type="button" class="btn  w-100 p-3" >Utilizadores</button> 
    <button type="button" class="btn  w-100 p-3" >Departamentos</button>
    <button type="button" class="btn  w-100 p-3">Processamento</button>
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
                //echo $_POST['salario'];
                criar_perfil($_POST);
            }                
            break;
        case 'list_utilizadores':
            $ultilizadores = get_adm_ultilizadores();
            //print_r($ultilizadores);
            bild_list_utilizador($ultilizadores);    
            break;
        case 'editar_ultilizador':
            $id = $_GET['id'];
            $ultilizador = getUltilizador($id);
            build_perfil_adm($ultilizador);
            if (isset($_POST['update_user'])) {
                update_perfil_for_adm($_POST);
            }

            break;
        case 'salarios':

            break;
        case 'info_salario':

            break;
        default:
            echo '';
            break;
    }
    ?>
</div>
</div>
</section>

