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
                    <h2><a href="?main=utilizador&conteudo=perfil" > ' . $info_utilizador['nome'] . '</a> </h2>';

?>
</div>
<div class="text-center d-flex flex-column h-100  gap-5 mb-5 ">

<div class="dropdown ">
  <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  Salários
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <?php 
    $array_anos = get_anos_processado($_SESSION['id_user']);
    foreach ($array_anos as $anos) {
        echo '<li><a class="dropdown-item" href="?main=utilizador&conteudo=salarios&ano='. $anos .'">'. $anos .'</a></li>';
    }
    ?>
  </ul>
</div>
    <!-- <button type="button" class="btn  w-100 p-3"  onclick="window.location.href='?main=utilizador&conteudo=salarios'">Salários</button> -->
    <button type="button" class="btn  w-100 p-3" ></button>
    <button type="button" class="btn  w-100 p-3"></button>
    <button type="button" class="btn  w-100 p-3"></a></button>
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
        case 'perfil':
            build_perfil_utilizador($info_utilizador);
            if (isset($_POST['update_perfil'])) {
                update_perfil_utilizador($_POST,$_SESSION['id_user']);
            }
            
            break;
        case 'salarios':

            $id_utilizador = $_SESSION['id_user']; // ID do utilizador desejado
            $ano= $_GET['ano'];
            criarTabelaMesesProcessados($id_utilizador, $ano);
            break;
        case 'info_salario':
            $salario = $_GET['salario'];
            criar_info_salario($salario);
            break;
        default:
            echo '';
            break;
    }
    ?>
</div>
</div>
</section>

