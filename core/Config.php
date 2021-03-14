<?php

namespace Core;

/**
 * Class Config
 * Utilisée par la classe App pour la configuration de la base
 * @package Core
 */
class Config
{
    /**
     * @var String $settings Chemin vers le fichier de configuration
     * @var Config $_instance Instance unique de la classe
     */
    private $settings = [];
    private static $_instance;

    /**
     * @param String $file Chemin vers le fichier de configuration de la base
     * @return Config Instance unique de la classe
     */
    public static function getInstance($file)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config($file);
        }

        return self::$_instance;
    }

    public function __construct($file)
    {
        $this->settings =  require($file);
    }

    public function get($key)
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}
