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
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
          <th>Fatura</th>
          <th>Valor</th>
		  <th>Lucro</th>
          <th>Forma de Pagamento</th>
		  <th>Data / Hora</th>
		  <th>Opções</th>
        </tr>
        </thead>
		
	<?php	
		try {

              $stmt = $conn->prepare("SELECT * FROM fatura ORDER BY id"); 
              $stmt->execute();

						$lucroperiodo = 0;
                      while($row = $stmt->fetch()) {
                      echo "<tr>";
                      echo "<td>".$row['id']."</td>";
					  echo "<td>R$ ".$row['valortotal']."</td>";
					  
					  echo "<td>";
					  //PEGA O LUCRO DOS PRODUTOS VENDIDOS
					  $stmta = $conn->prepare("SELECT * FROM produtosvendidos WHERE fatura_id = '$row[id]'"); 
					  $stmta->execute();
					  $totallucro = 0;
						while($rowa = $stmta->fetch()) {
							$valor = $rowa['valor'];
							$qtd = $rowa['quantidade'];
							$total = $valor * $qtd;
							
							$margemlucro = $rowa['margemlucro'];
							
							$lucro = $total - ($total / 100 * $margemlucro);
							$lucro = $total - $lucro;
							
							$totallucro = $totallucro + $lucro;
							
						}
						echo "R$ ".round($totallucro, 2);
						$lucroperiodo = $lucroperiodo + $totallucro;
					echo "</td>";
					  echo "<td>".$row['pagamento']."</td>";
					  echo "<td>".$row['datahora']."</td>";
					  echo "<td><a href='verfatura.php?faturaid=".$row['id']."'>Visualizar Fatura</td>";
					  echo "</tr>";
                      } 
                              
          } catch (Exception $e) {
            echo "Erro de conexao({$e->getMessage()})";
          }
		  echo "Lucro Total no Periodo: R$ " .round($lucroperiodo, 2);
		}
		?>
		- Data <input type="text" name="dates" id="dates" value="">
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script>
		$('input[name="dates"]').daterangepicker();
		$('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
	  alert($(this).val());
  });
	</script>
</html>
