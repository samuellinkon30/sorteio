<?php

session_start();
include 'connection.php';

if(isset($_SESSION['id'])){
	if($_SESSION['adm'] == true) {
		header("location:administrador.php");
	} else {
		header("location:usuario.php");
	}
}
global $cpf;
if(isset($_POST['cpf']) && $_POST['cpf'] != null){
	$cpf = $_POST['cpf'];
	// Elimina possivel mascara
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	// die($cpf);
}
?>

<!DOCTYPE html>
<html lang= "pt-br">
<head>
	<meta charset="utf-8">
	<title>Sistema Sorteio</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="src/bootstrap3.3.7.min.js"></script>
	<script src="src/jquery.mask.min.js"></script>
</head>
<body>
	<div class="desktop">
		<h2 class="desc">ASPCRE - Associação de Servidores da Prefeitura da Cidade do Recife</h2>
		<h3 class= "pres"> Carlos Luiz: Presidente Inovador </h3>

		<div class="box">
			
				<img class="i" src="assets/logo.jpg">
		
			<h2 class="nome-login">Login</h2>
		</div>

		<div class="box-2">
			<form class="form-horizontal formulario" method="POST">

				<div class="form-group">
					<label class="control-label col-sm-2" for="cpf">CPF:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control cpf" name="cpf" placeholder="Digite seu CPF" value="<?php echo $cpf; ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Senha:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="senha" placeholder="Digite sua Senha">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">Logar</button>
					</div>
				</div>
			</form>

			<div class="redefinir">
				<form class=" button-1" method="get" action="cadastro.php">
					<button class="btn btn-primary" type="submit">Cadastrar</button>
				</form >

				<form class="button-2" method="get" action="redefinir.php">
					<button class="btn btn-primary" type="submit">Redefinir Senha</button>
				</form >
			</div>
		</div>
		<?php
		if (isset($_POST['cpf']) && isset($_POST['senha'])) {
			$senha = $_POST['senha'];
			if (isset( $_POST['tipo'])) {
				$tipo=  $_POST['tipo'];
			}
			$query = $conexao->query("SELECT id,nome,prioridade,cpf FROM `usuario` WHERE `cpf`='$cpf' and `senha`='$senha'");
			$row = $query->fetch_assoc();
			$cpf = $row['cpf'];
			$prioridade = $row['prioridade'];
			if (isset($cpf)) {
				if ($prioridade==1) {
					$_SESSION['id'] = $row['id'];
					$_SESSION['adm'] = true;
					header("location:administrador.php");
				} else if($prioridade == 0) {
					$_SESSION['id'] = $row['id'];
					header("location:usuario.php");
				}
			} else {
				// die("SELECT id,nome,prioridade,cpf FROM `usuario` WHERE `cpf`='$cpf' and `senha`='$senha'");
				?>
				<script> alert('CPF ou Senha incorretos!'); </script>
				<?php
			}
		}
		?>
	</div>



	<div class="mobile">
		<h2 class="desc-mob">ASPCRE - Associação de Servidores da Prefeitura da Cidade do Recife</h2>

		<img class="i-mobile" src="assets/logo.jpg" width="200px" height="200px">

		<div class="box-mobile">
			<form class="form-horizontal formulario" method="POST">

				<div class="form-group">
					<label class="control-label col-sm-2" for="cpf">CPF:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control cpf" name="cpf" placeholder="Digite seu CPF" value="<?php echo $cpf; ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Senha:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="senha" placeholder="Digite sua Senha">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">Logar</button>
					</div>
				</div>
			</form>
			<div class="redefinir">
				<form class=" button-1" method="get" action="cadastro.php">
					<button class="btn btn-primary" type="submit">Cadastrar</button>
				</form >

				<form class="button-2" method="get" action="redefinir.php">
					<button class="btn btn-primary" type="submit">Redefinir Senha</button>
				</form >
			</div>
		</div>
	</div>
	<?php include 'footer.php';?>
	<div class="tablet">
		<h2 class="desc-mob">ASPCRE - Associação de Servidores da Prefeitura da Cidade do Recife</h2>

		<img class="i-mobile" src="assets/logo.jpg" width="200px" height="200px">

		<div class="box-mobile">
			<form class="form-horizontal formulario" method="POST">

				<div class="form-group">
					<label class="control-label col-sm-2" for="cpf">CPF:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="cpf" placeholder="Digite seu CPF" value="<?php echo $cpf; ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Senha:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="senha" placeholder="Digite sua Senha">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">Logar</button>
					</div>
				</div>
			</form>
			<div class="redefinir">
				<form class=" button-1" method="get" action="cadastro.php">
					<button class="btn btn-primary" type="submit">Cadastrar</button>
				</form >

				<form class="button-2" method="get" action="redefinir.php">
					<button class="btn btn-primary" type="submit">Redefinir Senha</button>
				</form >
			</div>
		</div>	
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.cpf').mask('000.000.000-00');
	});
