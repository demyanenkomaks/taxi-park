<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_ya".
 *
 * @property int $id
 * @property int $id_user
 * @property string $work_ot_date
 * @property string $work_do_date
 * @property string $name_park
 * @property string $city
 * @property string $phone
 * @property double $rating
 * @property int $rating_stability
 * @property int $rating_you
 * @property string $note
 */
class UserYa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_ya';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'rating_stability', 'rating_you'], 'integer'],
            [['work_ot_date', 'work_do_date'], 'safe'],
            [['name_park', 'city', 'note'], 'string'],
            [['rating'], 'double'],
            [['phone'], 'string', 'max' => 18],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'work_ot_date' => 'От',
            'work_do_date' => 'До',
            'name_park' => 'Название парка',
            'city' => 'Город',
            'phone' => 'Телефон',
            'rating' => 'Рейтинг',
            'rating_stability' => 'Стабильность рейтинга',
            'rating_you' => 'Оценка таксопарка',
            'note' => 'Комментарий к опыту работы в этом таксопарке',
            'carTc' => 'Свидетельство о регистрации ТС',

            'phoneName' => 'Телефон',
            'yaRatingStabilityName' => 'Стабильность рейтинга',
            'ratingYouName' => 'Оценка таксопарка',
            'workDate' => 'Работал',
        ];
    }


    public function saveRegulations() // Обработка Масок и Дат до сохранения
    {
        if (!empty($this->work_ot_date)) {
            $this->work_ot_date = $this->getSaveDate($this->work_ot_date);
        }
        if (!empty($this->work_do_date)) {
            $this->work_do_date = $this->getSaveDate($this->work_do_date);
        }

        if (!empty($this->phone)) {
            $this->phone = $this->getSaveNumbers($this->phone);
        }
    }

    public function getSaveDate($date) {
        return \Yii::$app->formatter->asDate($date, 'yyyy-M-dd');
    }

    public function getSaveNumbers($numbers) {
        return preg_replace('/[^0-9a-zA-Z]/', '', $numbers);
    }

    public function getYaRatingStabilityArray() {
        return [
            1 => 'Растет',
            2 => 'Не меняется',
            3 => 'Падает'
        ];
    }

    public function getRatingYouArray() {
        return [
            1 => '1 звезда',
            2 => '2 звезды',
            3 => '3 звезды',
            4 => '4 звезды',
            5 => '5 звезд'
        ];
    }

    public function getYaRatingStabilityName() {
        $rating_stability = $this->getYaRatingStabilityArray();
        return !empty($this->rating_stability) ? $rating_stability[$this->rating_stability] : null;
    }

    public function getPhoneName() {
        return ($this->phone ? '<a href="tel: +' . $this->phone . '"><span class="mask-phone">' . $this->phone . '</span></a>' : null);
    }

    public function getRatingYouName() {
        $rating_you = $this->getRatingYouArray();
        return !empty($this->rating_you) ? $rating_you[$this->rating_you] : null;
    }

    public function getWorkDate() {
        return ($this->work_ot_date ? Yii::$app->formatter->asDate($this->work_ot_date, 'php:d.m.Y') : '') . ' - ' . ($this->work_do_date ? Yii::$app->formatter->asDate($this->work_do_date, 'php:d.m.Y') : '');
    }
}
