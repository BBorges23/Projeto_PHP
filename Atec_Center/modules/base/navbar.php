<!-- <style>
    nav {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom ">
    <div class="collapse navbar-collapse d-flex" id="navbarNav">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4  ">
            <ul class="navbar-nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link  fs-5" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5" href="#">Pricing</a>
                </li>
                <li class="nav-item fs-5">
                    <a class="nav-link fs-5" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-4 text-end">
             <?php
          if (@$_SESSION["log_type"] != '') {
            echo '<a href="sair.php" class="pe-5"><i class="fa-solid fa-right-from-bracket fa-2xl" style="color: #23284e;"></i></a>';
          } else {
            echo '<a href="?main=login" class="pe-5"><i class="fa-solid fa-user fa-2xl" style="color: #23284e;"></i></a>';
          }
          ?> 
             
        </div>

    </div>
    </div>
</nav> -->
