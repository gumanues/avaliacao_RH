<?php require_once('../../conexao.php');

session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

  $param_sql = "SELECT * FROM delega_acoes";
  $param_query = mysqli_query($conexao, $param_sql);
  
  while ($param_fetch = mysqli_fetch_assoc($param_query)) {
    $ano_vigente = $param_fetch['ano_vigente'];
    $concede_usuario = $param_fetch['concede_usuario'];
    $gerente = $param_fetch['gerente'];
  }
  

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
    <link rel="stylesheet" type="text/css" href="../../css/style_login.css">
  <title>Formulário de Desempenho</title>
  <link rel="icon" type="image/x-icon" href="../../img/pag.ico">
</head>

<body>

  <div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="../avaliacoes/avaliacoes_gerencia.php">Início</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="../sair.php">Sair</a>
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

  <div class="d-flex justify-content-center pt-2">
    <a href="avaliacoes.php?id_data=6&id_data=null" class="btn btn-secondary btn-lg m-2">Avaliação Geral</a>
    <a href="avaliacoes_setores.php?id_data=6&id_data=null" class="btn btn-secondary btn-lg m-2">Avaliação Por Setor</a>
    <a href="avaliacoes_usuarios.php?id_tipo=null&idusuario=null&id_data=null" class="btn btn-secondary btn-lg m-2">Editor e Avaliação Por Usuário</a>
   <a href="avaliacoes_lideres.php?idusuario=null&id_data=null" class="btn btn-secondary btn-lg m-2">Avaliação Por Liderança</a>
    <a href="avaliacoes_nao_realizadas.php?id_data=6&id_data=null&modo=null" class="btn btn-outline-secondary btn-lg m-2">Usuários Pendentes</a>
  </div>


  <div>
    <label class="fw-bold fs-3 d-flex justify-content-center py-3">Usuários Pendentes de Avaliação</label>
  </div>

  <div class="container py-2">
    <form action="avaliacoes_nao_realizadas.php" method="GET">
    <div>
    <input name="id_data" value="6" type="hidden" id="id_data" checked require>
    </div>
      <div class="mb-3">

      <label for="modo" class="form-label pt-3">Modo:</label>
        <select class="form-select" name="modo" id="modo" required>
        <option value='1' hidden>Avaliações Pendentes</option>
        <option value='1'>Avaliações Pendentes</option>
        <option value='2'>Avaliações Já Realizadas</option>
        </select>


        <label for="id_data" class="form-label pt-3">Selecione o Ano:</label>
        <select class="form-select" name="id_data" id="id_data" required>
        <option value='<?=$ano_vigente?>' hidden><?=$ano_vigente?></option>
        <?php
          $ano_atual = date("Y");
          $ano_inicial = 2023;
          $ano_final = 2100;
          while ($ano_inicial <= $ano_final) {
            echo "<option value='$ano_inicial'>$ano_inicial</option>";
            $ano_inicial++;
          }
          ?>
        </select>

        <div class="d-grid gap-2 mt-3">
        <button class="btn btn-secondary" type="submit">Enviar</button>
        </div>
        </form>
      </div>



     
