<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\LoginForm;

class LoginFormWidget extends Widget {

    public function run() {
        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
            return $this->render('loginFormWidget', [
                'model' => $model,
            ]);
        } else {
            return ;
        }
    }

}