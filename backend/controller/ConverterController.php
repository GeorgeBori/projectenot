<?php

namespace App\controller;

use App\model\Currency;
use App\model\form\ConverterIndexForm;

/**
 * ConverterController
 */
class ConverterController extends BaseController
{
    /**
     * @return void
     */
    public function actionIndex()
    {
        $this->requireLogin();
        $currencies = Currency::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $form = new ConverterIndexForm($_POST);

            if ($form->validate()) {
                $convertedAmount = $form->convert();
                if ($convertedAmount !== false) {
                    echo $this->render('/converter/index', ['currencies' => $currencies, 'value' => $convertedAmount]);
                } else {
                    echo $this->render('/converter/index', ['currencies' => $currencies, 'error' => $form->errors]);
                }
            } else {
                echo $this->render('/converter/index', ['currencies' => $currencies, 'error' => $form->errors]);
            }
        } else {
            echo $this->render('/converter/index', ['currencies' => $currencies]);
        }
    }
}
