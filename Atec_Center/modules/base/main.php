
<body class="d-flex flex-column h-75">
<main>
    <?php

    @$main = $_REQUEST['main'];

    if (@$_SESSION["log_type"] =='') {
        include 'modules/paginas/login.php';
    }
    if (@$_SESSION['log_type'] != '')
    {
        switch ($main) {
            case 'login':
                include 'modules/paginas/login.php';
                break;
            case 'utilizador':
                if (@$_SESSION["log_type"] == 0 ) {
                    include 'modules/paginas/utilizador.php';
                }
                break;
            case 'admin':
                if (@$_SESSION["log_type"] == 1 ) {
                    include 'modules/admin/admin.php';
                }

                break;
            default:

                break;


        }
    }


    ?>
</main>
