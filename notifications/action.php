<?php

if (isset ($_POST['token'])){
    $token = $_POST['token'];

    $link = mysqli_connect('db4free.net', 'atzinmoreb', 'halo3eslopeor', 'notifications');
    if ($link){
        die ('Could nott connect: ' . mysqli_error());

    }
    echo 'Connected successfully';
    mysql_select_db("notifications") or die (mysqli_error());

    $result = mysqli_query("INSERT INTO push (token,fecha) VALUES ('$token', now()");
    if (!$result){
        die('error: '.mysql_error());
    }else
    echo ('token guardado');

    mysqli_close($link);
}