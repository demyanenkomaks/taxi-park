<?php

namespace backend\modules\driver\models;
use Yii;

/**
 * @property int $count_week
 */
class ModelScheduleAdjustment extends \yii\db\ActiveRecord
{

    public $date_output;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_output'], 'required'],
            [['date_output'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'date_output' => 'День',
        ];
    }


}
