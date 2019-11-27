<?php
include_once('head.php');
$k = $_GET['u'];
$e = $_GET['e'];
$su = 'update users set passwd = :passwd where verhash = :verhash';
$st = $conn->prepare($su);
$st->execute(['passwd' => md5($e), 'verhash' => $k]);
echo	"update successful!!!";
?>
