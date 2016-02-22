<?php 

$dbh = get_connection();

$stmt = $dbh->prepare("SELECT `id`, `email`, `name`, `cpf`, `location`, `rank` FROM `users` ORDER BY `id` ASC");
$stmt->execute();
$users = $stmt->fetchAll();

?>
<div class="container-fluid">
    <div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Gerenciar usuários</h1>
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
				<div class="panel-heading">Usuários cadastrados</div>					
				<!-- Table -->
				<table class="table">
					<tbody>
						<tr style="font-weight: bold;">
							<td>#</td>
							<td>Nome completo</td>
							<td>Endereço eletrônico</td>
							<td>CPF</td>
							<td>Cargo</td>
							<td>Localização</td>
						</tr>
						<?php
						foreach($users as $user) {
							echo '
								<tr>
									<td>' . $user["id"] . '</td>
									<td>' . $user["name"] . '</td>
									<td>' . $user["email"] . '</td>
									<td>' . $user["cpf"] . '</td>
									<td>' . translate_rank($user["rank"]) . '</td>
									<td>' . translate_location($user["location"]) . '</td>
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