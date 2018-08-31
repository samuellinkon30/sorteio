<?php
include 'connection.php';
session_start();
if(isset($_GET['deslogar'])){
  session_destroy();
  header("location:index.php");
}

$sql = "SELECT u.nome , u.cpf , ds.codigo_sorteio FROM dados_sorteio ds INNER JOIN usuario u ON ds.usuario_id = u.id  WHERE usuario_id = ".$_SESSION['id'];

$participa = false;
$codigo_sorteio = "";
$nome_sorteio = "";
$cpf_sorteio = "";
$result = $conexao->query($sql);
$row = $result->fetch_assoc();
if($row) {
  $codigo_sorteio = $row['codigo_sorteio'];
  $nome_sorteio = $row['nome'];
  $cpf_sorteio = $row['cpf'];
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<center>
     <div class="caixa">

        <img class= "logo" src="assets/logo.png">
    <h4><b>Nome: <?php echo $nome_sorteio ?> </b></h4>
    <h4><b> CPF: <?php echo $cpf_sorteio ?> </b></h4>
    <h4><b> Número do Sorteio: <?php echo $codigo_sorteio ?>
</center>
  </div>


        <style>
        .caixa
        {
          width: 500px;
          border-color: black;
          border-style: solid;
          border-width: 1px 1px 1px 1px;
          margin-left: 5%;
          margin-right: 5%;
          border-radius: 10px 10px 10px 10px;
          margin-bottom: 7%;
        }
        .logo{
          width: 200px;
        }
        </style>

        <script >
         window.print();
        </script>
  </body>
</html>
