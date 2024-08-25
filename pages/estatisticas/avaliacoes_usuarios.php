<?php require_once('../../conexao.php');

session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

  

  $id_login = $_SESSION['id'];
  $usu_login_sql = "SELECT * FROM usuario where idusuario = $id_login";
  $usu_login_query = mysqli_query($conexao, $usu_login_sql);
  while ($usu_login_fetch = mysqli_fetch_assoc($usu_login_query)) {
  
  $usu_login = $usu_login_fetch['nomecompleto'];
  
  }

  $param_sql = "SELECT * FROM delega_acoes";
  $param_query = mysqli_query($conexao, $param_sql);

  while ($param_fetch = mysqli_fetch_assoc($param_query)) {
    $ano_vigente = $param_fetch['ano_vigente'];
    $idpergunta1 = $param_fetch['pergunta1'];
    $idpergunta2 = $param_fetch['pergunta2'];
    $delega_tipo2 = $param_fetch['concede_usuario'];
    $delega_tipo_array2 = explode(",", $delega_tipo2); 
    $gerente = $param_fetch['gerente'];
    $delega_tipo_array = explode(",", $gerente);
  }

  if ($_GET['id_data'] == 'null') {
    $data_ano = date('Y', strtotime(str_replace("/", "-", $ano_vigente)));
  } else {
    $data_ano = $ano_vigente;
  }



  $id_usuario_selecionado = $_GET['idusuario'];


  if ($_GET['idusuario'] != 'null') {
  $usuario_selecionado = "SELECT * FROM usuario WHERE idusuario = '$id_usuario_selecionado' and situacao = 1";
  $usu_select = mysqli_query($conexao, $usuario_selecionado);
  
  while ($nome_selecionado = mysqli_fetch_assoc($usu_select)) {
      $nome_selec = $nome_selecionado['nomecompleto'];
  }
} else if ($_GET['idusuario'] != 'null') {
      $nome_selec = $_GET['idusuario'];
      
} else {
      $nome_selec = 'Selecione';   
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
            <a class="nav-link">Login:
              <?=$usu_login?>
            </a>
          </li>
        </ul>

      </div>
    </nav>
  </div>

  <div class="d-flex justify-content-center pt-2">
    <a href="avaliacoes.php?id_data=6&id_data=null" class="btn btn-secondary btn-lg m-2">Avaliação Geral</a>
    <a href="avaliacoes_setores.php?id_data=6&id_data=null" class="btn btn-secondary btn-lg m-2">Avaliação Por Setor</a>
    <a href="avaliacoes_usuarios.php?id_tipo=null&idusuario=null&id_data=null"
      class="btn btn-outline-secondary btn-lg m-2">Editor e Avaliação Por Usuário</a>
    <a href="avaliacoes_lideres.php?idusuario=null&id_data=null" class="btn btn-secondary btn-lg m-2">Avaliação Por
      Liderança</a>
    <a href="avaliacoes_nao_realizadas.php?id_data=6&id_data=null&modo=null"
      class="btn btn-secondary btn-lg m-2">Usuários Pendentes</a>
  </div>



  <div id="alertas">
    <?php if(isset($_GET['retorno'])==true && $_GET['retorno']==1){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <span>Houve um problema no envio do formulário!</span>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- Envios -->

    <?php } if(isset($_GET['retorno'])==true && $_GET['retorno']==1.1){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <span>Formulário enviado com Sucesso!</span>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php } ?>
  </div>


  <div>
    <label class="fw-bold fs-3 d-flex justify-content-center py-3">Avaliações por Usuários</label>
  </div>


  <div class="container py-2">
    <form action="avaliacoes_usuarios.php" method="GET">
      <div>
        <input name="id_tipo" value="6" type="hidden" id="id_tipo" checked require>
      </div>
      <div class="mb-3">
        <label for="idusuario" class="form-label pt-3">Selecione o Avaliado:</label>
        <select class="form-select" name="idusuario" id="idusuario" required>
          <option value='<?=$id_usuario_selecionado?>' hidden>
            <?=$nome_selec?>
          </option>
          <?php  


          $editar_usuarios = "SELECT * FROM usuario where situacao = 1 and avaliador <> 0 order by nomecompleto ASC";
          $id_servico = mysqli_query($conexao, $editar_usuarios);
          
          while ($id_ser = mysqli_fetch_assoc($id_servico)) {

          $idusuario = $id_ser['idusuario'];
          $nomecompleto = $id_ser['nomecompleto'];
  
          echo "<option value='$idusuario'>$nomecompleto</option>";
        
          }?>

        </select>
        <label for="id_data" class="form-label pt-3">Selecione o Ano:</label>
        <select class="form-select" name="id_data" id="id_data" required>
          <option value='<?=$ano_vigente?>' hidden>
            <?=$ano_vigente?>
          </option>
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




  <div>

    <?php  

 

 ?>
     <?php

        $idusuario = $_GET['idusuario'];
        $id_data = $_GET['id_data'];
        $notas = "

            SELECT 
            id, nota1, nota2, nota3, nota4, nota5, nota6, nota7, nota8, nota9, nota10, setor, data, lider, idsupervisor, setorsupervisor, lidersupervisor, idusuario, idpergunta,
            texto1, texto2, texto3 , texto4 , texto5 , texto6 , texto7 , texto8 , texto9 , texto10
            FROM avaliacoes a
            WHERE idusuario = $idusuario and data = $id_data order by idpergunta
        ";

        $nota_find = mysqli_query($conexao, $notas);
        $nota_tt_total1 = 0;
        if (mysqli_num_rows($nota_find) > 0) {
            while ($id_nota = mysqli_fetch_assoc($nota_find)) {
                $id_quest = $id_nota['id'];
                $nota1 = $id_nota['nota1'];
                $nota2 = $id_nota['nota2'];
                $nota3 = $id_nota['nota3'];
                $nota4 = $id_nota['nota4'];
                $nota5 = $id_nota['nota5'];
                $nota6 = $id_nota['nota6'];
                $nota7 = $id_nota['nota7'];
                $nota8 = $id_nota['nota8'];
                $nota9 = $id_nota['nota9'];
                $nota10 = $id_nota['nota10'];
                $texto1 = $id_nota['texto1'];
                if (!empty($texto1)) {
                  $texto1 = 'Comentário: ' . $texto1;
                }
                $texto2 = $id_nota['texto2'];
                if (!empty($texto2)) {
                  $texto2 = 'Comentário: ' . $texto2;
                }
                $texto3 = $id_nota['texto3'];
                if (!empty($texto3)) {
                  $texto3 = 'Comentário: ' . $texto3;
                }
                $texto4 = $id_nota['texto4'];
                if (!empty($texto4)) {
                  $texto4 = 'Comentário: ' . $texto4;
                }
                $texto5 = $id_nota['texto5'];
                if (!empty($texto5)) {
                  $texto5 = 'Comentário: ' . $texto5;
                }
                $texto6 = $id_nota['texto6'];
                if (!empty($texto6)) {
                  $texto6 = 'Comentário: ' . $texto6;
                }
                $texto7 = $id_nota['texto7'];
                if (!empty($texto7)) {
                  $texto7 = 'Comentário: ' . $texto7;
                }
                $texto8 = $id_nota['texto8'];
                if (!empty($texto8)) {
                  $texto8 = 'Comentário: ' . $texto8;
                }
                $texto9 = $id_nota['texto9'];
                if (!empty($texto9)) {
                  $texto9 = 'Comentário: ' . $texto9;
                }
                $texto10 = $id_nota['texto10'];
                if (!empty($texto10)) {
                  $texto10 = 'Comentário: ' . $texto10;
                }
                $idsupervisor = $id_nota['idsupervisor'];
                $lider = $id_nota['lider'];
                $lidersupervisor = $id_nota['lidersupervisor'];
                $idusuario_a = $id_nota['idusuario'];
                $id_pergunta = $id_nota['idpergunta'];
                $data = date('Y', strtotime(str_replace("/", "-", $id_nota["data"])));
                $id_usuario_destino = $id_nota['idusuario'];


                if($idsupervisor == $idusuario_a && $lidersupervisor == 1){
                  echo "<p class='text-decoration-underline fw-bold fs-5'>Auto Avaliação Coordenadores</p>";
                } 
                if(in_array($idsupervisor, $delega_tipo_array) && $id_pergunta == $idpergunta1){
                  echo "<p class='text-decoration-underline fw-bold fs-5'>Gerência avalia Competência Coordenador</p>";
                } 
                if(in_array($idsupervisor, $delega_tipo_array) && $id_pergunta == $idpergunta2){
                  echo "<p class='text-decoration-underline fw-bold fs-5'>Gerência avalia Competência Liderança</p>";
                } 
                if($idsupervisor != $idusuario_a && $lidersupervisor <> 0 && $lider == 0){
                  echo "<p class='text-decoration-underline  fw-bold fs-5'>Coordenadores Avaliam Colaboradores</p>";
                } 
                if($idsupervisor == $idusuario_a && ($lider == 0 || in_array($idusuario, $delega_tipo_array2))){
                  echo "<p class='text-decoration-underline fw-bold fs-5'>Auto Avaliação Colaboradores</p>";
                } 
              
            

          if ($idusuario_a <> 0) {
          $usuarios_p = "SELECT nomecompleto FROM usuario WHERE idusuario = $idusuario_a";
          $usuarios_p_result = mysqli_query($conexao, $usuarios_p);

          
              while ($usuarios_p_assoc = mysqli_fetch_assoc($usuarios_p_result)) {
                  $usuarios_p_nome = $usuarios_p_assoc['nomecompleto'];
                  echo "<p class='fw-bold fs-5'>Nome do Avaliado: $usuarios_p_nome</p>";
              }
          }


          if ($idsupervisor <> 0) {
          $supervisor = "SELECT nomecompleto FROM usuario WHERE idusuario = $idsupervisor";
          $supervisor_result = mysqli_query($conexao, $supervisor);

              while ($supervisor_assoc = mysqli_fetch_assoc($supervisor_result)) {
                  $supervisor_nome = $supervisor_assoc['nomecompleto'];
                  echo "<p class='fw-bold fs-5'>Supervisor Imediato: $supervisor_nome</p>";
              }
          }


          if ($idusuario_a <> 0) {
        $sql_perguntas = "SELECT * FROM pergunta WHERE id = $id_pergunta";
        $id_perguntas = mysqli_query($conexao, $sql_perguntas);


          while ($perguntas = mysqli_fetch_assoc($id_perguntas)) {
              $idpergunta1 = $perguntas['pergunta1'];
              $idpergunta2 = $perguntas['pergunta2'];
              $pergunta3 = $perguntas['pergunta3'];
              $pergunta4 = $perguntas['pergunta4'];
              $pergunta5 = $perguntas['pergunta5'];
              $pergunta6 = $perguntas['pergunta6'];
              $pergunta7 = $perguntas['pergunta7'];
              $pergunta8 = $perguntas['pergunta8'];
              $pergunta9 = $perguntas['pergunta9'];
              $idpergunta10 = $perguntas['pergunta10'];
          }


        if ($idusuario_a <> 0) {
        $sql_col= "SELECT (
                      IF(pergunta1 <> '', 1, 0) +
                      IF(pergunta2 <> '', 1, 0) +
                      IF(pergunta3 <> '', 1, 0) +
                      IF(pergunta4 <> '', 1, 0) +
                      IF(pergunta5 <> '', 1, 0) +
                      IF(pergunta6 <> '', 1, 0) +
                      IF(pergunta7 <> '', 1, 0) +
                      IF(pergunta8 <> '', 1, 0) +
                      IF(pergunta9 <> '', 1, 0) +
                      IF(pergunta10 <> '', 1, 0)
                  ) qt_col
                  FROM pergunta
                  WHERE id = $id_pergunta
                  LIMIT 1
                    ";
                        
          $col_query = mysqli_query($conexao, $sql_col);
          while ($fetch_col = mysqli_fetch_assoc($col_query)) {

            $divisao = $fetch_col['qt_col']; 
          
          }
        }

        
       $quantidade = 10; 
        

        $nota_tt = number_format((($nota1 + $nota2 + $nota3 + $nota4 + $nota5 + $nota6 + $nota7 + $nota8 + $nota9 + $nota10)/$divisao), 2, '.', '');


echo "
<div>
    <div class='row'>
        <div class='col-sm'>
            <p class='fw-bold'>Período a avaliar: $data_ano</p>
            <hr>
            <p class='text-decoration-underline' style='display: inline;'>1. $idpergunta1</p>
            <p class='fw-bold' style='display: inline;'>$nota1</p>
            <p class='text-body-secondary fst-italic'>$texto1</p>
            <hr>
            <p class='text-decoration-underline' style='display: inline;'>2. $idpergunta2</p>
            <p class='fw-bold' style='display: inline;'>$nota2</p>
            <p class='text-body-secondary fst-italic'>$texto2</p>
            <hr>
            <p class='text-decoration-underline' style='display: inline;'>3. $pergunta3</p>
            <p class='fw-bold' style='display: inline;'>$nota3</p>
            <p class='text-body-secondary fst-italic'>$texto3</p>
            <hr>
            <p class='text-decoration-underline' style='display: inline;'>4. $pergunta4</p>
            <p class='fw-bold' style='display: inline;'>$nota4</p>
            <p class='text-body-secondary fst-italic'>$texto4</p>
            <hr>";
            if($pergunta5 != "" && $quantidade <= 10) {
        echo "<p class='text-decoration-underline' style='display: inline;'>5. $pergunta5</p>
              <p class='fw-bold' style='display: inline;'>$nota5</p>
              <p class='text-body-secondary fst-italic'>$texto5</p>
              <hr>";}
            if($pergunta6 != "" && $quantidade <= 10) {
        echo "<p class='text-decoration-underline' style='display: inline;'>6. $pergunta6</p>
              <p class='fw-bold' style='display: inline;'>$nota6</p>
              <p class='text-body-secondary fst-italic'>$texto6</p>
              <hr>";}
            if($pergunta7 != "" && $quantidade <= 10) {
        echo "<p class='text-decoration-underline' style='display: inline;'>7. $pergunta7</p>
              <p class='fw-bold' style='display: inline;'>$nota7</p>
              <p class='text-body-secondary fst-italic'>$texto7</p>
              <hr>";}
            if($pergunta8 != "" && $quantidade <= 10) {
        echo "<p class='text-decoration-underline' style='display: inline;'>8. $pergunta8</p>
              <p class='fw-bold' style='display: inline;'>$nota8</p>
              <p class='text-body-secondary fst-italic'>$texto8</p>
              <hr>";}
            if($pergunta9 != "" && $quantidade <= 10) {
        echo "<p class='text-decoration-underline' style='display: inline;'>9. $pergunta9</p>
              <p class='fw-bold' style='display: inline;'>$nota9</p>
              <p class='text-body-secondary fst-italic'>$texto9</p>
              <hr>";} 
            if($idpergunta10 != "" && $quantidade <= 10) {
        echo "<p class='text-decoration-underline' style='display: inline;'>10. $idpergunta10</p>
              <p class='fw-bold' style='display: inline;'>$nota10</p>
              <p class='text-body-secondary fst-italic'>$texto10</p>
              <hr>";}
        echo "</div>
              <div class='col col-lg-2'>
              <p class='fw-bold fs-5'>Média: $nota_tt</p>
                  <form action='../dados/editar_avaliacao.php' method='POST'>
                    <input type='hidden' name='id_quest' value='$id_quest'>
                    <button type='submit' class='btn btn-secondary btn-sm'>Editar</button>
                  </form>
              </div>
          </div>
      </div>
      <hr class='border border-secondary border-2 opacity-50'>";  
      $qt_perguntas_sql = "
      SELECT SUM(qt_total) AS qt_contas FROM (
        SELECT COUNT(*) AS qt_total FROM avaliacoes WHERE idusuario = $idusuario AND data = $id_data 
      ) AS subquery
      ";

      $qt_perguntas_query = mysqli_query($conexao, $qt_perguntas_sql);

      if ($qt_perguntas_query) {
      $qt_perguntas_assoc = mysqli_fetch_assoc($qt_perguntas_query);
      $qt_contas = $qt_perguntas_assoc['qt_contas']; 
      } 

      $nota_tt_total1 += $nota_tt/$qt_contas;     
}    
}  
echo "<p class='fw-bold fs-5 text-center'>A Média do Avaliado é: $nota_tt_total1</p>";
} else {
    $idsupervisor = 0;
    $idusuario_a = 0;
    echo "Pressione enviar ou não há registros para esta data.";
}


?>





  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>

<?php } else {
  header('Location: login.php');
} ?>