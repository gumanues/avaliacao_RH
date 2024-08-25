<?php require_once('../conexao.php'); 

session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

$pergunta1 = $_POST['pergunta1'];
$pergunta2 = $_POST['pergunta2'];
$pergunta3 = $_POST['pergunta3'];
$pergunta4 = $_POST['pergunta4'];
$pergunta5 = $_POST['pergunta5'];
$pergunta6 = $_POST['pergunta6'];
$pergunta7 = $_POST['pergunta7'];
$pergunta8 = $_POST['pergunta8'];
$pergunta9 = $_POST['pergunta9'];
$pergunta10 = $_POST['pergunta10'];


if ($pergunta1 != null) { 
    $comando = "INSERT INTO `pergunta` (`id`, `pergunta1`, `pergunta2`, `pergunta3`, `pergunta4`, `pergunta5`, `pergunta6`, `pergunta7`, `pergunta8`, `pergunta9`, `pergunta10`) VALUES (NULL, '$pergunta1', '$pergunta2', '$pergunta3', '$pergunta4', '$pergunta5', '$pergunta6', '$pergunta7', '$pergunta8', '$pergunta9', '$pergunta10')";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=5');

} else {
    header('Location: ../pages/erro.php');
}
}