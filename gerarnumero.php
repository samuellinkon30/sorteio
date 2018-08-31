<?php
include 'connection.php';
session_start();
$id = $_SESSION['id'];
// $voltar = $_GET['voltar'];

//verifica se o usuario já está participando do sorteio

$sql = "SELECT 1 FROM dados_sorteio WHERE usuario_id = ".$id;
$result = $conexao->query($sql);
$row = $result->fetch_assoc();

if(!$row){
	$sql = "INSERT INTO dados_sorteio (datasorteio,usuario_id) VALUES (current_timestamp,'".$id."')";
	$result = $conexao->query($sql);

	echo "<script> alert('Agora você está participando do sorteio atual!');
				window.location = 'usuario.php';
				</script>";
	// header('Location: usuario.php');
} else {
	echo "<script> alert('Você já está participando do sorteio atual!');
				window.location = 'usuario.php';
				</script>";
}

?>