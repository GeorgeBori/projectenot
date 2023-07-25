<?php

namespace App\controller;

use App\model\form\SiteLoginForm;
use App\model\form\SiteRegisterForm;

/**
 * SiteController
 */
class SiteController extends BaseController
{
    /**
     * @return void
     */
    public function actionIndex()
    {
        echo $this->render('site/index');
    }

    /**
     * @param $success
     * @return void
     * @throws \Exception
     */
    public function actionRegister($success)
    {
        $this->requireGuest();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $form = new SiteRegisterForm($_POST);

            if ($form->validate() && $form->register()) {
                $this->redirect('/site/login', ['status' => 'success']);
            } else {
                $this->redirect('/site/register', ['status' => 'error']);
            }
        } else {
            echo $this->render('site/register', $success ?: ['status' => 'default']);
        }
    }

    /**
     * @param $success
     * @return void
     */
    public function actionLogin($success)
    {
        $this->requireGuest();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $form = new SiteLoginForm($_POST);

            if ($form->validate() && $form->login()) {
                $this->redirect('/converter/index');
            } else {
                $this->redirect('/site/login', ['status' => 'error']);
            }
        } else {
            echo $this->render('site/login', $success ?: ['status' => 'default']);
        }
    }

    /**
     * @return void
     */
    public function actionLogout()
    {
        $this->requireLogin();

        setcookie('access_token', '', time() - 3600, '/');

        $this->redirect('/');
    }
}
