<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "faq_phone".
 *
 * @property int $id
 * @property string $mark
 * @property string $model
 * @property int $created_at
 * @property int $updated_at
 * @property int $user
 */
class FaqPhone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq_phone';
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
            [['mark', 'model'], 'required'],
            [['mark', 'model'], 'string'],
            [['created_at', 'updated_at', 'user'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mark' => 'Марка',
            'model' => 'Модели',
            'created_at' => 'Добавлн',
            'updated_at' => 'Отредактирован',
            'user' => 'Редактировал',
        ];
    }
}
