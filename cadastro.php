<?php
include 'util.php';
$_SESSION['scriptcase']['display_mobile'] = false; 
$_SESSION['scriptcase']['device_mobile'] = false;
include 'connection.php';
echo "	<meta charset='utf-8'>";
$nome="";
if(isset($_POST['nome'])){
	$nome = $_POST['nome'];
}
$cpf="";
if(isset($_POST['cpf'])){
	$cpf = $_POST['cpf'];
}
$senha="";
if(isset($_POST['senha'])){
	$senha = $_POST['senha'];
}
$empresa_id="";
if(isset($_POST['empresa_id'])){
	$empresa_id = $_POST['empresa_id'];
}
$modo="";
if(isset($_POST['modo'])){
	$modo = $_POST['modo'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="cadastro.css">
	<link rel="stylesheet" href="css/bootstrap3.0.3.min.css">
	<style>

@media only screen and (min-width: 320px) and (max-width: 425px)
{
	h2
	{
		margin-top: 0;
		margin-bottom: 0;
	}
	.formulario
	{
		margin-top: 0;
	}
	.desktop
	{
		display: none;
	}
	.form-group
	{
		margin-bottom: 0;
	}
	.desc-mob
	{
		font-size:15px;
		text-align: center;
		color: white;
		padding: 2%;
		margin-top: 5%;
	}
	.btn-primary
	{
		margin-top: 4%;
	}
	.redefinir
	{
		margin-left: 18%;
	}
	.form-horizontal .form-group
	{
		margin-left: 0;
		margin-right: 0;
	}
	.i-mobile
	{
		position: relative!important;
		width: 25%!important;
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

}
@media only screen and (min-width: 375px) and (max-width: 425px)
{
	h2
	{
		margin-top: 0;
		margin-bottom: 0;
	}
	.formulario
	{
		margin-top: 0;
	}
	.desktop
	{
		display: none;
	}
	.form-group
	{
		margin-bottom: 0;
	}
	.desc-mob
	{
		font-size:15px;
		text-align: center;
		color: white;
		padding: 2%;
		margin-top: 5%;
	}
	.btn-primary
	{
		margin-top: 4%;
	}
	.redefinir
	{
		margin-left: 19%;
	}
	.form-horizontal .form-group
	{
		margin-left: 0;
		margin-right: 0;
	}
	.i-mobile
	{
		position: relative!important;
		width: 25%!important;
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
		.btn-primary
{margin-left: 34%!important;}

}
@media only screen and (min-width: 426px) and (max-width: 1025px)
{


	.desktop
	{
		display: none;
	}
	.desc-mob
	{
		font-size:20px;
		text-align: center;
		color: white;
		padding: 2%;
		margin-top: 3%;
	}
	.i-mobile
	{
		position: relative!important;
		width: 13%!important;
		margin-top: -6%;
		margin-bottom: 2%;
		left: 46%;
		height: auto;
		background-color: #ffffffb8;
		border-radius: 50%;
	}
	.box-mobile
	{
		background-color: #bce8e652;
		border-radius: 10px 10px 0px 0px;
		margin-left: 5%;
		margin-right: 5%;
		margin-top: 5%;
	}
	.box-2-mobile
	{
		background-color: #bce8e652;
		border-radius: 0px 0px 10px 10px;
		margin-left: 5%;
		margin-right: 5%;
	}
	.formulario
	{
		margin-top: 0;
	}
.form-horizontal .form-group
	{
		margin-top: 0px;
	}
.col-sm-offset-2
{
	padding-bottom: 1%;
}
	.redefinir
	{
		margin-left: 29%;
		margin-top: 0;
	}
}
@media only screen and (min-width: 1025px)
{
	.mobile{display: none;}
	.left{padding-left: 5%!important0;padding-right: 5%!important;}


}
/*Cor Botoões*/

.btn-primary
{

	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	font-size:15px;
	margin-left: 30%;
border:1px solid #7d99ca;
	background-color: #00658d;}
.btn-primary:hover{
	border:1px solid #5d7fbc;
	background-color: #1a4555;
}
/*Cor Botoões*/
.form-horizontal .control-label
{
	padding-top: 0;
	color: white;
}
	.left
{
	padding-left: 5%!important;
	bottom: 0;
	float: left;
	padding-top: 0.5%;
}
</style>
	<script src="src/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="jquery-3.2.1.min.js"></script> -->
	<script type="text/javascript" src="src/jquery.mask.min.js"></script>
	<script src="src/bootstrap3.3.7.min.js"></script>
</head>
<body>
	<div class="desktop">
		<h2 class="desc">ASPCRE - Associação de Servidores da Prefeitura da Cidade do Recife</h2>
		<h3 class= "pres"> Carlos Luiz: Presidente Inovador </h3>
		<div class="box">
			<div class="ic">
				<img class="i" src="assets/logo.jpg">
			</div>
			<h2>Cadastro</h2>
		</div>
		<div class="box-2">
			<form class="form-horizontal formulario" method="POST" action="cadastro.php">
			<input type="hidden" name="modo" value="inserir"/>
				<div class="form-group">
					<label class="control-label col-sm-2" >Empresa:</label>
					<div class="col-sm-10">
						<select class="form-control" name="empresa_id" class="empresa_id">
							<option value="">Selecione a empresa onde trabalha...</option>
							<?php
							$sql = "SELECT id,nome FROM empresa WHERE id > -1 ";
							$result = $conexao->query($sql);
							$row = $result->fetch_assoc();
							while($row){
								$selected = "";
								if($row['id'] == $empresa_id) {
									$selected = "selected";
								}
								echo "<option value='".$row['id']."' $selected>".$row['nome']."</option>";
								$row = $result->fetch_assoc();
							}
							?>
							<option value="-1" <?php if($empresa_id == '-1') echo "selected"; ?>>Outros</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" >Nome Completo:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>" placeholder="Digite Seu Nome Completo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="cpf">CPF:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control cpf" name="cpf" value="<?php echo $cpf; ?>" placeholder="Digite seu CPF" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="senha">Senha:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="senha" placeholder="Digite uma Senha" required>
					</div>
				</div>
				<div class="form-group">
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">Cadastrar</button>
					</div>
				</div>
			</form>
		</div>
		<div class="redefinir">
			<form method="get" action="index.php">
				<button class="btn btn-primary" type="submit">Voltar ao Login</button>
			</form>
		</div>
	</div>

	 <div  class="mobile">

		<h2 class="desc-mob">ASPCRE - Associação de Servidores da Prefeitura da Cidade do Recife</h2>

		<div class="box-mobile">
				<img class="i-mobile" src="assets/logo.jpg">
		</div>

		<div class="box-2-mobile">
			<form class="form-horizontal formulario" method="POST" action="cadastro.php">
			<input type="hidden" name="modo" value="inserir"/>
				<div class="form-group">
					<label class="control-label col-sm-2" >Empresa:</label>
					<div class="col-sm-10">
						<select class="form-control" name="empresa_id" class="empresa_id">
							<option value="">Selecione a empresa onde trabalha...</option>
							<?php
							$sql = "SELECT id,nome FROM empresa WHERE id > 0 ";
							$result = $conexao->query($sql);
							$row = $result->fetch_assoc();
							while($row){
								$selected = "";
								if($row['id'] == $empresa_id) {
									$selected = "selected";
								}
								echo "<option value='".$row['id']."' $selected>".$row['nome']."</option>";
								$row = $result->fetch_assoc();
							}
							?>
							<option value="-1">Outros</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" >Nome Completo:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>" placeholder="Digite Seu Nome Completo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="cpf">CPF:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control cpf" name="cpf" value="<?php echo $cpf; ?>" placeholder="Digite seu CPF" required>
					</div>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
    				$('.cpf').mask('000.000.000-00');
					});
				</script>
				<div class="form-group">
					<label class="control-label col-sm-2" for="senha">Senha:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="senha" placeholder="Digite uma Senha" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">Cadastrar</button>
					</div>
				</div>
			</form>
		</div>
		<div class="redefinir">
			<form method="get" action="index.php">
				<button class="btn btn-primary" type="submit">Voltar ao Login</button>
			</form>
		</div>
	</div>
	<?php include 'footer.php';?>
</body>
</html>
<?php
if($modo == "inserir") {
	if($senha && $nome && $cpf){
			// Elimina possivel mascara
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		$query2 = $conexao->query("SELECT cpf FROM `usuario` WHERE `cpf`='$cpf' ");
		$row =  $query2->fetch_assoc();
		if($row) {
			echo "<script> alert('CPF digitado já possui cadastro!');</script>";
		} else if(!validaCPF($cpf)) {
			echo "<script> alert('CPF inválido!');</script>";
		} else if(strlen($senha) < 4 || strlen($senha) > 6 ) {
			echo "<script> alert('A senha deve possuir entre 4 e 6 dígitos!');</script>";
		} else if($empresa_id == null){
			echo "<script> alert('É necessário selecionar uma Empresa!');</script>";
		} else {
			$sql = "INSERT INTO usuario (nome,senha,cpf,empresa_id) VALUES('$nome','$senha','$cpf','$empresa_id')";
			if($conexao->query($sql)){
				echo "<script> alert('Cadastro completo com sucesso!');
				window.location = 'index.php'; </script>";
			} else {
				echo "<script> alert('Ocorreu um erro durante o cadastro'); </script>";
			}
		}
	}
}
?>
