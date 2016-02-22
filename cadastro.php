<?php

require("./core/main.php");

if (isset($_POST["submit"])) {
	$name = htmlspecialchars($_POST["name"]);
	$cpf = htmlspecialchars($_POST["cpf"]);
	$email = htmlspecialchars($_POST["email"]);
	$location = htmlspecialchars($_POST["location"]);
	$password = sha1($_POST["password"]);
	$confirm_password = sha1($_POST["confirm_password"]);
	$rank = 0;
	$false = false;
	$null = NULL;

	if (empty($name) || empty($cpf) || empty($email) || empty($location) || empty($password) || $password == sha1("") || empty($confirm_password) || $confirm_password == sha1("")) {
		$msg = [0, "Preencha todos os campos!"];
	} else {
		if ($password == $confirm_password) {
			$dbh = get_connection();

			$stmt = $dbh->prepare("SELECT `id` FROM `users` WHERE `cpf` = :cpf OR `email` = :email");
			$stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();

			$rs = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($rs !== false) {
				$msg = [0, "Um usuário já está cadastrado com esse e-mail ou CPF!"];
			} else {
				$stmt = $dbh->prepare("INSERT INTO `users` (`email`, `name`, `cpf`, `location`, `password`, `password_req`, `password_req_time`, `password_req_hash`, `rank`) VALUES (:email, :name, :cpf, :location, :pwd, :pwd_req, :pwd_req_time, :pwd_req_hash, :rank)");
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindParam(":name", $name, PDO::PARAM_STR);
				$stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
				$stmt->bindParam(":location", $location, PDO::PARAM_STR);
				$stmt->bindParam(":pwd", $password, PDO::PARAM_STR);
				$stmt->bindParam(":pwd_req", $false, PDO::PARAM_BOOL);
				$stmt->bindParam(":pwd_req_time", $null, PDO::PARAM_NULL);
				$stmt->bindParam(":pwd_req_hash", $null, PDO::PARAM_NULL);
				$stmt->bindParam(":rank", $rank, PDO::PARAM_INT);
				$stmt->execute();

				$msg = [1, "Você foi cadastrado com sucesso!"];
			}
		} else {
			$msg = [0, "As senhas não conferem!"];
		}
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
		<title>Cadastro de novo parceiro</title>
		<link rel="stylesheet" type="text/css" href="./media/css/login.css" />
	</head>
	<body>
		<div id="logo" style="margin-top: -350px; !important;">Frete Agora</div>
		<div id="login-crate" style="top: 55% !important; margin-top: -265px !important; margin-bottom: 40px;">
			<?php
			if (isset($msg)) {
				$type = $msg[0];
				$message = $msg[1];

				if ($type) {
					echo '<div class="alert alert-success" role="alert"><i class="glyphicon glyphicon-ok"></i> ' . $message . '</div>';
				} else {
					echo '<div class="alert alert-danger" role="alert"><i class="glyphicon glyphicon-remove"></i> ' . $message . '</div>';
				}
			}
			?>
			<form id="login-form" method="post" action="<?= $_SERVER["REQUEST_URI"] ?>">
				<label for="name">Nome completo:</label>
				<input type="text" id="name" name="name" placeholder="ex. Fulano da Silva" required />
				<label for="cpf">Seu CPF:</label>
				<input type="text" id="cpf" name="cpf" placeholder="ex. 123.456.789-10" required />
				<label for="email">E-mail:</label>
				<input type="email" id="email" name="email" placeholder="ex. fulano@email.com" required />
				<label for="location">Localização atual:</label>
				<input type="text" id="location" name="location" placeholder="ex. João Pessoa - PB" required />
				<label for="password">Senha:</label>
				<input type="password" id="password" name="password" placeholder="******" required />
				<label for="confirm_password">Confirmar senha:</label>
				<input type="password" id="confirm_password" name="confirm_password" placeholder="******" required />
				<button type="submit" name="submit">Cadastrar</button>
			</form>
		</div>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="./media/js/masker.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#cpf").mask("999.999.999-99");
			});
		</script>
	</body>
</html>