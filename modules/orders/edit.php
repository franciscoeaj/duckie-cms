<?php
if (!isset($_GET["id"])) {
	get_404_content();
} else {
	$dbh = get_connection();

	$stmt = $dbh->prepare("SELECT * FROM `orders` WHERE `id` = :id");
	$stmt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
	$stmt->execute();
	$order = $stmt->fetchAll();
}
?>
<div class="container-fluid">
    <div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Editando pedido: "<?= $order[0]["subject"]; ?>"</h1>
			<?php
			if (isset($_COOKIE["msg"])) {
				$msg = explode(", ", $_COOKIE["msg"]);
				$type = $msg[0];
				$message = $msg[1];

				if ($type) {
					echo '<div class="alert alert-success" role="alert"><i class="glyphicon glyphicon-ok"></i> ' . $message . '</div>';
				} else {
					echo '<div class="alert alert-danger" role="alert"><i class="glyphicon glyphicon-remove"></i> ' . $message . '</div>';
				}
			}
			?>
			<form method="post" action="./modules/orders/edit.code.php">
				<input type="hidden" name="id" value="<?= $_GET['id']; ?>" />
				<div class="input-group">
					<span class="input-group-addon" id="name-addon">Nome completo*</span>
					<input required value="<?= $order[0]['name'] ?>" class="form-control" aria-describedby="name-addon" required type="text" name="name" placeholder="ex. Fulano da Silva" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="email-addon">Endereço eletrônico*</span>
					<input required value="<?= $order[0]['email'] ?>" class="form-control" aria-describedby="email-addon" required type="email" name="email" placeholder="ex. fulano@site.com" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="location-addon">Telefone*</span>
					<input required value="<?= $order[0]['phone'] ?>" class="form-control phone-mask" aria-describedby="location-addon" type="text" name="phone" placeholder="ex. (83) 3948-1395" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="ed-saida-addon">Endereço de saída*</span>
					<input required value="<?= $order[0]['ed_from'] ?>" class="form-control" aria-describedby="ed-saida-addon" required type="text" name="ed_from" placeholder="ex. João Pessoa - PB" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="ed-chegada-addon">Endereço de chegada*</span>
					<input required value="<?= $order[0]['ed_to'] ?>" class="form-control" aria-describedby="ed-chegada-addon" type="text" name="ed_to" placeholder="ex. Campina Grande - PB" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="obj-addon">Objeto para entrega*</span>
					<input required value="<?= $order[0]['subject'] ?>" class="form-control" aria-describedby="obj-addon" type="text" name="subject" placeholder="ex. Alimentos perecíveis" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="obs-addon">Observações*</span>
					<input required value="<?= $order[0]['comments'] ?>" class="form-control" aria-describedby="obs-addon" type="text" name="comments" placeholder="ex. Transporte refrigerado" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="rank-addon">Situação do pedido*</span>
					<select class="form-control" aria-describedby="rank-addon" required name="status">
						<option <?= $order[0]['status'] == -1 ? "selected " : "" ?>value="-1">Selecione...</option>
						<option <?= $order[0]['status'] == 0 ? "selected " : "" ?>value="0">Concluido</option>
						<option <?= $order[0]['status'] == 1 ? "selected " : "" ?>value="1">Em andamento</option>
						<option <?= $order[0]['status'] == 2 ? "selected " : "" ?>value="2">Cancelado</option>
					</select>
				</div>
				<div class="alert alert-info" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-info-sign"></i> &nbsp;<b>Legenda:</b> * = campo obrigatório</div>
				<button class="btn btn-success" type="submit" name="submit">Fazer alterações</button>
			</form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>