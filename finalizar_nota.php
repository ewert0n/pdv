<?php  
include 'conexao.php';
if (isset($_POST['valortotal'])) {

	$produtos = $_POST['produtos'];
	$valortotal = $_POST['valortotal'];
	$formapagamento = $_POST['formapagamento'];
	$Object = new DateTime();  
	$DateAndTime = $Object->format("Y-m-d h:i:s");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO fatura (pagamento, valortotal, datahora)
    VALUES ('$_POST[formapagamento]', '$_POST[valortotal]', '$DateAndTime')";
    // use exec() because no results are returned
    $conn->exec($sql);
	
	$faturaid = 0;
	// PEGA A FATURA_ID PRA INSERIR OS PRODUTOS EM PRODUTOSVENDIDOS
	$stmt = $conn->prepare("SELECT * FROM fatura ORDER BY id DESC LIMIT 1");
    $stmt->execute();

    while ($row = $stmt->fetch()) {
    	$faturaid = $row['id'];
    }

	foreach($produtos as &$prod) {
		$div = explode(",", $prod);
	// PEGA A MARGEM DE LUCRO DO PRODUTO E O ESTOQUE DO PRODUTO
	$stmt = $conn->prepare("SELECT * FROM produtos WHERE codigo='$div[0]' ORDER BY produto_id DESC LIMIT 1");
    $stmt->execute();

    while ($row = $stmt->fetch()) {
    	$margemlucro = $row['margemlucro'];
		$estoque = $row['estoque'];
    }
		$estoque = $estoque - $div[3]; // DIMINUI O ESTOQUE
	
		$sql = "INSERT INTO produtosvendidos (fatura_id, valor, quantidade, margemlucro, produto_id)
    VALUES ('$faturaid', '$div[2]', '$div[3]', '$margemlucro', '$div[0]')";
		$conn->exec($sql);	
		
		// UPDATE NO ESTOQUE
		$sqla = "UPDATE produtos SET estoque='$estoque' WHERE codigo='$div[0]' LIMIT 1";
		$conn->exec($sqla);
	}

}
else{
    	//echo deu ruim
    }
?>