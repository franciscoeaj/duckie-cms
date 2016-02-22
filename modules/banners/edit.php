<?php
if (!isset($_GET["id"])) {
	get_404_content();
} else {
	$dbh = get_connection();

	$stmt = $dbh->prepare("SELECT * FROM `banners` WHERE `id` = :id");
	$stmt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
	$stmt->execute();
	$banner = $stmt->fetchAll();
}
?>
<div class="container-fluid">
    <div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Editando banner: "<?= $banner[0]["title"]; ?>"</h1>
			<?php
			if (isset($_COOKIE["msg"])) {
				$msg = explode(", ", $_COOKIE["msg"]);
				$type = $msg[0];
				$message = $msg[1];

				if ($type) {
					echo '<div class="alert alert-success" role="alert"><i class="glyphicon glyphicon-ok"></i> ' . $message . '</div>';
				} else {
					echo '<div class="alert alert-danger" role="alert"><i class="glyphicon glyphicon-remove"></i> ' . $message . '</div>';
				}
			}
			?>
			<form method="post" action="<? $_SERVER['REQUEST_URI']; ?>">
				<div class="input-group">
					<span class="input-group-addon" id="title-addon">Titulo do banner*</span>
					<input value="<?= $banner[0]['title'] ?>" class="form-control" aria-describedby="title-addon" required type="text" name="title" placeholder="ex. Destaque semanal" /><br />
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="link-addon">Link de redirecionamento*</span>
					<input value="<?= $banner[0]['link'] ?>" class="form-control" aria-describedby="body-addon" required type="text" name="link" placeholder="ex. http://seusite.com.br/" /><br />
				</div>
			    <div class="input-group">
                    <span class="input-group-addon" style="height: 60px; border: 1px solid #ccc; border-radius: 3px">Imagem
                    	<input value="" type="file" name="image-file" style="height: 60px" />
                	</span>
                </div>
                <div class="alert alert-warning" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-warning-sign"></i> &nbsp;<b>Atenção!</b> Caso não queira alterar a imagem, não selecione nenhuma.</div>
                <div class="alert alert-info" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-info-sign"></i> &nbsp;<b>Legenda:</b> * = campo obrigatório<br /></div>
				<button class="btn btn-success" type="submit" name="submit">Fazer alterações</button>
			</form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>