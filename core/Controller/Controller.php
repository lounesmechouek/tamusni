<?php

namespace Core\Controller;
use App;

/**
 * Class Controller
 * Classe mère dont dérivent les controlleurs concrets, permet de définir les méthodes et attributs génériques
 */
class Controller
{
    protected $viewPath = ROOT . "\\app\\View\\";
    protected $template;

    protected function secureInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function secure_form($form)
    {
        foreach ($form as $key => $value) {
            $form[$key] = $this->secure_input($value);
        }
        return $form;
    }

    /*
    public function render($view)
    {
        ob_start();
        require $this->viewPath . $view . '.php';
        $content = ob_get_clean();
        var_dump($content);
        require_once $this->viewPath . '\\' . 'templates\\' . $this->template . '.php';
    }
  */

}
