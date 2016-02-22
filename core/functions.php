<?php

function construct_page($module, $action) {
	$top = "./core/layout/top.php";
	$bottom = "./core/layout/bottom.php";
	$_404 = "./modules/404.php";

	if (isset($module) && isset($action)) {
		$path = "./modules/" . $module . "/" . $action . ".php";
	} else {
		$path = "./modules/home.php";
	}

	include($top);
	file_exists($path) ? include($path) : include($_404);
	include($bottom);
}

function translate_rank($value) {
	$jobs = ["Caminhoneiro", "Moderador", "Administrador"];

	return $jobs[$value];
}

function translate_order_status($value) {
	$statuses = ["Concluído", "Em andamento", "Cancelado"];

	return $statuses[$value];
}

function translate_location($value) {
	if (!isset($value) || empty($value) || $value == "") {
		return "Não definida";
	} else {
		return $value;
	}
}

function get_404_content() {
	echo '
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Página não encontrada</h1>
            <p>O arquivo que você procura não foi encontrado. :/</p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
	';
}

function get_fixed_text($slug) {
	$dbh = get_connection();
	$stmt = $dbh->prepare("SELECT `title`, `body` FROM `texts` where `slug` = :slug");
	$stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
	$stmt->execute();
	$rs = $stmt->fetchAll();

	return $rs[0];
}

function send_password_reset_email($email, $hash) {
	$to      = $email;
	$subject = 'Recuperar sua senha';
	$headers = 'From: Administrativo FreteAgora <administrativo@freteagora.com>' . "\r\n" .
    'X-Mailer: PHP/' . phpversion() . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-Type: text/html; charset=UTF-8';
	$message = '
	<body>
		<p>Foi socilitado para esse e-mail um pedido de alteração de senha do administrativo do FreteAgora.<br />Caso você tenha solicitado e realmente deseje alterar sua senha, basta clicar <a href="http://208.68.39.137/~freteagora/cms/login.php?hash=' . $hash . '">aqui</a> e seguir as instruções da página para realizar a alteração de sua senha.</p>
		<p>Caso não tenha sido você, apenas ignore esse e-mail e sua senha não será alterada.</p>
		<p>
			<small>Se você não deveria receber esse e-mail, pedimos que apenas o ignore e mova-o para o lixo.</small><br />
			<small>Esse é um e-mail completamente automático, não envie resposta a ele pois você não será atendido.</small>
		</p>
		<p>
			<span>
			-----<br />
			Atenciosamente,<br />
			Equipe FreteAgora.
			</span>
		</p>

	</body>';

	mail($to, $subject, $message, $headers);
}

function slug($str) {
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	
	return $str;
}