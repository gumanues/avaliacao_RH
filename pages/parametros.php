<?php require_once('../conexao.php'); 

session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
  $data_today = date("Y");

  $id_login = $_SESSION['id'];

  $usu_login_sql = "SELECT * FROM usuario where idusuario = $id_login";
  $usu_login_query = mysqli_query($conexao, $usu_login_sql);
  
  while ($usu_login_fetch = mysqli_fetch_assoc($usu_login_query)) {
  
  $usu_login = $usu_login_fetch['nomecompleto'];
  
  }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../css/style_login.css">
  <title>Formulário de Desempenho</title>
  <style>
  .navbar {
    position: relative;
    z-index: 2; /* Coloca a navbar acima de outros elementos */
  }

  .vertical-line {
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    border-left: 1px solid #ccc; /* Cor cinza mais clarinho */
    content: "";
    z-index: 1; /* Coloca a linha abaixo da navbar */
  }
</style>
<link rel="icon" type="image/x-icon" href="../img/pag.ico">
</head>

<body>

  <div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
      <a class="navbar-brand" href="avaliacoes/avaliacoes_gerencia.php">Início</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="sair.php">Sair</a>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav text-end">
                <li class="nav-item">
                  <a class="nav-link">Login: <?=$usu_login?></a>
                </li>
              </ul>
      </div>
    </nav>
  </div>


      <!-- Erros -->

  <div id="alertas">
        <?php if(isset($_GET['retorno'])==true && $_GET['retorno']==1){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span>Parâmetro Salvo!</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

  <!-- Envios -->

        <?php } if(isset($_GET['retorno'])==true && $_GET['retorno']==1.1){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span>Houve um problema! Talvez não foi selecionado usuário.</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php } ?>
  </div>

  <p class="text-center pt-2">Atenção, para alterar estes parâmetros você precisa selecionar os usuários que já estão no parâmetro e acrescentar ou remover os que deseja editar.</p>



  <div class="vertical-line"></div>



  <div class="container text-center">
  <form action="/funcoes/parametros.php" method="post">
  <div class="row">
    <div class="col pt-5">

<p class="fs-5"> Selecione os Usuários para aplicação no parâmetro </p>


<?php



    $usu_sql = "SELECT * FROM usuario where lider in(1,2)";
    $usu_query = mysqli_query($conexao, $usu_sql);
    
    while ($usu_fetch = mysqli_fetch_assoc($usu_query)) {
        $usu_edt = $usu_fetch['nomecompleto'];
        $id_edt = $usu_fetch['idusuario'];


    $usuarios = [['id' => $id_edt, 'nome' => $usu_edt]];



    foreach ($usuarios as $usuario) {
        echo '<input type="checkbox" name="usu_parametro[]" value="' . $usuario['id'] . '"> ' . $usuario['nome'] . '<br>';
    }
   
}?>
    </div>
    <div class="col pt-5">
    <p class="fs-5"> Selecione o parâmetro a editar </p>

<?php

$param_sql = "SELECT * FROM delega_acoes";
$param_query = mysqli_query($conexao, $param_sql);

while ($param_fetch = mysqli_fetch_assoc($param_query)) {

    $pergunta1 = $param_fetch['pergunta1'];
    $pergunta2 = $param_fetch['pergunta2'];

    $ds_gerente = $param_fetch['ds_gerente'];
    $gerente = $param_fetch['gerente'];

    $ds_concede = $param_fetch['ds_concede'];
    $concede_usuario = $param_fetch['concede_usuario'];

    $ds_esqueci_senha = $param_fetch['ds_esqueci_senha'];
    $esqueci_senha = $param_fetch['esqueci_senha'];

    $ds_terceiro = $param_fetch['ds_terceiro'];
    $terceiro = $param_fetch['terceiro'];

    $ds_enfermagem = $param_fetch['ds_enfermagem'];
    $enfermagem = $param_fetch['enfermagem'];

    $ds_retorno_pagina = $param_fetch['ds_retorno_pagina'];
    $retorno_pagina = $param_fetch['retorno_pagina'];



}



//-------------------- Pergunta 1

$param_sql = "SELECT * FROM pergunta where id = $pergunta1";
$param_query = mysqli_query($conexao, $param_sql);

