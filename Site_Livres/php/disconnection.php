<?php
/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 31.03.2017
 * Time: 13:47
 */
session_start();

//Déconnect
session_destroy();
//Redirige sur le page d'accueil
header('Location: ../index.php');
?>