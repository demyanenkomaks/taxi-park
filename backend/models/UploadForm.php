<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $directory = Yii::getAlias('@backend/web/doc/') . \Yii::$app->user->identity->id . '/';
            if (!is_dir($directory)) {
                FileHelper::createDirectory($directory);
            }
            $path = 'doc/' . \Yii::$app->user->identity->id . '/';


            $this->imageFile->saveAs($path . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}