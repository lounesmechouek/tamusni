<?php

namespace Core;

/**
 * Implémentation d'un autoloader
 * @package App
 */
class Autoloader
{
    /**
     * Enregistrement de l'autoloader
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Spécification du chemin du fichier de la classe
     * @param $class string : représente la classe à charger
     */
    static function autoload($class)
    {
        $typeClass = null;
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            if (str_contains($class, 'Controller')) {
                $typeClass = 'Controller';
            } elseif (str_contains($class, 'Table')) {
                $typeClass = 'Table';
            } elseif (str_contains($class, 'Database')) {
                $typeClass = 'Database';
            }

            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('Controller' . '\\', '', $class);
            $class = str_replace('Table' . '\\', '', $class);
            $class = str_replace('Database' . '\\', '', $class);
            $class = str_replace('\\', '\'', $class);

            require __DIR__ . '\\' . $typeClass . '\\' . $class . '.php';
        }
    }
}
