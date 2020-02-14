<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "faq_question".
 *
 * @property int $id
 * @property int $user_ask
 * @property string $question
 * @property int $identifier
 * @property int $created_at
 * @property int $updated_at
 * @property int $user
 */
class FaqQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq_question';
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
            [['user_ask', 'question'], 'required'],
            [['user_ask', 'identifier', 'created_at', 'updated_at', 'user'], 'integer'],
            [['question'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_ask' => 'Пользователь задавший вопрос',
            'question' => 'Вопрос',
            'identifier' => 'Идентификатор',
            'created_at' => 'Добавлен',
            'updated_at' => 'Отредактирован',
            'user' => 'Отредактировал',
        ];
    }
}
