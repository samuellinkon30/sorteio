<?php
session_start();
include 'connection.php';
$id = $_SESSION['id'];

if(isset($_POST['submit'])){
	$file = $_FILES['file'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg','jpeg','png','pdf');

	if(in_array($fileActualExt, $allowed)){
		if($fileError === 0){
			if($fileSize < 1000000){
				$fileNameNew = "usuario".$id.".".$fileActualExt;
				$fileDestination = 'imagemperfil/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				$sql = "UPDATE usuario SET imgurl = '$fileDestination'  WHERE id = $id ;";
				$result = $conexao->query($sql);
				header("Location: editarperfil.php");
			} else {
				echo "<script>alert('Arquivo muito grande!');
							window.location = 'editarperfil.php';</script>";
			} 
		} else {
			echo "<script>alert('Houve um erro no upload do arquivo!');
						window.location = 'editarperfil.php;'</script>";
		}
	} else {
		echo "<script>alert('Formato de imagem não suportado!');
					window.location = 'editarperfil.php';</script>";
	}
}
?>