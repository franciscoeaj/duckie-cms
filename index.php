<?php
require_once("./core/main.php");

session_start();

if (!(isset($_SESSION["uid"]) && isset($_SESSION["uname"]))) {
	header("Location: ./login.php");
} else {
	if (isset($_GET["destroy"])) {
		session_destroy();
		header("Location: ./login.php");
	}

	if (isset($_GET["module"])) {
		$module = $_GET["module"];
		$action = $_GET["action"];

		construct_page($module, $action);
	} else {
		construct_page(NULL, NULL);
	}
}