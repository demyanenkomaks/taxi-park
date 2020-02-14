<?php
namespace frontend\models;

use backend\models\AuthAssignment;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupDriverForm extends Model
{
    public $username;
    public $password;
    public $checkPolicy;
    public $checkPark;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Введите номер телефона.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот номер уже зарегистрирован.'],
            ['username', 'string', 'min' => 18, 'max' => 18, 'tooShort' => 'Номер введен не корректно'],

            ['password', 'required', 'message' => 'Введите пароль.'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Пароль должен быть от 6 символов'],

            [['checkPolicy', 'checkPark'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'checkPark' => 'Регистрируясь я подтверждаю намерение работать в таксопарке My Way',
            'checkPolicy' => 'Регистрируясь я даю согласие на обработку персональных данных',
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = preg_replace('/[^0-9a-zA-Z]/', '', $this->username);

        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = 10;
        $user->identifier = 0;
        if ($this->checkPark == 1) {
            $user->park = 1;
            $user->park_name = 'My Way';
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!($flag = $user->save())) {
                $transaction->rollBack();
            }

            $authassignment = new AuthAssignment();
            $authassignment->item_name = 'Не подтвержденный';
            $authassignment->user_id = strval($user->id);

            if (!($flag = $authassignment->save())) {
                $transaction->rollBack();
            }
            if ($flag) {
                $transaction->commit();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        return $flag;
    }
}
