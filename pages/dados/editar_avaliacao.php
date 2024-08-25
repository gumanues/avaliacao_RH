<?php require_once('../../conexao.php'); 

session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {


$id_login = $_SESSION['id'];
$login = $_SESSION['login'];
$id_setor = $_SESSION['setor'];
$ano_vigente = $_SESSION['ano_vigente'];
    

$usu_login_sql = "SELECT * FROM usuario where idusuario = $id_login";
$usu_login_query = mysqli_query($conexao, $usu_login_sql);

while ($usu_login_fetch = mysqli_fetch_assoc($usu_login_query)) {
$usu_login = $usu_login_fetch['nomecompleto'];
$id_lider = $usu_login_fetch['lider'];

}

$id_avaliacao = $_POST['id_quest'];

$notas = "

SELECT 
id, nota1, nota2, nota3, nota4, nota5, nota6, nota7, nota8, nota9, nota10, setor, data, lider, idsupervisor, setorsupervisor, lidersupervisor, idusuario, idpergunta,
texto1, texto2, texto3 , texto4 , texto5 , texto6 , texto7 , texto8 , texto9 , texto10
FROM avaliacoes a
WHERE id = $id_avaliacao
";


$nota_find = mysqli_query($conexao, $notas);
$nota_tt_total = 0;
if (mysqli_num_rows($nota_find) > 0) {
    while ($id_nota = mysqli_fetch_assoc($nota_find)) {
        if ($id_nota['nota1'] == 1) {

            $nota1_1 = 'checked';
        } else {$nota1_1 = ' ';}
         if ($id_nota['nota1'] == 2) {

            $nota1_2 = 'checked';
        } else {$nota1_2 = ' ';}
        if ($id_nota['nota1'] == 3) {

            $nota1_3 = 'checked';
        } else {$nota1_3 = ' ';}
        if ($id_nota['nota1'] == 4) {

            $nota1_4 = 'checked';
        } else {$nota1_4 = ' ';}
        if ($id_nota['nota1'] == 5) {

            $nota1_5 = 'checked';
        } else {$nota1_5 = ' ';}


        if ($id_nota['nota2'] == 1) {

            $nota2_1 = 'checked';
        } else {$nota2_1 = ' ';}
         if ($id_nota['nota2'] == 2) {

            $nota2_2 = 'checked';
        } else {$nota2_2 = ' ';}
        if ($id_nota['nota2'] == 3) {

            $nota2_3 = 'checked';
        } else {$nota2_3 = ' ';}
        if ($id_nota['nota2'] == 4) {

            $nota2_4 = 'checked';
        } else {$nota2_4 = ' ';}
        if ($id_nota['nota2'] == 5) {

            $nota2_5 = 'checked';
        } else {$nota2_5 = ' ';}


        if ($id_nota['nota3'] == 1) {

            $nota3_1 = 'checked';
        } else {$nota3_1 = ' ';}
         if ($id_nota['nota3'] == 2) {

            $nota3_2 = 'checked';
        } else {$nota3_2 = ' ';}
        if ($id_nota['nota3'] == 3) {

            $nota3_3 = 'checked';
        } else {$nota3_3 = ' ';}
        if ($id_nota['nota3'] == 4) {

            $nota3_4 = 'checked';
        } else {$nota3_4 = ' ';}
        if ($id_nota['nota3'] == 5) {

            $nota3_5 = 'checked';
        } else {$nota3_5 = ' ';}


        if ($id_nota['nota4'] == 1) {

            $nota4_1 = 'checked';
        } else {$nota4_1 = ' ';}
         if ($id_nota['nota4'] == 2) {

            $nota4_2 = 'checked';
        } else {$nota4_2 = ' ';}
        if ($id_nota['nota4'] == 3) {

            $nota4_3 = 'checked';
        } else {$nota4_3 = ' ';}
        if ($id_nota['nota4'] == 4) {

            $nota4_4 = 'checked';
        } else {$nota4_4 = ' ';}
        if ($id_nota['nota4'] == 5) {

            $nota4_5 = 'checked';
        } else {$nota4_5 = ' ';}


        if ($id_nota['nota5'] == 1) {

            $nota5_1 = 'checked';
        } else {$nota5_1 = ' ';}
         if ($id_nota['nota5'] == 2) {

            $nota5_2 = 'checked';
        } else {$nota5_2 = ' ';}
        if ($id_nota['nota5'] == 3) {

            $nota5_3 = 'checked';
        } else {$nota5_3 = ' ';}
        if ($id_nota['nota5'] == 4) {

            $nota5_4 = 'checked';
        } else {$nota5_4 = ' ';}
        if ($id_nota['nota5'] == 5) {

            $nota5_5 = 'checked';
        } else {$nota5_5 = ' ';}


        if ($id_nota['nota6'] == 1) {

            $nota6_1 = 'checked';
        } else {$nota6_1 = ' ';}
         if ($id_nota['nota6'] == 2) {

            $nota6_2 = 'checked';
        } else {$nota6_2 = ' ';}
        if ($id_nota['nota6'] == 3) {

            $nota6_3 = 'checked';
        } else {$nota6_3 = ' ';}
        if ($id_nota['nota6'] == 4) {

            $nota6_4 = 'checked';
        } else {$nota6_4 = ' ';}
        if ($id_nota['nota6'] == 5) {

            $nota6_5 = 'checked';
        } else {$nota6_5 = ' ';}


        if ($id_nota['nota7'] == 1) {

            $nota7_1 = 'checked';
        } else {$nota7_1 = ' ';}
         if ($id_nota['nota7'] == 2) {

            $nota7_2 = 'checked';
        } else {$nota7_2 = ' ';}
        if ($id_nota['nota7'] == 3) {

            $nota7_3 = 'checked';
        } else {$nota7_3 = ' ';}
        if ($id_nota['nota7'] == 4) {

            $nota7_4 = 'checked';
        } else {$nota7_4 = ' ';}
        if ($id_nota['nota7'] == 5) {

            $nota7_5 = 'checked';
        } else {$nota7_5 = ' ';}


        if ($id_nota['nota8'] == 1) {

            $nota8_1 = 'checked';
        } else {$nota8_1 = ' ';}
         if ($id_nota['nota8'] == 2) {

            $nota8_2 = 'checked';
        } else {$nota8_2 = ' ';}
        if ($id_nota['nota8'] == 3) {

            $nota8_3 = 'checked';
        } else {$nota8_3 = ' ';}
        if ($id_nota['nota8'] == 4) {

            $nota8_4 = 'checked';
        } else {$nota8_4 = ' ';}
        if ($id_nota['nota8'] == 5) {

            $nota8_5 = 'checked';
        } else {$nota8_5 = ' ';}


        if ($id_nota['nota9'] == 1) {

            $nota9_1 = 'checked';
        } else {$nota9_1 = ' ';}
         if ($id_nota['nota9'] == 2) {

            $nota9_2 = 'checked';
        } else {$nota9_2 = ' ';}
        if ($id_nota['nota9'] == 3) {

            $nota9_3 = 'checked';
        } else {$nota9_3 = ' ';}
        if ($id_nota['nota9'] == 4) {

            $nota9_4 = 'checked';
        } else {$nota9_4 = ' ';}
        if ($id_nota['nota9'] == 5) {

            $nota9_5 = 'checked';
        } else {$nota9_5 = ' ';}


        if ($id_nota['nota10'] == 1) {

            $nota10_1 = 'checked';
        } else {$nota10_1 = ' ';}
         if ($id_nota['nota10'] == 2) {

            $nota10_2 = 'checked';
        } else {$nota10_2 = ' ';}
        if ($id_nota['nota10'] == 3) {

            $nota10_3 = 'checked';
        } else {$nota10_3 = ' ';}
        if ($id_nota['nota10'] == 4) {

            $nota10_4 = 'checked';
        } else {$nota10_4 = ' ';}
        if ($id_nota['nota10'] == 5) {

            $nota10_5 = 'checked';
        } else {$nota10_5 = ' ';}


      
        $texto1 = $id_nota['texto1'];
        if (!empty($texto1)) {
          $texto1 = $texto1;
        }
        $texto2 = $id_nota['texto2'];
        if (!empty($texto2)) {
          $texto2 = $texto2;
        }
        $texto3 = $id_nota['texto3'];
        if (!empty($texto3)) {
          $texto3 = $texto3;
        }
        $texto4 = $id_nota['texto4'];
        if (!empty($texto4)) {
          $texto4 = $texto4;
        }
        $texto5 = $id_nota['texto5'];
        if (!empty($texto5)) {
          $texto5 = $texto5;
        }
        $texto6 = $id_nota['texto6'];
        if (!empty($texto6)) {
          $texto6 = $texto6;
        }
        $texto7 = $id_nota['texto7'];
        if (!empty($texto7)) {
          $texto7 = $texto7;
        }
        $texto8 = $id_nota['texto8'];
        if (!empty($texto8)) {
          $texto8 = $texto8;
        }
        $texto9 = $id_nota['texto9'];
        if (!empty($texto9)) {
          $texto9 = $texto9;
        }
        $texto10 = $id_nota['texto10'];
        if (!empty($texto10)) {
          $texto10 = $texto10;
        }
        $idsupervisor = $id_nota['idsupervisor'];
        $lider = $id_nota['lider'];
        $lidersupervisor = $id_nota['lidersupervisor'];
        $idusuario = $id_nota['idusuario'];
        $id_pergunta = $id_nota['idpergunta'];
        $data = date('Y', strtotime(str_replace("/", "-", $id_nota["data"])));
        $id_usuario_destino = $id_nota['idusuario'];
}
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
      <?php 
        if ($id_lider == 2) {
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


  echo "<div>
          <label class='fw-bold fs-3 d-flex justify-content-center py-3'>Editor de Avaliações</label>
        </div>";



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

    if ($idsupervisor != $idusuario){
    ?>
        <form action='../../funcoes/editar_avaliacao.php' method='post'>
        <?php  

$delega_sql = "SELECT * FROM delega_acoes";
$delega_query = mysqli_query($conexao, $delega_sql);

while ($delega_acoes = mysqli_fetch_assoc($delega_query)) {

$delega_tipo = $delega_acoes['gerente'];
$delega_tipo_array = explode(",", $delega_tipo);

}




?>
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
WHERE a.id = $id_pergunta
LIMIT 1
";
    
$col_query = mysqli_query($conexao, $sql_col);
while ($fetch_col = mysqli_fetch_assoc($col_query)) {

$quantidade = $fetch_col['qt_col']; 

}


$sql_perguntas = "SELECT * FROM pergunta a where a.id = $id_pergunta";
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
            $nota1_1 autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota1'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota1' value='2' type='radio' class='btn-check' id='nota2' 
            $nota1_2 autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota2'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota1' value='3' type='radio' class='btn-check' id='nota3' 
            $nota1_3 autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota3'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota1' value='4' type='radio' class='btn-check' id='nota4' 
            $nota1_4 autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota4'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota1' value='5' type='radio' class='btn-check' id='nota5' 
            $nota1_5 autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota5'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto1' name='texto1' rows='2'>$texto1</textarea>
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
            $nota2_1 autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota6'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota2' value='2' type='radio' class='btn-check' id='nota7'
            $nota2_2 autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota7'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota2' value='3' type='radio' class='btn-check' id='nota8'
            $nota2_3 autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota8'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota2' value='4' type='radio' class='btn-check' id='nota9'
            $nota2_4 autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota9'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota2' value='5' type='radio' class='btn-check'
            $nota2_5   id='nota10' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota10'>5</label>
          </div>
          </div>
              <textarea class='form-control' id='texto2' name='texto2' rows='2'>$texto2</textarea>
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
           $nota3_1   id='nota11' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota11'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota3' value='2' type='radio' class='btn-check'
           $nota3_2   id='nota12' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota12'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota3' value='3' type='radio' class='btn-check'
           $nota3_3   id='nota13' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota13'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota3' value='4' type='radio' class='btn-check'
           $nota3_4   id='nota14' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota14'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota3' value='5' type='radio' class='btn-check'
           $nota3_5   id='nota15' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota15'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto3' name='texto3' rows='2'>$texto3</textarea>
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
           $nota4_1   id='nota16' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota16'>1</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota4' value='2' type='radio' class='btn-check'
           $nota4_2   id='nota17' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota17'>2</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota4' value='3' type='radio' class='btn-check'
           $nota4_3   id='nota18' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota18'>3</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota4' value='4' type='radio' class='btn-check'
           $nota4_4   id='nota19' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota19'>4</label>
          </div>
          <div class='col d-grid gap-2'>
            <input name='nota4' value='5' type='radio' class='btn-check'
           $nota4_5   id='nota20' autocomplete='off' required>
            <label class='btn btn-outline-secondary btn-lg' for='nota20'>5</label>
          </div>
          </div>
               <textarea class='form-control' id='texto4' name='texto4' rows='2'>$texto4</textarea>
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
           $nota5_1        id='nota21' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota21'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota5' value='2' type='radio' class='btn-check'
           $nota5_2        id='nota22' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota22'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota5' value='3' type='radio' class='btn-check'
           $nota5_3       id='nota23' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota23'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota5' value='4' type='radio' class='btn-check'
           $nota5_4        id='nota24' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota24'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota5' value='5' type='radio' class='btn-check'
           $nota5_5        id='nota25' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota25'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto5' name='texto5' rows='2'>$texto5</textarea>
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
           $nota6_1        id='nota26' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota26'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota6' value='2' type='radio' class='btn-check'
           $nota6_2        id='nota27' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota27'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota6' value='3' type='radio' class='btn-check'
           $nota6_3        id='nota28' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota28'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota6' value='4' type='radio' class='btn-check'
           $nota6_4        id='nota29' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota29'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota6' value='5' type='radio' class='btn-check'
           $nota6_5        id='nota30' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota30'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto6' name='texto6' rows='2'>$texto6</textarea>
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
           $nota7_1        id='nota31' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota31'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota7' value='2' type='radio' class='btn-check'
           $nota7_2        id='nota32' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota32'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota7' value='3' type='radio' class='btn-check'
           $nota7_3        id='nota33' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota33'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota7' value='4' type='radio' class='btn-check'
           $nota7_4        id='nota34' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota34'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota7' value='5' type='radio' class='btn-check'
           $nota7_5        id='nota35' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota35'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto7' name='texto7' rows='2'>$texto7</textarea>
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
           $nota8_1        id='nota36' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota36'>1</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota8' value='2' type='radio' class='btn-check'
           $nota8_2        id='nota37' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota37'>2</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota8' value='3' type='radio' class='btn-check'
           $nota8_3        id='nota38' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota38'>3</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota8' value='4' type='radio' class='btn-check'
           $nota8_4        id='nota39' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota39'>4</label>
               </div>
               <div class='col d-grid gap-2'>
                 <input name='nota8' value='5' type='radio' class='btn-check'
           $nota8_5        id='nota40' autocomplete='off' required>
                 <label class='btn btn-outline-secondary btn-lg' for='nota40'>5</label>
               </div>
               </div>
               <textarea class='form-control' id='texto8' name='texto8' rows='2'>$texto8</textarea>
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
           $nota9_1          id='41' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='41'>1</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota9' value='2' type='radio' class='btn-check'
           $nota9_2          id='nota42' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota42'>2</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota9' value='3' type='radio' class='btn-check'
           $nota9_3          id='nota43' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota43'>3</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota9' value='4' type='radio' class='btn-check'
           $nota9_4          id='nota44' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota44'>4</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota9' value='5' type='radio' class='btn-check'
           $nota9_5           id='nota45' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota45'>5</label>
                 </div>
                 </div>
               <textarea class='form-control' id='texto9' name='texto9' rows='2'>$texto9</textarea>
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
           $nota10_1          id='nota46' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota46'>1</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota10' value='2' type='radio' class='btn-check'
           $nota10_2          id='nota47' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota47'>2</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota10' value='3' type='radio' class='btn-check'
           $nota10_3          id='nota48' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota48'>3</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota10' value='4' type='radio' class='btn-check'
           $nota10_4          id='nota49' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota49'>4</label>
                 </div>
                 <div class='col d-grid gap-2'>
                   <input name='nota10' value='5' type='radio' class='btn-check'
           $nota10_5          id='nota50' autocomplete='off' required>
                   <label class='btn btn-outline-secondary btn-lg' for='nota50'>5</label>
                 </div>
                 </div>
               <textarea class='form-control' id='texto10' name='texto10' rows='2'>$texto10</textarea>
               <div>
               </div>
             </div>
             ";
            }
        }?> 
     <input type='hidden' name='id_avaliacao' value='<?=$_POST['id_quest']?>'>  
     <input type='hidden' name='id_pergunta' value='<?=$id_pergunta?>'>
     <input type='hidden' name='idusuario' value='<?=$idusuario?>'>
     <?php

     ?>
   
          <input type="hidden" name='idusuario' value="<?=$idusuario?>">
          <div class='d-grid gap-2'>
          <button class='btn btn-secondary' type='submit'>Enviar</button>
              </div>
              <hr class='py-3'>
            </form>
<?php

}
?>
<hr>

            <div class='d-grid gap-2'>
                <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#staticBackdrop8'>Excluir</button>
            </div>
 
          </div>
<hr>
 
          <div class="modal fade" id="staticBackdrop8" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
      <form action='../../funcoes/deleta_avaliacao.php' method='post'>
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Atenção!</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <h1>Tem certeza que deseja excluir este registro?</h1>
            <input type='hidden' name='id_pergunta' value='<?=$id_pergunta?>'>
            <input type='hidden' name='idusuario' value='<?=$idusuario?>'>
            <input type='hidden' name='lidersupervisor' value='<?=$lidersupervisor?>'>
            <input type='hidden' name='lider' value='<?=$lider?>'>
            <input class='form-check-input' type='hidden' name='id_avaliacao' value='<?=$_POST['id_quest']?>' id='id_avaliacao'>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
              <button type="submit" class="btn btn-danger">Sim</button>
            </div>
          </div>
        </form>
      </div>
    </div>



    <!-- Modal Modifica ano -->






</body>


          
            




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

