<?php
        include_once("config/database.php");
        $u = $_GET['u'];
        $n = 1;
        $su = 'update users set notify = :notify where verhash = :verhash';
        $st = $conn->prepare($su);
        $st->execute(['notify' => $n, 'verhash' => $u]);
        header("Location: settings.php?u=$u&n=$n");
?>

