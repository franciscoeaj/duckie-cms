<?php 
require("../../core/main.php");

$dbh = get_connection();

if (isset($_POST["submit"])) {
	$title = htmlspecialchars($_POST["title"]);
	$body = htmlspecialchars($_POST["body"]);
	$image_file = $_POST["image-file"];
	$id = $_POST["id"];

	if (empty($title) || empty($body)) {
		$msg = "0, Preencha todos os campos!";
	} else {
		if (!isset($image_file)) {
			$stmt = $dbh->prepare("UPDATE `texts` SET `title` = :title, `body` = :body WHERE `id` = :id");
			$stmt->bindParam(":title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":body", $body, PDO::PARAM_STR);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		} else {
			$stmt = $dbh->prepare("UPDATE `texts` SET `title` = :title, `body`, `image` = :image = :body WHERE `id` = :id");
			$stmt->bindParam(":title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":body", $body, PDO::PARAM_STR);
			$stmt->bindParam(":image", $image_file, PDO::PARAM_STR);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		}
		
		$stmt->execute();
		$msg = "1, Texto atualizado com sucesso!";
		setcookie("msg", $msg, time() + 1, "/");
		header("Location: ../../?module=texts&action=edit&id=" . $id);
	}
}