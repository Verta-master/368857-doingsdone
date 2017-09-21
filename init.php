<?php

$con = mysqli_connect("localhost", "root", "","diary");

if ($con == false) {
    $error = mysqli_connect_error();
    $error_message = renderTemplate('templates/error.php', ['error' => $error]);
    print ($error_message);
    exit();
}
?>