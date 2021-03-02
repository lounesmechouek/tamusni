<?php

namespace App\Model;

use Core\Table;

/**
 * Class Utilisateur
 * Accès aux uilisateurs -- Rmq : faire un extends de Table à l'implémentation
 */
class UsersModel extends Table
{
    private $idUser;
    private $typeUser;
    private $username;
    private $birthdate;
    private $email;
    private $phone;
    private $address;

    public function __construct()
    {
        parent::__construct(App::getDb());
    }

    

}
