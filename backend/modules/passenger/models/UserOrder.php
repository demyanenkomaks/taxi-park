<?php

namespace backend\modules\passenger\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user_order".
 *
 * @property int $id
 * @property int $id_user
 * @property string $latitude_start
 * @property string $longitude_start
 * @property string $latitude_stop
 * @property string $longitude_stop
 * @property string $date
 * @property string $time
 * @property string $start
 * @property string $stop
 * @property int $created_at
 * @property string $duration
 * @property string $driver
 * @property int $cost
 */
class UserOrder extends ActiveRecord
{
    public $startSelect;
    public $stopSelect;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_order';
    }

    public function behaviors()
    {
        return [
            [
                'class'      => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'latitude_start', 'longitude_start', 'latitude_stop', 'longitude_stop', 'date', 'time', 'duration'], 'required'],
            [['driver'], 'required', 'message' => 'Для заказа, Вам необходимо в профиле указать {attribute}'],
            [['id_user', 'created_at', 'cost'], 'integer'],
            [['date', 'time', 'duration'], 'safe'],
            [['startSelect', 'stopSelect'], 'safe'],
            [['latitude_start', 'longitude_start', 'latitude_stop', 'longitude_stop'], 'string', 'max' => 50],
            [['driver'], 'string', 'max' => 25],
            [['start', 'stop'], 'string'],
            ['duration', 'validateDuration'],
        ];
    }

    public function validateDuration($attribute, $params)
    {
        if ($this->$attribute == '00:00') {
            $this->addError($attribute, 'Продолжительность поездки не может равнятся 00:00.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Пассажир',
            'latitude_start' => 'Широта откуда',
            'longitude_start' => 'Долгота откуда',
            'latitude_stop' => 'Широта куда',
            'longitude_stop' => 'Долгота куда',
            'date' => 'Дата',
            'time' => 'Время',
            'start' => 'Откуда',
            'stop' => 'Куда',
            'startSelect' => 'Откуда',
            'stopSelect' => 'Куда',
            'created_at' => 'Добавлен',
            'duration' => 'Продолжительность поездки',
            'driver' => 'Водитель такси',
            'cost' => 'Стоимость',
        ];
    }

    public function getRouteArray() {
        return ArrayHelper::map(UserRoutes::find()->where(['id_user' => Yii::$app->user->identity->id])->all(),
            function ($data) {
                return $data->latitude . ',' . $data->longitude;
            },
            function ($data) {
                return $data->name . (!empty($data->address) ? ' (' . $data->address . ')' : '');
            }
        );
    }

    public function saveRegulations() // Обработка Масок и Дат до сохранения
    {
        if (!empty($this->date)) {
            $this->date = $this->getSaveDate($this->date);
        }
    }

    public function getSaveDate($date) {
        return Yii::$app->formatter->asDate($date, 'yyyy-MM-dd');
    }
}
