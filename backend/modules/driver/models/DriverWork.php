<?php

namespace backend\modules\driver\models;

use Yii;

/**
 * This is the model class for table "driver_work".
 *
 * @property int $id
 * @property int $id_user
 * @property string $start_d
 * @property string $start_t
 * @property string $stop_d
 * @property string $stop_t
 * @property string $title
 * @property int $price
 */
class DriverWork extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'driver_work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'start_d', 'start_t', 'stop_d', 'stop_t', 'title', 'price'], 'required'],
            [['id_user', 'price'], 'integer'],
            [['start_d', 'start_t', 'stop_d', 'stop_t'], 'safe'],
            [['title'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Пользователь',
            'start_d' => 'Дата начала',
            'start_t' => 'Время начала',
            'stop_d' => 'Дата окончания',
            'stop_t' => 'Время окончания',
            'title' => 'Название',
            'price' => 'Цена (руб./час)',
        ];
    }
}
