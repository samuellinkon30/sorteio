<?php 
include 'connection.php';

session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Redefinir Senha</title>
	<link rel="stylesheet" type="text/css" href="redefinir.css">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
@media only screen and  (max-width: 375px)
{
	
	.desktop
	{
		display: none;
	}
	
	.desc-mob
	{
		font-size:15px;
		text-align: center;
		color: white;
		padding: 2%;
		margin-top: 5%;
	}
	
	.redefinir
	{
		margin-left: 18%;
	}
	
	.i-mobile
	{
		position: relative!important;
		width: 30%!important;
		margin-top: -22%;
		left: 36%;
		height: auto;
		background-color: #ffffffb8;
		border-radius: 50%;
	}
	.box-mobile
	{
		margin-top: 15%;
		padding-top: 5%;
		padding-bottom: 3%;
		background-color: #bce8e652;
		border-radius: 10px 10px 0px 0px;
		margin-left: 5%;
		margin-right: 5%;
		color: white;
	}
	.box-2-mobile
	{
		padding-bottom: 3%;
		background-color: #bce8e652;
		border-radius: 0px 0px 10px 10px;
		margin-left: 5%;
		margin-right: 5%;
	}
	.formulario{margin-top: 0;}
	.redefinir{margin-left: 27%;}

}
@media only screen and (min-width: 375px) and (max-width: 426px)
{
	
	.desktop
	{
		display: none;
	}
	
	.desc-mob
	{
		font-size:15px;
		text-align: center;
		color: white;
		padding: 2%;
		margin-top: 5%;
	}
	
	
	.form-group{margin-bottom: 10px!important;}
	.botao
	{
		margin-left: 33%!important;
	}
	.i-mobile
	{
		position: relative!important;
		width: 30%!important;
		margin-top: -22%;
		left: 36%;
		height: auto;
		background-color: #ffffffb8;
		border-radius: 50%;
	}
	.box-mobile
	{
		margin-top: 15%;
		padding-top: 5%;
		padding-bottom: 3%;
		background-color: #bce8e652;
		border-radius: 10px 10px 0px 0px;
		margin-left: 5%;
		margin-right: 5%;
		color: white;
	}
	.box-2-mobile
	{
		padding-bottom: 3%;
		background-color: #bce8e652;
		border-radius: 0px 0px 10px 10px;
		margin-left: 5%;
		margin-right: 5%;
	}
	.formulario{margin-top: 0;}
	.redefinir{margin-left: 32%;}
}
@media only screen and (min-width: 426px) and (max-width: 768px)
{
	.desktop{display: none;}
	.desktop
	{
		display: none;
	}
	
	.desc-mob
	{
		font-size:15px;
		text-align: center;
		color: white;
		padding: 2%;
		margin-top: 5%;
	}
	
	
	.form-group{margin-bottom: 10px!important;}
	.botao
	{
		margin-left: 33%!important;
	}
	.i-mobile
	{
		position: relative!important;
		width: 17%!important;
		margin-top: -14%;
		left: 43%;
		height: auto;
		background-color: #ffffffb8;
		border-radius: 50%;
	}
	.box-mobile
	{
		margin-top: 6%;
		padding-top: 5%;
		padding-bottom: 3%;
		background-color: #bce8e652;
		border-radius: 10px 10px 0px 0px;
		margin-left: 5%;
		margin-right: 5%;
		color: white;
	}
	.box-2-mobile
	{
		padding-bottom: 3%;
		background-color: #bce8e652;
		border-radius: 0px 0px 10px 10px;
		margin-left: 5%;
		margin-right: 5%;
	}
	.formulario{margin-top: 0;}
	.redefinir{margin-left: 43%;}
	.left{left: 20%!important;}
}
@media only screen and (min-width: 1024px)
{
	.mobile{display: none;}
}

/*Botoões*/

.btn-primary
{

	border:1px solid #7d99ca;
	background-color: #00658d;

}
.btn-primary:hover{
	border:1px solid #5d7fbc;
	background-color: #1a4555;
}

.left
{
	position: relative;
	left: 5%;
	bottom: 0;
	float: left;
	padding-top: 0.5%;
}
.rigth
{
	position: relative;
	right: 5%;
	bottom: 0;
	float: right;
	padding-top: 0.5%;

}
.form-horizontal .control-label
{
	padding-top: 0;
	color: white;
}
.botao
	{
		margin-left: 28%;
	}
</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="src/bootstrap.min.js"></script>
	<script type="text/javascript" src="src/jquery.mask.min.js"></script>
</head>
<body>
	<div class="desktop">
		<h2 class="desc">ASPCRE - Associação de Servidores da Prefeitura da Cidade do Recife</h2>
		<h3 class= "pres"> Carlos Luiz: Presidente Inovador </h3>

		<div class="box">
			<div class="ic">
				<img class="i" src="assets/logo.jpg">
			</div>
			<h2>Redefinir Senha</h2>
		</div>

		<div class="box-2">
			<form class="form-horizontal formulario" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" >Nome Completo:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nome" placeholder="Digite Seu Nome Completo">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="cpf">CPF:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control cpf" name="cpf" " placeholder="Digite seu CPF">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="senha">Nova Senha:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="senha" placeholder="Digite uma Senha">
					</div>
				</div>
				<div class="form-group">
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="botao">
							<button type="submit" class="btn btn-primary">Mudar Senha</button>
						</div>
					</div>
				</div>
			</form>

			<div class="redefinir">

				<form method="get" action="index.php">
					<button class="btn btn-primary" type="submit">Voltar ao Login</button>
				</form>
			</div>
		</div>
	</div>

	<div class="mobile">
		<h2 class="desc-mob">ASPCRE - Associação de Servidores da Prefeitura da Cidade do Recife</h2>

		<div class="box-mobile">
			<img class="i-mobile" src="assets/logo.jpg">
		</div>

		<div class="box-2-mobile">
			<form class="form-horizontal formulario" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" >Nome Completo:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nome" placeholder="Digite Seu Nome Completo">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="cpf">CPF:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control cpf" name="cpf" " placeholder="Digite seu CPF">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="senha">Nova Senha:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="senha" placeholder="Digite uma Senha">
					</div>
				</div>
				<div class="form-group">
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="botao">
							<button type="submit" class="btn btn-primary">Mudar Senha</button>
						</div>
					</div>
				</div>
			</form>

			<div class="redefinir">

				<form method="get" action="index.php"><br>
					<button class="btn btn-primary" type="submit">Voltar ao Login</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.cpf').mask('000.000.000-00');
	});
</script>

<?php
include 'footer.php';

$_SESSION['scriptcase']['display_mobile'] = false; 
$_SESSION['scriptcase']['device_mobile'] = false;

if(isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['senha'])){
	$cpf= $_POST['cpf'];
	// Elimina possivel mascara
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

	$senha= $_POST['senha'];
	$nome = $_POST['nome'];
	$query = $conexao->query("SELECT id,nome,cpf,prioridade FROM usuario WHERE `cpf`='$cpf' AND `nome`= '$nome'");

	$row = $query->fetch_assoc();
	if ($row) {
		$query = $conexao->query("UPDATE usuario SET `senha` = '$senha' WHERE `cpf`='$cpf'");
		echo "<script type='text/javascript'>
		alert('Senha Alterada!');
		window.location.href = 'index.php';
		</script>";
				// header("location:index.php");
	}else{ 
	echo "<script>alert('Dados inseridos incorretos')</script>";		
 }
}  ?>
</body>
</html>
