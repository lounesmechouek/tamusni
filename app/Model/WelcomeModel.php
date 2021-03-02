<?php

namespace App\Model;

use App;
use Core\Table\Table;

class WelcomeModel extends Table
{
    private $title = "Bienvenue !";
    private $diapo;
    private $menu;
    private $corps;

    public function __construct()
    {
        parent::__construct(App::getDb());
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDiapo()
    {
        if ($this->diapo === null) {
            $this->diapo = $this->query("SELECT `imageDiapo`, `textOverlay` FROM `diapoelement`");
        }
        return $this->diapo;
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function getCorps()
    {
        return $this->corps;
    }
}
