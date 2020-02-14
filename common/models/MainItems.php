<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "main_items".
 *
 * @property int $id
 * @property string $img
 * @property string $icon
 * @property string $name
 * @property string $text
 * @property string $url
 * @property int $identifier
 */
class MainItems extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img', 'icon', 'name', 'text', 'url'], 'string'],
            [['name', 'identifier'], 'required'],
            [['identifier'], 'integer'],
            [['file'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Картинка',
            'icon' => 'Иконка',
            'name' => 'Название',
            'text' => 'Текст',
            'identifier' => 'Индентификатор',
            'file' => 'Картинка',
            'url' => 'Url статической страницы',
        ];
    }
}
