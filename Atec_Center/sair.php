<?php 

   //habilitar a sessao que está em curso (vamos buscar os dados do browser)
   session_start();
   //destruimos esses mesmos dados (qualquer variável de sessão e a sessão em si)
   session_destroy();
   //recarregamos a página
   echo '<meta http-equiv="refresh" content="0;url=index.php">';

?>