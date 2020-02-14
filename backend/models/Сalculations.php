<?php

namespace backend\models;

use common\models\AdditionalFunctions;
use common\models\User;
use Yii;

class Сalculations
{
    /**
     * Перевод даты время в формат MySql
     */
    public static function orderСost($data)
    {
        $duration['time'] = AdditionalFunctions::sumTime($data['time'], $data['duration']);
        $duration['date'] = ($duration['time'] < $data['time']) ? $duration['date'] = date('Y-m-d', strtotime($data['date'] . ' + 1 days')) : $data['date'] ;

        $driverWorks = User::find()
            ->joinWith([
                'driverWork0' => function ($q) use ($data, $duration) {
                    $q->onCondition(['and',
                        ['and', ['start_d' => AdditionalFunctions::inDateTimeDb($data['date'])], ['>', 'stop_t', $data['time']]],
                        ['and', ['start_d' => AdditionalFunctions::inDateTimeDb($duration['date'])], ['<', 'start_t', $duration['time']]]
                    ]);
                }
            ])
            ->where(['username' => Yii::$app->user->identity->phone_driver])
            ->asArray()
            ->one();

        if (!empty($driverWorks['driverWork0'])) {
            $sum = 0;
            $start_order = $data['date'] . ' ' . $data['time'];
            $end_order = $duration['date'] . ' ' . $duration['time'];

            $arr_work = $driverWorks['driverWork0'];
            $last_time_work = count($arr_work);

            if ($last_time_work == 1) {
                $interval = AdditionalFunctions::intervalDateTime($start_order, $end_order);

                $sum += $arr_work[0]['price'] / 60 * ($interval['h'] * 60 + $interval['i']);
            } else {
                // Подсчет "Первого" рабочего времени водителя попавшего во время заказа
                $interval_first = AdditionalFunctions::intervalDateTime($start_order, ($arr_work[0]['stop_d'] . ' ' . $arr_work[0]['stop_t']));
                $sum += $arr_work[0]['price'] / 60 * ($interval_first['h'] * 60 + $interval_first['i']);

                // Подсчет "Последнего" рабочего времени водителя попавшего во время заказа
                $interval_last = AdditionalFunctions::intervalDateTime((end($arr_work)['start_d'] . ' ' . end($arr_work)['start_t']), $end_order);
                $sum += end($arr_work)['price'] / 60 * ($interval_last['h'] * 60 + $interval_last['i']);

                // Подсчет "Середины" рабочего времени водителя попавшего во время заказа (без первого и последнего!!! если оно есть)
                for($i = 1; $i < $last_time_work - 1; $i++) {
                    $interval_first = AdditionalFunctions::intervalDateTime(($arr_work[$i]['start_d'] . ' ' . $arr_work[$i]['start_t']), ($arr_work[$i]['stop_d'] . ' ' . $arr_work[$i]['stop_t']));
                    $sum += $arr_work[$i]['price'] / 60 * ($interval_first['h'] * 60 + $interval_first['i']);
                }
            }

            $sum = round($sum);

            return $sum + round($sum / 20);
        }

        return false;
    }


}