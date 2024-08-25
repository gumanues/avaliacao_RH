
<?php require_once('../conexao.php'); 

session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

$ano_vigente = $_POST['id_data'];

if ($ano_vigente != Null) {

$comando = "UPDATE `delega_acoes` SET `ano_vigente` = '$ano_vigente' WHERE `delega_acoes`.`id` = 1;";
mysqli_query($conexao, $comando);
header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php?retorno=5');

} else {
header('Location: ../pages/erro.php');
}
}