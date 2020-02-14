<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use backend\models\UserCars;
use Yii;
use common\models\User;
use yii\web\Controller;

/**
 * OrderController implements the CRUD actions for UserOrder model.
 */
class ParsController extends Controller
{

    public function actionDriver()
    {
        $dir = Yii::getAlias('@backend/web/pars/');

//        if (($handle = fopen($dir . '2.csv', "r")) !== FALSE) {
//            while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {
////                debug($data);
//
//                $transaction = Yii::$app->db->beginTransaction();
//                try {
//
//                    $model = new User();
//                    $model->username = trim($data['1']);
//                    $model->city = trim($data['7']);
//
//                    $fio_arr = explode(' ', trim($data['0']));
//                    $model->p_f = $fio_arr['0'];
//                    $model->p_i = $fio_arr['1'];
//                    $model->p_o = $fio_arr['2'] . (!empty($fio_arr['3']) ? ' ' . $fio_arr['3'] : '');
//                    $model->setPassword($model->username);
//                    $model->generateAuthKey();
//                    $model->status = 10;
//                    $model->identifier = 0;
//
//                    if ($flag = $model->save(false)) {
//                        $model_auto = new UserCars();
//                        $model_auto->id_user = $model->id;
//                        $model_auto->state_number = trim($data['2']);
//                        $model_auto->color = trim($data['3']);
//
//                        $auto = trim($data['4']);
//                        $lada = 'LADA (ВАЗ)';
//
//                        if (stristr($auto, $lada) === FALSE) {
//                            $auto_arr = explode(' ', $auto);
//
//                            $model_auto->mark = $auto_arr['0'];
//                            $model_auto->model = $auto_arr['1'];
//                        } else {
//                            $model_auto->mark = $lada;
//
//                            $auto_arr = explode(' ', $auto);
//                            $model_auto->model = $auto_arr['2'] . (!empty($auto_arr['3']) ? ' ' . $auto_arr['3'] : '');
//                        }
//
//                        if ($flag = $model_auto->save(false)) {
//                            $authassignment = new AuthAssignment();
//                            $authassignment->item_name = 'Не подтвержденный';
//                            $authassignment->user_id = strval($model->id);
//
//                            $flag = $authassignment->save();
//                        }
//                    }
//
//                    if ($flag) {
//                        $transaction->commit();
//                    } else {
//                        $transaction->rollBack();
//                    }
//
//                } catch (\Exception $e) {
//                    $transaction->rollBack();
//                }
//            }
//            fclose($handle);
//        }

        debug("Ok!!!");
        die;
    }

}
