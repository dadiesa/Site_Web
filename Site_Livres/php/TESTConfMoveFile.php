<?php
/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 05.04.2019
 * Time: 08:14
 */


$fileToMove =  $_FILES['pic']['name'];
echo $_FILES['pic']['tmp_name'];
$dest = "../images/".$fileToMove;

//echo "The file to move is  ".$fileToMove. " in ". $dest;


//copy($fileToMove,$dest);


$resultat = move_uploaded_file($_FILES['pic']['tmp_name'],$dest);
if ($resultat) echo "Transfert réussi";





?>