<?php
include 'connection.php';
session_start();
if(isset($_GET['deslogar'])){
  session_destroy();
  header("location:index.php");
}
$historico = $_GET['historico'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Relatório</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>
  </head>
  <body>
    <div align="center">
          <img id="ft"src="assets/logo.png">
    <?php if($historico == 'true'){ ?>
      <table class="table table-bordered" style="width:50%">
      <br />
      <thead>
      	<td><b>Nome</b></td>
      	<td><b>Número do Sorteio</b></td>
      	<td><b>Data de realização</b></td>
      </thead>
      <?php
      	$sql = "SELECT nome,codigo_sorteio,datasorteio FROM resultado WHERE 1=1 ";
      	$sql .= "ORDER BY datasorteio";
      	$result = $conexao->query($sql);
      	$row = $result->fetch_assoc();
      	while ($row) {
      		echo "<tr>";
      		echo "<td>".$row['nome']."</td>";
      		echo "<td>".$row['codigo_sorteio']."</td>";
      		echo "<td>".date( 'd-m-Y' , strtotime($row['datasorteio']) )."</td>";
      		echo "</tr>";
      		$row = $result->fetch_assoc();
      	}
      ?>
      </table>
    <?php }else { ?>


    <table class="table table-bordered" style="width:50%">
    <thead>
    	<td><b>Número do Sorteio</b></td>
    	<td><b>Nome</b></td>
    	<td><b>CPF</b></td>
    	<td><b>Empresa</b></td>
    </thead>
    <?php
    $sql = "SELECT u.id, u.nome as usuario , u.cpf , e.nome as empresa_id , ds.codigo_sorteio FROM dados_sorteio ds
    				INNER JOIN usuario u ON u.id = ds.usuario_id
    				LEFT JOIN empresa e ON u.empresa_id = e.id WHERE 1=1 ORDER BY ds.codigo_sorteio ";
    $result = $conexao->query($sql);
    $row = $result->fetch_assoc();
    while($row){
    	echo "<tr>";
    	echo "<td>".$row['codigo_sorteio']."</td>";
    	echo "<td>".$row['usuario']."</td>";
    	echo "<td>".$row['cpf']."</td>";
    	echo "<td>".$row['empresa_id']."</td>";
    	echo "</tr>";
    	$row = $result->fetch_assoc();
    }
    ?>
    </table>

<?php } ?>
  </div>
  <style>
      #ft
      {
        width: 125px;
        height: 125px;
      }
  </style>
  <script >
   window.print();
  </script>
  </body>
</html>
