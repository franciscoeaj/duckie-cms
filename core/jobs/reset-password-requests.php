<?php

require_once("../main.php");

$dbh = get_connection();

$cur_time = time();
$limit_time = $cur_time - 3600;
$null = NULL;
$false = false;

$stmt = $dbh->prepare("UPDATE `users` SET `password_req` = :pwd_req, `password_req_time` = :pwd_req_time, `password_req_hash` = :pwd_req_hash WHERE `password_req_time` < :pwd_req_time_limit");
$stmt->bindParam(":pwd_req", $false, PDO::PARAM_BOOL);
$stmt->bindParam(":pwd_req_time", $null, PDO::PARAM_NULL);
$stmt->bindParam(":pwd_req_hash", $null, PDO::PARAM_NULL);
$stmt->bindParam(":pwd_req_time_limit", $limit_time, PDO::PARAM_INT);
$stmt->execute();