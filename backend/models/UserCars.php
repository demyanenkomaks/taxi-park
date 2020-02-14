<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user_cars".
 *
 * @property int $id
 * @property int $id_user
 * @property string $tc_ser
 * @property string $tc_number
 * @property string $tc_date
 * @property string $mark
 * @property string $model
 * @property string $color
 * @property int $year
 * @property string $state_number
 * @property int $brend
 * @property int $lajtboks
 * @property string $lic_number
 * @property string $lic_date
 * @property string $files_1
 * @property string $files_2
 * @property int $rent
 * @property string $owner
 * @property boolean $charging
 * @property boolean $baby_chair
 * @property boolean $booster
 * @property boolean $conditioner
 * @property boolean $delivery
 * @property boolean $smoke
 * @property boolean $wi_fi
 * @property boolean $checks
 * @property boolean $shipping_bicycle
 * @property boolean $shipping_ski
 * @property string $os_file
 * @property string $os_num
 * @property string $os_date
 */
class UserCars extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_cars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'year', 'brend', 'lajtboks', 'rent'], 'integer'],
            [['tc_date', 'lic_date', 'os_date'], 'safe'],
            [['files_1', 'files_2', 'owner', 'os_file'], 'string'],
            [['tc_ser'], 'string', 'max' => 5],
            [['tc_number'], 'string', 'max' => 6],
            [['os_num'], 'string', 'max' => 25],
            [['mark', 'model', 'color', 'state_number', 'lic_number'], 'string', 'max' => 55],
            [['charging', 'baby_chair', 'booster', 'conditioner', 'delivery', 'smoke', 'wi_fi', 'checks', 'shipping_bicycle', 'shipping_ski'], 'boolean'],
            [['charging', 'baby_chair', 'booster', 'conditioner', 'delivery', 'smoke', 'wi_fi', 'checks', 'shipping_bicycle', 'shipping_ski'], 'default', 'value' => 0],
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
            'tc_ser' => 'СТС Серия',
            'tc_number' => 'СТС Номер',
            'tc_date' => 'СТС Дата',
            'mark' => 'Марка',
            'model' => 'Модель',
            'color' => 'Цвет',
            'year' => 'Год',
            'state_number' => 'Гос номер',
            'brend' => 'Брендирована',
            'lajtboks' => 'Лайтбокс',
            'lic_number' => 'Номер лицензии',
            'lic_date' => 'Дата лицензии',
            'files_1' => 'СТС 1 сторона',
            'files_2' => 'СТС 2 сторона',
            'rent' => 'Аренда',
            'owner' => 'Владелец если арендована',
            'licTaxi' => 'Лицензия такси',

            'charging' => 'Зарядное устройство',
            'baby_chair' => 'Детское кресло',
            'booster' => 'Бустер',
            'conditioner' => 'Кондиционер',
            'delivery' => 'Доставка',
            'smoke' => 'Салон для курящих',
            'wi_fi' => 'Wi-fi',
            'checks' => 'БСО-чеки',
            'shipping_bicycle' => 'Перевозка велосипеда',
            'shipping_ski' => 'Перевозка лыж',

            'os_num' => 'Серия номер',
            'os_date' => 'Действителен до',
            'os_file' => 'Фото',
            'fileOsView' => 'Фото',

            'dopView' => 'Дополнительные условия',

            'carTc' => 'Свидетельство о регистрации ТС и дата выдачи',
            'file1View' => 'СТС 1 сторона',
            'file2View' => 'СТС 2 сторона',
            'brendName' => 'Брендирована',
            'lajtboksName' => 'Лайтбокс',
            'rentName' => 'Аренда',
        ];
    }

    public function saveRegulations() // Обработка Масок и Дат до сохранения
    {
        if (!empty($this->tc_date)) {
            $this->tc_date = $this->getSaveDate($this->tc_date);
        }
        if (!empty($this->lic_date)) {
            $this->lic_date = $this->getSaveDate($this->lic_date);
        }
        if (!empty($this->os_date)) {
            $this->os_date = $this->getSaveDate($this->os_date);
        }
    }


    public function getSaveDate($date) {
        return \Yii::$app->formatter->asDate($date, 'yyyy-M-dd');
    }

    public function getCarTc() {
        return ($this->tc_ser ?? '') . ' ' . ($this->tc_number ?? '') . ' ' . (!empty($this->tc_date) ? \Yii::$app->formatter->asDate($this->tc_date, 'php:d.m.Y') : '');
    }

    public function getLicTaxi() {
        return (!empty($this->lic_number) || empty(!$this->lic_date)) ? '<span class="label label-info">Да</span> ' . ($this->lic_number ?? '') . ' ' . (\Yii::$app->formatter->asDate($this->lic_date, 'dd.MM.yyyy') ?? '') : '<span class="label label-danger">Нет</span>';
    }

    public function getFile1View() {
        return !empty($this->files_1) ? '<a href="' . $this->files_1 . '" class="label label-info" target="_blank">Просмотреть</a>' : null;
    }

    public function getFile1Update() {
        return !empty($this->files_1) ? '<a href="' . $this->files_1 . '" class="btn btn-info btn-block normal" target="_blank">Просмотреть 1 сторону СТС</a>' : '<a href="#" class="btn btn-info btn-block normal disabled" role="button" aria-disabled="true">Не загружен</a>';
    }

    public function getFile2View() {
        return !empty($this->files_2) ? '<a href="' . $this->files_2 . '" class="label label-info" target="_blank">Просмотреть</a>' : null;
    }
    public function getFile2Update() {
        return !empty($this->files_2) ? '<a href="' . $this->files_2 . '" class="btn btn-info btn-block normal" target="_blank">Просмотреть 2 сторону СТС</a>' : '<a href="#" class="btn btn-info btn-block normal disabled" role="button" aria-disabled="true">Не загружен</a>';
    }

    public function getFileOsView() {
        return !empty($this->os_file) ? '<a href="' . $this->os_file . '" class="label label-info" target="_blank">Просмотреть</a>' : null;
    }
    public function getFileOsUpdate() {
        return !empty($this->os_file) ? '<a href="' . $this->os_file . '" class="btn btn-info btn-block normal" target="_blank">Просмотреть ОСАГО</a>' : '<a href="#" class="btn btn-info btn-block normal disabled" role="button" aria-disabled="true">Не загружен</a>';
    }

    public function getBrendName() {
        return ($this->brend === 1 ? '<span class="label label-info">Да</span>' : '<span class="label label-danger">Нет</span>');
    }

    public function getLajtboksName() {
        return ($this->lajtboks === 1 ? '<span class="label label-info">Да</span>' : '<span class="label label-danger">Нет</span>');
    }

    public function getRentName() {
        return ($this->rent === 1 ? '<span class="label label-danger ">Да</span>' : '<span class="label label-info">Нет</span>');
    }

    public function getDopView() {
        return
            (!empty($this->charging) ? '<span class="label label-info">' . $this->getAttributeLabel('charging') . '</span> ' : null) .
            (!empty($this->baby_chair) ? '<span class="label label-info">' . $this->getAttributeLabel('baby_chair') . '</span> ' : null) .
            (!empty($this->booster) ? '<span class="label label-info">' . $this->getAttributeLabel('booster') . '</span> ' : null) .
            (!empty($this->conditioner) ? '<span class="label label-info">' . $this->getAttributeLabel('conditioner') . '</span> ' : null) .
            (!empty($this->delivery) ? '<span class="label label-info">' . $this->getAttributeLabel('delivery') . '</span> ' : null) .
            (!empty($this->smoke) ? '<span class="label label-info">' . $this->getAttributeLabel('smoke') . '</span> ' : null) .
            (!empty($this->wi_fi) ? '<span class="label label-info">' . $this->getAttributeLabel('wi_fi') . '</span> ' : null) .
            (!empty($this->checks) ? '<span class="label label-info">' . $this->getAttributeLabel('checks') . '</span> ' : null) .
            (!empty($this->shipping_bicycle) ? '<span class="label label-info">' . $this->getAttributeLabel('shipping_bicycle') . '</span> ' : null) .
            (!empty($this->shipping_ski) ? '<span class="label label-info">' . $this->getAttributeLabel('shipping_ski') . '</span> ' : null)
            ;
    }

    public function getCheckCarsFile() {
        return (empty($this->files_1) || empty($this->files_2))
            ? false
            : true;
    }
}
