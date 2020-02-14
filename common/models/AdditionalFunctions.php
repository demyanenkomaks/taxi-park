<?php
namespace common\models;


class AdditionalFunctions
{

    /**
     * Перевод даты время в формат MySql
     */
    public static function inDateTimeDb($date, $time = null)
    {
        $date = new \DateTime($date);

        if (!empty($time)) {
            $time = new \DateTime($time);
            $merge = new \DateTime($date->format('Y-m-d') . ' ' . $time->format('H:i:s'));
            return $merge->format('Y-m-d H:i:s');
        } else {
            return $date->format('Y-m-d');
        }
    }

    /**
     * Сложение времени
     */
    public static function sumTime($time, $time_sum)
    {
        return date('H:i',strtotime($time) + strtotime($time_sum) - strtotime("00:00:00"));
    }

    /**
     * Объединение даты время
     */
    public static function intervalDateTime($start, $end)
    {
        $start = new \DateTime($start);
        $end = new \DateTime($end);
        $interval = $end->diff($start);

        $result['h'] = $interval->h;
        $result['i'] = $interval->i;
        return $result;
    }

    /**
     * Сравнение Datetime
     */
//    public static function compareDatetime($sign, $start, $end)
//    {
//        $start = new \DateTime($start);
//        $end = new \DateTime($end);
//
//        if ($sign === '=') {
//            return $start == $end;
//        } elseif ($sign === '>') {
//            return $start > $end;
//        } elseif ($sign === '<') {
//            return $start < $end;
//        } elseif ($sign === '>=') {
//            return $start >= $end;
//        } elseif ($sign === '<=') {
//            return $start <= $end;
//        }
//    }
}