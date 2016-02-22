<?php

require("./core/main.php");

if (isset($_POST["submit"])) {
	$cpf = $_POST["cpf"];
	$password = sha1($_POST["password"]);

	if (empty($cpf) || $password == sha1("")) {
		$msg = [0, "Preencha todos os campos!"];
	} else {
		$dbh = get_connection();
		$stmt = $dbh->prepare("SELECT * FROM `users` WHERE `cpf` = :cpf AND `password` = :pwd");
		$stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
		$stmt->bindParam(":pwd", $password, PDO::PARAM_STR);
		$stmt->execute();

		$rs = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($rs["cpf"] == $cpf && $rs["password"] == $password)
		{
			session_start();
			$_SESSION["uid"] = $rs["id"];
			$_SESSION["uname"] = $rs["name"];
			header("Location: ./index.php");
		}
		else
		{
			$msg = [0, "Usuário e/ou senha incorreto(s)"];
		}
	}
}

if (isset($_POST["forgot"])) {
	$cpf = $_POST["cpf-forgot"];
	$time = time();
	$hash = sha1($time . $cpf);
	$true = true;

	$dbh = get_connection();

	$stmt = $dbh->prepare("SELECT `email` from `users` WHERE `cpf` = :cpf");
	$stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
	$stmt->execute();

	$rs = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($rs) {
		$email = $rs["email"];

		if (empty($cpf)) {
			$msg = [0, "Preencha todos os campos"];
		} else {
			$stmt = $dbh->prepare("UPDATE `users` SET `password_req` = :pwd_req, `password_req_time` = :pwd_req_time, `password_req_hash` = :pwd_req_hash WHERE `cpf` = :cpf");
			$stmt->bindParam(":pwd_req", $true, PDO::PARAM_BOOL);
			$stmt->bindParam(":pwd_req_time", $time, PDO::PARAM_INT);
			$stmt->bindParam(":pwd_req_hash", $hash, PDO::PARAM_STR);
			$stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
			$stmt->execute();

			send_password_reset_email($email, $hash);

			$msg = [1, "Instruções enviadas com sucesso por e-mail"];
		}
	} else {
		$msg = [0, "Usuário não encontrado"];
	}
}

if (isset($_POST["reset-pass"])) {
	$password = sha1($_POST["reset-password"]);
	$confirm_password = sha1($_POST["confirm-reset-password"]);
	$uid = $_POST["uid"];
	$false = false;
	$null = NULL;

	if (empty($password) || empty($confirm_password) || $password == sha1("") || $confirm_password == sha1("")) {
		$msg = [0, "Preencha todos os campos"];
	} else {
		if ($password == $confirm_password) {
			$dbh = get_connection();

			$stmt = $dbh->prepare("UPDATE `users` SET `password` = :new_password, `password_req` = :pwd_req, `password_req_time` = :pwd_req_time, `password_req_hash` = :pwd_req_hash WHERE `id` = :uid");
			$stmt->bindParam(":new_password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":pwd_req", $false, PDO::PARAM_BOOL);
			$stmt->bindParam(":pwd_req_time", $null, PDO::PARAM_NULL);
			$stmt->bindParam(":pwd_req_hash", $null, PDO::PARAM_NULL);
			$stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
			$stmt->execute();

			$msg = [1, "Senha alterada com sucesso"];
		} else {
			$msg = [0, "As senhas não conferem"];
		}
	}
}

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
		<title>Área administrativa</title>
		<link rel="stylesheet" type="text/css" href="./media/css/login.css" />
	</head>
	<body>
		<div id="logo">Frete Agora</div>
		<div id="login-crate">
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
			<? if (isset($_GET["forgot"]) && $_GET["forgot"]): ?>
			<form id="login-form" method="post" action="<?= $_SERVER["REQUEST_URI"] ?>">
				<p>Insira abaixo seu CPF e você receberá instruções por e-mail de como alterar sua senha.</p><br />
				<p><small>Caso tenha esquecido o e-mail cadastrado no sistema, entre em contato com um supervisor com urgência e solicite a alteração de e-mail e senha.</small></p>
				<input type="text" id="cpf" name="cpf-forgot" placeholder="123.456.789-10" required />
				<a id="forgot" href="./">&laquo; Voltar</a>
				<button type="submit" name="forgot" style="width: 40%">Esqueci minha senha</button>
			</form>
			<? elseif (isset($_GET["hash"])): ?>
			<?php
			$dbh = get_connection();

			$stmt = $dbh->prepare("SELECT `id` from `users` WHERE `password_req_hash` = :hash");
			$stmt->bindParam(":hash", $_GET["hash"], PDO::PARAM_STR);
			$stmt->execute();

			$rs = $stmt->fetch(PDO::FETCH_ASSOC);
			?>
			<? if ($rs !== false): ?>
			<form id="login-form" method="post" action="<?= $_SERVER["REQUEST_URI"] ?>">
				<label for="password">Sua senha:</label>
				<input type="password" name="reset-password" placeholder="********" required />
				<label for="password">Confirmar:</label>
				<input type="password" name="confirm-reset-password" placeholder="********" required />
				<input type="hidden" name="uid" value="<?= $rs['id'] ?>" />
				<a id="forgot" href="./">&laquo; Voltar</a>
				<button type="submit" name="reset-pass">Alterar senha</button>
			</form>
			<? else: ?>
			<? if (!isset($msg)): ?>
			<div class="alert alert-danger" role="alert"><i class="glyphicon glyphicon-remove"></i> Pedido inválido</div>
			<? endif; ?>
			<a id="forgot" href="./">&laquo; Voltar</a>
			<? endif; ?>
			<? else: ?>
			<form id="login-form" method="post" action="<?= $_SERVER["REQUEST_URI"] ?>">
				<label for="cpf">Seu CPF:</label>
				<input type="text" id="cpf" name="cpf" placeholder="123.456.789-10" required />
				<label for="password">Sua senha:</label>
				<input type="password" name="password" placeholder="********" required />
				<a id="forgot" href="?forgot=true">Esqueceu sua senha?</a>
				<button type="submit" name="submit">Entrar</button>
				<div style="clear: both;"></div>
				<div class="alert alert-info" style="margin-top: 10px"><b>Para acessar a área demonstrativa utilize os dados:</b><br />CPF: 000.000.000-00<br />Senha: demo</div>
			</form>
			<? endif; ?>
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