</script>

</body>
</html>

<style>
/*CSS da versão Mobile com largura max de 320px*/
@media only screen and (max-width: 320px)
{
	.desktop{display: none;}
	.tablet{display: none;}

	.col-sm-offset-2
	{
		margin-left: 3%!important;
	}
	.desc-mob
	{
		font-size:20px!important;
		text-align: center!important;
		color: white!important;
		padding: 2%!important;
	}
	.redefinir
	{
		padding:0!important;
		margin-left: 0%!important;
	}
	.form-horizontal .form-group
	{
		margin-left: 0!important;
		margin-right: 0!important;
	}
	.btn-primary
	{
		margin-left: 40%!important;
	}
	.i-mobile
	{
		position: relative!important;
		width: 30%!important;
		height: auto!important;
		left: 35%!important;
		top: 20%!important;
		background-color: #ffffffb8!important;
		border-radius: 50%!important;
	}
	.box-mobile
	{
		margin-top: -6%!important;
		padding-top: 4%!important;
		padding-bottom: 3%!important;
		background-color: #bce8e652!important;
		border-radius: 10px 10px 10px 10px!important;
		margin-left: 5%!important;
		margin-right: 5%!important;
	}
}
/*CSS da versão Mobile com largura max de 425px e min de 320px*/

@media only screen and (max-width: 426px) and (min-width: 321px)
{
	.desktop{display: none;}
	.tablet{display: none;}

	.col-sm-offset-2
	{
		margin-left: 3%!important;
	}
	.desc-mob
	{
		font-size:20px!important;
		text-align: center!important;
		color: white!important;
		padding: 2%!important;
	}
	.redefinir
	{
		padding:0!important;
		margin-left: 10%!important;
	}
	.form-horizontal .form-group
	{
		margin-left: 0!important;
		margin-right: 0!important;
	}
	.btn-primary
	{
		margin-left: 40%!important;
	}
	.i-mobile
	{
		position: relative!important;
		width: 30%!important;
		height: auto!important;
		left: 35%!important;
		top: 20%!important;
		background-color: #ffffffb8!important;
		border-radius: 50%!important;
	}
	.box-mobile
	{
		margin-top: -4%!important;
		padding-top: 4%!important;
		padding-bottom: 3%!important;
		background-color: #bce8e652!important;
		border-radius: 10px 10px 10px 10px!important;
		margin-left: 5%!important;
		margin-right: 5%!important;
	}

}
/*CSS da versão Tablet com largura max de 425px e min de 320px*/

