<?php require_once('../conexao.php'); 

$senha = md5($_POST['senha']);
$idusuario = $_POST['idusuario'];

$sql_acesso = "SELECT * FROM usuario where idusuario = $idusuario";
$acesso = mysqli_query($conexao, $sql_acesso);

$param_sql = "SELECT * FROM delega_acoes";
$param_query = mysqli_query($conexao, $param_sql);

while ($param_fetch = mysqli_fetch_assoc($param_query)) {
$ano_vigente = $param_fetch['ano_vigente'];
}
while ($login = mysqli_fetch_assoc($acesso)) {

$idusuario1 = $login['idusuario'];
$senha1 = $login['senha'];
$setor = $login['setorid'];
$lider = $login['lider'];

}

if ($idusuario == $idusuario1 and $senha == $senha1 and $lider == 2) {

    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['id'] = $idusuario;
    $_SESSION['ano_vigente'] = $ano_vigente;
    $_SESSION['setor'] = $setor;

	header('Location: ../pages/avaliacoes/avaliacoes_gerencia.php');

}

else if ($idusuario == $idusuario1 and $senha == $senha1 and $lider == 1) {

    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['id'] = $idusuario;
    $_SESSION['ano_vigente'] = $ano_vigente;
    $_SESSION['setor'] = $setor;
	header('Location: ../pages/avaliacoes/avaliacoes_coordenador.php');	
    
}  
else { 
    header('Location: ../pages/login.php?retorno=erro');	
}
