<?php 
if (isset($_POST["submit"])) {
	$title = htmlspecialchars($_POST["title"]);
	$link = htmlspecialchars($_POST["link"]);
	$image_file = $_POST["image-file"];

	if (empty($title) || empty($link)) {
		$msg = [0, "Preencha todos os campos!"];
	} else {
		$dbh = get_connection();

		$stmt = $dbh->prepare("INSERT INTO `banners` (title, link, image) VALUES (:title, :link, :image)");
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":link", $link, PDO::PARAM_STR);
		$stmt->bindParam(":image", $image_file, PDO::PARAM_STR);
		$stmt->execute();

		$msg = [1, "Banner inserido com sucesso!"];
	}
}
?>
<div class="container-fluid">
    <div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Adicionar novo banner</h1>
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
					<span class="input-group-addon" id="title-addon">Titulo do banner*</span>
					<input class="form-control" aria-describedby="title-addon" required type="text" name="title" placeholder="ex. Destaque semanal" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="link-addon">Link de redirecionamento*</span>
					<input class="form-control" aria-describedby="link-addon" required type="text" name="link" placeholder="ex. http://seusite.com.br/" /><br />
				</div>
			    <div class="input-group">
                    <span class="input-group-addon" style="height: 60px; border: 1px solid #ccc; border-radius: 3px">Imagem
                    	<input type="file" required name="image-file" style="height: 60px" />
                	</span>
                </div>
                <div class="alert alert-info" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-info-sign"></i> &nbsp;<b>Legenda:</b> * = campo obrigatório</div>
				<button class="btn btn-success" type="submit" name="submit">Inserir o banner</button>
				<button class="btn btn-danger" type="reset" name="reset">Resetar formulário</button>
			</form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>

