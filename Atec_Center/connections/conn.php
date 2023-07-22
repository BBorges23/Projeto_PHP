<?php 

//identificar variaveis utilizadas
$server_name = "localhost:8886"; //Nome do servidor sql 
$user_name = "root"; //Nome usuario para login na db
$password = ""; //Senha para login na db

//criar a ligação a BD
$conn = mysqli_connect($server_name,$user_name,$password);


//Verificar se a ligação foi bem sucessida
if(!$conn)
{
    //Não foi estabelecida a ligação à base de dados
    die("Erro de ligação: ".mysqli_connect_error());
}else
{
    //Foi estabelecida a ligação à base de dados
    mysqli_select_db($conn,"techstack");
    //opcional forçar a tipologia de caracteres
    mysqli_set_charset($conn,"utf8");
}
?>