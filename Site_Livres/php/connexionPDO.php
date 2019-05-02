<?php

/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 17.03.2017
 * Time: 13:14
 */
class connexionPDO
{

    private $bdd;

    function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost;dbname=db_book;charset=utf8','root','');
    }

    /**
     * @param $query requete à exécuter
     * @return array
     */
    function executeQuerySelect ($query)
    {

        $data = $this->bdd->prepare($query);
        $data->execute();
        $getdata = $data->fetchAll(PDO::FETCH_ASSOC);

        return $getdata;
    }

    /**
     * @param $query requete à exécuter
     * @return array
     */
    function executeQuery ($query)
    {
        $data = $this->bdd->prepare($query);
        $data->execute();

    }
}