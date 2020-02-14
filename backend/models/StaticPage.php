<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "static_page".
 *
 * @property int $id
 * @property string $title
 * @property string $kod
 * @property string $description
 * @property string $keywords
 * @property string $url
 */
class StaticPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'static_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'kod', 'url'], 'required'],
            [['title', 'kod', 'description', 'keywords', 'url'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'kod' => 'Kod',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'url' => 'Url',
        ];
    }
}
