<?php

$user = $_SESSION['user'];

?>

Welcome <?= $user['firstname'] ?> <?= $user['lastname'] ?> !

Voici un récapitulatif de vos informations :
    <?php
    foreach ($user as $key => $value) {
        echo $key . " : " . $value . "<br>";
    }
    ?>