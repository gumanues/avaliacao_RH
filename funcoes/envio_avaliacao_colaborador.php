<?php require_once('../conexao.php'); 

$param_sql = "SELECT * FROM delega_acoes";
$param_query = mysqli_query($conexao, $param_sql);
while ($param_fetch = mysqli_fetch_assoc($param_query)) {
$ano_vigente = $param_fetch['ano_vigente'];
}

echo $idusuario = $_POST['idusuario'];
echo $idpergunta1 = $_POST['idpergunta1'];

$setor = "SELECT * FROM usuario WHERE idusuario = $idusuario";
$setor_query = mysqli_query($conexao, $setor);
while ($param_fetch = mysqli_fetch_assoc($setor_query)) {
$setorid = $param_fetch['setorid'];
$lideravaliado = $param_fetch['lider'];
}

 $nota1 = $_POST['nota1'];
 $nota2 = $_POST['nota2'];
 $nota3 = $_POST['nota3'];
 $nota4 = $_POST['nota4'];
 $nota5 = $_POST['nota5'];
 $nota6 = $_POST['nota6'];
 $nota7 = $_POST['nota7'];
 $nota8 = $_POST['nota8'];
 $nota9 = $_POST['nota9'];
 $nota10 = $_POST['nota10'];


$comando = "
  INSERT INTO `avaliacoes` (`id`, `nota1`, `nota2`, `nota3`, `nota4`, `nota5`, `nota6`, `nota7`, `nota8`, `nota9`, `nota10`, `texto1`, `texto2`, `texto3`, `texto4`, `texto5`, `texto6`, `texto7`, `texto8`, `texto9`, `texto10`, `setor`, `data`, `lider`, `idsupervisor`, `setorsupervisor`, `lidersupervisor`, `idusuario`, `idpergunta`) 
    VALUES (
    NULL,
    NULLIF('$nota1', 0),
    NULLIF('$nota2', 0),
    NULLIF('$nota3', 0),
    NULLIF('$nota4', 0),
    NULLIF('$nota5', 0),
    NULLIF('$nota6', 0),
    NULLIF('$nota7', 0),
    NULLIF('$nota8', 0),
    NULLIF('$nota9', 0),
    NULLIF('$nota10', 0),
    NULLIF('$texto1', NULL),
    NULLIF('$texto2', NULL),
    NULLIF('$texto3', NULL),
    NULLIF('$texto4', NULL),
    NULLIF('$texto5', NULL),
    NULLIF('$texto6', NULL),
    NULLIF('$texto7', NULL),
    NULLIF('$texto8', NULL),
    NULLIF('$texto9', NULL),
    NULLIF('$texto10', NULL),
    '$setorid',
    '$ano_vigente',
    '$lideravaliado',
    '$idusuario',
    '$setorid',
    '$lideravaliado',
    '$idusuario',
    '$idpergunta1')

    ";
mysqli_query($conexao, $comando); 
header('Location: ../index.php?retorno=9');