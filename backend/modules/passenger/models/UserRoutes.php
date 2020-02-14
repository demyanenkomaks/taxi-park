<?php

namespace backend\modules\passenger\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_routes".
 *
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property string $search
 * @property string $address
 * @property int $d_t
 */
class UserRoutes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_routes';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['d_t'],
                ],
                // если вместо метки времени UNIX используется datetime:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'name', 'latitude', 'longitude'], 'required'],
            [['id_user', 'd_t'], 'integer'],
            [['name', 'search'], 'string', 'max' => 255],
            [['address'], 'string'],
            [['latitude', 'longitude'], 'string', 'max' => 50],
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
            'name' => 'Название',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
            'd_t' => 'Дата внесения',
            'search' => 'Поиск',
            'address' => 'Адрес',
        ];
    }
}
