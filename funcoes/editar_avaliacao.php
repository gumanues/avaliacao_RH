<?php
require_once('../conexao.php');
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

$id_login = $_SESSION['id'];
$ano_vigente = $_SESSION['ano_vigente'];
$id_pergunta = $_POST['id_pergunta'];
$id_avaliacao = $_POST['id_avaliacao'];
$idusuario = $_POST['idusuario'];

$delega_sql = "SELECT * FROM delega_acoes";
$delega_query = mysqli_query($conexao, $delega_sql);

while ($delega_acoes = mysqli_fetch_assoc($delega_query)) {

$delega_tipo = $delega_acoes['retorno_pagina'];
$delega_tipo_array = explode(",", $delega_tipo);

}


$sql_col1= "SELECT (
    IF(a.pergunta1 <> '', 1, 0) +
    IF(a.pergunta2 <> '', 1, 0) +
    IF(a.pergunta3 <> '', 1, 0) +
    IF(a.pergunta4 <> '', 1, 0) +
    IF(a.pergunta5 <> '', 1, 0) +
    IF(a.pergunta6 <> '', 1, 0) +
    IF(a.pergunta7 <> '', 1, 0) +
    IF(a.pergunta8 <> '', 1, 0) +
    IF(a.pergunta9 <> '', 1, 0) +
    IF(a.pergunta10 <> '', 1, 0)
  ) qt_col
  FROM pergunta a
  WHERE a.id = $id_pergunta
  LIMIT 1
  ";
      
  $col_query1 = mysqli_query($conexao, $sql_col1);
  while ($fetch_col1 = mysqli_fetch_assoc($col_query1)) {
  
  $quantidade1 = $fetch_col1['qt_col']; 
  
  }




    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];
    $nota4 = $_POST['nota4'];
    $nota5 = ($quantidade1 >= 5 && $quantidade1 <= 10) ? $_POST['nota5'] : $_POST['nota5'];
    $nota6 = ($quantidade1 >= 6 && $quantidade1 <= 10) ? $_POST['nota6'] : $_POST['nota6'];
    $nota7 = ($quantidade1 >= 7 && $quantidade1 <= 10) ? $_POST['nota7'] : $_POST['nota7'];
    $nota8 = ($quantidade1 >= 8 && $quantidade1 <= 10) ? $_POST['nota8'] : $_POST['nota8'];
    $nota9 = ($quantidade1 >= 9 && $quantidade1 <= 10) ? $_POST['nota9'] : $_POST['nota9'];
    $nota10 = ($quantidade1 >= 10 && $quantidade1 <= 10) ? $_POST['nota10'] : $_POST['nota10'];

    $texto1 = $_POST['texto1'];
    $texto2 = $_POST['texto2'];
    $texto3 = $_POST['texto3'];
    $texto4 = $_POST['texto4'];
    $texto5 = ($quantidade1 >= 5 && $quantidade1 <= 10) ? $_POST['texto5'] : $_POST['texto5'];
    $texto6 = ($quantidade1 >= 6 && $quantidade1 <= 10) ? $_POST['texto6'] : $_POST['texto6'];
    $texto7 = ($quantidade1 >= 7 && $quantidade1 <= 10) ? $_POST['texto7'] : $_POST['texto7'];
    $texto8 = ($quantidade1 >= 8 && $quantidade1 <= 10) ? $_POST['texto8'] : $_POST['texto8'];
    $texto9 = ($quantidade1 >= 9 && $quantidade1 <= 10) ? $_POST['texto9'] : $_POST['texto9'];
    $texto10 = ($quantidade1 >= 10 && $quantidade1 <= 10) ? $_POST['texto10'] : $_POST['texto10'];
   
    if ($id_pergunta <> 0) {

      $update_nota = "UPDATE `avaliacoes` SET 
      `nota1` = NULLIF('$nota1', 0), 
      `nota2` = NULLIF('$nota2', 0), 
      `nota3` = NULLIF('$nota3', 0),
      `nota4` = NULLIF('$nota4', 0),
      `nota5` = NULLIF('$nota5', 0), 
      `nota6` = NULLIF('$nota6', 0), 
      `nota7` = NULLIF('$nota7', 0), 
      `nota8` = NULLIF('$nota8', 0), 
      `nota9` = NULLIF('$nota9', 0), 
      `nota10` = NULLIF('$nota10', 0), 
      `texto1` = NULLIF('$texto1', NULL), 
      `texto2` = NULLIF('$texto2', NULL), 
      `texto3` = NULLIF('$texto3', NULL), 
      `texto4` = NULLIF('$texto4', NULL), 
      `texto5` = NULLIF('$texto5', NULL), 
      `texto6` = NULLIF('$texto6', NULL), 
      `texto7` = NULLIF('$texto7', NULL), 
      `texto8` = NULLIF('$texto8', NULL), 
      `texto9` = NULLIF('$texto9', NULL), 
      `texto10` = NULLIF('$texto10', NULL) 
       WHERE `avaliacoes`.`id` = '$id_avaliacao'";
  mysqli_query($conexao, $update_nota);
  
    }
  

  if (in_array($id_login,$delega_tipo_array)) {
  header("Location: ../pages/estatisticas/avaliacoes_usuarios.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");
  } else {header("Location: ../pages/estatisticas/avaliacoes_usuarios_coordenadores.php?id_tipo=null&idusuario=$idusuario&id_data=$ano_vigente");}

}
  
 




