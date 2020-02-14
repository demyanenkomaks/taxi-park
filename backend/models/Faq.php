<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "faq".
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $created_at
 * @property int $updated_at
 * @property int $user
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq';
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
            [['question', 'answer', 'user'], 'required'],
            [['question', 'answer'], 'string'],
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
            'question' => 'Вопрос',
            'answer' => 'Ответ',
            'created_at' => 'Добавлен',
            'updated_at' => 'Отредактирован',
            'user' => 'Пользователь',
        ];
    }
}
