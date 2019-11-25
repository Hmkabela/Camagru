<?php
include_once('head.php');
$k = $_GET['u'];
$e = $_GET['e'];
$su = 'update users set username = :username where verhash = :verhash';
$st = $conn->prepare($su);
$st->execute(['username' => $e, 'verhash' => $k]);
echo	"update successful!!!";
?>
