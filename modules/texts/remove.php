<?php
if (!isset($_GET["id"])) {
	get_404_content();
} else {
	$dbh = get_connection();

	$stmt = $dbh->prepare("DELETE FROM `texts` WHERE `id` = :id");
	$stmt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
	$stmt->execute();

	$_SESSION["msg"] = [1, "Texto removido com sucesso!"];
	echo '<script type="text/javascript">window.location.replace("./?module=texts&action=manage");</script>';
}