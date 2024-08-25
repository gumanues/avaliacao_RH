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
    $concede_usuario = $param_fetch['concede_usuario'];
    $idpergunta1 = $param_fetch['pergunta1'];
    $idpergunta2 = $param_fetch['pergunta2'];
  }

  if ($_GET['id_data'] == 'null') {
    $data_ano = date('Y', strtotime(str_replace("/", "-", $ano_vigente)));
  } else {
    $data_ano = $ano_vigente;
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
    <a href="avaliacoes.php?id_data=6&id_data=null" class="btn btn-outline-secondary btn-lg m-2">Avaliação Geral</a>
    <a href="avaliacoes_setores.php?id_data=6&id_data=null" class="btn btn-secondary btn-lg m-2">Avaliação Por Setor</a>
    <a href="avaliacoes_usuarios.php?id_tipo=null&idusuario=null&id_data=null" class="btn btn-secondary btn-lg m-2">Editor e Avaliação Por Usuário</a>
    <a href="avaliacoes_lideres.php?idusuario=null&id_data=null" class="btn btn-secondary btn-lg m-2">Avaliação Por Liderança</a>
    <a href="avaliacoes_nao_realizadas.php?id_data=6&id_data=null&modo=null" class="btn btn-secondary btn-lg m-2">Usuários Pendentes</a>
  </div>


  <div>
    <label class="fw-bold fs-3 d-flex justify-content-center py-3">Avaliações Gerais</label>
  </div>

  <div class="container py-2">
    <form action="avaliacoes.php" method="GET">
    <div>
    <input name="id_data" value="6" type="hidden" id="id_data" checked require>
    </div>
      <div class="mb-3">


        <label for="id_data" class="form-label pt-3">Selecione o Ano:</label>
        <select class="form-select" name="id_data" id="id_data" required>
          <option value='<?=$ano_vigente?>' hidden><?=$ano_vigente?></option>
          <?php
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
          $data = $_GET['id_data'];

          // Inicio Nota média Colaboradores
          $data_sql1 = "

          SELECT
          b.qt_col, 
          nvl(
              (
                  (
                      sum(
                          nvl(c.nota1, 0) + nvl(c.nota2, 0) + nvl(c.nota3, 0) + nvl(c.nota4, 0) +
                          nvl(c.nota5, 0) + nvl(c.nota6, 0) + nvl(c.nota7, 0) + nvl(c.nota8, 0) +
                          nvl(c.nota9, 0) + nvl(c.nota10, 0)
                      ) / b.qt_col
                  ) / a.qtd
              ), 0
          ) nota_tt1,
          nvl(a.qtd, 0) qtd
      FROM 
          (
              SELECT 
                  (
                      IF(nota1 IS NOT NULL, 1, 0) +
                      IF(nota2 IS NOT NULL, 1, 0) +
                      IF(nota3 IS NOT NULL, 1, 0) +
                      IF(nota4 IS NOT NULL, 1, 0) +
                      IF(nota5 IS NOT NULL, 1, 0) +
                      IF(nota6 IS NOT NULL, 1, 0) +
                      IF(nota7 IS NOT NULL, 1, 0) +
                      IF(nota8 IS NOT NULL, 1, 0) +
                      IF(nota9 IS NOT NULL, 1, 0) +
                      IF(nota10 IS NOT NULL, 1, 0)
                  ) qt_col
              FROM avaliacoes
              WHERE `data` = $data and lider = lidersupervisor and (lider = 0  or idusuario in ($concede_usuario))
              LIMIT 1
          ) b,
          (
              SELECT sum(1) qtd from `avaliacoes` WHERE `data` = $data and lider = lidersupervisor and (lider = 0  or idusuario in ($concede_usuario))
          ) a,
          `avaliacoes` c
         WHERE 
          c.`data` = $data and lider = lidersupervisor and (lider = 0  or idusuario in ($concede_usuario));

          ";


          $datasql1 = mysqli_query($conexao, $data_sql1);
          
          while ($id_nota1 = mysqli_fetch_assoc($datasql1)) {

          

          $qt_col1 = $id_nota1['qt_col'];
          $media1 = substr($id_nota1['nota_tt1'],0,-7);
          if ($media1 != null) {
          $qtd1 = $id_nota1['qtd'];
          $media_div1 = $media1 * $qt_col1;
          $media_graf1 = ($media1 * $qt_col1) * 2.5;
       
   

          if (floor($media1) == 1) {
            $bg1 = "bg-danger";
          } else if (floor($media1) == 2) {
            $bg1 = "bg-warning";
          } else if (floor($media1) == 3) {
            $bg1 = "bg-info";
          } else if (floor($media1) == 4) {
            $bg1 = "";
          } else {
            $bg1 = "bg-success";
          }

        
       
        echo "

        <div class='row'>
          <div class='col-8'>
            <p class='fs-5'>Nota Média Auto-Avaliação Colaboradores: $media1</p>
          </div>
        </div>

        
        <p>Colaboradores se auto-avaliam. Quantidade de registros: $qtd1</p>
        
        <div class='progress'>
          <div class='progress-bar progress-bar-striped $bg1' role='progressbar' style='width: $media_graf1%' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'></div>
        </div>
        
        <hr>
        ";

          } else { 
            echo 'Não há registros de Nota Média Auto-Avaliação Colaboradores.';
            echo '<hr>';
          
          }
        }


        // Fim Nota média Colaboradores

          // Inicio Nota média Coordenadores avaliam colaboradores


          $data_sql3 = "

          SELECT 
          b.qt_col,
          nvl(
              (
                  (
                      sum(
                          nvl(c.nota1, 0) + nvl(c.nota2, 0) + nvl(c.nota3, 0) + nvl(c.nota4, 0) +
                          nvl(c.nota5, 0) + nvl(c.nota6, 0) + nvl(c.nota7, 0) + nvl(c.nota8, 0) +
                          nvl(c.nota9, 0) + nvl(c.nota10, 0)
                      ) / b.qt_col
                  ) / a.qtd
              ), 0
          ) nota_tt3,
          nvl(a.qtd, 0) qtd
      FROM 
          (
              SELECT 
                  (
                      IF(nota1 IS NOT NULL, 1, 0) +
                      IF(nota2 IS NOT NULL, 1, 0) +
                      IF(nota3 IS NOT NULL, 1, 0) +
                      IF(nota4 IS NOT NULL, 1, 0) +
                      IF(nota5 IS NOT NULL, 1, 0) +
                      IF(nota6 IS NOT NULL, 1, 0) +
                      IF(nota7 IS NOT NULL, 1, 0) +
                      IF(nota8 IS NOT NULL, 1, 0) +
                      IF(nota9 IS NOT NULL, 1, 0) +
                      IF(nota10 IS NOT NULL, 1, 0)
                  ) qt_col
              FROM avaliacoes
              WHERE `data` = $data and lider != lidersupervisor and lidersupervisor = 1
              LIMIT 1
          ) b,
          (
              SELECT sum(1) qtd from `avaliacoes` WHERE `data` = $data and lider != lidersupervisor and lidersupervisor = 1
          ) a,
          `avaliacoes` c
         WHERE 
          c.`data` = $data and lider != lidersupervisor and lidersupervisor = 1;
  
          ";
  
  
          $datasql3 = mysqli_query($conexao, $data_sql3);
          
          while ($id_nota3 = mysqli_fetch_assoc($datasql3)) {
  
          $qt_col3 = $id_nota3['qt_col'];  
          $media3 = substr($id_nota3['nota_tt3'],0,-7);
          if ($media3 != null) {
          $qtd3 = $id_nota3['qtd'];
          $media_div3 = $media3 * $qt_col3;
          $media_graf3 = ($media3 * $qt_col3) * 2.5;
  
   
  
          if (floor($media3) == 1) {
            $bg3 = "bg-danger";
          } else if (floor($media3) == 2) {
            $bg3 = "bg-warning";
          } else if (floor($media3) == 3) {
            $bg3 = "bg-info";
          } else if (floor($media3) == 4) {
            $bg3 = "";
          } else {
            $bg3 = "bg-success";
          }
  
        
       
        echo "
  
        <div class='row'>
          <div class='col-8'>
            <p class='fs-5'>Nota Média Líderes Colaboradores: $media3</p>
          </div>
        </div>
  
        
        <p>Coordenador avalia Colaboradores. Quantidade de registros: $qtd3</p>
        
        <div class='progress'>
          <div class='progress-bar progress-bar-striped $bg3' role='progressbar' style='width: $media_graf3%' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'></div>
        </div>
        
        <hr>
        ";
  
      } else { 
        echo 'Não há registros de Nota Média Líderes Colaboradores.';
        echo '<hr>';
      
      }
    }
  
       // Fim Nota média Coordenadores avaliam colaboradores
        // Inicio Nota média Coordenadores


        $data_sql2 = "

        SELECT 
        b.qt_col,
        nvl(
            (
                (
                    sum(
                        nvl(c.nota1, 0) + nvl(c.nota2, 0) + nvl(c.nota3, 0) + nvl(c.nota4, 0) +
                        nvl(c.nota5, 0) + nvl(c.nota6, 0) + nvl(c.nota7, 0) + nvl(c.nota8, 0) +
                        nvl(c.nota9, 0) + nvl(c.nota10, 0)
                    ) / b.qt_col
                ) / a.qtd
            ), 0
        ) nota_tt2,
        nvl(a.qtd, 0) qtd
    FROM 
        (
            SELECT 
                (
                    IF(nota1 IS NOT NULL, 1, 0) +
                    IF(nota2 IS NOT NULL, 1, 0) +
                    IF(nota3 IS NOT NULL, 1, 0) +
                    IF(nota4 IS NOT NULL, 1, 0) +
                    IF(nota5 IS NOT NULL, 1, 0) +
                    IF(nota6 IS NOT NULL, 1, 0) +
                    IF(nota7 IS NOT NULL, 1, 0) +
                    IF(nota8 IS NOT NULL, 1, 0) +
                    IF(nota9 IS NOT NULL, 1, 0) +
                    IF(nota10 IS NOT NULL, 1, 0)
                ) qt_col
            FROM avaliacoes
            WHERE `data` = $data and lider = lidersupervisor and lidersupervisor = 1 and idpergunta = $idpergunta1
            LIMIT 1
        ) b,
        (
            SELECT sum(1) qtd from `avaliacoes` WHERE `data` = $data and lider = lidersupervisor and lidersupervisor = 1 and idpergunta = $idpergunta1
        ) a,
        `avaliacoes` c
       WHERE 
        c.`data` = $data and lider = lidersupervisor and lidersupervisor = 1 and idpergunta = $idpergunta1;
        ";


        $datasql2 = mysqli_query($conexao, $data_sql2);
        
        while ($id_nota2 = mysqli_fetch_assoc($datasql2)) {


          
        $qt_col2 = $id_nota2['qt_col'];



        $media2 = substr($id_nota2['nota_tt2'],0,-7);
        if ($media2 != null) {
        $qtd2 = $id_nota2['qtd'];
        $media_div2 = $media2 * $qt_col2;
        $media_graf2 = ($media2 * $qt_col2) * 2.5;

 

        if (floor($media2) == 1) {
          $bg2 = "bg-danger";
        } else if (floor($media2) == 2) {
          $bg2 = "bg-warning";
        } else if (floor($media2) == 3) {
          $bg2 = "bg-info";
        } else if (floor($media2) == 4) {
          $bg2 = "";
        } else {
          $bg2 = "bg-success";
        }

      
     
      echo "

      <div class='row'>
        <div class='col-8'>
          <p class='fs-5'>Nota Média Auto-Avaliação Coordenadores: $media2</p>
        </div>
      </div>

      
      <p>Coordenadores se auto-avaliam. Quantidade de registros: $qtd2</p>
      
      <div class='progress'>
        <div class='progress-bar progress-bar-striped $bg2' role='progressbar' style='width: $media_graf2%' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'></div>
      </div>
      
      <hr>
      ";

    } else { 
      echo 'Não há registros de Nota Média Auto-Avaliação Coordenadores.';
      echo '<hr>';
    
    }
  }

     // Fim Nota média Coordenadores

        // Inicio Nota média Coordenadores Líderes


        $data_sql6 = "

        SELECT 
        b.qt_col,
        nvl(
            (
                (
                    sum(
                        nvl(c.nota1, 0) + nvl(c.nota2, 0) + nvl(c.nota3, 0) + nvl(c.nota4, 0) +
                        nvl(c.nota5, 0) + nvl(c.nota6, 0) + nvl(c.nota7, 0) + nvl(c.nota8, 0) +
                        nvl(c.nota9, 0) + nvl(c.nota10, 0)
                    ) / b.qt_col
                ) / a.qtd
            ), 0
        ) nota_tt6,
        nvl(a.qtd, 0) qtd
    FROM 
        (
            SELECT 
                (
                    IF(nota1 IS NOT NULL, 1, 0) +
                    IF(nota2 IS NOT NULL, 1, 0) +
                    IF(nota3 IS NOT NULL, 1, 0) +
                    IF(nota4 IS NOT NULL, 1, 0) +
                    IF(nota5 IS NOT NULL, 1, 0) +
                    IF(nota6 IS NOT NULL, 1, 0) +
                    IF(nota7 IS NOT NULL, 1, 0) +
                    IF(nota8 IS NOT NULL, 1, 0) +
                    IF(nota9 IS NOT NULL, 1, 0) +
                    IF(nota10 IS NOT NULL, 1, 0)
                ) qt_col
            FROM avaliacoes
            WHERE `data` = $data and lider = lidersupervisor and lidersupervisor = 1 and idpergunta = $idpergunta2
            LIMIT 1
        ) b,
        (
            SELECT sum(1) qtd from `avaliacoes` WHERE `data` = $data and lider = lidersupervisor and lidersupervisor = 1 and idpergunta = $idpergunta2
        ) a,
        `avaliacoes` c
       WHERE 
        c.`data` = $data and lider = lidersupervisor and lidersupervisor = 1 and idpergunta = $idpergunta2;
        ";


        $datasql6 = mysqli_query($conexao, $data_sql6);
        
        while ($id_nota6 = mysqli_fetch_assoc($datasql6)) {


          
        $qt_col6 = $id_nota6['qt_col'];



        $media6 = substr($id_nota6['nota_tt6'],0,-7);
        if ($media6 != null) {
        $qtd6 = $id_nota6['qtd'];
        $media_div6 = $media6 * $qt_col6;
        $media_graf6 = ($media6 * $qt_col6) * 2.5;

 

        if (floor($media6) == 1) {
          $bg6 = "bg-danger";
        } else if (floor($media6) == 2) {
          $bg6 = "bg-warning";
        } else if (floor($media6) == 3) {
          $bg6 = "bg-info";
        } else if (floor($media6) == 4) {
          $bg6 = "";
        } else {
          $bg6 = "bg-success";
        }

      
     
      echo "

      <div class='row'>
        <div class='col-8'>
          <p class='fs-5'>Nota Média Auto-Avaliação Coordenadores Líderes: $media6</p>
        </div>
      </div>

      
      <p>Coordenadores se auto-avaliam. Quantidade de registros: $qtd6</p>
      
      <div class='progress'>
        <div class='progress-bar progress-bar-striped $bg6' role='progressbar' style='width: $media_graf6%' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'></div>
      </div>
      
      <hr>
      ";

    } else { 
      echo 'Não há registros de Nota Média Auto-Avaliação Coordenadores Líderes.';
      echo '<hr>';
    
    }
  }

     // Fim Nota média Coordenadores Líderes

  
  
           // Inicio Nota Média Gerência avalia Coordenadores


           $data_sql4 = "

           SELECT 
           b.qt_col,
           nvl(
               (
                   (
                       sum(
                           nvl(c.nota1, 0) + nvl(c.nota2, 0) + nvl(c.nota3, 0) + nvl(c.nota4, 0) +
                           nvl(c.nota5, 0) + nvl(c.nota6, 0) + nvl(c.nota7, 0) + nvl(c.nota8, 0) +
                           nvl(c.nota9, 0) + nvl(c.nota10, 0)
                       ) / b.qt_col
                   ) / a.qtd
               ), 0
           ) nota_tt4,
           nvl(a.qtd, 0) qtd
       FROM 
           (
               SELECT 
                   (
                       IF(nota1 IS NOT NULL, 1, 0) +
                       IF(nota2 IS NOT NULL, 1, 0) +
                       IF(nota3 IS NOT NULL, 1, 0) +
                       IF(nota4 IS NOT NULL, 1, 0) +
                       IF(nota5 IS NOT NULL, 1, 0) +
                       IF(nota6 IS NOT NULL, 1, 0) +
                       IF(nota7 IS NOT NULL, 1, 0) +
                       IF(nota8 IS NOT NULL, 1, 0) +
                       IF(nota9 IS NOT NULL, 1, 0) +
                       IF(nota10 IS NOT NULL, 1, 0)
                   ) qt_col
               FROM avaliacoes
               WHERE `data` = $data and (lider != lidersupervisor or idusuario in ($concede_usuario)) and lidersupervisor = 2 and idpergunta = $idpergunta1
               LIMIT 1
           ) b,
           (
               SELECT sum(1) qtd from `avaliacoes` WHERE `data` = $data and (lider != lidersupervisor or idusuario in ($concede_usuario)) and lidersupervisor = 2 and idpergunta = $idpergunta1
           ) a,
           `avaliacoes` c
          WHERE 
           c.`data` = $data and (lider != lidersupervisor or idusuario in ($concede_usuario)) and lidersupervisor = 2 and idpergunta = $idpergunta1;
   
           ";
   
   
           $datasql4 = mysqli_query($conexao, $data_sql4);
           
           while ($id_nota4 = mysqli_fetch_assoc($datasql4)) {
   
           $qt_col4 = $id_nota4['qt_col'];
           $media4 = substr($id_nota4['nota_tt4'],0,-7);
           if ($media4 != null) {
           $qtd4 = $id_nota4['qtd'];
           $media_div4 = $media4 * $qt_col4;
           $media_graf4 = ($media4 * $qt_col4) * 2.5;
   
    
   
           if (floor($media4) == 1) {
             $bg4 = "bg-danger";
           } else if (floor($media4) == 2) {
             $bg4 = "bg-warning";
           } else if (floor($media4) == 3) {
             $bg4 = "bg-info";
           } else if (floor($media4) == 4) {
             $bg4 = "";
           } else {
             $bg4 = "bg-success";
           }
   
         
        
         echo "
   
         <div class='row'>
           <div class='col-8'>
             <p class='fs-5'>Nota Média Gerência avalia Coordenadores: $media4</p>
           </div>
         </div>
   
         
         <p>Gerência avalia Coordenadores. Quantidade de registros: $qtd4</p>
         
         <div class='progress'>
           <div class='progress-bar progress-bar-striped $bg4' role='progressbar' style='width: $media_graf4%' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'></div>
         </div>
         
         <hr>
         ";
   
        } else { 
          echo 'Não há registros de Nota Média Gerência avalia Coordenadores.';
          echo '<hr>';
        
        }
      }
    
   
        // Fim Nota Média Gerência avalia Coordenadores

              // Inicio Nota Média Gerência avalia Competência Liderança


              $data_sql5 = "

              SELECT 
              b.qt_col,
              nvl(
                  (
                      (
                          sum(
                              nvl(c.nota1, 0) + nvl(c.nota2, 0) + nvl(c.nota3, 0) + nvl(c.nota4, 0) +
                              nvl(c.nota5, 0) + nvl(c.nota6, 0) + nvl(c.nota7, 0) + nvl(c.nota8, 0) +
                              nvl(c.nota9, 0) + nvl(c.nota10, 0)
                          ) / b.qt_col
                      ) / a.qtd
                  ), 0
              ) nota_tt5,
              nvl(a.qtd, 0) qtd
          FROM 
              (
                  SELECT 
                      (
                          IF(nota1 IS NOT NULL, 1, 0) +
                          IF(nota2 IS NOT NULL, 1, 0) +
                          IF(nota3 IS NOT NULL, 1, 0) +
                          IF(nota4 IS NOT NULL, 1, 0) +
                          IF(nota5 IS NOT NULL, 1, 0) +
                          IF(nota6 IS NOT NULL, 1, 0) +
                          IF(nota7 IS NOT NULL, 1, 0) +
                          IF(nota8 IS NOT NULL, 1, 0) +
                          IF(nota9 IS NOT NULL, 1, 0) +
                          IF(nota10 IS NOT NULL, 1, 0)
                      ) qt_col
                  FROM avaliacoes
                  WHERE `data` = $data and lider != lidersupervisor and lidersupervisor = 2 and idpergunta = $idpergunta2
                  LIMIT 1
              ) b,
              (
                  SELECT sum(1) qtd from `avaliacoes` WHERE `data` = $data and lider != lidersupervisor and lidersupervisor = 2 and idpergunta = $idpergunta2
              ) a,
              `avaliacoes` c
            WHERE 
              c.`data` = $data and lider != lidersupervisor and lidersupervisor = 2 and idpergunta = $idpergunta2;
      
              ";
      
      
              $datasql5 = mysqli_query($conexao, $data_sql5);
              
              while ($id_nota5 = mysqli_fetch_assoc($datasql5)) {
      
              $qt_col5 = $id_nota5['qt_col'];  
              $media5 = substr($id_nota5['nota_tt5'],0,-7);
              if ($media5 != null) {
              $qtd5 = $id_nota5['qtd'];
              $media_div5 = $media5 * $qt_col5;
              $media_graf5 = ($media5 * $qt_col5) * 2.5;
      
      
      
              if (floor($media5) == 1) {
                $bg5 = "bg-danger";
              } else if (floor($media5) == 2) {
                $bg5 = "bg-warning";
              } else if (floor($media5) == 3) {
                $bg5 = "bg-info";
              } else if (floor($media5) == 4) {
                $bg5 = "";
              } else {
                $bg5 = "bg-success";
              }
      
            
          
            echo "
      
            <div class='row'>
              <div class='col-8'>
                <p class='fs-5'>Nota Média Gerência avalia Competência Liderança: $media5</p>
              </div>
            </div>
      
            
            <p>Tania avalia Coordenadores. Quantidade de registros: $qtd5</p>
            
            <div class='progress'>
              <div class='progress-bar progress-bar-striped $bg5' role='progressbar' style='width: $media_graf5%' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100'></div>
            </div>
            
            <hr>
            ";
      
          } else { 
            echo 'Não há registros de Nota Média Gerência avalia Competência Liderança.';
            echo '<hr>';
          
          }
        }
      
      
          // Fim Nota Média Gerência avalia Competência Liderança

          //Inicio média total 
      
          $qt_media = (
            (isset($media1) && $media1 != 0 ? 1 : 0) +
            (isset($media2) && $media2 != 0 ? 1 : 0) +
            (isset($media3) && $media3 != 0 ? 1 : 0) +
            (isset($media4) && $media4 != 0 ? 1 : 0) +
            (isset($media5) && $media5 != 0 ? 1 : 0) +
            (isset($media6) && $media6 != 0 ? 1 : 0)
        );
        
        $qt_media;
                //-----------------------------------
            
// Definir a quantidade de médias válidas
$qt_media = (
  (isset($media1) && $media1 != '' ? 1 : 0) +
  (isset($media2) && $media2 != '' ? 1 : 0) +
  (isset($media3) && $media3 != '' ? 1 : 0) +
  (isset($media4) && $media4 != '' ? 1 : 0) +
  (isset($media5) && $media5 != '' ? 1 : 0) +
  (isset($media6) && $media6 != '' ? 1 : 0)
);

// Verificar se $qt_media é zero para evitar divisão por zero
if ($qt_media > 0) {
  // Calcular a média total
  $media_tt = (($media1 + $media2 + $media3 + $media4 + $media5 + $media6) / $qt_media);

  // Formatar a média para 1 casa decimal
  $media_tt_formatada = number_format($media_tt, 1);

  // Calcular a largura da barra de progresso
  $media_div = ($media_tt_formatada * 20);

  // Determinar a classe de fundo com base na média
  if (floor($media_tt_formatada) == 1) {
      $bgtt = "bg-danger";
  } else if (floor($media_tt_formatada) == 2) {
      $bgtt = "bg-warning";
  } else if (floor($media_tt_formatada) == 3) {
      $bgtt = "bg-info";
  } else if (floor($media_tt_formatada) == 4) {
      $bgtt = "";
  } else {
      $bgtt = "bg-success";
  }

  // Exibir os resultados
  echo "
  <div class='row'>
      <div class='col-8'>
          <p class='fs-5 fw-bold'>Média Total: $media_tt_formatada</p>
      </div>
      <div class='col-4'>
          <!-- Pode adicionar algo aqui, se necessário -->
      </div>
  </div>
  <div class='progress'>
      <div class='progress-bar progress-bar-striped $bgtt' role='progressbar' style='width: $media_div%' aria-valuenow='$media_div' aria-valuemin='0' aria-valuemax='100'></div>
  </div>
  <hr>";
} else {
  // Exibir mensagem ou valor padrão quando não há médias válidas
  echo "<hr class='mt-4'>
  <div class='row'>
      <div class='col-8'>
          <p class='fs-5 fw-bold'>Média Total: 0.0</p>
      </div>
      <div class='col-4'>
          <!-- Pode adicionar algo aqui, se necessário -->
      </div>
  </div>
  <div class='progress'>
      <div class='progress-bar progress-bar-striped bg-secondary' role='progressbar' style='width: 0%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>
  </div>
  <hr>";
}




?> 

<div class="container">
  <div class="row">
  <div class="col-sm">
    <?php
    // Definir a quantidade de médias válidas
    $qt_media = (
        (isset($media2) && $media2 != 0 ? 1 : 0) +
        (isset($media6) && $media6 != 0 ? 1 : 0)
    );

    // Verificar se $qt_media é maior que zero para evitar divisão por zero
    if ($qt_media > 0) {
        // Calcular a média total
        $media_tt = (($media2 + $media6) / $qt_media);

        // Formatar a média para 1 casa decimal
        $media_tt_formatada = number_format($media_tt, 1);

        // Calcular a largura da barra de progresso
        $media_div = ($media_tt_formatada * 20);

        // Determinar a classe de fundo com base na média
        if (floor($media_tt_formatada) == 1) {
            $bgtt = "bg-danger";
        } else if (floor($media_tt_formatada) == 2) {
            $bgtt = "bg-warning";
        } else if (floor($media_tt_formatada) == 3) {
            $bgtt = "bg-info";
        } else if (floor($media_tt_formatada) == 4) {
            $bgtt = "";
        } else {
            $bgtt = "bg-success";
        }

        // Exibir os resultados
        echo "
        <div class='row'>
            <div class='col-8'>
                <p class='fs-5 fw-bold'>Média Total<br> Coordenadores: $media_tt_formatada</p>
            </div>
            <div class='col-4'>
                <!-- Pode adicionar algo aqui, se necessário -->
            </div>
        </div>
        <div class='progress'>
            <div class='progress-bar progress-bar-striped $bgtt' role='progressbar' style='width: $media_div%' aria-valuenow='$media_div' aria-valuemin='0' aria-valuemax='100'></div>
        </div>
        ";
    } else {
        // Exibir mensagem ou valor padrão quando não há médias válidas
        echo "
        <div class='row'>
            <div class='col-8'>
                <p class='fs-5 fw-bold'>Média Total<br> Coordenadores: 0.0</p>
            </div>
            <div class='col-4'>
                <!-- Pode adicionar algo aqui, se necessário -->
            </div>
        </div>
        <div class='progress'>
            <div class='progress-bar progress-bar-striped bg-secondary' role='progressbar' style='width: 0%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>
        </div>
        ";
    }
    ?> 
</div>

<div class="col-sm">
    <?php
    // Definir a quantidade de médias válidas
    $qt_media = (
        (isset($media4) && $media4 != 0 ? 1 : 0) +
        (isset($media5) && $media5 != 0 ? 1 : 0)
    );

    // Verificar se $qt_media é maior que zero para evitar divisão por zero
    if ($qt_media > 0) {
        // Calcular a média total
        $media_tt = (($media4 + $media5) / $qt_media);

        // Formatar a média para 1 casa decimal
        $media_tt_formatada = number_format($media_tt, 1);

        // Calcular a largura da barra de progresso
        $media_div = ($media_tt_formatada * 20);

        // Determinar a classe de fundo com base na média
        if (floor($media_tt_formatada) == 1) {
            $bgtt = "bg-danger";
        } else if (floor($media_tt_formatada) == 2) {
            $bgtt = "bg-warning";
        } else if (floor($media_tt_formatada) == 3) {
            $bgtt = "bg-info";
        } else if (floor($media_tt_formatada) == 4) {
            $bgtt = "";
        } else {
            $bgtt = "bg-success";
        }

        // Exibir os resultados
        echo "
        <div class='row'>
            <div class='col-8'>
                <p class='fs-5 fw-bold'>Média Total<br> Gerente: $media_tt_formatada</p>
            </div>
            <div class='col-4'>
                <!-- Pode adicionar algo aqui, se necessário -->
            </div>
        </div>
        <div class='progress'>
            <div class='progress-bar progress-bar-striped $bgtt' role='progressbar' style='width: $media_div%' aria-valuenow='$media_div' aria-valuemin='0' aria-valuemax='100'></div>
        </div>
        ";
    } else {
        // Exibir mensagem ou valor padrão quando não há médias válidas
        echo "
        <div class='row'>
            <div class='col-8'>
                <p class='fs-5 fw-bold'>Média Total<br> Gerente: 0.0</p>
            </div>
            <div class='col-4'>
                <!-- Pode adicionar algo aqui, se necessário -->
            </div>
        </div>
        <div class='progress'>
            <div class='progress-bar progress-bar-striped bg-secondary' role='progressbar' style='width: 0%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>
        </div>
        ";
    }
    ?> 
</div>

  </div>
</div>



<hr>
</div>
       



</body>



<?php } else {
  header('Location: login.php');
} ?>