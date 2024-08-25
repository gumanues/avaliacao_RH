<?php require_once('../../conexao.php'); 

session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {

  //Testar Ainda, ERRO, Avaliação Jania

$id_login = $_SESSION['id'];
$login = $_SESSION['login'];
$id_setor = $_SESSION['setor'];
$idusuario = $_POST['idusuario'];
$idsupervisor = $_POST['idsupervisor'];
$ano_vigente = $_SESSION['ano_vigente'];


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


<style>
body {
  background: linear-gradient(to bottom, #f0fbfc, #d8f5f9);
}
</style>

<body>

  


  <div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
      <a class="navbar-brand" href="#" onclick="history.back(); return false;">Início</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link " type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"
                  href="#">Notas</a>
              </li>
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
<div class="container py-2">

<?php 


$delega_sql = "SELECT * FROM delega_acoes";
$delega_query = mysqli_query($conexao, $delega_sql);

while ($delega_acoes = mysqli_fetch_assoc($delega_query)) {

$idpergunta1 = $delega_acoes['pergunta1'];
$idpergunta2 = $delega_acoes['pergunta2'];
$delega_tipo2 = $delega_acoes['concede_usuario'];
$delega_tipo_array2 = explode(",", $delega_tipo2); 
$gerente = $delega_acoes['gerente'];
$delega_tipo_array = explode(",", $gerente);


if (in_array($id_login, $delega_tipo_array)) {

  echo "<div>
          <label class='fw-bold fs-3 d-flex justify-content-center py-3'>Competências Avaliativas Coordenadores</label>
          <p class='text-body-secondary d-flex justify-content-center py-1'>Gerência Avalia os Coordenadores</p>
        </div>";

} 
if (!in_array($id_login, $delega_tipo_array)) {

  echo "<div>
          <label class='fw-bold fs-3 d-flex justify-content-center py-3'>Competências Avaliativas Colaboradores</label>
          <p class='text-body-secondary d-flex justify-content-center py-1'>Coordenador Avalia os Colaboradores</p>
        </div>";

}

}
?>



  <form action='../../funcoes/envio_avaliacao.php' method='post'>
  <?php  

$sql_supervisor = "SELECT * FROM usuario where situacao = 1 and idusuario =  $idusuario";
          $fetch_supervisor = mysqli_query($conexao, $sql_supervisor);
          
          while ($id_sup = mysqli_fetch_assoc($fetch_supervisor)) {
          echo "<p class=' d-flex justify-content-center'>Avaliado(a): " . $nomecompleto = $id_sup['nomecompleto'] . "<p/>";
          $qt_emancipado = $id_sup['emancipado'];

          $sql_supervisor = "SELECT * FROM usuario where situacao = 1 and idusuario =  $idsupervisor";
          $fetch_supervisor = mysqli_query($conexao, $sql_supervisor);
          
          while ($id_sup = mysqli_fetch_assoc($fetch_supervisor)) {
          echo "<p class=' d-flex justify-content-center'>Avaliador(a): " . $nomecompleto = $id_sup['nomecompleto'] . "<p/>";
          }
          } 



$delega_sql = "SELECT * FROM delega_acoes";
$delega_query = mysqli_query($conexao, $delega_sql);

while ($delega_acoes = mysqli_fetch_assoc($delega_query)) {

$delega_tipo = $delega_acoes['gerente'];
$delega_tipo_array = explode(",", $delega_tipo);

}


if ($qt_emancipado <= 2 || $idusuario != $idsupervisor) {

?><div>
  <hr>
<p class="text-body-secondary d-flex justify-content-center py-1">Parte 1</p>
</div>
<?php 

$sql_col= "SELECT (
  IF(a.pergunta1 <> '', 1, 0) +
  IF(a.pergunta2 <> '', 1, 0) +
  IF(a.pergunta3 <> '', 1, 0) +
  IF(a.pergunta4 <> '', 1, 0) +
  IF(a.pergunta5 <> '', 1, 0) +
  IF(a.pergunta6 <> '', 1, 0) +
  IF(a.pergunta7 <> '', 1, 0) +
  IF(a.pergunta8 <> '', 1, 0) +
  IF(a.pergunta9 <> '', 1, 0) +
  IF(a.pergunta10 <> '', 1, 0)
) qt_col
FROM pergunta a
WHERE a.id = $idpergunta1
LIMIT 1
";
    
$col_query = mysqli_query($conexao, $sql_col);
while ($fetch_col = mysqli_fetch_assoc($col_query)) {

$quantidade = $fetch_col['qt_col']; 

}


$sql_perguntas = "SELECT * FROM pergunta a where a.id = $idpergunta1";
$id_perguntas = mysqli_query($conexao, $sql_perguntas);

while ($perguntas = mysqli_fetch_assoc($id_perguntas)) {

$pergunta1 = $perguntas['pergunta1'];
$pergunta2 = $perguntas['pergunta2'];
$pergunta3 = $perguntas['pergunta3'];
$pergunta4 = $perguntas['pergunta4'];
$pergunta5 = $perguntas['pergunta5'];
$pergunta6 = $perguntas['pergunta6'];
$pergunta7 = $perguntas['pergunta7'];
$pergunta8 = $perguntas['pergunta8'];
$pergunta9 = $perguntas['pergunta9'];
$pergunta10 = $perguntas['pergunta10'];



echo"
  
   <hr>
      <div>
        <div class='row text-start py-3'>
          <div class='pb-3'>
            <label class='fw-bold fs-3'>1. $pergunta1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota1' value='1' type='radio' class='btn-check' id='nota1'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota1'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota1' value='2' type='radio' class='btn-check' id='nota2'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota2'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota1' value='3' type='radio' class='btn-check' id='nota3'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota3'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota1' value='4' type='radio' class='btn-check' id='nota4'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota4'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota1' value='5' type='radio' class='btn-check' id='nota5'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota5'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto1' name='texto1' rows='2'></textarea>
               <div>
        </div>
      </div>
      <hr>
      <div>
        <div class='row text-start py-3'>
          <div class='pb-3'>
            <label class='fw-bold fs-3'>2. $pergunta2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota2' value='1' type='radio' class='btn-check' id='nota6'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota6'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota2' value='2' type='radio' class='btn-check' id='nota7'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota7'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota2' value='3' type='radio' class='btn-check' id='nota8'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota8'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota2' value='4' type='radio' class='btn-check' id='nota9'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota9'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota2' value='5' type='radio' class='btn-check'
              id='nota10' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota10'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto2' name='texto2' rows='2'></textarea>
               <div>
        </div>
      </div>
      <hr>
      <div>
        <div class='row text-start py-3'>
          <div class='pb-3'>
            <label class='fw-bold fs-3'>3. $pergunta3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota3' value='1' type='radio' class='btn-check'
              id='nota11' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota11'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota3' value='2' type='radio' class='btn-check'
              id='nota12' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota12'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota3' value='3' type='radio' class='btn-check'
              id='nota13' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota13'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota3' value='4' type='radio' class='btn-check'
              id='nota14' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota14'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota3' value='5' type='radio' class='btn-check'
              id='nota15' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota15'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto3' name='texto3' rows='2'></textarea>
               <div>
        </div>
      </div>
      <hr>
      <div>
        <div class='row text-start py-3'>
          <div class='pb-3'>
            <label class='fw-bold fs-3'>4. $pergunta4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota4' value='1' type='radio' class='btn-check'
              id='nota16' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota16'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota4' value='2' type='radio' class='btn-check'
              id='nota17' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota17'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota4' value='3' type='radio' class='btn-check'
              id='nota18' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota18'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota4' value='4' type='radio' class='btn-check'
              id='nota19' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota19'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota4' value='5' type='radio' class='btn-check'
              id='nota20' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota20'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto4' name='texto4' rows='2'></textarea>
               <div>
        </div>
      </div>
      <hr>";
      if($quantidade >= 5 && $quantidade <= 10) {
        echo "<div>
             <div class='row text-start py-3'>
               <div class='pb-3'>
                 <label class='fw-bold fs-3'>5. $pergunta5</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota5' value='1' type='radio' class='btn-check'
                   id='nota21' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota21'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota5' value='2' type='radio' class='btn-check'
                   id='nota22' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota22'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota5' value='3' type='radio' class='btn-check'
                   id='nota23' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota23'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota5' value='4' type='radio' class='btn-check'
                   id='nota24' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota24'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota5' value='5' type='radio' class='btn-check'
                   id='nota25' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota25'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto5' name='texto5' rows='2'></textarea>
               <div>
             </div>
           </div>
           <hr>";
     
     }
     if($quantidade >= 6 && $quantidade <= 10) {
       echo "<div>
             <div class='row text-start py-3'>
               <div class='pb-3'>
                 <label class='fw-bold fs-3'>6. $pergunta6</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota6' value='1' type='radio' class='btn-check'
                   id='nota26' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota26'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota6' value='2' type='radio' class='btn-check'
                   id='nota27' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota27'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota6' value='3' type='radio' class='btn-check'
                   id='nota28' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota28'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota6' value='4' type='radio' class='btn-check'
                   id='nota29' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota29'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota6' value='5' type='radio' class='btn-check'
                   id='nota30' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota30'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto6' name='texto6' rows='2'></textarea>
               <div>
             </div>
           </div>
           <hr>";
     
     
     }
     if($quantidade >= 7 && $quantidade <= 10) {
       echo "<div>
             <div class='row text-start py-3'>
               <div class='pb-3'>
                 <label class='fw-bold fs-3'>7. $pergunta7</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota7' value='1' type='radio' class='btn-check'
                   id='nota31' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota31'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota7' value='2' type='radio' class='btn-check'
                   id='nota32' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota32'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota7' value='3' type='radio' class='btn-check'
                   id='nota33' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota33'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota7' value='4' type='radio' class='btn-check'
                   id='nota34' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota34'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota7' value='5' type='radio' class='btn-check'
                   id='nota35' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota35'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto7' name='texto7' rows='2'></textarea>
               <div>
             </div>
           </div>
           <hr>";
     
     
     }
     if($quantidade >= 8 && $quantidade <= 10) {
       echo "<div>
             <div class='row text-start py-3'>
               <div class='pb-3'>
                 <label class='fw-bold fs-3'>8. $pergunta8</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota8' value='1' type='radio' class='btn-check'
                   id='nota36' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota36'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota8' value='2' type='radio' class='btn-check'
                   id='nota37' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota37'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota8' value='3' type='radio' class='btn-check'
                   id='nota38' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota38'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota8' value='4' type='radio' class='btn-check'
                   id='nota39' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota39'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota8' value='5' type='radio' class='btn-check'
                   id='nota40' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota40'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto8' name='texto8' rows='2'></textarea>
               <div>
             </div>
           </div>
           <hr>";
     
     }      
     if($quantidade >= 9 && $quantidade <= 10) {
         echo "<div>
               <div class='row text-start py-3'>
                 <div class='pb-3'>
                   <label class='fw-bold fs-3'>9. $pergunta9</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota9' value='1' type='radio' class='btn-check'
                     id='41' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='41'>1</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota9' value='2' type='radio' class='btn-check'
                     id='nota42' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota42'>2</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota9' value='3' type='radio' class='btn-check'
                     id='nota43' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota43'>3</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota9' value='4' type='radio' class='btn-check'
                     id='nota44' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota44'>4</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota9' value='5' type='radio' class='btn-check'
                     id='nota45' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota45'>5</label>
                 </div>
                 </div>
               <textarea class='form-control' id='texto9' name='texto9' rows='2'></textarea>
               <div>
               </div>
             </div>
             <hr>";
     }
     if($quantidade >= 10 && $quantidade <= 10) {
             
       echo  "<div>
               <div class='row text-start py-3'>
                 <div class='pb-3'>
                   <label class='fw-bold fs-3'>10. $pergunta10</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota10' value='1' type='radio' class='btn-check'
                     id='nota46' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota46'>1</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota10' value='2' type='radio' class='btn-check'
                     id='nota47' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota47'>2</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota10' value='3' type='radio' class='btn-check'
                     id='nota48' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota48'>3</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota10' value='4' type='radio' class='btn-check'
                     id='nota49' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota49'>4</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota10' value='5' type='radio' class='btn-check'
                     id='nota50' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota50'>5</label>
                 </div>
                 </div>
               <textarea class='form-control' id='texto10' name='texto10' rows='2'></textarea>
               <div>
               </div>
             </div>
             <hr>
             ";

     }
     }
     ?> <input type='hidden' name='idpergunta1' value='<?=$idpergunta1?>'> <?php
     } //qt_perguntas PERGUNTAS 1
    

   
if ($qt_emancipado == 2) {
   
  ?><div>
    <p class="text-body-secondary d-flex justify-content-center pt-4">Parte 2</p>
    </div>
  <?php 
    

$sql_col= "SELECT (
  IF(a.pergunta1 <> '', 1, 0) +
  IF(a.pergunta2 <> '', 1, 0) +
  IF(a.pergunta3 <> '', 1, 0) +
  IF(a.pergunta4 <> '', 1, 0) +
  IF(a.pergunta5 <> '', 1, 0) +
  IF(a.pergunta6 <> '', 1, 0) +
  IF(a.pergunta7 <> '', 1, 0) +
  IF(a.pergunta8 <> '', 1, 0) +
  IF(a.pergunta9 <> '', 1, 0) +
  IF(a.pergunta10 <> '', 1, 0)
) qt_col
FROM pergunta a
WHERE a.id = $idpergunta2
LIMIT 1
";
    
$col_query = mysqli_query($conexao, $sql_col);
while ($fetch_col = mysqli_fetch_assoc($col_query)) {

$quantidade = $fetch_col['qt_col']; 

}


$sql_perguntas = "SELECT * FROM pergunta a where a.id = $idpergunta2";
$id_perguntas = mysqli_query($conexao, $sql_perguntas);

while ($perguntas = mysqli_fetch_assoc($id_perguntas)) {

$pergunta1 = $perguntas['pergunta1'];
$pergunta2 = $perguntas['pergunta2'];
$pergunta3 = $perguntas['pergunta3'];
$pergunta4 = $perguntas['pergunta4'];
$pergunta5 = $perguntas['pergunta5'];
$pergunta6 = $perguntas['pergunta6'];
$pergunta7 = $perguntas['pergunta7'];
$pergunta8 = $perguntas['pergunta8'];
$pergunta9 = $perguntas['pergunta9'];
$pergunta10 = $perguntas['pergunta10'];


echo" <div class='container py-2'>
      <hr>
      <div>
        <div class='row text-start py-3'>
          <div class='pb-3'>
            <label class='fw-bold fs-3'>1. $pergunta1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota11' value='1' type='radio' class='btn-check' id='nota51'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota51'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota11' value='2' type='radio' class='btn-check' id='nota52'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota52'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota11' value='3' type='radio' class='btn-check' id='nota53'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota53'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota11' value='4' type='radio' class='btn-check' id='nota54'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota54'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota11' value='5' type='radio' class='btn-check' id='nota55'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota55'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto11' name='texto11' rows='2'></textarea>
               <div>
        </div>
      </div>
      <hr>
      <div>
        <div class='row text-start py-3'>
          <div class='pb-3'>
            <label class='fw-bold fs-3'>2. $pergunta2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota12' value='1' type='radio' class='btn-check' id='nota56'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota56'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota12' value='2' type='radio' class='btn-check' id='nota57'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota57'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota12' value='3' type='radio' class='btn-check' id='nota58'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota58'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota12' value='4' type='radio' class='btn-check' id='nota59'
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota59'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota12' value='5' type='radio' class='btn-check' id='nota60' 
              autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota60'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto12' name='texto12' rows='2'></textarea>
               <div>
        </div>
      </div>
      <hr>
      <div>
        <div class='row text-start py-3'>
          <div class='pb-3'>
            <label class='fw-bold fs-3'>3. $pergunta3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota13' value='1' type='radio' class='btn-check'
              id='nota61' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota61'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota13' value='2' type='radio' class='btn-check'
              id='nota62' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota62'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota13' value='3' type='radio' class='btn-check'
              id='nota63' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota63'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota13' value='4' type='radio' class='btn-check'
              id='nota64' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota64'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota13' value='5' type='radio' class='btn-check'
              id='nota65' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota65'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto13' name='texto13' rows='2'></textarea>
               <div>
        </div>
      </div>
      <hr>
      <div>
        <div class='row text-start py-3'>
          <div class='pb-3'>
            <label class='fw-bold fs-3'>4. $pergunta4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota14' value='1' type='radio' class='btn-check'
              id='nota66' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota66'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota14' value='2' type='radio' class='btn-check'
              id='nota67' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota67'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota14' value='3' type='radio' class='btn-check'
              id='nota68' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota68'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota14' value='4' type='radio' class='btn-check'
              id='nota69' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota69'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota14' value='5' type='radio' class='btn-check'
              id='nota70' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota70'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto14' name='texto14' rows='2'></textarea>
               <div>
        </div>
      </div>
      <hr>";
      if($quantidade >= 5 && $quantidade <= 10) {
        echo "<div>
             <div class='row text-start py-3'>
               <div class='pb-3'>
                 <label class='fw-bold fs-3'>5. $pergunta5</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota15' value='1' type='radio' class='btn-check'
                   id='nota71' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota71'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota15' value='2' type='radio' class='btn-check'
                   id='nota72' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota72'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota15' value='3' type='radio' class='btn-check'
                   id='nota73' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota73'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota15' value='4' type='radio' class='btn-check'
                   id='nota74' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota74'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota15' value='5' type='radio' class='btn-check'
                   id='nota75' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota75'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto15' name='texto15' rows='2'></textarea>
               <div>
             </div>
           </div>
           <hr>";
     
     }
     if($quantidade >= 6 && $quantidade <= 10) {
       echo "<div>
             <div class='row text-start py-3'>
               <div class='pb-3'>
                 <label class='fw-bold fs-3'>6. $pergunta6</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota16' value='1' type='radio' class='btn-check'
                   id='nota76' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota76'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota16' value='2' type='radio' class='btn-check'
                   id='nota77' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota77'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota16' value='3' type='radio' class='btn-check'
                   id='nota78' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota78'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota16' value='4' type='radio' class='btn-check'
                   id='nota79' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota79'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota16' value='5' type='radio' class='btn-check'
                   id='nota80' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota80'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto16' name='texto16' rows='2'></textarea>
               <div>
             </div>
           </div>
           <hr>";
     
     
     }
     if($quantidade >= 7 && $quantidade <= 10) {
       echo "<div>
             <div class='row text-start py-3'>
               <div class='pb-3'>
                 <label class='fw-bold fs-3'>7. $pergunta7</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota17' value='1' type='radio' class='btn-check'
                   id='nota81' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota81'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota17' value='2' type='radio' class='btn-check'
                   id='nota82' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota82'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota17' value='3' type='radio' class='btn-check'
                   id='nota83' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota83'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota17' value='4' type='radio' class='btn-check'
                   id='nota84' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota84'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota17' value='5' type='radio' class='btn-check'
                   id='nota85' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota85'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto17' name='texto17' rows='2'></textarea>
               <div>
             </div>
           </div>
           <hr>";
     
     
     }
     if($quantidade >= 8 && $quantidade <= 10) {
       echo "<div>
             <div class='row text-start py-3'>
               <div class='pb-3'>
                 <label class='fw-bold fs-3'>8. $pergunta8</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota18' value='1' type='radio' class='btn-check'
                   id='nota86' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota86'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota18' value='2' type='radio' class='btn-check'
                   id='nota87' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota87'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota18' value='3' type='radio' class='btn-check'
                   id='nota88' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota88'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota18' value='4' type='radio' class='btn-check'
                   id='nota89' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota89'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota18' value='5' type='radio' class='btn-check'
                   id='nota90' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota90'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto18' name='texto18' rows='2'></textarea>
               <div>
             </div>
           </div>
           <hr>";
     
     }      
     if($quantidade >= 9 && $quantidade <= 10) {
         echo "<div>
               <div class='row text-start py-3'>
                 <div class='pb-3'>
                   <label class='fw-bold fs-3'>9. $pergunta9</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota19' value='1' type='radio' class='btn-check'
                     id='nota91' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota91'>1</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota19' value='2' type='radio' class='btn-check'
                     id='nota92' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota92'>2</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota19' value='3' type='radio' class='btn-check'
                     id='nota93' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota93'>3</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota19' value='4' type='radio' class='btn-check'
                     id='nota94' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota94'>4</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota19' value='5' type='radio' class='btn-check'
                     id='nota95' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota95'>5</label>
                 </div>
                 </div>
               <textarea class='form-control' id='texto19' name='texto19' rows='2'></textarea>
               <div>
               </div>
             </div>
             <hr>";
     }
     if($quantidade >= 10 && $quantidade <= 10) {
             
       echo  "<div>
               <div class='row text-start py-3'>
                 <div class='pb-3'>
                   <label class='fw-bold fs-3'>10. $pergunta10</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota20' value='1' type='radio' class='btn-check'
                     id='nota96' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota96'>1</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota20' value='2' type='radio' class='btn-check'
                     id='nota97' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota97'>2</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota20' value='3' type='radio' class='btn-check'
                     id='nota98' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota98'>3</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota20' value='4' type='radio' class='btn-check'
                     id='nota99' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota99'>4</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota20' value='5' type='radio' class='btn-check'
                     id='nota100' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota100'>5</label>
                 </div>
                 </div>
               <textarea class='form-control' id='texto10' name='texto10' rows='2'></textarea>
               <div>
               </div>
             </div>     
             <hr>
             ";
     }
     }
     ?> <input type='hidden' name='idpergunta2' value='<?=$idpergunta2?>'> <?php
     }//qt_perguntas PERGUNTAS 2
     ?>
          <input type="hidden" name='idusuario' value="<?=$idusuario?>">
          <div class='d-grid gap-2'>
          <button class='btn btn-secondary' type='submit'>Enviar</button>
              </div>
              <hr class='py-3'>
            </form>
          </div>

            




    <!-- Modal Notas-->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Peso das Notas</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img class="card-img-top" src="../../img/avaliacao.png" width="600" height="200" alt="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <a class="nav-link " type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"
