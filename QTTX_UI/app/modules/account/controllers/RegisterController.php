<?php
/**
 * This file is part of QTTX frame.
 *
 * @author    hyunsu
 * @date      2020-09-07 10:58 上午
 */

namespace app\modules\account\controllers;


use app\modules\account\models\register\MobileModel;
use qttx_frm\libs\ui\Controller;

class RegisterController extends Controller
{
    /**
     * 通过手机号注册
     * @return array|string[]|void
     */
    public function actionMobile()
    {
        $model = new MobileModel();

        return $this->runModel($model);
    }

    public function actionUsername()
    {
        echo "register by username";
    }

    public function actionSendCode()
    {
        echo "send mobile code used register";
    }
}