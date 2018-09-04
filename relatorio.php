<?php
session_start();
include 'connection.php';
if($_SESSION['adm'] != true) {
	echo "<script type='text/javascript'>
	alert('Necessita estar logado como adm para acessar esta pagina');
	window.location = 'index.php';
	</script>";
}

if(isset($_GET['deslogar'])){
	session_destroy();
	header('Location: index.php');
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
$numerohistorico = "";
if(isset($_GET['numerohistorico'])){
	$numerohistorico = $_GET['numerohistorico'];
}
$datahistorico = "";
if(isset($_GET['datahistorico'])){
	$datahistorico = $_GET['datahistorico'];
}
$historico = "";
if(isset($_GET['historico'])){
	$historico = $_GET['historico'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Relatório</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="relatorio.css">
		<meta name="viewport" content="width=device-width, user-scalable=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
	<div>
		<?php include 'footerperfil.php';?>
	<?php include 'sidebar.php';?>
	</div>

	<div class="desktop-relatorio">
	<center>
			<div class="card shadow-lg">
				<div class="card-header bg-warning mb-3"></div>
				<div class="card-body">
					<h3 class="titulo">Selecione a lista desejada</h3>
		

					<div class="search">

						<form action="relatorio.php">
							<select name='historico'>
								<option value='false' <?php if($historico == 'false') echo 'selected'; ?>>Inscritos do mês</option>
								<option value='true' <?php if($historico == 'true') echo 'selected'; ?>>Histórico</option>
							</select>

							<input type="submit" value="Visualizar" class="btn btn-primary "/>
						</form>
						<?php if(!isset($_GET['historico']) || $_GET['historico'] == 'false') {?>

						</div>
				
<br>
<h2>Inscritos do Mês</h2>
<form action="relatorio.php">
	<input type="text" id="nomeinscritos" name="nomeinscritos" placeholder="Nome" value="<?php echo $nomeinscritos ; ?>"/>
	<input type="text" id="cpfinscritos" name="cpfinscritos" placeholder="CPF" value="<?php echo $cpfinscritos ; ?>"/>
	<input type="text" id="numeroinscritos" name="numeroinscritos" placeholder="Número" value="<?php echo $numeroinscritos ; ?>"/>
	<input type="submit" class="btn btn-primary" value="Filtrar"/>
	<input type="button" onclick="javascript:limpar('relatorio');" class="btn btn-primary" value="Limpar"/>
</form>
<br>
<div class= "table-overflow">
<table class="table table-hover">
<thead>
	<td><b>Número do Sorteio</b></td>
	<td><b>Nome</b></td>
	<td><b>CPF</b></td>
	<td><b>Empresa</b></td>
</thead>
<?php
$sql = "SELECT u.id, u.nome as usuario , u.cpf , e.nome as empresa_id , ds.codigo_sorteio FROM dados_sorteio ds
				INNER JOIN usuario u ON u.id = ds.usuario_id
				LEFT JOIN empresa e ON u.empresa_id = e.id ";
$sql .= "WHERE 1=1 ";
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
	echo "</tr>";
	$row = $result->fetch_assoc();
}
?>
</table>
</div>
<input type="button" class="btn btn-primary" id= "btnsize"  value="Imprimir" onClick="window.open('impressaorelatorio.php?historico=<?php echo $historico; ?>');"/>
<?php } ?>
<?php if(isset($_GET['historico']) && $_GET['historico'] == 'true') { ?>
<h2>Lista com histórico dos participantes</h2>
<form action="relatorio.php">
	<input type="text" id="nomehistorico" name="nomehistorico" placeholder="Nome" value="<?php echo $nomehistorico ; ?>"/>
	<input type="text" id="numerohistorico" name="numerohistorico" placeholder="Número" value="<?php echo $numerohistorico ; ?>"/>
	<input type="date" id="datahistorico" name="datahistorico" value="<?php echo $datahistorico; ?>"/>
	<input class="btn btn-primary" type="submit" value="Filtrar"/>
	<input class="btn btn-primary" type="button" onclick="javascript:limpar('histórico');" value="Limpar"/>
	<input type="hidden" name="historico" value="<?php echo $historico; ?>"/>
</form>
<div class="table-overflow">
<table class="table table-hover">
<br>
<thead>
	<td><b>Nome</b></td>
	<td><b>Número do Sorteio</b></td>
	<td><b>Data de realização</b></td>
</thead>
<?php
	$sql = "SELECT nome,codigo_sorteio,datasorteio FROM resultado WHERE 1=1 ";
		if($nomehistorico){
			$sql .= "AND nome LIKE '%$nomehistorico%' ";
		}
		if($numerohistorico){
			$sql .= "AND codigo_sorteio LIKE '%$numerohistorico%' ";
		}
		if($datahistorico){
			$sql .= "AND datasorteio = '$datahistorico' ";
		}
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
</div>
<input type="button" class="btn btn-primary" id= "btnsize"  value="Imprimir" onClick="window.open('impressaorelatorio.php?historico=<?php echo $historico; ?>');"/>
</div>
</div>
<?php } ?>
</center>

</div>

	<div class="mobile-relatorio">
	<center>
			<div class="card">
				<div class="card-header bg-warning mb-3"></div>
				<div class="card-body">
					<h4 class="titulo">Selecione a lista desejada</h4>

					<div class="search">

						<form action="relatorio.php">
							<select name='historico'>
								<option value='false' <?php if($historico == 'false') echo 'selected'; ?>>Inscritos do mês</option>
								<option value='true' <?php if($historico == 'true') echo 'selected'; ?>>Histórico</option>
							</select><br><br>
							<input type="submit" value="Visualizar" class="btn btn-primary "/>
						</form>
						<?php if(!isset($_GET['historico']) || $_GET['historico'] == 'false') {?>

						</div>
					<style>
						.titulo{font-size: 20px;}
					</style>
<br>
<h2>Inscritos do Mês</h2>
<form action="relatorio.php">
	<input type="text" id="cpfinscritos" name="cpfinscritos" placeholder="CPF" value="<?php echo $cpfinscritos ; ?>"/><br><br>
	<input type="text" id="numeroinscritos" name="numeroinscritos" placeholder="Número" value="<?php echo $numeroinscritos ; ?>"/><br><br>
	<input type="submit" class="btn btn-primary botao" value="Filtrar"/><br><br>
	<input type="button" onclick="javascript:limpar('relatorio');" class="btn btn-primary botao" value="Limpar"/>
</form>
<br><br>
<div class= "table-overflow">
<table class="table table-hover">
<thead>
	<td><b>Nª do Sorteio</b></td>
	<td><b>CPF</b></td>
	
</thead>
<?php
$sql = "SELECT u.id, u.nome as usuario , u.cpf , e.nome as empresa_id , ds.codigo_sorteio FROM dados_sorteio ds
				INNER JOIN usuario u ON u.id = ds.usuario_id
				LEFT JOIN empresa e ON u.empresa_id = e.id ";
$sql .= "WHERE 1=1 ";
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
	echo "</tr>";
	$row = $result->fetch_assoc();
}
?>
</table>
</div>
<input type="button" class="btn btn-primary" id= "btnsize"  value="Imprimir" onClick="window.open('impressaorelatorio.php?historico=<?php echo $historico; ?>');"/>
<?php } ?>
<?php if(isset($_GET['historico']) && $_GET['historico'] == 'true') { ?>
	<br>
<h2 class="titulo-2">Lista com histórico<br> dos participantes</h2>
	<style>
						.titulo{font-size: 20px!important;}
												.titulo-2{font-size: 20px!important;}

					</style>
<form action="relatorio.php">
	<input type="text" id="nomehistorico" name="nomehistorico" placeholder="Nome" value="<?php echo $nomehistorico ; ?>"/><br><br>
	<input type="text" id="numerohistorico" name="numerohistorico" placeholder="Número" value="<?php echo $numerohistorico ; ?>"/><br><br>
	<input type="date" id="datahistorico" name="datahistorico" value="<?php echo $datahistorico; ?>"/><br><br>
	<input class="btn btn-primary" type="submit" value="Filtrar"/><br><br>
	<input class="btn btn-primary" type="button" onclick="javascript:limpar('histórico');" value="Limpar"/><br>
	<input type="hidden" name="historico" value="<?php echo $historico; ?>"/>
</form>
<div class="table-overflow">
<table class="table table-hover">
<br>
<thead>
	<td><b>Nº do Sorteio</b></td>
	<td><b>Realização</b></td>
</thead>
<?php
	$sql = "SELECT nome,codigo_sorteio,datasorteio FROM resultado WHERE 1=1 ";
		if($nomehistorico){
			$sql .= "AND nome LIKE '%$nomehistorico%' ";
		}
		if($numerohistorico){
			$sql .= "AND codigo_sorteio LIKE '%$numerohistorico%' ";
		}
		if($datahistorico){
			$sql .= "AND datasorteio = '$datahistorico' ";
		}
	$sql .= "ORDER BY datasorteio";
	$result = $conexao->query($sql);
	$row = $result->fetch_assoc();
	while ($row) {
		echo "<tr>";
		echo "<td>".$row['codigo_sorteio']."</td>";
		echo "<td>".date( 'd-m-Y' , strtotime($row['datasorteio']) )."</td>";
		echo "</tr>";
		$row = $result->fetch_assoc();
	}
?>
</table>
</div>
<input type="button" class="btn btn-primary" id= "btnsize"  value="Imprimir" onClick="window.open('impressaorelatorio.php?historico=<?php echo $historico; ?>');"/>
</div>
</div>
<?php } ?>
</center>
</div>


	<div class="desktop-small-relatorio">
	<center>
			<div class="card">
				<div class="card-header bg-warning mb-3"></div>
				<div class="card-body">
					<h3 class="titulo">Selecione a lista desejada</h3>
		

					<div class="search">

						<form action="relatorio.php">
							<select name='historico'>
								<option value='false' <?php if($historico == 'false') echo 'selected'; ?>>Inscritos do mês</option>
								<option value='true' <?php if($historico == 'true') echo 'selected'; ?>>Histórico</option>
							</select>

							<input type="submit" value="Visualizar" class="btn btn-primary "/>
						</form>
						<?php if(!isset($_GET['historico']) || $_GET['historico'] == 'false') {?>

						</div>
				
<br>
<h2>Inscritos do Mês</h2>
<form action="relatorio.php">
	<input type="text" id="nomeinscritos" name="nomeinscritos" placeholder="Nome" value="<?php echo $nomeinscritos ; ?>"/>
	<input type="text" id="cpfinscritos" name="cpfinscritos" placeholder="CPF" value="<?php echo $cpfinscritos ; ?>"/>
	<input type="text" id="numeroinscritos" name="numeroinscritos" placeholder="Número" value="<?php echo $numeroinscritos ; ?>"/><br><br>
	<input type="submit" class="btn btn-primary" value="Filtrar"/>
	<input type="button" onclick="javascript:limpar('relatorio');" class="btn btn-primary" value="Limpar"/>
</form>
<br><br>
<div class= "table-overflow">
<table class="table table-hover">
<thead>
	<td><b>Número do Sorteio</b></td>
	<td><b>Nome</b></td>
	<td><b>CPF</b></td>
	<td><b>Empresa</b></td>
</thead>
<?php
$sql = "SELECT u.id, u.nome as usuario , u.cpf , e.nome as empresa_id , ds.codigo_sorteio FROM dados_sorteio ds
				INNER JOIN usuario u ON u.id = ds.usuario_id
				LEFT JOIN empresa e ON u.empresa_id = e.id ";
$sql .= "WHERE 1=1 ";
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
	echo "</tr>";
	$row = $result->fetch_assoc();
}
?>
</table>
</div>
<input type="button" class="btn btn-primary" id= "btnsize"  value="Imprimir" onClick="window.open('impressaorelatorio.php?historico=<?php echo $historico; ?>');"/>
<?php } ?>
<?php if(isset($_GET['historico']) && $_GET['historico'] == 'true') { ?>
<h2>Lista com histórico dos participantes</h2>
<form action="relatorio.php">
	<input type="text" id="nomehistorico" name="nomehistorico" placeholder="Nome" value="<?php echo $nomehistorico ; ?>"/>
	<input type="text" id="numerohistorico" name="numerohistorico" placeholder="Número" value="<?php echo $numerohistorico ; ?>"/>
	<input type="date" id="datahistorico" name="datahistorico" value="<?php echo $datahistorico; ?>"/>
	<input class="btn btn-primary" type="submit" value="Filtrar"/>
	<input class="btn btn-primary" type="button" onclick="javascript:limpar('histórico');" value="Limpar"/>
	<input type="hidden" name="historico" value="<?php echo $historico; ?>"/>
</form>
<div class="table-overflow">
<table class="table table-hover">
<br>
<thead>
	<td><b>Nome</b></td>
	<td><b>Número do Sorteio</b></td>
	<td><b>Data de realização</b></td>
</thead>
<br>
<?php
	$sql = "SELECT nome,codigo_sorteio,datasorteio FROM resultado WHERE 1=1 ";
		if($nomehistorico){
			$sql .= "AND nome LIKE '%$nomehistorico%' ";
		}
		if($numerohistorico){
			$sql .= "AND codigo_sorteio LIKE '%$numerohistorico%' ";
		}
		if($datahistorico){
			$sql .= "AND datasorteio = '$datahistorico' ";
		}
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
</div>

<input type="button" class="btn btn-primary" id= "btnsize"  value="Imprimir" onClick="window.open('impressaorelatorio.php?historico=<?php echo $historico; ?>');"/>
</div>
</div>
<?php } ?>
</center>

