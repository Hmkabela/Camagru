<?php
include_once('head.php');
$k = $_GET['u'];
$e = $_GET['e'];
$su = 'update users set email = :email where verhash = :verhash';
$st = $conn->prepare($su);
$st->execute(['email' => $e, 'verhash' => $k]);
echo	"update successful!!!";
?>