target="_blank"
style="position:fixed;bottom:20px;right:30px;">
<svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16" style="opacity: 0.5;">
  <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg>

</a>



      <!-- Modal Avaliações-->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Avaliação</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
      <?php
        $notas = "

        SELECT 
        id, nota1, nota2, nota3, nota4, nota5, nota6, nota7, nota8, nota9, nota10, setor, data, lider, idsupervisor, setorsupervisor, lidersupervisor, idusuario, idpergunta,
        texto1, texto2, texto3 , texto4 , texto5 , texto6 , texto7 , texto8 , texto9 , texto10
        FROM avaliacoes a
        WHERE idusuario = $idusuario and data = $ano_vigente order by idpergunta
    ";

    $nota_find = mysqli_query($conexao, $notas);
    $nota_tt_total2 = 0;
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
            if($idsupervisor == $idusuario_a && ($lider == 0 ||  in_array($idusuario, $delega_tipo_array2))){
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
          $pergunta1 = $perguntas['pergunta1'];
          $pergunta2 = $perguntas['pergunta2'];
          $pergunta3 = $perguntas['pergunta3'];
          $pergunta4 = $perguntas['pergunta4'];
          $pergunta5 = $perguntas['pergunta5'];
          $pergunta6 = $perguntas['pergunta6'];
          $pergunta7 = $perguntas['pergunta7'];
          $pergunta8 = $perguntas['pergunta8'];
          $pergunta9 = $perguntas['pergunta9'];
          $pergunta10 = $perguntas['pergunta10'];
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
            <p class='fw-bold'>Período a avaliar: $ano_vigente</p>
            <hr>
            <p class='text-decoration-underline' style='display: inline;'>1. $pergunta1</p>
            <p class='fw-bold' style='display: inline;'>$nota1</p>
            <p class='text-body-secondary fst-italic'>$texto1</p>
            <hr>
            <p class='text-decoration-underline' style='display: inline;'>2. $pergunta2</p>
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
            if($pergunta10 != "" && $quantidade <= 10) {
        echo "<p class='text-decoration-underline' style='display: inline;'>10. $pergunta10</p>
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
      SELECT COUNT(*) AS qt_total FROM avaliacoes WHERE idusuario = $idusuario AND data = $ano_vigente
      ) AS subquery
      ";

      $qt_perguntas_query = mysqli_query($conexao, $qt_perguntas_sql);

      if ($qt_perguntas_query) {
      $qt_perguntas_assoc = mysqli_fetch_assoc($qt_perguntas_query);
      $qt_contas = $qt_perguntas_assoc['qt_contas']; 
      } 

      $nota_tt_total2 += $nota_tt/$qt_contas;         
}    
}  
echo "<p class='fw-bold fs-5 text-center'>A Média do Avaliado é: $nota_tt_total2</p>";
} else {
    $idsupervisor = 0;
    $idusuario_a = 0;
    echo "Não há registros para esta data.";
}

      ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>



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