</div>

</body>
</html>


<style>
.table-overflow{margin-bottom: 5%;}
	@media only screen and (max-width: 768px)
	{
		.desktop-relatorio
		{
			display: none;
		}
		.desktop-small-relatorio
		{
			display: none;
		}
		body
		{
			margin-left: 0px!important;
		}
		.card
		{
			margin-left: 5%;
			margin-right: 5%;
			width: 90%;
			margin-bottom: 20%!important;
			border-radius: 0px 0px 10px 10px;

		}
	}

	@media only screen and (min-width: 769px) and (max-width: 1024px)
	{
		.mobile-relatorio
		{
			display: none;
		}
		.desktop-relatorio
		{
			display: none;
		}
		.card
		{
			margin-left: 5%;
			margin-right: 5%;
			width: 80%;
			margin-bottom: 100px;
		}
		.btn
		{
			width: 100px!important;
		}
		.card-body input
		{
			width: 30%!important;
		}
		button, input, optgroup, select, textarea
		{
			font-size: large;
		}
	}

	@media only screen and (min-width: 1025px)
		{
		.mobile-relatorio
		{
			display: none;
		}
		.desktop-small-relatorio
		{
			display: none;
		}
		.card
		{
			margin-left: 5%;
			margin-right: 5%;
			width: 80%;
		}
		.btn
		{
			width: 100px!important;
		}
		
	}
</style>

<script type="text/javascript">
	function limpar(campo){
		if(campo == "relatorio"){
			document.getElementById('nomeinscritos').value = "";
			document.getElementById('cpfinscritos').value = "";
			document.getElementById('numeroinscritos').value = "";
		}
		if(campo == "histórico"){
			document.getElementById('nomehistorico').value = "";
			document.getElementById('numerohistorico').value = "";
			document.getElementById('datahistorico').value = "";
		}
	}
</script>