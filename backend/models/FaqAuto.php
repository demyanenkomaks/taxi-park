<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "faq_auto".
 *
 * @property int $id
 * @property string $auto
 * @property int $economy
 * @property int $comfort
 * @property int $comfort_plus
 * @property int $business
 * @property int $premium
 * @property int $minivan
 * @property int $child
 * @property int $created_at
 * @property int $updated_at
 * @property int $user
 */
class FaqAuto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq_auto';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auto'], 'required'],
            [['auto'], 'string'],
            [['economy', 'comfort', 'comfort_plus', 'business', 'premium', 'minivan', 'child', 'created_at', 'updated_at', 'user'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auto' => 'Марка, модель',
            'economy' => 'Эконом (год от)',
            'comfort' => 'Комфорт (год от)',
            'comfort_plus' => 'Комфорт+ (год от)',
            'business' => 'Бизнес (год от)',
            'premium' => 'Премиум (год от)',
            'minivan' => 'Минивэн (год от)',
            'child' => 'Детский (год от)',
            'created_at' => 'Добавлен',
            'updated_at' => 'Отредактирован',
            'user' => 'Редоктировал',
        ];
    }
}
