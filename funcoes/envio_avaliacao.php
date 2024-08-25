<?php require_once('../conexao.php'); 

session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

$param_sql = "SELECT * FROM delega_acoes";
$param_query = mysqli_query($conexao, $param_sql);

while ($param_fetch = mysqli_fetch_assoc($param_query)) {
$ano_vigente = $param_fetch['ano_vigente'];
$id_pergunta1 = $param_fetch['pergunta1'];
$id_pergunta2 = $param_fetch['pergunta2'];
}

$id_login = $_SESSION['id'];
$id_setor = $_SESSION['setor'];
$idavaliado = $_POST['idusuario'];
$idpergunta1 = $_POST['idpergunta1'];
$idpergunta2 = $_POST['idpergunta2'];



$setor = "SELECT * FROM usuario WHERE idusuario = $idavaliado";
$setor_query = mysqli_query($conexao, $setor);
while ($param_fetch = mysqli_fetch_assoc($setor_query)) {
$setoravaliado = $param_fetch['setorid'];
$lideravaliado = $param_fetch['lider'];
}

$lider_sql = "SELECT * FROM usuario WHERE idusuario = $id_login";
$lider_query = mysqli_query($conexao, $lider_sql);
while ($param_fetch = mysqli_fetch_assoc($lider_query)) {
$lidersupervisor = $param_fetch['lider'];
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

 $texto1 = $_POST['texto1'];
 $texto2 = $_POST['texto2'];
 $texto3 = $_POST['texto3'];
 $texto4 = $_POST['texto4'];
 $texto5 = $_POST['texto5'];
 $texto6 = $_POST['texto6'];
 $texto7 = $_POST['texto7'];
 $texto8 = $_POST['texto8'];
 $texto9 = $_POST['texto9'];
 $texto10 =  $_POST['texto10'];

 $nota11 = $_POST['nota11'];
 $nota12 = $_POST['nota12'];
 $nota13 = $_POST['nota13'];
 $nota14 = $_POST['nota14'];
 $nota15 = $_POST['nota15'];
 $nota16 = $_POST['nota16'];
 $nota17 = $_POST['nota17'];
 $nota18 = $_POST['nota18'];
 $nota19 = $_POST['nota19'];
 $nota20 = $_POST['nota20'];

 $texto11 = $_POST['texto11'];
 $texto12 = $_POST['texto12'];
 $texto13 = $_POST['texto13'];
 $texto14 = $_POST['texto14'];
 $texto15 = $_POST['texto15'];
 $texto16 = $_POST['texto16'];
 $texto17 = $_POST['texto17'];
 $texto18 = $_POST['texto18'];
 $texto19 = $_POST['texto19'];
 $texto20 =  $_POST['texto20'];



if ($idpergunta1 == $id_pergunta1) {

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
        '$setoravaliado',
        '$ano_vigente',
        '$lideravaliado',
        '$id_login',
        '$id_setor',
        '$lidersupervisor',
        '$idavaliado',
        '$idpergunta1')

        ";
    mysqli_query($conexao, $comando);

} 

if ($idpergunta2 == $id_pergunta2) {

    $comando = "

    INSERT INTO `avaliacoes` (`id`, `nota1`, `nota2`, `nota3`, `nota4`, `nota5`, `nota6`, `nota7`, `nota8`, `nota9`, `nota10`, `texto1`, `texto2`, `texto3`, `texto4`, `texto5`, `texto6`, `texto7`, `texto8`, `texto9`, `texto10`, `setor`, `data`, `lider`, `idsupervisor`, `setorsupervisor`, `lidersupervisor`, `idusuario`, `idpergunta`) 
    VALUES (
        NULL,
        NULLIF('$nota11', 0),
        NULLIF('$nota12', 0),
        NULLIF('$nota13', 0),
        NULLIF('$nota14', 0),
        NULLIF('$nota15', 0),
        NULLIF('$nota16', 0),
        NULLIF('$nota17', 0),
        NULLIF('$nota18', 0),
        NULLIF('$nota19', 0),
        NULLIF('$nota20', 0),
        NULLIF('$texto11', NULL),
        NULLIF('$texto12', NULL),
        NULLIF('$texto13', NULL),
        NULLIF('$texto14', NULL),
        NULLIF('$texto15', NULL),
        NULLIF('$texto16', NULL),
        NULLIF('$texto17', NULL),
        NULLIF('$texto18', NULL),
        NULLIF('$texto19', NULL),
        NULLIF('$texto20', NULL),
        '$setoravaliado',
        '$ano_vigente',
        '$lideravaliado',
        '$id_login',
        '$id_setor',
        '$lidersupervisor',
        '$idavaliado',
        '$idpergunta2')


        ";
    mysqli_query($conexao, $comando);
} 

if ($lidersupervisor == 2) {
    header('Location: ../pages/dados/interface_avaliacao.php?retorno=9');
} else if ($lidersupervisor == 1) {
    header('Location: ../pages/dados/interface_avaliacao.php?retorno=9');
}
}


