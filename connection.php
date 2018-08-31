<?php
	$host = "localhost";
	$user = "u683890805_aspcr";
	$pass = "g4dOeMQM4PVWDH8";
	$banco = "u683890805_aspcr";
	//user: u683890805_aspcr
	//bd: u683890805_aspcr
	//g4dOeMQM4PVWDH8
	$conexao = new mysqli($host, $user, $pass,$banco);
	// $conexao->query('SET character_set_connection=utf8');
	// $conexao->query('SET character_set_client=utf8');
	$conexao->query('SET character_set_results=utf8');

// Check connection
if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}
?>
