<?php

namespace App\controller;

use App\model\User;

/**
 * BaseController
 */
class BaseController
{
    /**
     * @return bool
     */
    protected function isGuest()
    {
        if (empty($_COOKIE['access_token'])) {
            return true;
        }

        return User::where('access_token', $_COOKIE['access_token'])->first() === null;
    }

    /**
     * @return void
     */
    protected function requireGuest()
    {
        if (!$this->isGuest()) {
            $this->redirect('/');
        }
    }

    /**
     * @return void
     */
    protected function requireLogin()
    {
        if ($this->isGuest()) {
            $this->redirect('/site/login');
        }
    }

    /**
     * @param $view
     * @param $params
     * @return false|string
     */
    protected function render($view, $params = [])
    {
        extract($params);

        ob_start();

        require_once __DIR__ . '/../view/layouts/header.php';
        require_once __DIR__ . "/../view/{$view}.php";
        require_once __DIR__ . '/../view/layouts/footer.php';

        return ob_get_clean();
    }

    /**
     * @param $url
     * @param array $params
     * @return void
     */
    protected function redirect($url, array $params = [])
    {
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        header('Location: ' . $url, true, 302);
        exit;
    }
}
