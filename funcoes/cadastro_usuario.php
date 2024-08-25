<?php
require_once('../conexao.php');

session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

function escape($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

$nomecompleto = $_POST['nomecompleto'];
$cargo = $_POST['cargo'];
$setor = $_POST['setor'];
$senha = md5($_POST['senha']);
$avaliador = $_POST['avaliador'];
$emancipado = $_POST['emancipado'];
$acesso = $_POST['acesso'];


if ($nomecompleto != "") {

    $comando = "INSERT INTO `usuario` (`idusuario`, `nomecompleto`, `situacao`, `cargo`, `senha`, `lider`, `avaliador`, `emancipado`, `setorid`) VALUES (NULL, '$nomecompleto', '1', '$cargo', '$senha', '$acesso', '$avaliador', '$emancipado', '$setor')";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=1.1');
  
} else {
   header('Location: ../pages/erro.php');
}

}