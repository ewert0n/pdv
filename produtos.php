<?php include("conexao.php"); ?>
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

    <hr>
	<?php
		if(isset($_GET['excluir'])) {
			//EXCLUIR
			echo 'TEM CERTEZA QUE DESEJA EXCLUIR O ITEM '. $_GET['excluir'] .'?';
	?>
	<form role="form" method="POST" action="">
	<input type="hidden" name="produtoid" value="<?php echo $_GET['excluir'];?>">
	<div class="form-group">
        <button type="button" name="excluir" id="excluir" class="btn btn-primary">Excluir</button>
	</div>
	<div class="form-group">
        <button type="button" name="cancelar" id="cancelar" class="btn btn-primary">Cancelar</button>
	</div>
	</form>
	<?php
		} else if(isset($_GET['editar'])) {
			//EDITAR
		} else {
	?>
      <div class="table">
        <table class=" table table-condensed" id="tableA">
        <thead class="thead">
        <tr>
          <th>Código</th>
          <th>Descrição</th>
          <th>Valor de Compra</th>
          <th>Margem de Lucro</th>
		  <th>Valor de Venda</th>
		  <th>Estoque</th>
		  <th>Opções</th>
        </tr>
        </thead>
	<?php
		try {

              $stmt = $conn->prepare("SELECT * FROM produtos"); 
              $stmt->execute();

                  
                      while($row = $stmt->fetch()) {
                      echo "<tr>";
                      echo "<td>".$row['codigo']."</td>";
					  echo "<td>".$row['descricao']."</td>";
					  echo "<td>".round($row['valor'], 2)."</td>";
					  echo "<td>".$row['margemlucro']."</td>";
					  echo "<td>".round($row['valordevenda'], 2)."</td>";
					  echo "<td>".$row['estoque']."</td>";
					  echo "<td><a href='editarprodutos.php?produtoid=".$row['codigo']."'>Editar</a> - <a href='produtos.php?excluir=".$row['codigo']."'>Excluir</a></td>";
					  echo "</tr>";
                      } 
                              
          } catch (Exception $e) {
            echo "Erro de conexao({$e->getMessage()})";
          }
		}
		?>
        </table>
        <span id="span"></span>
		<div class="col-md-3">
                            <a href="index.php"><button type="button" name="enviar" class="btn btn-primary"> Voltar
                            </button></a>          
                        </div>
      </div>


</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
      integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
</html>
