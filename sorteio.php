<?php
session_start();
include 'connection.php';
if(isset($_GET['deslogar'])){
	session_destroy();
	header('Location: index.php');
}
if(!isset($_SESSION['adm'])){
	die('Não tem permissão para acessar essa página!');
}
$codigo_sorteado = "";
if(isset($_POST['codigo_sorteado'])){
	$codigo_sorteado = $_POST['codigo_sorteado'];
}
if($codigo_sorteado) {
	$sql = "SELECT u.id, u.cpf , u.nome , u.senha , u.empresa_id FROM usuario u INNER JOIN dados_sorteio ds ON ds.usuario_id = u.id WHERE ds.codigo_sorteio = ".$codigo_sorteado." AND NOT EXISTS (SELECT 1 FROM resultado r WHERE r.id = u.id )" ;
	$result = $conexao->query($sql);
	$row = $result->fetch_assoc();

	if($row) {
		$empresa_id = $row['empresa_id'];
		if (!$empresa_id) {
			$empresa_id = "null";
		}
		$sql = "INSERT INTO resultado (id,cpf,nome,senha,empresa_id,datasorteio,codigo_sorteio) VALUES (".$row['id'].",'".$row['cpf']."','".$row['nome']."','".$row['senha']."',".$empresa_id.",now(),".$codigo_sorteado.")";
		$conexao->query($sql);
	} else {
		echo "<script>alert('Ninguem possui a senha ".$codigo_sorteado." ou já foi sorteado! ')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>

	<title>Sorteio</title>
	<link rel="stylesheet" type="text/css" href="sorteio.css">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
	
	<?php include 'sidebar.php';?>
	<div class="desktop">

		<center>
			<div class = "card">
				<div class="card-header bg-warning mb-3"><h4> Sorteio </h4></div>
				<div class = "card-body">
					<div>
						<form method="POST" action="sorteio.php">
							<label class= "nsorteado"><b>Número do Sorteado:</b></label>
							<input type="text" name="codigo_sorteado" id="codigo_sorteado">
							<input type="submit" class="btn btn-primary btn-sm" value="Sortear!">
						</form>
						<div class = "table-overflow">
							<table class = "table table-hover">
								<tr>
									<td><b>Data de Realização</b></td>
									<td><b>Número do Sorteio</b></td>
									<td><b>Nome</b></td>
									<td><b>Cpf</b></td>
									<td><b>Empresa</b></td>
								</tr>
								<?php
								$sql = "SELECT u.nome, u.cpf , ds.datasorteio , ds.codigo_sorteio , e.nome as empresa FROM resultado u
								INNER JOIN dados_sorteio ds ON ds.usuario_id = u.id
								LEFT JOIN empresa e ON u.empresa_id = e.id
								ORDER BY ds.datasorteio DESC";

								$result = $conexao->query($sql);
								$row = $result->fetch_assoc();

								while($row){
									echo "<tr>";
									echo "<td>".date('d-m-Y',strtotime($row['datasorteio']))."</td>";
									echo "<td>".$row['codigo_sorteio']."</td>";
									echo "<td>".$row['nome']."</td>";
									echo "<td>".$row['cpf']."</td>";
									echo "<td>".$row['empresa']."</td>";
									echo "</tr>";
									$row = $result->fetch_assoc();
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</center>
	</div>

	<div class="mobile">	
		<center>
			<div class = "card">
				<div class="card-header bg-warning mb-3"></div>
				<div class = "card-body">
					<div>
						<form method="POST" action="sorteio.php">
							<label class= "nsorteado"><b>Número do Sorteado</b></label><br>
							<input type="text" name="codigo_sorteado" id="codigo_sorteado"><br><br>
							<input type="submit" class="btn btn-primary btn-sm" value="Sortear!">
						</form>
						<div class = "table-overflow">
							<table class = "table table-hover">
								<tr>
									<td><b>Data</b></td>
									<td><b>Nº do Sorteio</b></td>
								</tr>
								<?php
								$sql = "SELECT u.nome, u.cpf , ds.datasorteio , ds.codigo_sorteio , e.nome as empresa FROM resultado u
								INNER JOIN dados_sorteio ds ON ds.usuario_id = u.id
								LEFT JOIN empresa e ON u.empresa_id = e.id
								ORDER BY ds.datasorteio DESC";

								$result = $conexao->query($sql);
								$row = $result->fetch_assoc();

								while($row){
									echo "<tr>";
									echo "<td>".date('d-m-Y',strtotime($row['datasorteio']))."</td>";
									echo "<td>".$row['codigo_sorteio']."</td>";
									echo "</tr>";
									$row = $result->fetch_assoc();
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</center>
	</div>

	
</body>
</html>
<?php include 'footerperfil.php'; ?>

<style>
@media only screen and (min-width: 320px) and (max-width: 768px)
{
	body{margin-left: 0!important;}
	.desktop{display: none;}
.card
		{
			margin-left: 5%;
			margin-right: 5%;
			width: 90%;
			margin-bottom: 20%!important;
			border-radius: 0px 0px 10px 10px;

		}	.card-body{background-color: white;width:90%;margin-left: 5%;margin-right: 5%;margin-bottom: 20%!important;}
	.card-body input{margin: 1%;}
	.table-overflow{margin-left: -5%;margin-right: -5%;}
	.card-body{border-radius: 0px 0px 10px 10px;}
	.table td, .table th{padding-left: 0.1em; padding-right: 0.1em;}
}
@media only screen and (min-width: 768px)
{
	.card{margin-top: 5%;width:90%;margin-left: 5%;margin-right: 5%;margin-bottom: 0;height: 450px;}

}




</style>