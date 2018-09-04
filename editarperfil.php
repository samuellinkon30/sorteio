<?php
include 'connection.php';
include 'util.php';
session_start();
if(!isset($_SESSION['id']) || isset($_GET['deslogar'])) {
	session_destroy();
	header("Location:index.php");
} else {
	$id = $_SESSION['id'];
	$disabled = "";
	$voltar = urlVoltar('editarperfil.php',$_GET);
	if(isset($_GET['id']) && isset($_SESSION['adm'])) {
		$id = $_GET['id'];
		$disabled = "disabled";
	}
}
$sql = "SELECT nome,cpf,imgurl FROM usuario WHERE id = $id ";
$result = $conexao->query($sql);
$row = $result->fetch_assoc();

$nomeeditar = $row['nome'];
$cpfeditar = $row['cpf'];

$modo = "";
if(isset($_POST['modo'])){
	$modo = $_POST['modo'];
}
if($modo == "alterar") {
	$nomealterar = "";
	if(isset($_POST['nome'])){
		$nomealterar = $_POST['nome'];
	}
	$cpfalterar = "";
	if(isset($_POST['cpf'])){
		$cpfalterar = $_POST['cpf'];
	}
	$sql = "SELECT id FROM usuario WHERE cpf = '$cpfalterar' AND id <> ".$id;
	$result = $conexao->query($sql);
	$row = $result->fetch_assoc();

	if(!$row && $nomealterar && $cpfalterar) {
		$sql = "UPDATE usuario SET nome = '$nomealterar' , cpf = '$cpfalterar' WHERE id = $id";
		$result = $conexao->query($sql);
		if($result) {
			echo "<script> alert('Dados alterados com sucesso! ');";
			echo "window.location = ".$voltar;
			echo "</script>";
		}
	} else {
		echo "<script> alert(' Não é permitido deixar campo vázio ou CPF já está cadastrado! ');";
		echo  "</script>";
	}
}
$sql = "SELECT nome,cpf,imgurl FROM usuario WHERE id = ".$id;
$result = $conexao->query($sql);
$row = $result->fetch_assoc();

$nomeeditar = $row['nome'];
$cpfeditar = $row['cpf'];
$imgurleditar = $row['imgurl'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Editar Perfil</title>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<!-- <link rel="stylesheet" type="text/css" href="cliente.css"> -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<style>
			@media only screen and (max-width: 769px)
			{
				.desktop{display: none;}
				#file{width: 100px!important;
					margin-top:5%;
					margin-left: -12%;}
			.card-deck
			{
				margin: 5!important;
				width: 90%!important;
				margin-left: 5%!important;
				margin-right: 5%!important;
				padding: 0!important;
			}
		}
			@media only screen and (max-width: 769px)
			{
				.desktop{display: none;}
				#file{width: 100px!important;
					margin-top: 5%;
					margin-left: -12%;}
			.card-deck
			{
				margin: 5!important;
				width: 90%!important;
				margin-left: 5%!important;
				margin-right: 5%!important;
				padding: 0!important;
			}
			body{margin-left: 0!important;}
			
		}
		</style>
	

	<body>
		<?php include 'sidebar.php'; ?>
		<head>
			<title>Editar Perfil</title>
			<meta name="viewport" content="width=device-width, user-scalable=no">
			<link rel="stylesheet" type="text/css" href="editarperfil.css">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
			<body>
				<div class="desktop">
					<div class= "card-deck">

						<div class="card shadow-lg">
							<div class="card-sm-header bg-warning" align="center" >
								<h2>Editar perfil</h2>
							</div>

							<div class="card-body" align="center" >


								<img src="<?php echo $imgurleditar; ?>" alt="Avatar" class="avatar">
								<br><br>
								<form action="upload.php" method="POST" enctype="multipart/form-data">
									<input type="file" name="file" id="file" <?php echo $disabled; ?>/>
									<br>
									<button class= "btn btn-primary" type="submit" name="submit" <?php echo $disabled; ?>>Alterar imagem</button>
								</form>

								<form method="POST">
									<table>
										<tr>
											<td><label class="control-label" for="name">Nome:</label></td>
											<td><input type = "text"  name = "nome" value="<?php echo $nomeeditar; ?>"></td>
										</tr>
										<tr>
											<td><label class="control-label" for="name">CPF:</label></td>
											<td><input id= "cpfinput" type = "text" name = "cpf" value="<?php echo $cpfeditar; ?>"></td>
										</tr>
									</table>
							
									<input type="hidden" name="modo" value="alterar"/>
									<input type="submit" id= "btnsize" class="btn btn-primary" value="Alterar Dados"></center>
									
								</form>
							</div>

						</div>
					</div>
				</div>

					<div class="mobile">
					<div class= "card-deck">

						<div class="card shadow-lg">
							<div class="card-sm-header bg-warning" align="center" >
								<h2>Editar perfil</h2>
							</div>

							<div class="card-body" align="center" >


								<img src="<?php echo $imgurleditar; ?>" alt="Avatar" class="avatar">
								<br>
								<form action="upload.php" method="POST" enctype="multipart/form-data">
									<input type="file" name="file" id="file" <?php echo $disabled; ?>/>
									<br>
									<button class= "btn btn-primary" type="submit" name="submit" <?php echo $disabled; ?>>Alterar imagem</button>
								</form>

								<form method="POST">

									<table>
										<tr><br>
											<td><label class="control-label" for="name">Nome:</label></td>
											<td><input type = "text"  name = "nome" value="<?php echo $nomeeditar; ?>"></td>
										</tr>
										<tr>
											<td><label class="control-label" for="name">CPF:</label></td>
											<td><input id= "cpfinput" type = "text" name = "cpf" value="<?php echo $cpfeditar; ?>"></td>
										</tr>
									</table>
									<table>
										<tr>
											<td></td>
											<input type="hidden" name="modo" value="alterar"/>
											<td align= "center">	<input type="submit" id= "btnsize" class="btn btn-primary" value="Alterar Dados"></td>
										</tr>
									</table>
								</form>
							</div>

						</div>
					</div>
				</div>
				<?php include 'footerperfil.php'; ?>
			</body>
			</html>