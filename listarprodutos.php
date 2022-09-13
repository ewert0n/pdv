<?php   
include 'conexao.php';
$stmt = $conn->prepare("SELECT descricao FROM produtos");
$stmt->execute();
while ($row = $stmt->fetch()) {
	echo '"'.htmlentities($row['descricao']).'",';
}	
?>