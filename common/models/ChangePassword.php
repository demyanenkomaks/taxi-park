<?php
namespace common\models;

use Yii;
use yii\base\Model;


class ChangePassword extends Model
{
    public $last_password;
    public $new_password;
    public $verifying_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_password', 'new_password', 'verifying_password'], 'required'],
            [['last_password', 'verifying_password'], 'string'],
            [['new_password'], 'string', 'min' => 6],
            ['verifying_password', 'compare', 'compareAttribute' => 'new_password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'last_password' => 'Действующий пароль',
            'new_password' => 'Новый пароль',
            'verifying_password' => 'Новый пароль подтверждение',
        ];
    }

}
