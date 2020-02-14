<?php
namespace common\models;

use app\models\UserYa;
use backend\models\UserCars;
use backend\modules\driver\models\DriverWork;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

/**
 * User model
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 * @property string $city
 * @property int $hitched
 * @property int $children
 * @property string $cart_bank
 * @property string $cart_num
 * @property double $skill_taxi
 * @property string $p_num
 * @property string $p_f
 * @property string $p_i
 * @property string $p_o
 * @property int $p_sex
 * @property string $p_date_birth
 * @property string $p_place_birth
 * @property string $p_date_vydachi
 * @property string $p_code_unit
 * @property string $p_p_date
 * @property string $p_p_region
 * @property string $p_p_point
 * @property string $p_p_yl
 * @property string $p_p_dom
 * @property string $p_p_korp
 * @property string $p_p_kvart
 * @property string $p_p_registered
 * @property string $urlUpload
 * @property string $login
 * @property string $citizenship
 * @property string $cart_other
 * @property string $prava_num
 * @property string $prava_date
 * @property string $prava_cat
 * @property string $files_prava_1
 * @property string $files_prava_2
 * @property string $files_pas_1
 * @property string $files_pas_2
 * @property string $files_pas_3
 * @property string $cart_file_lic
 * @property string $park_name
 * @property boolean $name
 * @property integer $identifier
 * @property string $cart_fio
 * @property string $phone_driver
 * @property integer $cart_month
 * @property integer $cart_year
 * @property string $message
 * @property integer $update_user
 * @property integer $create_user
 * @property integer $t_moderator
 * @property integer $t_admin
 * @property integer $t_d_t_mod
 * @property integer $t_d_t_adm
 * @property boolean $t_paid
 * @property integer $hr_id
 * @property integer $mod_ident
 * @property string $mod_comment
 *
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $filesPrava1;
    public $checkPolicy;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
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
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],

            [['username', 'password_hash'], 'required'],
            [['status', 'created_at', 'updated_at', 'hitched', 'children', 'p_sex', 'identifier', 'cart_month', 'cart_year', 't_moderator', 't_admin', 'update_user', 'create_user', 'hr_id', 'mod_ident'], 'integer'],
            [['p_date_birth', 'p_date_vydachi', 'p_p_date', 'prava_date'], 'date', 'format' => 'php:Y-m-d'],
            [['t_d_t_mod', 't_d_t_adm', 't_d_t_paid'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['skill_taxi'], 'number'],
            [['p_place_birth', 'p_p_registered', 'park_name', 'cart_fio', 'phone_driver', 'message', 'mod_comment'], 'string'],
            [['username'], 'string', 'min' => 11, 'max' => 18],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email', 'verification_token', 'cart_bank', 'p_p_yl', 'urlUpload', 'citizenship'], 'string', 'max' => 255],
            [['city', 'p_f', 'p_i', 'p_o', 'p_p_region', 'p_p_point', 'login', 'prava_cat'], 'string', 'max' => 55],
            [['prava_num', 'p_num', 'cart_num'], 'string', 'max' => 25],
            [['p_code_unit', 'p_p_dom', 'p_p_korp', 'p_p_kvart'], 'string', 'max' => 10],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['username', 'unique', 'targetAttribute' => 'username', 'message' => 'Этот номер уже зарегистрирован.'],
            [['files_prava_1', 'files_prava_2', 'files_pas_1', 'files_pas_2', 'files_pas_3', 'cart_file_lic'], 'file', 'extensions' => 'png, jpg'],
            [['park', 't_paid', 'checkPolicy'], 'boolean']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Телефон',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Пароль',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'E-mail',
            'status' => 'Статус',
            'created_at' => 'Добавлен',
            'updated_at' => 'Отредактирован',
            'verification_token' => 'Verification Token',
            'city' => 'Город',
            'skill_taxi' => 'Опыт работы в такси (сколько лет)',
            'hitched' => 'Женат(замужем)',
            'children' => 'Дети',
            'cart_bank' => 'Банк',
            'cart_num' => 'Карта номер',
            'cart_other' => 'Другое',
            'cart_fio' => 'Фамилия Имя (латиницей)',
            'cart_month' => 'Месяц',
            'cart_year' => 'Год',
            'cart_file_lic' => 'Лицевая сторона банковской карты',
            'cartDate' => 'Дата действия',
            'p_num' => 'Серия номер паспорта',
            'p_f' => 'Фамилия',
            'p_i' => 'Имя',
            'p_o' => 'Отчество',
            'p_sex' => 'Пол',
            'p_date_birth' => 'Дата рождения',
            'p_place_birth' => 'Место рождения',
            'p_date_vydachi' => 'Дата выдачи',
            'p_code_unit' => 'Код подразделения',
            'p_p_date' => 'Дата регистрации',
            'p_p_region' => 'Регион',
            'p_p_point' => 'Город',
            'p_p_yl' => 'Улица',
            'p_p_dom' => 'Дом',
            'p_p_korp' => 'Корус',
            'p_p_kvart' => 'Квартира',
            'p_p_registered' => 'Орган регистрации учёта',
            'passport' => 'Серия номер паспорта',
            'fio' => 'Фамилия Имя Отчество',
            'login' => 'Логин',
            'phone_driver' => 'Телефон водителя такси',
            'citizenship' => 'Гражданство',
            'prava_num' => 'Серия номер',
            'prava_date' => 'Дата выдачи',
            'prava_cat' => 'Категории',
            'files_prava_1' => 'Водительское удостоверение 1 сторона',
            'files_prava_2' => 'Водительское удостоверение 2 сторона',
            'files_pas_1' => 'Паспорт 1 страница',
            'files_pas_2' => 'Паспорт 2 страница',
            'files_pas_3' => 'Паспорт прописка',
            'park' => 'Автопарк',
            'park_name' => 'Название автопарка',
            'identifier' => 'Типы пользователей',
            'message' => 'Сообщение',
            't_moderator' => 'Проверил',
            't_d_t_mod' => 'Когда проверил',
            't_admin' => 'Подтвердил',
            't_d_t_adm' => 'Когда подтвердил',
            't_paid' => 'Оплачено',
            't_d_t_paid' => 'Когда оплачено',
            'update_user' => 'Отредактировал',
            'create_user' => 'Добавил',
            'checkPolicy' => 'Регистрируясь я даю согласие на обработку персональных данных',
            'hr_id' => 'HR',
            'mod_ident' => 'Идентификатор',
            'mod_comment' => 'Комментарий',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getYaRatingStabilityArray() {
        return [
            1 => 'Растет',
            2 => 'Не меняется',
            3 => 'Падает'
        ];
    }

    public function getYaRatingStability() {
        $ya_rating_stability = $this->getYaRatingStabilityArray();
        return !empty($this->ya_rating_stability) ? $ya_rating_stability[$this->ya_rating_stability] : null;
    }

    public function getChildrenArray() {
        return [
            0 => 'Нет',
            1 => 'Есть',
        ];
    }

    public function getChildrenName() {
        $children = $this->getChildrenArray();
        return isset($this->children) ? $children[$this->children] : null;
    }

    public function getMonthArray() {
        return [
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ];
    }

    public function getMonthName() {
        $month = $this->getMonthArray();
        return isset($this->cart_month) ? $month[$this->cart_month] : null;
    }

    public function getCartDate() {
        return $this->getMonthName() . ' ' . $this->cart_year;
    }

    public function getFio() {
        return ($this->p_f ?? '') . ' ' . ($this->p_i ?? '') . ' ' . ($this->p_o ?? '');
    }


    public function saveRegulations() // Обработка Масок и Дат до сохранения
    {
        $id = $this->id;

        $path = '/personal/doc/' . $id . '/';

        $this->update_user = $id;

        if (!empty($this->p_p_date)) {
            $this->p_p_date = $this->getSaveDate($this->p_p_date);
        }
        if (!empty($this->p_date_birth)) {
            $this->p_date_birth = $this->getSaveDate($this->p_date_birth);
        }
        if (!empty($this->p_date_vydachi)) {
            $this->p_date_vydachi = $this->getSaveDate($this->p_date_vydachi);
        }
        if (!empty($this->prava_date)) {
            $this->prava_date = $this->getSaveDate($this->prava_date);
        }
        if (!empty($this->prava_num)) {
            $this->prava_num = $this->getSaveNumbers($this->prava_num);
        }
        if (!empty($this->phone_driver)) {
            $phone_driver = $this->getSaveNumbers($this->phone_driver);

            $model_check = User::find()->where(['username' => preg_replace('/[^0-9a-zA-Z]/', '', $phone_driver)])->one();
            if (!empty($model_check)) {
                $this->phone_driver = $phone_driver;
            } else {
                $this->addError('phone_driver', 'Водитель не зарегестрирован в приложении');
            }
        }

        if (!empty(UploadedFile::getInstance($this, 'files_prava_1'))){
            $name_file = 'Права_1_сторона';
            $file = UploadedFile::getInstances($this, 'files_prava_1')[0];
            $files[$name_file] = $file;
            $this->files_prava_1 = $path . $name_file . '.' . $file->extension;
        } else {
            $this->files_prava_1 = $this->getOldAttribute('files_prava_1');
        }

        if (!empty(UploadedFile::getInstance($this, 'files_prava_2'))){
            $name_file = 'Права_2_сторона';
            $file = UploadedFile::getInstances($this, 'files_prava_2')[0];
            $files[$name_file] = $file;
            $this->files_prava_2 = $path . $name_file . '.' . $file->extension;
        } else {
            $this->files_prava_2 = $this->getOldAttribute('files_prava_2');
        }

        if (!empty(UploadedFile::getInstance($this, 'files_pas_1'))){
            $name_file = 'Паспорт_1_страница';
            $file = UploadedFile::getInstances($this, 'files_pas_1')[0];
            $files[$name_file] = $file;
            $this->files_pas_1 = $path . $name_file . '.' . $file->extension;
        } else {
            $this->files_pas_1 = $this->getOldAttribute('files_pas_1');
        }

        if (!empty(UploadedFile::getInstance($this, 'files_pas_2'))){
            $name_file = 'Паспорт_2_страница';
            $file = UploadedFile::getInstances($this, 'files_pas_2')[0];
            $files[$name_file] = $file;
            $this->files_pas_2 = $path . $name_file . '.' . $file->extension;
        } else {
            $this->files_pas_2 = $this->getOldAttribute('files_pas_2');
        }

        if (!empty(UploadedFile::getInstance($this, 'files_pas_3'))){
            $name_file = 'Паспорт_прописка';
            $file = UploadedFile::getInstances($this, 'files_pas_3')[0];
            $files[$name_file] = $file;
            $this->files_pas_3 = $path . $name_file . '.' . $file->extension;
        } else {
            $this->files_pas_3 = $this->getOldAttribute('files_pas_3');
        }

        if (!empty(UploadedFile::getInstance($this, 'cart_file_lic'))){
            $name_file = 'Лицевая сторона карты';
            $file = UploadedFile::getInstances($this, 'cart_file_lic')[0];
            $files[$name_file] = $file;
            $this->cart_file_lic = $path . $name_file . '.' . $file->extension;
        } else {
            $this->cart_file_lic = $this->getOldAttribute('cart_file_lic');
        }

        if (!empty($files)) {
            $this->upload($files, $id);
        }

        if (!empty($this->park_name) && $this->park_name == 'My Way') {
            $this->park = 1;
        } else {
            $this->park = 0;
        }
    }

    public function upload($files, $id)
    {
        $directory = Yii::getAlias('@backend/web/doc/') . $id . '/';
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }
        $path = 'doc/' . $id . '/';

        foreach ($files as $key => $file) {
            $file->saveAs($path . $key . '.' . $file->extension);
        }

        return true;
    }

    public function getSaveDate($date) {
        return Yii::$app->formatter->asDate($date, 'yyyy-MM-dd');
    }

    public function getSaveDateTime($date) {
        return Yii::$app->formatter->asDate($date, 'yyyy-MM-dd H:i:s');
    }

    public function getSaveNumbers($numbers) {
        return preg_replace('/[^0-9a-zA-Z]/', '', $numbers);
    }

    public function getCars0()
    {
        return $this->hasMany(UserCars::class, ['id_user' => 'id']);
    }

    public function getYa0()
    {
        return $this->hasMany(UserYa::class, ['id_user' => 'id']);
    }

    public function getCheckPassportFile() {
        return (empty($this->files_pas_1) || empty($this->files_pas_2) || empty($this->files_pas_3))
            ? false
            : true;
    }

    public function getCheckPravaFile() {
        return (empty($this->files_prava_1) || empty($this->files_prava_2))
            ? false
            : true;
    }

    public function getUsernameIndex() {
        return '<a href="tel: +' . $this->username . '"><span class="mask-phone">' . $this->username . '</span></a>';
    }

    public function getFilePrava1View() {
        return !empty($this->files_prava_1) ? '<a href="' . $this->files_prava_1 . '" class="label label-info" target="_blank">Просмотреть</a>' : null;
    }
    public function getFilePrava1Update() {
        return !empty($this->files_prava_1) ? '<a href="' . $this->files_prava_1 . '" class="btn btn-info btn-block normal" target="_blank">Просмотреть 1 сторону водительского удостоверения</a>' : '<a href="#" class="btn btn-info btn-block normal disabled" role="button" aria-disabled="true">Не загружен</a>';
    }

    public function getFilePrava2View() {
        return !empty($this->files_prava_2) ? '<a href="' . $this->files_prava_2 . '" class="label label-info" target="_blank">Просмотреть</a>' : null;
    }
    public function getFilePrava2Update() {
        return !empty($this->files_prava_2) ? '<a href="' . $this->files_prava_2 . '" class="btn btn-info btn-block normal" target="_blank">Просмотреть 2 сторону водительского удостоверения</a>' : '<a href="#" class="btn btn-info btn-block normal disabled" role="button" aria-disabled="true">Не загружен</a>';
    }

    public function getFilePas1View() {
        return !empty($this->files_pas_1) ? '<a href="' . $this->files_pas_1 . '" class="label label-info" target="_blank">Просмотреть</a>' : null;
    }
    public function getFilePas1Update() {
        return !empty($this->files_pas_1) ? '<a href="' . $this->files_pas_1 . '" class="btn btn-info btn-block normal" target="_blank">Просмотреть 1 страницу паспорта</a>' : '<a href="#" class="btn btn-info btn-block normal disabled" role="button" aria-disabled="true">Не загружен</a>';
    }

    public function getFilePas2View() {
        return !empty($this->files_pas_2) ? '<a href="' . $this->files_pas_2 . '" class="label label-info" target="_blank">Просмотреть</a>' : null;
    }
    public function getFilePas2Update() {
        return !empty($this->files_pas_2) ? '<a href="' . $this->files_pas_2 . '" class="btn btn-info btn-block normal" target="_blank">Просмотреть 2 страницу паспорта</a>' : '<a href="#" class="btn btn-info btn-block normal disabled" role="button" aria-disabled="true">Не загружен</a>';
    }

    public function getFilePas3View() {
        return !empty($this->files_pas_3) ? '<a href="' . $this->files_pas_3 . '" class="label label-info" target="_blank">Просмотреть</a>' : null;
    }
    public function getFilePas3Update() {
        return !empty($this->files_pas_3) ? '<a href="' . $this->files_pas_3 . '" class="btn btn-info btn-block normal" target="_blank">Просмотреть страницу с пропиской</a>' : '<a href="#" class="btn btn-info btn-block normal disabled" role="button" aria-disabled="true">Не загружен</a>';
    }

    public function getFileCartView() {
        return !empty($this->cart_file_lic) ? '<a href="' . $this->cart_file_lic . '" class="label label-info" target="_blank">Просмотреть</a>' : null;
    }
    public function getFileCartUpdate() {
        return !empty($this->cart_file_lic) ? '<a href="' . $this->cart_file_lic . '" class="btn btn-info btn-block normal" target="_blank">Просмотреть лицевую сторону банковской карты</a>' : '<a href="#" class="btn btn-info btn-block normal disabled" role="button" aria-disabled="true">Не загружен</a>';
    }

    public function getAssistantCheckButton() {
        if ($this->identifier == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getUpdateUser0()
    {
        return $this->hasOne(User::class, ['id' => 'update_user']);
    }

    public function getUpdateUserName()
    {
        return isset($this->updateUser0) ? '<a href="tel: +' . $this->updateUser0->username . '"><span class="mask-phone">' . $this->updateUser0->username . '</span></a> ' . $this->updateUser0->login : '';
    }

    public function getHrUser0()
    {
        return $this->hasOne(User::class, ['id' => 'hr_id']);
    }

    public function getUserInHr0()
    {
        return $this->hasMany(User::class, ['hr_id' => 'id']);
    }

    public function getCountUserRawInHr0()
    {
        return $this->hasMany(User::class, ['hr_id' => 'id'])->onCondition('countRawUs.mod_ident is not null and countRawUs.identifier != 1');
    }

    public function getHrUserName()
    {
        if ($this->identifier == 5) {
            return !empty($this->userInHr0) ? count($this->countUserRawInHr0) . '/' . count($this->userInHr0) : '0/0';
        } else {
            return !empty($this->hrUser0) ? '<a href="tel: +' . $this->hrUser0->username . '"><span class="mask-phone">' . $this->hrUser0->username . '</span></a> ' . $this->hrUser0->login : '';
        }
    }
    public function getModer0()
    {
        return $this->hasOne(User::class, ['id' => 't_moderator']);
    }

    public function getModerName()
    {
        return isset($this->moder0) ? '<a href="tel: +' . $this->moder0->username . '"><span class="mask-phone">' . $this->moder0->username . '</span></a> ' . $this->moder0->login : '';
    }

    public function getAdmin0()
    {
        return $this->hasOne(User::class, ['id' => 't_admin']);
    }

    public function getAdminName()
    {
        return isset($this->admin0) ? '<a href="tel: +' . $this->admin0->username . '"><span class="mask-phone">' . $this->admin0->username . '</span></a> ' . $this->admin0->login : '';
    }

    public function getPaidIndex() {
        return !empty($this->t_paid) ? '<span class="label label-info normal">Оплачено</span>' : '';
    }

    public function getDriverWork0()
    {
        return $this->hasMany(DriverWork::class, ['id_user' => 'id'])->orderBy([
            'start_d' => SORT_ASC,
            'start_t' => SORT_ASC,
        ]);
    }
}
