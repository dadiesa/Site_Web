<?php
include "../php/connexionPDO.php";

$requete = 'SELECT t_user.usePassword FROM t_user';
$passHash = new connexionPDO();

$getdata = $passHash->executeQuerySelect($requete);

foreach ($getdata as $password)
{
    //echo password_hash($password['usePassword'], PASSWORD_DEFAULT) . '<br>';

}
echo password_hash("test", PASSWORD_DEFAULT) . '<br>';