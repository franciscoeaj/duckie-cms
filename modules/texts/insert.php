<?php 

if (isset($_POST["submit"])) {
	$title = htmlspecialchars($_POST["title"]);
	$slug = slug($_POST["title"]);
	$body = htmlspecialchars($_POST["body"]);
	$image = htmlspecialchars($_POST["image"]);
	$_false = false;
	$_NULL = NULL;

	if (empty($title) || empty($body) || empty($image)) {
		$error = "Preencha todos os campos!";
	} else {
		$dbh = get_connection();

		$stmt = $dbh->prepare("INSERT INTO `texts` (`slug`, `title`, `body`, `image`) VALUES (:slug, :title, :body, :image)");
		$stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":body", $body, PDO::PARAM_STR);
		$stmt->bindParam(":image", $image, PDO::PARAM_STR);
		$stmt->execute();
		$msg = [1, "Texto inserido com sucesso!"];
	}
}
?>
<div class="container-fluid">
    <div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Adicionar novo texto</h1>
			<?php
			if (isset($msg)) {
				$type = $msg[0];
				$message = $msg[1];

				if ($type) {
					echo '
						<div class="alert alert-success" role="alert"><i class="glyphicon glyphicon-ok"></i> ' . $message . '</div>
					';
				} else {
					echo '
						<div class="alert alert-danger" role="alert"><i class="glyphicon glyphicon-remove"></i> ' . $message . '</div>
					';
				}
			}
			?>
			<form method="post" action="<? $_SERVER['REQUEST_URI']; ?>">
				<div class="input-group">
					<span class="input-group-addon" id="title-addon">Titulo*</span>
					<input class="form-control" aria-describedby="title-addon" required type="text" name="title" placeholder="Título da página" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" style="border: 1px solid #ccc; border-radius: 3px">Corpo do texto*<br /><br /><textarea name="body"></textarea><br /></span>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="image-addon">Imagem*</span>
					<input class="form-control" aria-describedby="imagem-addon" required type="text" name="image" /><br />
				</div>
				<div class="alert alert-info" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-info-sign"></i> &nbsp;<b>Legenda:</b> * = campo obrigatório</div>
				<button class="btn btn-success" type="submit" name="submit">Inserir o texto</button>
				<button class="btn btn-danger" type="reset" name="reset">Resetar formulário</button>
			</form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>