while ($param_fetch = mysqli_fetch_assoc($param_query)) {
  $ds_pergunta1 = $param_fetch['pergunta1'];
  $pergunta1 = $param_fetch['id'];
}

       echo "<div class='form-check'><input class='form-check-input' type='radio' value='7' name='flexRadioDefault' id='flexRadioDefault7'>
             <label class='form-check-label ms-3' for='flexRadioDefault7'>Pergunta Padrão 1: <br> $pergunta1 - $ds_pergunta1. <br> Aplicado aos Colaboradores. Selecione Acesso TI e <br> Selecione qual deseja aplicar:</label></div>";
?>              <div class="d-flex justify-content-evenly" ><select class="form-select w-25" name="pergunta1" id="pergunta1">
                <option value=''>Selecione</option>
                <?php
                $sql_perguntas = "SELECT * FROM pergunta order by id desc";
                $id_perguntas = mysqli_query($conexao, $sql_perguntas);

                while ($perguntas = mysqli_fetch_assoc($id_perguntas)) {

                $idpergunta = $perguntas['id'];
                $pergunta1 = $perguntas['pergunta1'];
                echo "<option value='$idpergunta'>$idpergunta - $pergunta1</option>";

              }
              
?>
              </select></div><hr>
<?php
//-------------------- Pergunta 1

//-------------------- Pergunta 2

$param_sql = "SELECT * FROM pergunta where id = $pergunta2";
$param_query = mysqli_query($conexao, $param_sql);

while ($param_fetch = mysqli_fetch_assoc($param_query)) {
  $ds_pergunta2 = $param_fetch['pergunta1'];
  $pergunta2 = $param_fetch['id'];
}


       echo "<div class='form-check'><input class='form-check-input' type='radio' value='8' name='flexRadioDefault' id='flexRadioDefault8'>
             <label class='form-check-label ms-3' for='flexRadioDefault8'>Pergunta Padrão 2: <br> $pergunta2 - $ds_pergunta2. <br> Aplicado aos Coordenadores e LíderesSelecione Acesso TI e <br> Selecione qual deseja aplicar:</label></div>";
?>              <div class="d-flex justify-content-evenly" ><select class="form-select w-25" name="pergunta2" id="pergunta2">
                <option value=''>Selecione</option>
                <?php
                $sql_perguntas = "SELECT * FROM pergunta order by id desc";
                $id_perguntas = mysqli_query($conexao, $sql_perguntas);

                while ($perguntas = mysqli_fetch_assoc($id_perguntas)) {

                $idpergunta = $perguntas['id'];
                $pergunta1 = $perguntas['pergunta1'];
                echo "<option value='$idpergunta'>$idpergunta - $pergunta1</option>";

              }
              
?>
              </select></div><hr>
<?php
//-------------------- Pergunta 2

//-------------------- Usuário Gerência

$usu_sql = "SELECT * FROM usuario where idusuario in($gerente)";
$usu_query = mysqli_query($conexao, $usu_sql);

$nomes_completos = array();

while ($usu_fetch = mysqli_fetch_assoc($usu_query)) {
    $usu_edt = $usu_fetch['nomecompleto'];
    $nomes_completos[] = $usu_edt;
} 
$nomes_concatenados = implode(', ', $nomes_completos); 




       echo "<div class='form-check'><input class='form-check-input' type='radio' value='1' name='flexRadioDefault' id='flexRadioDefault1'>
             <label class='form-check-label ms-3' for='flexRadioDefault1'>Parâmetro 1: $ds_gerente. <br> Aplicado em: $nomes_concatenados</label></div><hr>";
//-------------------- Usuário Gerência

//-------------------- Concede Permissão de Avaliação de usuários Com Acesso Gerência (Apenas para RH) .

$usu_sql = "SELECT * FROM usuario where idusuario in($concede_usuario)";
$usu_query = mysqli_query($conexao, $usu_sql);

$nomes_completos = array();

while ($usu_fetch = mysqli_fetch_assoc($usu_query)) {
    $usu_edt = $usu_fetch['nomecompleto'];
    $nomes_completos[] = $usu_edt;
} 
$nomes_concatenados = implode(', ', $nomes_completos); 




       echo "<div class='form-check'><input class='form-check-input' type='radio' value='2' name='flexRadioDefault' id='flexRadioDefault2'>
             <label class='form-check-label ms-3' for='flexRadioDefault2'>Parâmetro 2: $ds_concede. <br> Aplicado em: $nomes_concatenados</label></div><hr>";
