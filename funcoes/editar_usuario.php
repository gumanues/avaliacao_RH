<?php require_once('../conexao.php'); 

session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

$idusuario = $_POST['idusuario'];
$nomecompleto = $_POST['nomecompleto']; 
$cargo = $_POST['cargo'];
$setor = $_POST['setor'];
$senha = md5($_POST['senha']);
$avaliador = $_POST['avaliador'];
$emancipado = $_POST['emancipado']; 
$acesso = $_POST['acesso'];
$situacao = $_POST['situacao'];




 if ($nomecompleto != null) { 
    $comando = "UPDATE `usuario` SET `nomecompleto` = '$nomecompleto' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=2.2');

}
if ($cargo != null) {
    $comando = "UPDATE `usuario` SET `cargo` = '$cargo' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=2.2');

}
if ($setor != "") {
    $comando = "UPDATE `usuario` SET `setorid` = '$setor' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=2.2');

}
if ($senha != "d41d8cd98f00b204e9800998ecf8427e") {
    $comando = "UPDATE `usuario` SET `senha` = '$senha' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=2.2');

}
if ($acesso != 'N') {
    $comando = "UPDATE `usuario` SET `lider` = '$acesso' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=2.2');
}

if ($situacao != 'N') {
    $comando = "UPDATE `usuario` SET `situacao` = '$situacao' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=2.2');

} 

if ($situacao != 'N') {
    $comando = "UPDATE `usuario` SET `situacao` = '$situacao' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=2.2');

} 

if ($emancipado != 'N') {
    $comando = "UPDATE `usuario` SET `emancipado` = '$emancipado' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=2.2');

} 

if ($avaliador != 'N') {
    $comando = "UPDATE `usuario` SET `avaliador` = '$avaliador' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=2.2');

} 



}

