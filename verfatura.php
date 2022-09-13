<?php
include("conexao.php");

function getprodutonamebyID($id) {
	$servername = "localhost";
$username = "root";
$password = "";

try {

	$conn = new PDO("mysql:host=$servername;dbname=database", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Deu certo";
	
} catch (Exception $e) {
	echo "Erro ao conectar: " . $e->getMessage();
}
	$stmt = $conn->prepare("SELECT descricao FROM produtos WHERE codigo='$id' LIMIT 1"); 
    $stmt->execute();
	while($row = $stmt->fetch()) {
		return $row['descricao'];
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Estacio :: PDV</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="custom.css" />
  <!-- Adicionando links para o modal-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
  <div class="container">

    <div class="header clearfix">
        <h3 class="text-muted">Mateus :: PDV</h3>
    </div>
<?php

	if(isset($_GET['faturaid'])) {
	$faturaid = $_GET['faturaid'];
	} else {
	$faturaid = 'error';
	}
	
		try {

              $stmt = $conn->prepare("SELECT * FROM fatura WHERE id='$faturaid' LIMIT 1"); 
              $stmt->execute();
			  
                      while($row = $stmt->fetch()) {
                      $pagamento = $row['pagamento'];
					  $valortotal = $row['valortotal'];
					  $datahora = $row['datahora'];
                      } 
                              
          } catch (Exception $e) {
            echo "Erro de conexao({$e->getMessage()})";
          }
	?>
    <form class="form-inline">
      <div class="form-group">
        <label for="cliente">Fatura #<?php echo $faturaid;?></label><br/>
		<label for="pagamento">Forma de pagamento: <?php echo $pagamento;?></label><br/>
		<label for="datahora">Data/Hora: <?php echo $datahora; ?></label>
    </form>

    <hr>
      <div class="table">
        <table class=" table table-condensed" id="tableA">
        <thead class="thead">
        <tr>
          <th>Código</th>
          <th>Descrição</th>
          <th>Valor</th>
          <th>Quantidade</th>
        </tr>
        </thead>
        <tbody class="tbody" name="tbody" id="tbody">
        </tbody>
        <tfoot>
		<?php
		try {

              $stmt = $conn->prepare("SELECT * FROM produtosvendidos WHERE fatura_id='$faturaid'"); 
              $stmt->execute();
				$quantidadetotal = 0;
                      while($row = $stmt->fetch()) {
					  $produto_id = $row['produto_id'];
					  $produto_nome = getprodutonamebyID($produto_id);
					  $valor = $row['valor'];
					  $quantidade = $row['quantidade'];
					  $quantidadetotal = $quantidadetotal + $quantidade;
					  
					  echo "<tr>";
					  echo "<td>".$produto_id."</td>";
					  echo "<td>".$produto_nome."</td>";
					  echo "<td>".$valor."</td>";
					  echo "<td>".$quantidade."</td>";
					  echo "</tr>";
                      } 
                              
          } catch (Exception $e) {
            echo "Erro de conexao({$e->getMessage()})";
          }
		?>
        <tr>
        <th></th>
        <th></th>
          <th>Valor Total</th>
          <th>Total de itens</th>
        </tr>
        <tr>
          <th></th>
          <th></th>
          <th id="valortotal"><?php echo round($valortotal, 2);?></th>
          <th id="totalitens"><?php echo $quantidadetotal;?></th>
        </tr>
        </tfoot>
        </table>
        <span id="span"></span>
      </div>
	  <div class="form-group">
		<a href="listarvendas.php"><button type="button" name="enviar" class="btn btn-primary">Voltar</button></a>          
      </div>
    </div>
	<form id="produtosform" role="form" method="POST" action="">
	</form>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
      integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
</html>
