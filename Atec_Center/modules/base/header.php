<!-- Elementos CSS -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Caprasimo&family=Press+Start+2P&display=swap');

    header {
        background-image: url('imgs/header.jpg');
        display: flex;
        align-items: center;
        height: 20vh;
    }
    body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
</style>

<!-- Criando header -->
<header>
    <div class="row ms-5 ">
        <div class="header-content ">
            <h2><a <?php  
            if (@$_SESSION["log_type"] == 0) {
               echo 'href="index.php?main=utilizador"style="text-decoration: none;color: white;">TechStack</a></h2>';
            }else if (@$_SESSION["log_type"] == 1) {
                echo 'href="index.php?main=admin"style="text-decoration: none;color: white;">TechStack</a></h2>';
            }else if (@$_SESSION["log_type"] == '') {
                echo 'href="index.php"style="text-decoration: none;color: white;">TechStack</a></h2>';
               
                //echo 'style="text-decoration: none;color: white;">TechStack</a></h2>';
            }
            echo @$_SESSION["log_type"] == 0;
            ?>
             
        </div>
    </div>
</header>