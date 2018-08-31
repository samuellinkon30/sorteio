<!DOCTYPE html>
<?php
include 'connection.php';
session_start();
if(isset($_GET['deslogar']) || !isset($_SESSION['id'])){
  session_destroy();
  header("location:index.php");
}
$id_sorteio = $_SESSION['id'];
$sql = "SELECT codigo_sorteio FROM dados_sorteio WHERE usuario_id = ".$_SESSION['id'];
$participa = false;
$codigo_sorteio = "";
$result = $conexao->query($sql);
$row = $result->fetch_assoc();
if($row) {
  $participa = true;
  $codigo_sorteio = $row['codigo_sorteio'];
}
?>
<html lang= "pt-br">
<head>
  <meta charset="utf-8">
  <title>Usuário</title>
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="cliente.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <body>

    <?php
    include 'sidebar.php';
    ?>
  <div class="card-deck">
  <div class="card shadow-lg">
    <div class="card-sm-header bg-warning" align="center">
      <h2>Dados pessoais</h2>
    </div>
    <div class="card-body" align="center">
      <h4 class="card-text card-title"><b>Bem-vindo, <?php echo $nome ;?></b></h4>
      <h4><b> CPF: <?php echo $cpf ?> </b></h4>
      <h4><b> Número do Sorteio: <?php if($participa){
        echo  $codigo_sorteio ;
      } else {
        echo "<br><br><p><a href='gerarnumero.php'>Clique aqui para participar do sorteio</a></p>";
      } ?> </b></h4>
      <br>
      <?php if($participa) {?>
      <a href="#" onclick="window.open('impressao.php')" class="btn btn-md btn-primary"><b>Imprimir</b></a>
      <?php } ?>
    </div>
  </div>
  <div class="card shadow-lg">
    <div class="card-sm-header bg-warning" align="center">
      <h2>Ganhadores do Mês</h2>
    </div>
    <div class="card-body">
    <center>
      <a href="historico.php?mes=1" class="btn mes btn-md btn-primary"><b>Janeiro</b></a>
      <a href="historico.php?mes=2" class="btn mes btn-md btn-primary"><b>Fevereiro</b></a>
      <a href="historico.php?mes=3" class="btn mes btn-md btn-primary"><b>Março</b></a>
      <a href="historico.php?mes=4" class="btn mes btn-md btn-primary"><b>Abril</b></a>
      <a href="historico.php?mes=5" class="btn mes btn-md btn-primary"><b>Maio</b></a>
      <a href="historico.php?mes=6" class="btn mes btn-md btn-primary"><b>Junho</b></a>
      <a href="historico.php?mes=7" class="btn mes btn-md btn-primary"><b>Julho</b></a>
      <a href="historico.php?mes=8" class="btn mes btn-md btn-primary"><b>Agosto</b></a>
      <a href="historico.php?mes=9" class="btn mes btn-md btn-primary"><b>Setembro</b></a>
      <a href="historico.php?mes=10" class="btn mes btn-md btn-primary"><b>Outubro</b></a>
      <a href="historico.php?mes=11" class="btn mes btn-md btn-primary"><b>Novembro</b></a>
      <a href="historico.php?mes=12" class="btn mes btn-md btn-primary"><b>Dezembro</b></a>
    </center>
  </div>
</div>
</div>
    <?php include 'footerperfil.php'; ?>
</body>
</html>
<style>
.card{
  border-radius: 2%;
}

</style>