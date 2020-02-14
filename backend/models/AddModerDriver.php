<?php

namespace backend\models;

/**
 * @property int $count_driver
 */
class AddModerDriver extends \yii\db\ActiveRecord
{
    public $count_driver;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count_driver'], 'required'],
            [['count_driver'], 'integer', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'count_driver' => 'Количество',
        ];
    }
}
