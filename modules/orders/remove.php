<?php
if (!isset($_GET["id"])) {
	get_404_content();
} else {
	$dbh = get_connection();

	$stmt = $dbh->prepare("DELETE FROM `orders` WHERE `id` = :id");
	$stmt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
	$stmt->execute();

	$_SESSION["msg"] = [1, "Pedido removido com sucesso!"];
	echo '<script type="text/javascript">window.location.replace("./?module=orders&action=manage");</script>';
}