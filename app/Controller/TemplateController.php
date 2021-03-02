<?php 
namespace App\Controller;
use App\View\Template\DefaultView;
use App\View\Template\OnlineView;

class TemplateController{

    private static $instance;
    private static $defaultView;
    private static $onlineView;
    private static $currentUsedTemplate = "DefaultView";

    private function __construct(){
        if(self::$defaultView === null){
            self::$defaultView = new DefaultView();
        }
        if(self::$onlineView === null){
            self::$onlineView = new OnlineView();
        }
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new TemplateController();
        }
        return self::$instance;
    }

    public static function setCurrentTemplate($newTemplate){
        self::$currentUsedTemplate = $newTemplate;
    }

    public static function getTemplate($templateName){
        if($templateName === "DefaultView"){
            self::setCurrentTemplate($templateName);
            return self::$defaultView;
        }elseif($templateName === "OnlineView"){
            self::setCurrentTemplate($templateName);
            return self::$onlineView;
        }
    }
}