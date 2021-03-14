<?php

namespace App;

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
     * Remarque : Ajouter les cas où typeUtilisateur = Eleve/Prof/Parent
     * @param String $class : représente la classe à charger
     */
    static function autoload($class)
    {
        $typeClass = null;
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            if (str_contains($class, 'Controller')) {
                if(str_contains($class, 'Admin')){
                    $typeClass = 'Controller\\admin';
                }else{
                    $typeClass = 'Controller';
                }
            } elseif (str_contains($class, 'View')) {
                if(str_contains($class, 'Template')){
                    $typeClass = 'View\\templates';
                }elseif(str_contains($class, 'Admin')){
                    $typeClass = 'View\\admin';
                }else{
                    $typeClass = 'View';
                }
            } elseif (str_contains($class, 'Model')) {
                $typeClass = 'Model';
            }

            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('Controller' . '\\', '', $class);
            $class = str_replace('View' . '\\', '', $class);
            $class = str_replace('Model' . '\\', '', $class);
            $class = str_replace('Template' . '\\', '', $class);
            $class = str_replace('Admin' . '\\', '', $class);
            $class = str_replace('\\', '\'', $class);

            if(is_readable(__DIR__ . '\\' . $typeClass . '\\' . $class . '.php')){
                require_once __DIR__ . '\\' . $typeClass . '\\' . $class . '.php';
            }else{
                throw new \Exception("Page inexistante !");
            }
          
        }
    }
}
