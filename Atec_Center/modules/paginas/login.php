<style>
    .btn-color {
        background-color: #0e1c36;
        color: #fff;

    }

    .profile-image-pic {
        height: 200px;
        width: 200px;
        object-fit: cover;
    }



    .cardbody-color {
        background-color: #ebf2fa;
    }

    a {
        text-decoration: none;
    }
</style>
<section>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">Login</h2>
            <div class="card my-5">
                <form class="card-body cardbody-color p-lg-5 " method="post">
                    <div class="text-center">
                        <img src="imgs/user.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                            width="200px" alt="profile">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="Username" aria-describedby="emailHelp"
                            placeholder="Nome ou email" name="log_email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" placeholder="senha" name="log_senha"
                            required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-color px-5 mb-5 w-100" name="bt_login">Login</button>
                    </div>
                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">Não registrado? <a href="#"
                            class="text-dark fw-bold"> Crie a sua conta aqui</a>
                    </div>
                </form>
                <?php

                if (isset($_POST["bt_login"])) {
                    $id_user = validar_login($_POST["log_email"], $_POST["log_senha"]);
                    $_SESSION['id_user'] = $id_user;
                }

                ?>
            </div>
        </div>
    </div>

</section>