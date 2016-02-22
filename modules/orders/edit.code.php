<?php 
require("../../core/main.php");

$dbh = get_connection();
$empty_pass = sha1("");

if (isset($_POST["submit"])) {
	$name = htmlspecialchars($_POST["name"]);
	$email = htmlspecialchars($_POST["email"]);
	$phone = htmlspecialchars($_POST["phone"]);
	$ed_from = htmlspecialchars($_POST["ed_from"]);
	$ed_to = htmlspecialchars($_POST["ed_to"]);
	$subject = htmlspecialchars($_POST["subject"]);
	$comments = htmlspecialchars($_POST["comments"]);
	$status = $_POST["status"];
	$id = $_POST["id"];

	if (empty($name)) {
		$msg = "0, Preencha todos os campos!";
	} else {

				$stmt = $dbh->prepare("UPDATE `orders` SET `email` = :email, `name` = :name, `phone` = :phone, `ed_from` = :ed_from, `ed_to` = :ed_to, `subject` = :subject, `comments` = :comments,  `status` = :status WHERE `id` = :id");
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindParam(":name", $name, PDO::PARAM_STR);
				$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
				$stmt->bindParam(":ed_from", $ed_from, PDO::PARAM_STR);
				$stmt->bindParam(":ed_to", $ed_to, PDO::PARAM_STR);
				$stmt->bindParam(":subject", $subject, PDO::PARAM_STR);
				$stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
				$stmt->bindParam(":status", $status, PDO::PARAM_INT);
				$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			
			$stmt->execute();
			$msg = "1, Pedido atualizado com sucesso!";
			setcookie("msg", $msg, time() + 1, "/");
			header("Location: ../../?module=orders&action=edit&id=" . $id);
		
	}
}