@media only screen and (min-width: 426px) and (max-width: 769px)
{
	.desktop{display: none;}
	.mobile{display: none;}
	
	.col-sm-offset-2
	{
		margin-left: 10%!important;
	}
	.desc-mob
	{
		font-size:20px!important;
		text-align: center!important;
		color: white!important;
		padding: 2%!important;
	}
	.redefinir
	{
		padding:0!important;
		margin-left: 22%!important;
	}
	.form-horizontal .form-group
	{
		margin-left: 0!important;
		margin-right: 0!important;
	}
	.btn-primary
	{
		margin-left: 40%!important;
	}
	.i-mobile
	{
		position: relative!important;
		width: 110px!important;
		height: auto!important;
		left: 45%!important;
		top: 10%!important;
		background-color: #ffffffb8!important;
		border-radius: 50%!important;
		margin-top: -1%;
	}
	.box-mobile
	{
		margin-top: -3%!important;
		padding-top: 4%!important;
		padding-bottom: 1%!important;
		background-color: #bce8e652!important;
		border-radius: 10px 10px 10px 10px!important;
		margin-left: 15%!important;
		width: 70%;
	}

	.btn btn-primary
	{
		margin-left: 2%!important;
	}
}
/*CSS da versão Desktop com largura max de 1024px e min de 768px*/
@media only screen and (min-width: 769px) and (max-width:1024px)
{
	.mobile{display: none;}
	.tablet{display: none;}
	.desc
	{
		color: white;
		text-shadow: 1px 1px black;
		margin-top:6%;
		font-size: 1.5em;
	}
	.pres{
		color: white;
		text-shadow: 1px 1px black;
	}
	.btn btn-primary
	{
		margin-left: 35%!important;
	}
	.box
	{
		margin-top: 7%;
		background-color:#bce8e652;
		width: 30%;
		margin-left: 37%;
		border-radius: 10px 10px 0px 0px;
		background-attachment: fixed;
		background-position: center;
		border-style: solid;
		border-width: 5px 3px 0px 3px;
		border-color: #bce8e652;
		padding-top: 1%;
		opacity: 1;
		color: white;
	}
	.i
	{
		width: 100px;
		position: relative;
		border-radius: 50%;
		margin-top: -27%;
		border-radius: 45%;
		background-color: #ffffffc9;
		border: 1px solid #2e6da4;
		left: 34%;
		
	}
	.box-2
	{
		width: 30%;
		margin-left: 37%;
		background-color:#bce8e652;
		background-attachment: fixed;
		background-position: center;
		border-style: solid;
		border-width: 0px 3px 5px 3px;
		border-color: #bce8e652;
		border-radius: 0px 0px 10px 10px;

	}
	.box h2
	{
		margin-bottom: 0px;
		padding-bottom: 15px;
	}
	.col-sm-offset-2
	{
		margin-left: 38%;
	}
	.redefinir
	{
		width: 100%;
		margin-top: 5%;
		float: left;
		padding-left: 10%;
		margin-left: -8%
	}
	.formulario
	{
		width: 86%;
		margin-left: 4%;
		padding-bottom: 0%;
	}
}
/*CSS da versão Desktop com largura min de 1024px*/
@media only screen and (min-width:1024px)
{
	.mobile{display: none;}
	.tablet{display: none;}
	.desc
	{
		color: white;
		text-shadow: 1px 1px black;
		margin-top:6%;
		font-size: 2em;
	}
	.pres{
		color: white;
		text-shadow: 1px 1px black;
	}
	.btn btn-primary
	{
		margin-left: 35%!important;
	}
	.nome-login
	{
		margin:0;
	}
	.box
	{
		margin-top: 7%;
		background-color:#bce8e652;
		width: 30%;
		margin-left: 34%;
		border-radius: 10px 10px 0px 0px;
		background-attachment: fixed;
		background-position: center;
		border-style: solid;
		border-width: 5px 3px 0px 3px;
		border-color: #bce8e652;
		padding-top: 1%;
		opacity: 1;
		color: white;
	}
	.i
	{
		width: 100px;
		position: relative;
		border-radius: 50%;
		margin-top: -27%;
		border-radius: 45%;
		background-color: #ffffffc9;
		border: 1px solid #2e6da4;
		left: 36%;
		
	}
	.box-2
	{
		width: 30%;
		margin-left: 34%;
		background-color:#bce8e652;
		background-attachment: fixed;
		background-position: center;
		border-style: solid;
		border-width: 0px 3px 5px 3px;
		border-color: #bce8e652;
		border-radius: 0px 0px 10px 10px;

	}
	.box h2
	{
		margin-bottom: 0px;
		padding-bottom: 15px;
	}
	.col-sm-offset-2
	{
		margin-left: 38%;
	}
	.redefinir
	{
		width: 100%;
		margin-top: 5%;
		float: left;
		padding-left: 25%;
	}
	.formulario
	{
		width: 86%;
		margin-left: 4%;
		padding-bottom: 0%;
	}
}
/*Cor Botoões*/
.btn-primary
{
	border:1px solid #7d99ca;
	background-color: #00658d;
}
.btn-primary:hover
{
	border:1px solid #5d7fbc;
	background-color: #1a4555;
}
</style>
