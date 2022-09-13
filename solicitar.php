<?php  
include 'conexao.php';
$cod;
$descricao;
$valor;
if (isset($_POST['codigo'])) {

	$codigo = $_POST['codigo'];

	//echo $codigo;

	$stmt = $conn->prepare("SELECT * FROM produtos where codigo like :codigo");
    $stmt->execute(array('codigo' => $codigo));

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