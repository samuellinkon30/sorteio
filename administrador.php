<?php
include 'connection.php';
session_start();
if($_SESSION['adm'] != true) {
	header("location:index.php");
	session_destroy();
}
if(isset($_GET['modo']) && $_GET['modo'] == 'remover') {
	$id = $_GET['id'];
	if($id && $_SESSION['adm'] == true) {
		$sql = "DELETE FROM dados_sorteio WHERE usuario_id = ".$id;
		$result = $conexao->query($sql);
		header('Location:administrador.php');
	}
	die;
}
if(isset($_GET['deslogar'])) {
	session_destroy();
	header("location:index.php");
}
if(isset($_POST['apg']) && $_POST['apg'] == 'true'){
	$conexao->query("DELETE FROM dados_sorteio");
	$conexao->query("ALTER TABLE dados_sorteio AUTO_INCREMENT = 1000");
	die;
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
<html  lang= "pt-br">
<head>
	<meta charset="UTF-8">
	<title>Página ADM</title>
	<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap4.1.3.min.css">
	<link rel="stylesheet" type="text/css" href="gerencia.css">
	<script src="src/jquery.min.js"></script>
</head>
<body>

	<?php include 'sidebar.php'; ?>
	<?php include 'footerperfil.php'; ?>

	<div class="desktop">
		<center>
			<div class="card shadow-lg">

				<div class="card-header bg-warning mb-3"></div>


				<div class="card-body">
					<table>
						<tr>
							<td><label class="control-label" for="id"><b>Iniciar Sorteio:</b></label></td>
							<td align="center"><input type="button" class="btn btn-primary" id= "btnsizesorteio" onclick="window.location='sorteio.php'" value="Clique Aqui"></button></td>

						</tr>
						<tr>
							<td><label class="control-label" for="apg" ><b>Começar novo sorteio:</b>&nbsp;&nbsp;</label></td>
							<td align="center"><input type="button" class="btn btn-primary" id= "btnsizesorteio" value="Clique Aqui	" onclick="deletarLista();"></td>

						</tr>
					</table>

					<br>
					<h2>Inscritos</h2>
					<form action="administrador.php">
						<input type="text" id="nomeinscritos" name="nomeinscritos" placeholder="Nome" value="<?php  echo $nomeinscritos ; ?>"></input>
						<input type="text" id="cpfinscritos" name="cpfinscritos" placeholder="CPF" value="<?php echo $cpfinscritos ; ?>"></input>
						<input type="text" id="numeroinscritos" name="numeroinscritos" placeholder="Número" value="<?php echo $numeroinscritos ; ?>"></input>
						<div class="espaco">
						<br>	
						</div>
						<input type="submit" class= "btn btn-primary" id= "btnsize" value="Filtrar"></input>
						<input type="button" class= "btn btn-primary" id= "btnsize" onclick="javascript:limpar();" value="Limpar"></input>
					</form>
					<br><br>
					<div class= "table-overflow">

						<table class="table table-hover">
							<thead>
								<td><b>Número do Sorteio</b></td>
								<td><b>Nome</b></td>
								<td><b>CPF</b></td>
								<td><b>Empresa</b></td>
								<td></td>
							</thead>

							<?php
							$sql = "SELECT u.id, u.nome as usuario , u.cpf , e.nome as empresa_id , ds.codigo_sorteio FROM dados_sorteio ds
							INNER JOIN usuario u ON u.id = ds.usuario_id
							LEFT JOIN empresa e ON u.empresa_id = e.id
							WHERE 1=1 ";
							if($nomeinscritos){
								$sql .= "AND upper(u.nome) LIKE upper('%$nomeinscritos%') ";
							}
							if($cpfinscritos){
								$sql .= "AND u.cpf LIKE '%$cpfinscritos%' ";
							}
							if($numeroinscritos){
								$sql .= "AND ds.codigo_sorteio LIKE '%$numeroinscritos%' ";
							}
							$sql .= "ORDER BY ds.codigo_sorteio";
							$result = $conexao->query($sql);
							$row = $result->fetch_assoc();
							while($row){
								echo "<tr>";
								echo "<td>".$row['codigo_sorteio']."</td>";
								echo "<td>".$row['usuario']."</td>";
								echo "<td>".$row['cpf']."</td>";
								echo "<td>".$row['empresa_id']."</td>";
								echo "<td>";
								echo "<a href='editarperfil.php?id=".$row['id']."'><img src='assets/alterar.png'></a>&nbsp&nbsp";
								echo "<a href='javascript:remover(".$row['id'].")'><img src='assets/deletar.png'></button>
								";
								echo "</td>";
								echo "</tr>";
								$row = $result->fetch_assoc();
							}
							?>
						</table>

					</div>
					<input type="button" class="btn btn-primary" id= "btnsize"  value="Imprimir" onClick="window.open('impressaogerente.php')"/>
				</div>
			</div>
		</center>
	</div>

	<div class="mobile">
				<div class="card-header bg-warning "></div>
				<div class="card-body">
					<center>
						<label class="control-label prim" for="id">Sorteio:</label>
						<button type="submit" class="btn btn-primary prim-b" onclick="window.location='sorteio.php'">Clique Aqui</button>
						<br>
						<br>

						<label class="control-label" for="apg" >Resetar lista:</label>

						<input type="button" class="btn btn-primary" id= "btnsize" style="width: 105px" value="Clique Aqui" onclick="deletarLista();">
				</center>

					<br><br>
					<center>
					<h2>Inscritos</h2>
					<form action="administrador.php">
						<input type="text" id="cpfinscritos" name="cpfinscritos" placeholder="CPF" value="<?php echo $cpfinscritos ; ?>"></input>
						<br>
						<input type="text" id="numeroinscritos" name="numeroinscritos" placeholder="Nº do Sorteio" value="<?php echo $numeroinscritos ; ?>"></input>
						<br><br>
						<input type="submit" class= "btn btn-primary" id= "btnsize" value="Filtrar"></input>
						<input type="button" class= "btn btn-primary" id= "btnsize" onclick="javascript:limpar();" value="Limpar"></input>
					</form>
					</center>
					<br><br>
					<div class= "table-overflow">

						<table class="table table-hover">
							<thead>
								<td class="sort"><b>Nº do Sorteio</b></td>
								<td class="cpf"><b>CPF</b></td>
								<td></td>
							</thead>
							<?php
							$sql = "SELECT u.id, u.nome as usuario , u.cpf , e.nome as empresa_id , ds.codigo_sorteio FROM dados_sorteio ds
							INNER JOIN usuario u ON u.id = ds.usuario_id
							LEFT JOIN empresa e ON u.empresa_id = e.id
							WHERE 1=1 ";
							if($nomeinscritos){
								$sql .= "AND upper(u.nome) LIKE upper('%$nomeinscritos%') ";
							}
							if($cpfinscritos){
								$sql .= "AND u.cpf LIKE '%$cpfinscritos%' ";
							}
							if($numeroinscritos){
								$sql .= "AND ds.codigo_sorteio LIKE '%$numeroinscritos%' ";
							}
							$sql .= "ORDER BY ds.codigo_sorteio";
							$result = $conexao->query($sql);
							$row = $result->fetch_assoc();
							while($row){
								echo "<tr>";
								echo "<td>".$row['codigo_sorteio']."</td>";
								echo "<td>".$row['cpf']."</td>";
								echo "<td>";
								echo "<a href='editarperfil.php?id=".$row['id']."'><img src='assets/alterar.png'></a>&nbsp&nbsp";
								echo "<a href='javascript:remover(".$row['id'].")'><img src='assets/deletar.png'></a>";								echo "</td>";
								echo "</tr>";
								$row = $result->fetch_assoc();
							}
							?>
						</table>

					</div>
					<center>
					<input type="button" class="btn btn-primary" id= "btnsize"  value="Imprimir" onClick="window.open('impressaogerente.php')"/>
					</center>
				</div>


</body>

	<script type="text/javascript">
		function deletarLista(){
			if(confirm(" Tem certeza que deseja resetar a lista de sorteados? ")){
				$.ajax({
					type: 'post',
					url : 'administrador.php',
					data: { "apg": "true" },
					success: function(response) {
						window.location.href = "administrador.php";
					}
				});
			}
		}
		function limpar(){
			document.getElementById('nomeinscritos').value = "";
			document.getElementById('cpfinscritos').value = "";
			document.getElementById('numeroinscritos').value = "";
		}
		function remover(id){
			if(confirm('Tem certeza que deseja remover este usuario do sorteio atual?')){
				window.location ='administrador.php?modo=remover&id='+id;
			}
		}
	</script>

<style>

@media only screen and (min-width: 320px) and (max-width: 768px)
{	.cpf{padding-left: 15%!important;}
	.espaco{display: none;}
	.table td, .table th{padding-left: 0.1em; padding-right: 0.1em;}
	.desktop
	{display: none;}
	body
	{margin-left: 0!important;}
	.card-header{margin-top: 5%;width:90%;margin-left: 5%;margin-right: 5%;margin-bottom: 0;}
	.card-body{background-color: white;width:90%;margin-left: 5%;margin-right: 5%;margin-bottom: 20%!important;}
	.card-body input{margin: 1%;}
	.table-overflow{margin-left: -5%;margin-right: -5%;}
	.card-body{border-radius: 0px 0px 10px 10px;}
}

@media only screen and (min-width: 425px) and (max-width: 768px)
{	.table-overflow{margin-left: 0%;margin-right: 0%;}
	.cpf{padding-left: 0%!important;}
}
.card
{
	position: initial!important;
	height: auto!important;
}


</style>
