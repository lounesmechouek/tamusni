<?php

use Core\Config;
use Core\Database\Database;

/**
 * Class App
 * Permet de définir des variables globales à l'app ainsi que des points d'accès à certains singletons
 */
class App
{
    /**
     * @var String $title : Titre de la page appelé dans les templates, il change dynamiquement grâce aux contrôleurs
     * @var App $_instance : Design Pattern Singleton pour permettre d'avoir une seule instance de la classe App
     * @var Database $db_instance : Design Pattern Singleton pour avoir une seule connexion à la base de données
     */
    private static $title = "Tamusni";
    private static $_instance;
    private static $db_instance;
    private static $content;

    /**
     * @return App L'instance unique d'app
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * Démarre une session et fait appel à l'Autoloader de chaque namespace
     */
    public static function load()
    {
        session_start();
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();

        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }

    /**
     * @return Database L'instance unique de la BDD
     */
    public static function getDb()
    {
        $config = Config::getInstance(ROOT . '/config/Config.php');
        if (is_null(self::$db_instance)) {
            self::$db_instance = new Database($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return self::$db_instance;
    }

    /**
     * @param String $newTitle : Permet de définir le titre de la page courante par le contrôleur
     */
    public static function setTitle($newTitle)
    {
        self::$title = $newTitle;
    }

    /**
     * @return String Le titre de la page actuelle
     */
    public static function getTitle()
    {
        return self::$title;
    }

    public static function getContent()
    {
        return self::$content;
    }

    public static function setContent($content)
    {
        self::$content=$content;
    }
}
