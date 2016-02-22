<?php 
require("../../core/main.php");

$dbh = get_connection();
$empty_pass = sha1("");

if (isset($_POST["submit"])) {
	$title = htmlspecialchars($_POST["title"]);
	$link = htmlspecialchars($_POST["link"]);
	$image_file = $_POST["image-file"];
	$id = $_POST["id"];

	if (empty($title)) {
		$msg = "0, Preencha todos os campos!";
	} else {
			$stmt = $dbh->prepare("UPDATE `banners` SET `title` = :title, `link` = :link, `image` = :image WHERE `id` = :id");
			$stmt->bindParam(":title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":link", $link, PDO::PARAM_STR);
			$stmt->bindParam(":image", $image_file, PDO::PARAM_STR);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			
			$stmt->execute();
			$msg = "1, Banner atualizado com sucesso!";
			setcookie("msg", $msg, time() + 1, "/");
			header("Location: ../../?module=banners&action=edit&id=" . $id);
	}
}