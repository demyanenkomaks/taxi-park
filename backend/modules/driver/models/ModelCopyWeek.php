<?php

namespace backend\modules\driver\models;
use Yii;

/**
 * @property int $count_week
 */
class ModelCopyWeek extends \yii\db\ActiveRecord
{

    public $count_week;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count_week'], 'required'],
            [['count_week'], 'number', 'min' => 1, 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'count_week' => 'Количество недель',
        ];
    }


    public function copyWeek($count_week)
    {
        $model_start_end_date = DriverWork::find()->asArray()
            ->select('
        (start_d - INTERVAL (WEEKDAY(start_d)) DAY) AS `date_start`,
        (start_d - INTERVAL (WEEKDAY(start_d) - 6) DAY) AS `date_end`
        ')
            ->where(['id_user' => Yii::$app->user->identity->id])
            ->orderBy(['start_d' => SORT_DESC])
            ->one();

        if (!empty($model_start_end_date)) {
            $model_all = DriverWork::find()
                ->where(['id_user' => Yii::$app->user->identity->id])
                ->andWhere(['between', 'start_d', $model_start_end_date['date_start'], $model_start_end_date['date_end']])
                ->all();

            if (!empty($model_all)) {
                $day = 7;

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    for ($i = 1; $i <= $count_week; $i++) {
                        foreach ($model_all as $one) {
                            $model_new = New DriverWork();
                            $model_new->id_user = Yii::$app->user->identity->id;
                            $model_new->title = $one->title;
                            $model_new->start_d = date('Y-m-d', strtotime('+' . $day * $i . ' days', strtotime($one->start_d)));
                            $model_new->start_t = $one->start_t;
                            $model_new->stop_d = date('Y-m-d', strtotime('+' . $day * $i . ' days', strtotime($one->stop_d)));
                            $model_new->stop_t = $one->stop_t;
                            $model_new->price = $one->price;

                            if (!($flag = $model_new->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return true;
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return false;
    }
}
