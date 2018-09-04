<?php 
include 'connection.php';
session_start();
if(isset($_GET['deslogar']) || !isset($_SESSION['id'])){
	session_destroy();
	header("location:index.php");
}

function obterCampos(){
	global $mes;

	$mes = $_GET['mes'];

}
obterCampos();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap4.1.3.min.css">
	<meta name="viewport" content="width=device-width, user-scalable=no">

	<title>Histórico dos Sorteio</title>
</head>
<body>
	<?php include 'sidebar.php'; ?>
	<?php include 'footerperfil.php'; ?>
</body>
</html>

<div class="desktop">
	<center>
		<div class="card shadow-lg">

			<div class="card-header bg-warning mb-3"></div>
			<div class="card-body">

				<br>
				<h1>Ganhadores do Mês</h1>
				<br>
				<form method="get">
					<label>Selecione o mês que deseja visualizar:</label>
					<select name="mes">
						<option value=""></option>
						<option value="1" <?php if($mes == '1') echo "selected"; ?>>Janeiro</option>
						<option value="2" <?php if($mes == '2') echo "selected"; ?>>Fevereiro</option>
						<option value="3" <?php if($mes == '3') echo "selected"; ?>>Março</option>
						<option value="4" <?php if($mes == '4') echo "selected"; ?>>Abril</option>
						<option value="5" <?php if($mes == '5') echo "selected"; ?>>Maio</option>
						<option value="6" <?php if($mes == '6') echo "selected"; ?>>Junho</option>
						<option value="7" <?php if($mes == '7') echo "selected"; ?>>Julho</option>
						<option value="8" <?php if($mes == '8') echo "selected"; ?>>Agosto</option>
						<option value="9" <?php if($mes == '9') echo "selected"; ?>>Setembro</option>
						<option value="10" <?php if($mes == '10') echo "selected"; ?>>Outubro</option>
						<option value="11" <?php if($mes == '11') echo "selected"; ?>>Novembro</option>
						<option value="12" <?php if($mes == '12') echo "selected"; ?>>Dezembro</option>
					</select>
					<button class="btn btn-primary" type="submit">Visualizar</button>
				</form>
				<br><br>
				<div class="table-responsive">
					<table class="table table-striped table-bordered" style="width: 100%">
						<th>Código sorteado</th>
						<th>Nome</th>
						<th>Data</th>
						<?php

						$sql = "SELECT nome,cpf,datasorteio,codigo_sorteio FROM resultado WHERE YEAR(datasorteio) = (SELECT YEAR(current_timestamp())) ";
						if($mes != null){
							$sql .= "AND MONTH(datasorteio) = $mes ";
						}
						$result = $conexao->query($sql);
						$row = $result->fetch_assoc();

						while ($row) {
							echo "<tr>";
							echo"<td>".$row['codigo_sorteio']."</td>";
							echo"<td>".$row['nome']."</td>";
							echo"<td>".date('d-m-Y',strtotime($row['datasorteio']))."</td>";
							echo"</tr>";
							$row = $result->fetch_assoc();
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</center>
</div>

<div class="mobile">
	<center>
		<div class="card shadow-lg">

			<div class="card-header bg-warning mb-3"></div>
			<div class="card-body">

				<br>
				<h3 id="gan">Ganhadores do Mês</h3>
				<br>
				<style>
					#gan{font-size: 25px;}
					#txt-select{font-size: 22px;}
				</style>
				<form method="get">
					<label id="txt-select">Selecione o mês<br>que deseja visualizar:</label>
					<br>
					<center>
					<select name="mes">
						<option value=""></option>
						<option value="1" <?php if($mes == '1') echo "selected"; ?>>Janeiro</option>
						<option value="2" <?php if($mes == '2') echo "selected"; ?>>Fevereiro</option>
						<option value="3" <?php if($mes == '3') echo "selected"; ?>>Março</option>
						<option value="4" <?php if($mes == '4') echo "selected"; ?>>Abril</option>
						<option value="5" <?php if($mes == '5') echo "selected"; ?>>Maio</option>
						<option value="6" <?php if($mes == '6') echo "selected"; ?>>Junho</option>
						<option value="7" <?php if($mes == '7') echo "selected"; ?>>Julho</option>
						<option value="8" <?php if($mes == '8') echo "selected"; ?>>Agosto</option>
						<option value="9" <?php if($mes == '9') echo "selected"; ?>>Setembro</option>
						<option value="10" <?php if($mes == '10') echo "selected"; ?>>Outubro</option>
						<option value="11" <?php if($mes == '11') echo "selected"; ?>>Novembro</option>
						<option value="12" <?php if($mes == '12') echo "selected"; ?>>Dezembro</option>
					</select>
				</center><br>
					<button class="btn btn-primary" type="submit">Visualizar</button>
				</form>
				<br><br>
				<div class="table-responsive">
					<table class="table table-striped table-bordered" style="width: 100%">
						<th>Nome</th>
						<th>Data</th>
						<?php

						$sql = "SELECT nome,cpf,datasorteio,codigo_sorteio FROM resultado WHERE YEAR(datasorteio) = (SELECT YEAR(current_timestamp())) ";
						if($mes != null){
							$sql .= "AND MONTH(datasorteio) = $mes ";
						}
						$result = $conexao->query($sql);
						$row = $result->fetch_assoc();

						while ($row) {
							echo "<tr>";
							echo"<td>".$row['nome']."</td>";
							echo"<td>".date('d-m-Y',strtotime($row['datasorteio']))."</td>";
							echo"</tr>";
							$row = $result->fetch_assoc();
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</center>
</div>
<style>
html body
{
	margin-left: 216px;
	background-image: url('assets/fundo9.jpg');
	background-position: center;
	background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}

.card{
	position: initial!important;
	margin-top: 30px;
	width: 80%!important;
		margin-bottom: 70px!important;


}
.card-body{
	white-space: nowrap;
}
.card-body input{
	text-align: center;
	width: 200px;
}
.table-overflow {
    max-height:200px;
    overflow-y:auto;
}
.card-header{
	height: 45px;
}

#btnsize{
	width: 100px;
}
#btnsizesorteio{
	width: 100%;
}
@media only screen and  (max-width: 768px)
{	
	body
	{margin-left: 0!important;}
	.desktop{display: none;}
}
</style>
