<?php  
include 'conexao.php';
$cod;
$descricao;
$valor;
if (isset($_POST['descricao'])) {

	$descricao = $_POST['descricao'];

	//echo $codigo;

	$stmt = $conn->prepare("SELECT * FROM produtos where descricao like :descricao");
    $stmt->execute(array('descricao' => $descricao));

    while ($row = $stmt->fetch()) {
    	echo json_encode(array(
    		"codigo" => $row['codigo'],
    		"descricao" => $row['descricao'],
    		"valor" => $row['valordevenda']));

    	$cod = $row['codigo'];
    	$descricao = $row['descricao'];
    	$valor = $row['valordevenda'];
    }

}
else{
    	//echo "Deu merda!";
    }
?>