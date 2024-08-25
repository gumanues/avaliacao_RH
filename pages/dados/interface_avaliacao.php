<?php require_once('../../conexao.php'); 

session_start();
unset($_SESSION['usureferencia']);

if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

$login = $_SESSION['login'];
$id_setor = $_SESSION['setor'];
$ano_vigente = $_SESSION['ano_vigente'];
$id_login = $_SESSION['id'];

$usu_login_sql = "SELECT * FROM usuario where idusuario = $id_login";
$usu_login_query = mysqli_query($conexao, $usu_login_sql);

while ($usu_login_fetch = mysqli_fetch_assoc($usu_login_query)) {

$usu_login = $usu_login_fetch['nomecompleto'];
$lider = $usu_login_fetch['lider'];
}


$param_sql = "SELECT * FROM delega_acoes";
$param_query = mysqli_query($conexao, $param_sql);

while ($param_fetch = mysqli_fetch_assoc($param_query)) {
 $gerente = $param_fetch['gerente'];
 $terceiro = $param_fetch['terceiro'];
 $enfermagem = $param_fetch['enfermagem'];
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
    <link rel="stylesheet" type="text/css" href="../../css/style_perguntas.css">
  <title>Formulário de Desempenho</title>
  <link rel="icon" type="image/x-icon" href="../../img/pag.ico">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    for (var i = 1; i <= 10; i++) {
        $('#texto' + i).on('input', function() {
            validarTexto($(this));
        });
    }
});

function validarTexto(elemento) {
    elemento.val(elemento.val().replace(/'/g, '')); // Remover aspas simples
}
</script>

<body>

<div>
  


  <div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <?php 
        if ($lider == 2) {
           echo "<a class='navbar-brand' href='../avaliacoes/avaliacoes_gerencia.php'>Início</a>";
        } else {
           echo "<a class='navbar-brand' href='../avaliacoes/avaliacoes_coordenador.php'>Início</a>";
        }
        ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="../sair.php" >Sair</a>
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

  <!-- Envios -->

<div id="alertas">
      <?php if(isset($_GET['retorno'])==true && $_GET['retorno']==9){ ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>Formulário enviado com Sucesso!</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
<?php } ?>
</div>


<?php 



?>

  <div>
    <label class="fw-bold fs-3 d-flex justify-content-center py-3">Competências Avaliativas Liderança</label>
    <p class="text-body-secondary d-flex justify-content-center py-1">Gerência avalia Competência Liderança</p>
  </div>

  <div class="container py-2">
    <form action="avaliacao.php" method="post">
    <div>
    <input name="id_tipo" value="9" type="hidden" id="id_tipo" checked required>
    </div>
      <div class="mb-3">
        <label for="idusuario" class="form-label pt-3">Selecione o Usuário à ser Avaliado:</label>


          <select class="form-select" name="idusuario" id="idusuario" required>
          <option value=''>Selecione</option>  
          <?php  
          if ($lider == 2) {

            $lider_sql  = "
            AND NOT EXISTS (
            SELECT 1 
            FROM avaliacoes a 
            WHERE e.idusuario = a.idusuario and data = $ano_vigente and idsupervisor in ($gerente))";
          }
          if ($lider == 1) {

            $lider_sql = "
            AND (
                NOT EXISTS (
                    SELECT 1 
                    FROM avaliacoes a 
                    WHERE e.idusuario = a.idusuario 
                    AND data = '$ano_vigente' 
                    AND idsupervisor NOT IN ($gerente)
                    AND (idusuario = ($id_login) or idsupervisor != idusuario)
                    AND ((idusuario = ($id_login) or idsupervisor NOT IN ($enfermagem))  
                    or (idusuario NOT IN ($enfermagem) or idsupervisor = ($id_login)))
                )
            )";

          }

      

     
          $sql_usuario = "
          
          SELECT * 
          FROM usuario e
          where situacao = 1

          $lider_sql

          and (avaliador = $id_login or e.idusuario = $id_login) 
          and e.idusuario not in ($gerente,$terceiro)
         

          order by e.nomecompleto ASC
          
          ";
          // 1 = $lider Configurações da Gerência
          // 2 = $lider Configurações da Coordenadores
          $query_usuario = mysqli_query($conexao, $sql_usuario);
          
          while ($id_usu = mysqli_fetch_assoc($query_usuario)) {

          $idusuario = $id_usu['idusuario'];
          $nomecompleto = $id_usu['nomecompleto'];
          $setorid = $id_usu['setorid'];

        
          echo "<option value='$idusuario'>$nomecompleto</option>";
        
          }?>
        </select> <!-- aqui -->

    <?php 
}
?>

        <label for="idsupervisor" class="form-label pt-3">Selecione o Supervisor Imediato:</label>
        <select class="form-select" name="idsupervisor" id="idsupervisor">
          <?php  
          $sql_supervisor = "SELECT * FROM usuario where situacao = 1  and idusuario in($id_login) ";
          $fetch_supervisor = mysqli_query($conexao, $sql_supervisor);
          
          while ($id_sup = mysqli_fetch_assoc($fetch_supervisor)) {

          $idusuario = $id_sup['idusuario'];
          $nomecompleto = $id_sup['nomecompleto'];
          

          echo "<option value='$idusuario'>$nomecompleto</option>";
        
          }?>
        </select>
      </div>


      <div class="d-grid gap-2">
        <button class="btn btn-secondary" type="submit">Iniciar Avaliação</button>
      </div>
      <hr class="py-3">
    </form>
    </div>
    
      <?php