<?php 

$dbh = get_connection();

$stmt = $dbh->prepare("SELECT * FROM `texts` ORDER BY `id` ASC");
$stmt->execute();
$texts = $stmt->fetchAll();

?>
<div class="container-fluid">
    <div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Gerenciar textos</h1>
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
				<div class="panel-heading">Textos cadastradas</div>					
				<!-- Table -->
				<table class="table">
					<tbody>
						<tr style="font-weight: bold;">
							<td>#</td>
							<td>Título</td>
							<td>Slug</td>
							<td>Imagem</td>
							<td>Ações</td>
						</tr>
						<?php
						foreach($texts as $text) {
							echo '
								<tr>
									<td>' . $text["id"] . '</td>
									<td>' . $text["title"] . '</td>
									<td>' . $text["slug"] . '</td>
									<td>' . $text["image"] . '</td>
									<td id="actions"><a href="./?module=texts&action=edit&id=' . $text["id"] . '" class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Editar"></a><a href="./?module=texts&action=remove&id=' . $text["id"] . '" onclick="return confirm(\'Você tem certeza que deseja remover esse texto?\');" class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Remover"></a></td>
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

