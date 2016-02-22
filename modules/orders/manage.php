<?php 

$dbh = get_connection();

$stmt = $dbh->prepare("SELECT * FROM `orders` ORDER BY `id` ASC");
$stmt->execute();
$orders = $stmt->fetchAll();

?>
<div class="container-fluid">
    <div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Gerenciar pedidos</h1>
			<?php
			if (isset($_SESSION["msg"])) {
				$msg = $_SESSION["msg"];
				$type = $msg[0];
				$message = $msg[1];

				if ($type) {
					echo '<div class="alert alert-success" role="alert"><i class="glyphicon glyphicon-ok"></i> ' . $message . '</div>';
				} else {
					echo '<div class="alert alert-danger" role="alert"><i class="glyphicon glyphicon-remove"></i> ' . $message . '</div>';
				}

				unset($_SESSION["msg"]);
			}
			?>
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">Pedidos cadastrados</div>					
				<!-- Table -->
				<table class="table">
					<tbody>
						<tr style="font-weight: bold;">
							<td>#</td>
							<td>Nome completo</td>
							<td>Status</td>
							<td>Endereço de saida</td>
							<td>Endereço de chegada</td>
							<td>Ações</td>
						</tr>
						<?php
						foreach($orders as $order) {
							echo '
								<tr>
									<td>' . $order["id"] . '</td>
									<td>' . $order["name"] . '</td>
									<td>' . translate_order_status($order["status"]) . '</td>
									<td>' . $order["ed_from"] . '</td>
									<td>' . $order["ed_to"] . '</td>
									<td id="actions"><a href="./?module=orders&action=edit&id=' . $order["id"] . '" class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Editar"></a><a href="./?module=orders&action=remove&id=' . $order["id"] . '" onclick="return confirm(\'Você tem certeza que deseja remover esse pedido?\');" class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Remover"></a></td>
								</tr>
							';
						}
						?>
					</tbody>
				</table>
			</div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>