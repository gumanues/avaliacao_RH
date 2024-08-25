<?php require_once('../conexao.php'); 

echo $idusuario = $_POST['idusuario'];
echo $cd_verificacao = $_POST['cd_verificacao'];
echo $senha = md5($_POST['senha']);

$param_sql = "SELECT * FROM delega_acoes";
$param_query = mysqli_query($conexao, $param_sql);

while ($param_fetch = mysqli_fetch_assoc($param_query)) {
  $esqueci_senha = $param_fetch['esqueci_senha'];
}



if ($senha != "d41d8cd98f00b204e9800998ecf8427e" && $cd_verificacao == $esqueci_senha) {
    $comando = "UPDATE `usuario` SET `senha` = '$senha' WHERE `usuario`.`idusuario` = $idusuario";
    mysqli_query($conexao, $comando);
    header('Location: ../pages/login.php?retorno=2.2');

} else {

header('Location: ../pages/login.php?retorno=2');

}