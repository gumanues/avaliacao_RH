<?php require_once('../conexao.php'); 


session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

if (isset($_POST['flexRadioDefault'])) {
    $flexRadioDefault = $_POST['flexRadioDefault'];
} else {
    header("Location: ../pages/parametros.php?retorno=1.1");
    exit();
}
if (isset($_POST['usu_parametro'])) {
    $valores_selecionados = implode(',', $_POST['usu_parametro']);
} else {
    header("Location: ../pages/parametros.php?retorno=1.1");
    exit(); 
}


$codigo = $_POST['codigo'];
$pergunta1 = $_POST['pergunta1'];
$pergunta2 = $_POST['pergunta2'];



if ($flexRadioDefault == 1) {

    $comando = "UPDATE `delega_acoes` SET `gerente` = '$valores_selecionados' WHERE `delega_acoes`.`id` = 1;";
    mysqli_query($conexao, $comando);
    header("Location: ../pages/parametros.php?retorno=1");
  
}

if ($flexRadioDefault == 2) {

    $comando = "UPDATE `delega_acoes` SET `concede_usuario` = '$valores_selecionados' WHERE `delega_acoes`.`id` = 1;";
    mysqli_query($conexao, $comando);
    header("Location: ../pages/parametros.php?retorno=1");
  
}

if ($flexRadioDefault == 3) {

    $comando = "UPDATE `delega_acoes` SET `esqueci_senha` = '$codigo' WHERE `delega_acoes`.`id` = 1;";
    mysqli_query($conexao, $comando);
    header("Location: ../pages/parametros.php?retorno=1");
  
}


if ($flexRadioDefault == 4) {

    $comando = "UPDATE `delega_acoes` SET `terceiro` = '$valores_selecionados' WHERE `delega_acoes`.`id` = 1;";
    mysqli_query($conexao, $comando);
    header("Location: ../pages/parametros.php?retorno=1");
  
}

if ($flexRadioDefault == 5) {

    $comando = "UPDATE `delega_acoes` SET `enfermagem` = '$valores_selecionados' WHERE `delega_acoes`.`id` = 1;";
    mysqli_query($conexao, $comando);
    header("Location: ../pages/parametros.php?retorno=1");
  
}

if ($flexRadioDefault == 6) {

    $comando = "UPDATE `delega_acoes` SET `retorno_pagina` = '$valores_selecionados' WHERE `delega_acoes`.`id` = 1;";
    mysqli_query($conexao, $comando);
    header("Location: ../pages/parametros.php?retorno=1");
  
}
if ($flexRadioDefault == 7) {

    $comando = "UPDATE `delega_acoes` SET `pergunta1` = '$pergunta1' WHERE `delega_acoes`.`id` = 1;";
    mysqli_query($conexao, $comando);
    header("Location: ../pages/parametros.php?retorno=1");
  
}
if ($flexRadioDefault == 8) {

    $comando = "UPDATE `delega_acoes` SET `pergunta2` = '$pergunta2' WHERE `delega_acoes`.`id` = 1;";
    mysqli_query($conexao, $comando);
    header("Location: ../pages/parametros.php?retorno=1");
  
}

}


