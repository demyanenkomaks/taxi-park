<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "main_names".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 */
class MainNames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_names';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'text'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'text' => 'Текст',
        ];
    }
}
