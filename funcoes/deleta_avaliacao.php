<?php require_once('../conexao.php'); 

session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

$id_login = $_SESSION['id'];  
$ano_vigente = $_SESSION['ano_vigente'];
$id_avaliacao = $_POST['id_avaliacao'];
$id_pergunta = $_POST['id_pergunta'];
$idusuario = $_POST['idusuario'];
$lidersupervisor = $_POST['lidersupervisor'];
$lider = $_POST['lider'];

$delega_sql = "SELECT * FROM delega_acoes";
$delega_query = mysqli_query($conexao, $delega_sql);

while ($delega_acoes = mysqli_fetch_assoc($delega_query)) {

$delega_tipo = $delega_acoes['retorno_pagina'];
$delega_tipo_array = explode(",", $delega_tipo);

}

 

$avaliacoes_sql = "SELECT * FROM avaliacoes where idusuario = $idusuario and lidersupervisor = 2";
$avaliacoes_query = mysqli_query($conexao, $avaliacoes_sql);

while ($avaliacoes_acoes = mysqli_fetch_assoc($avaliacoes_query)) {

   
$idusuario_avaliacoes = $avaliacoes_acoes['idusuario'];
    

}

$avaliacoes_sql = "SELECT * FROM avaliacoes where idusuario = $idusuario and lidersupervisor = 1 and lider = 1";
$avaliacoes_query = mysqli_query($conexao, $avaliacoes_sql);

while ($avaliacoes_acoes = mysqli_fetch_assoc($avaliacoes_query)) {

   
$idusuario_avaliacoes2 = $avaliacoes_acoes['idusuario'];
    

}


if ($lidersupervisor == 1 && $lider == 0) {

   $comando = "DELETE FROM avaliacoes WHERE `avaliacoes`.`id` = $id_avaliacao";
   mysqli_query($conexao, $comando);

   if (in_array($id_login,$delega_tipo_array)) {
    header("Location: ../pages/estatisticas/avaliacoes_usuarios.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");
    } else {header("Location: ../pages/estatisticas/avaliacoes_usuarios_coordenadores.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");}
  
}

if ($lidersupervisor == 0 && $lider == 0) {

   $comando = "DELETE FROM avaliacoes WHERE `avaliacoes`.`id` = $id_avaliacao";
   mysqli_query($conexao, $comando);

   if (in_array($id_login,$delega_tipo_array)) {
    header("Location: ../pages/estatisticas/avaliacoes_usuarios.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");
    } else {header("Location: ../pages/estatisticas/avaliacoes_usuarios_coordenadores.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");}
  
}
  
if ($lider == 1 && $lidersupervisor == 1) {
   
    $comando = "DELETE FROM avaliacoes WHERE `avaliacoes`.`idusuario` = $idusuario_avaliacoes2 and `avaliacoes`.`lidersupervisor` = 1 and `avaliacoes`.`lider` = 1";
    mysqli_query($conexao, $comando);

    if (in_array($id_login,$delega_tipo_array)) {
        header("Location: ../pages/estatisticas/avaliacoes_usuarios.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");
        } else {header("Location: ../pages/estatisticas/avaliacoes_usuarios_coordenadores.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");}
      
}

if ($lidersupervisor == 2) {
   
    $comando = "DELETE FROM avaliacoes WHERE `avaliacoes`.`idusuario` = $idusuario_avaliacoes and `avaliacoes`.`lidersupervisor` = 2";
    mysqli_query($conexao, $comando);

    if (in_array($id_login,$delega_tipo_array)) {
        header("Location: ../pages/estatisticas/avaliacoes_usuarios.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");
        } else {header("Location: ../pages/estatisticas/avaliacoes_usuarios_coordenadores.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");}
      
}



}