//-------------------- Concede Permissão de Avaliação de usuários Com Acesso Gerência (Apenas para RH) .

//-------------------- Código para resetar a senha dos usuários

$usu_sql = "SELECT * FROM usuario where idusuario in($esqueci_senha)";
$usu_query = mysqli_query($conexao, $usu_sql);

$nomes_completos = array();

while ($usu_fetch = mysqli_fetch_assoc($usu_query)) {
    $usu_edt = $usu_fetch['nomecompleto'];
    $nomes_completos[] = $usu_edt;
} 
$nomes_concatenados = implode(', ', $nomes_completos); 




       echo "<div class='form-check'>
       <input class='form-check-input' type='radio' value='3' name='flexRadioDefault' id='flexRadioDefault3'>
       <label class='form-check-label ms-3' for='flexRadioDefault3'>Parâmetro 3: $ds_esqueci_senha. <br> </label></div>Clique em Acesso TI e Digite a senha: <input type='number' name='codigo' value='$esqueci_senha'><hr>";
//-------------------- Código para resetar a senha dos usuários
 
//-------------------- Remove Auto-Avaliação de Coordenadores Terceiros.

$usu_sql = "SELECT * FROM usuario where idusuario in($terceiro)";
$usu_query = mysqli_query($conexao, $usu_sql);

$nomes_completos = array();

while ($usu_fetch = mysqli_fetch_assoc($usu_query)) {
    $usu_edt = $usu_fetch['nomecompleto'];
    $nomes_completos[] = $usu_edt;
} 
$nomes_concatenados = implode(', ', $nomes_completos); 




       echo "<div class='form-check'><input class='form-check-input' type='radio' value='4' name='flexRadioDefault' id='flexRadioDefault4'>
             <label class='form-check-label ms-3' for='flexRadioDefault4'>Parâmetro 4: $ds_terceiro. <br> Aplicado em: $nomes_concatenados</label></div><hr>";
//-------------------- Remove Auto-Avaliação de Coordenadores Terceiros.

//-------------------- Enfermeira chefe avalia enfermeira coordenadora

$usu_sql = "SELECT * FROM usuario where idusuario in($enfermagem)";
$usu_query = mysqli_query($conexao, $usu_sql);

$nomes_completos = array();

while ($usu_fetch = mysqli_fetch_assoc($usu_query)) {
    $usu_edt = $usu_fetch['nomecompleto'];
    $nomes_completos[] = $usu_edt;
} 
$nomes_concatenados = implode(', ', $nomes_completos); 




       echo "<div class='form-check'><input class='form-check-input' type='radio' value='5' name='flexRadioDefault' id='flexRadioDefault5'>
             <label class='form-check-label ms-3' for='flexRadioDefault5'>Parâmetro 5: $ds_enfermagem. <br> Aplicado em: $nomes_concatenados</label></div><hr>";
//-------------------- Enfermeira chefe avalia enfermeira coordenadora


//-------------------- Retorno a pagina Gerência

$usu_sql = "SELECT * FROM usuario where idusuario in($retorno_pagina)";
$usu_query = mysqli_query($conexao, $usu_sql);

$nomes_completos = array();

while ($usu_fetch = mysqli_fetch_assoc($usu_query)) {
    $usu_edt = $usu_fetch['nomecompleto'];
    $nomes_completos[] = $usu_edt;
} 
$nomes_concatenados = implode(', ', $nomes_completos); 




       echo "<div class='form-check'><input class='form-check-input' type='radio' value='6' name='flexRadioDefault' id='flexRadioDefault6'>
             <label class='form-check-label ms-3' for='flexRadioDefault6'>Parâmetro 6: $ds_retorno_pagina. <br> Aplicado em: $nomes_concatenados</label></div><hr>";
//-------------------- Retorno a pagina Gerência





?>

   
    </div>

</div>
<hr>
<div class="d-grid gap-2 mt-3">
        <button class="btn btn-secondary" type="submit">Enviar</button>
</div>
<hr>
</form>
</div>







</body>



<?php } else {
  header('Location: login.php');
} ?>