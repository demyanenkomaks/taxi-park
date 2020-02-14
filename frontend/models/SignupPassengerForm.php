<?php
namespace frontend\models;

use backend\models\AuthAssignment;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupPassengerForm extends Model
{
    public $username;
    public $password;
    public $checkPolicy;
    public $phone_driver;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Введите номер телефона.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот номер уже зарегистрирован.'],
            [['username', 'phone_driver'], 'string', 'min' => 18, 'max' => 18, 'tooShort' => 'Номер введен не корректно'],

            ['password', 'required', 'message' => 'Введите пароль.'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Пароль должен быть от 6 символов'],
            
            ['phone_driver', 'required', 'message' => 'Введите номер телефона водителя такси.'],
            [['checkPolicy'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
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
        $user->identifier = 2;
        $user->phone_driver = preg_replace('/[^0-9a-zA-Z]/', '', $this->phone_driver);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!($flag = $user->save())) {
                $transaction->rollBack();
            }

            $authassignment = new AuthAssignment();
            $authassignment->item_name = 'Пассажир';
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