<?php

          if ($_GET['modo'] == 1) {
            $modo = 'NOT';
            $titulo_auto_avaliacao_colaborador = "<p class='fw-bold h4 pt-2 pb-2' >Auto-Avaliação Colaborador Não Realizada:</p>";
            $titulo_auto_avaliacao_coordenador = "<p class='fw-bold h4 pt-2 pb-2' >Auto-Avaliação Coordenador Não Realizada:</p>";
            $titulo_avaliacao_coordenador = "<p class='fw-bold h4 pt-2 pb-2' >Avaliação Coordenador Não Realizada:</p>";
            $titulo_avaliacao_gerente = "<p class='fw-bold h4 pt-2 pb-2' >Avaliação Gerente Não Realizada:</p>";
          } if ($_GET['modo'] == 2) {
            $modo = ' ';
            $titulo_auto_avaliacao_colaborador = "<p class='fw-bold h4 pt-2 pb-2' >Auto-Avaliação Colaborador Realizadas:</p>";
            $titulo_auto_avaliacao_coordenador = "<p class='fw-bold h4 pt-2 pb-2' >Auto-Avaliação Coordenador Realizadas:</p>";
            $titulo_avaliacao_coordenador = "<p class='fw-bold h4 pt-2 pb-2' >Avaliação Coordenador Realizadas:</p>";
            $titulo_avaliacao_gerente = "<p class='fw-bold h4 pt-2 pb-2' >Avaliação Gerente Realizadas:</p>";
          }

          if ($_GET['id_data'] != 'null') {
          $ano_avaliacao = $_GET['id_data'];

// Avaliação não realizada auto avaliação colaboradores

          echo $titulo_auto_avaliacao_colaborador;
          $colab = "

          SELECT * 
          FROM usuario e
          where situacao = 1
          AND $modo EXISTS (
            SELECT 1 
            FROM avaliacoes a 
          WHERE e.idusuario = a.idusuario and data = $ano_avaliacao and (lidersupervisor = 0 or idusuario in ($concede_usuario)))
          and (lider = 0 or idusuario in ($concede_usuario))
          AND e.avaliador <> 0
          order by e.setorid ASC
          ";

          $id_colab = mysqli_query($conexao, $colab);
          
          while ($id_col = mysqli_fetch_assoc($id_colab)) {

          $nomecompleto_b = $id_col['nomecompleto'];
          $setorid_u = $id_col['setorid'];

          $setorid = "
          SELECT * 
          FROM setor where id = $setorid_u
          ";
          $id_setorid = mysqli_query($conexao, $setorid);
          
          while ($id_set = mysqli_fetch_assoc($id_setorid)) {
          $setorid_b = $id_set['setor'];
          }

          echo "<p><strong>$setorid_b</strong> - $nomecompleto_b</p>";
         
          }

// Avaliação não realizada auto avaliação colaboradores
// Avaliação não realizada auto avaliação coordenadores

          echo $titulo_auto_avaliacao_coordenador;
          $colab = "

          SELECT * 
          FROM usuario e
          where situacao = 1
          AND $modo EXISTS (
            SELECT 1 
            FROM avaliacoes a 
          WHERE e.idusuario = a.idusuario and data = $ano_avaliacao and a.lidersupervisor = a.lider and a.lider =1)
          AND e.lider =1
          AND e.avaliador <> 0
          order by e.setorid ASC
       
          ";

          $id_colab = mysqli_query($conexao, $colab);

          while ($id_col = mysqli_fetch_assoc($id_colab)) {

          $nomecompleto_b = $id_col['nomecompleto'];
          $setorid_u = $id_col['setorid'];

          $setorid = "
          SELECT * 
          FROM setor where id = $setorid_u
          ";
          $id_setorid = mysqli_query($conexao, $setorid);

          while ($id_set = mysqli_fetch_assoc($id_setorid)) {
          $setorid_b = $id_set['setor'];
          }

          echo "<p><strong>$setorid_b</strong> - $nomecompleto_b</p>";

          }
// Avaliação não realizada avaliação coordenadores

         echo $titulo_avaliacao_coordenador;
          $colab = "

          SELECT * 
          FROM usuario e
          where situacao = 1
          AND $modo EXISTS (
            SELECT 1 
            FROM avaliacoes a 
          WHERE e.idusuario = a.idusuario and data = $ano_avaliacao and a.lidersupervisor != a.lider and a.lidersupervisor = 1)
          and lider = 0
          AND e.avaliador <> 0 
          AND e.avaliador <> 1
          order by e.setorid ASC
          ";

          $id_colab = mysqli_query($conexao, $colab);
          
          while ($id_col = mysqli_fetch_assoc($id_colab)) {

          $nomecompleto_b = $id_col['nomecompleto'];
          $setorid_u = $id_col['setorid'];

          $setorid = "
          SELECT * 
          FROM setor where id = $setorid_u
          ";
          $id_setorid = mysqli_query($conexao, $setorid);
          
          while ($id_set = mysqli_fetch_assoc($id_setorid)) {
          $setorid_b = $id_set['setor'];
          }

          echo "<p><strong>$setorid_b</strong> - $nomecompleto_b</p>";
         
          }


// Avaliação não realizada avaliação Gerência

          echo $titulo_avaliacao_gerente;
          $colab = "

          SELECT * 
          FROM usuario e
          where situacao = 1
          AND $modo EXISTS (
            SELECT 1 
            FROM avaliacoes a 
          WHERE e.idusuario = a.idusuario and data = $ano_avaliacao and a.idsupervisor in ($gerente))
          AND e.avaliador in ($gerente)
          order by e.setorid ASC
       
          ";

          $id_colab = mysqli_query($conexao, $colab);

          while ($id_col = mysqli_fetch_assoc($id_colab)) {

          $nomecompleto_b = $id_col['nomecompleto'];
          $setorid_u = $id_col['setorid'];

          $setorid = "
          SELECT * 
          FROM setor where id = $setorid_u
          ";
          $id_setorid = mysqli_query($conexao, $setorid);

          while ($id_set = mysqli_fetch_assoc($id_setorid)) {
          $setorid_b = $id_set['setor'];
          }

          echo "<p><strong>$setorid_b</strong> - $nomecompleto_b</p>";

          }

// Avaliação não realizada avaliação Gerência



?>
 <?php } else {echo "Pressione enviar ou não há registros para esta data.";} ?>
       



</body>



<?php } else {
  header('Location: login.php');
} ?>