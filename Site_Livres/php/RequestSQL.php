<?php

/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 10.04.2019
 * Time: 09:28
 */
class RequestSQL
{

    function getUser($pseudo)
    {
        return "SELECT idUser,useAdminOrNot FROM t_user WHERE usePseudo = '$pseudo'";
    }

}