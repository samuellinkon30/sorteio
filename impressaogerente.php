<?php
include 'connection.php';
session_start();
if(isset($_GET['deslogar'])){
  session_destroy();
  header("location:index.php");
}

$nomeinscritos = "";
if(isset($_GET['nomeinscritos'])){
  $nomeinscritos = $_GET['nomeinscritos'];
}
$cpfinscritos = "";
if(isset($_GET['cpfinscritos'])){
  $cpfinscritos = $_GET['cpfinscritos'];
}
$numeroinscritos = "";
if(isset($_GET['numeroinscritos'])){
  $numeroinscritos = $_GET['numeroinscritos'];
}
$nomehistorico = "";
if(isset($_GET['nomehistorico'])){
  $nomehistorico = $_GET['nomehistorico'];
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Relatório</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>
  </head>
  <body>
    <div class = "info" align = "center">
      <img class= "logo" src="assets/logo.png">
    <br>
    <table class="table table-bordered" style = "width: 50%">
    <thead>
      <td><b>Número do Sorteio</b></td>
      <td><b>Nome</b></td>
      <td><b>CPF</b></td>
      <td><b>Empresa</b></td>
    </thead>
    <?php
      // header("Content-Type: text/html; charset=iso-8859-1",true);
    $sql = "SELECT u.id, u.nome as usuario , u.cpf , e.nome as empresa_id , ds.codigo_sorteio FROM dados_sorteio ds
          INNER JOIN usuario u ON u.id = ds.usuario_id
          LEFT JOIN empresa e ON u.empresa_id = e.id
          WHERE 1=1 ";
    if($nomeinscritos){
    $sql .= "AND upper(u.nome) LIKE upper('%$nomeinscritos%') ";
    }
    if($cpfinscritos){
    $sql .= "AND cpf LIKE '%$cpfinscritos%' ";
    }
    if($numeroinscritos){
    $sql .= "AND codigo_sorteio LIKE '%$numeroinscritos%' ";
    }
    $sql .= "ORDER BY id";
    $result = $conexao->query($sql);
    $row = $result->fetch_assoc();
    while($row){
    echo "<tr>";
    echo "<td>".$row['codigo_sorteio']."</td> ";
    echo "<td>".$row['usuario']."</td> ";
    echo "<td>".$row['cpf']."</td>";
    echo "<td>".$row['empresa_id']."</td> ";
    echo "</tr>";
    $row = $result->fetch_assoc();
    }

    ?>
  </table>
  </div>
  <style>
      .logo{
          width: 200px;
        }
  </style>
         <script >
         window.print();
        </script>
  </body>
</html>
