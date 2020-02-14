<?php
namespace frontend\models;

use backend\models\AuthAssignment;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupHrForm extends Model
{
    public $username;
    public $password;
    public $checkPolicy;
    public $p_f;
    public $p_i;
    public $p_o;
    public $email;
    public $city;
    public $cart_num;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Введите номер телефона.'],
            ['email', 'required', 'message' => 'Введите E-mail.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот номер уже зарегистрирован.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот почта уже зарегистрирована.'],
            [['username'], 'string', 'min' => 18, 'max' => 18, 'tooShort' => 'Номер введен не корректно'],

            ['password', 'required', 'message' => 'Введите пароль.'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Пароль должен быть от 6 символов'],
            [['city', 'p_f', 'p_i', 'p_o'], 'string', 'max' => 55],
            [['email'], 'string', 'max' => 255],
            [['cart_num'], 'string', 'max' => 25],

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
            'p_f' => 'Фамилия',
            'p_i' => 'Имя',
            'p_o' => 'Отчество',
            'email' => 'E-mail',
            'username' => 'Телефон',
            'password' => 'Пароль',
            'cart_num' => 'Номер карты для зачисления оплаты',
            'city' => 'Город в котором планируете работать',
        ];
    }

    public function signupHr()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = preg_replace('/[^0-9a-zA-Z]/', '', $this->username);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = 10;
        $user->identifier = 6;
        $user->p_f = $this->p_f;
        $user->p_i = $this->p_i;
        $user->p_o = $this->p_o;
        $user->email = $this->email;
        $user->cart_num = $this->cart_num;
        $user->city = $this->city;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!($flag = $user->save())) {
                $transaction->rollBack();
            }

            $authassignment = new AuthAssignment();
            $authassignment->item_name = 'Модератор HR не подтвержденный';
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


        if ($flag) {
            $email_text = '
                <p>Приветствую Вас в числе команды удаленных агентов подключения водителей Яндекс такси парка My Way.</p>
                <p>Ниже ссылка на инструкцию как добавлять новых водителей в парк и отслеживать их текущий статус, а пока хочу рассказать Вам почему работать с парком My Way интересно водителям.</p>
                <p>1. Я сам работаю в такси в СПБ и разработал стратегию, которую планирую продвигать другим водителям что бы облегчить их жизнь и увеличить доходы</p>
                <p>2. Парк не обрастает офисами и пр. затратными активами что дает нам возможность максимум усилий вкладывать в разработку трех основных приложений для водителя: мои постоянные пассажиры, календарь событий города, соц.сеть пассажиры и водители</p>
                <p>3. Мы не на словах, а на деле реально помогаем водителям в работе. Из свежих примеров: вчера вернули в работу занесенный Яндексом в черный список автомобиль водителя который использовал магнитные наклейки. На прошлой неделе провели тестирование трех новичков в офисе Яндекс такси что дало им несгораемые пять звезд в рейтинге. И пр. и пр.</p>
                <p>4. Мы добиваемся возвратов и реальной компенсации за поездки с безналичной оплатой деньги по которым не поступили от пассажиров.</p>
                <br>
                <p>На самом деле этот список можно продолжить и уверен, что именно Ваша работа в команде чем то дополнит этот список в будущем. Этим я хочу сказать: любое Ваше предложение направленное на развитие проекта парка в части новых востребованных сервисов будет рассмотрено и дана обратная связь. Реально, на деле, а не на словах.</p>
                <br>
                <p>Сейчас же нам важно развить сеть парка и присутствие в городах России. В приоритете сейчас подключение водителей в Санкт Петербурге, Москве, Тольятти, Тюмени, Саратове, Краснодаре, Новосибирске, Екатеринбурге, Нижний Новгороде, Казани, Челябинске, Омске, Самаре, Ростове-на-Дону, Уфе, Красноярске, Перми, Воронеже, Волгограде, Владивостоке, Иркутске, Хабаровске.</p>
                <br>
                <p>Но, если у Вас есть возможность привести водителей не только из этих городов, смело работайте, каждый привлеченный Вами водитель вышедший на линию будет оплачен.</p>
                <br>
                <p>Немного забегая вперед.</p>
                <br>
                <p>Я вижу Вашу работу в парке не только в роли агента подключения. Как только мы раскроем сеть водителей шире, для каждого из Вас кто привел более 100 водителей я сделаю дополнительное предложение по работе. Этим я даю Вам понять что планы распростаняются не только на водителей, в них есть будущее и для Вас.</p>
                <br>
                <p>А пока самое важное что нужно сделать, это увеличивать численность подключенных водителей.</p>
                ';

            Yii::$app->mailer->compose()
                ->setFrom(['hr@mw.spb.ru' => 'Письмо с сайта mw.spb.ru'])
                ->setTo($this->email)
                ->setSubject('Регистрация HR специалиста прошла успешно')
                ->setTextBody('Текст сообщения')
                ->setHtmlBody($email_text)
                ->attach(Yii::getAlias('@frontend/web/doc/instruction.pdf'))
                ->send();
        }

        return $flag;
    }
}
