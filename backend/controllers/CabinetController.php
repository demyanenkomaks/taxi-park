<?php

namespace backend\controllers;

use app\models\UserYa;
use backend\models\UserCars;
use common\models\ChangePassword;
use Yii;
use common\models\User;
use yii\base\DynamicModel;
use backend\models\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * CabinetController implements the CRUD actions for User model.
 */
class CabinetController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = User::find()
            ->joinWith(['cars0', 'ya0'])
            ->where(['user.id' => Yii::$app->user->identity->id])->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->saveRegulations();
            // Аватарка
            if (Yii::$app->request->post('cropping')) {
                $uploadParam = 'urlUpload';
                $maxSize = 2097152;
                $extensions = 'jpeg, jpg, png';
                $width = 200;
                $height = 200;

                $model_img = new DynamicModel([$uploadParam]);
                $model_img->load(Yii::$app->request->post());
                $model_img->{$uploadParam} = UploadedFile::getInstance($model, $uploadParam);
                $model_img->addRule($uploadParam, 'image', [
                    'maxSize' => $maxSize,
                    'extensions' => explode(', ', $extensions),
                ])->validate();
                if ($model_img->hasErrors()) {
                    Yii::$app->session->setFlash("warning", $model_img->getFirstError($uploadParam));
                } else {
                    $name = Yii::$app->user->identity->id . '.' . $model_img->{$uploadParam}->extension;
                    $cropInfo = Yii::$app->request->post('cropping');
                    try {
                        $image = Image::crop(
                            $model_img->{$uploadParam}->tempName,
                            intval($cropInfo['width']),
                            intval($cropInfo['height']),
                            [$cropInfo['x'], $cropInfo['y']]
                        )->resize(
                            new Box($width, $height)
                        );
                    } catch (\Exception $e) {
                        Yii::$app->session->setFlash("warning", $e->getMessage());
                    }

                    $directory = Yii::getAlias('@backend/web/avatar/') . Yii::$app->user->identity->id . '/';
                    if (!is_dir($directory)) {
                        FileHelper::createDirectory($directory);
                    }

                    $model->urlUpload = $name;
                    if (isset($image) && $image->save($directory . $name) && $model->save()) {
                        Yii::$app->session->setFlash('success', 'Аватарка успешно сохранена');
                    }
                }
            }
            // END Аватарка
        }

        if ($model->identifier == 2) {
            $identifier = 'passenger';
        } elseif (in_array($model->identifier, [5,6])) {
            $identifier = 'hr';
        } else {
            $identifier = 'driver';
        }

        return $this->render($identifier, [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($form)
    {
        $model = $this->findModel(Yii::$app->user->identity->id);

        if ($model->load(Yii::$app->request->post())) {

            $model->saveRegulations();

            if (empty($model->getErrors())) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'form' => $form,
        ]);
    }

    public function actionCars()
    {
        $id = Yii::$app->user->identity->id;
        $models_car = UserCars::find()->where(['id_user' => $id])->all();
        if(empty($models_car))
            $models_car = [new UserCars()];

        if (Yii::$app->request->post()) {
            $path = '/personal/doc/' . Yii::$app->user->identity->id . '/';

            $oldIDs = ArrayHelper::map($models_car, 'id', 'id');
            $models_car = Model::createMultiple(UserCars::class, $models_car);

            Model::loadMultiple($models_car, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($models_car, 'id', 'id')));
            if (Model::validateMultiple($models_car)) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if (!empty($deletedIDs)) {
                        $model_delete = UserCars::find()->where(['id' => $deletedIDs])->all();
                        $files_delete = ArrayHelper::merge(ArrayHelper::map($model_delete, 'id', 'files_1'), ArrayHelper::map($model_delete, 'id', 'files_2'));

                        UserCars::deleteAll(['id' => $deletedIDs]);
                    }
                    foreach ($models_car as $index => $car) {
                        $car->id_user = $id;

                        if (!empty(UploadedFile::getInstance($car, "[{$index}]files_1"))){
                            $name_file = 'СТС_' . $car->tc_ser . '_'. $car->tc_number . '_1_сторона';
                            $file = UploadedFile::getInstances($car, "[{$index}]files_1")[0];
                            $files[$name_file] = $file;
                            $car->files_1 = $path . $name_file . '.' . $file->extension;

                            if ($car->getOldAttribute('files_1') != $car->files_1) {
                                $files_delete[] = $car->getOldAttribute('files_1');
                            }

                        } else {
                            $car->files_1 = $car->getOldAttribute('files_1');
                        }

                        if (!empty(UploadedFile::getInstance($car, "[{$index}]files_2"))){
                            $name_file = 'СТС_' . $car->tc_ser . '_'. $car->tc_number . '_2_сторона';
                            $file = UploadedFile::getInstances($car, "[{$index}]files_2")[0];
                            $files[$name_file] = $file;
                            $car->files_2 = $path . $name_file . '.' . $file->extension;

                            if ($car->getOldAttribute('files_2') != $car->files_2) {
                                $files_delete[] = $car->getOldAttribute('files_2');
                            }
                        } else {
                            $car->files_2 = $car->getOldAttribute('files_2');
                        }

                        if (!empty(UploadedFile::getInstance($car, "[{$index}]os_file"))){
                            $name_file = 'Осаго_' . $car->os_num;
                            $file = UploadedFile::getInstances($car, "[{$index}]os_file")[0];
                            $files[$name_file] = $file;
                            $car->os_file = $path . $name_file . '.' . $file->extension;

                            if ($car->getOldAttribute('os_file') != $car->os_file) {
                                $files_delete[] = $car->getOldAttribute('os_file');
                            }

                        } else {
                            $car->os_file = $car->getOldAttribute('os_file');
                        }

                        $car->saveRegulations();

                        if (!($flag = $car->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                    if ($flag) {
                        if (!empty($files))
                            $this->upload($files);

                        $transaction->commit();

                        if (!empty($files_delete)) {
                            $path = '/personal/doc/' . Yii::$app->user->identity->id . '/';

                            $directory = Yii::getAlias('@backend/web/doc/') . Yii::$app->user->identity->id . '/';

                            foreach ($files_delete as $del) {
                                $url = str_replace($path, $directory, $del);

                                if (file_exists($url))
                                    unlink($url);
                            }
                        }

                        return $this->redirect(['index']);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
            $wef = 234;
        }


        return $this->render('cars', [
            'models_car' => $models_car,
        ]);
    }

    public function actionYa()
    {
        $id = Yii::$app->user->identity->id;
        $models_ya = UserYa::find()->where(['id_user' => $id])->all();
        if(empty($models_ya))
            $models_ya = [new UserYa()];

        if (Yii::$app->request->post()) {
            $oldIDs = ArrayHelper::map($models_ya, 'id', 'id');
            $models_ya = Model::createMultiple(UserYa::class, $models_ya);

            Model::loadMultiple($models_ya, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($models_ya, 'id', 'id')));

            if (Model::validateMultiple($models_ya)) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if (!empty($deletedIDs)) {
                        UserYa::deleteAll(['id' => $deletedIDs]);
                    }
                    foreach ($models_ya as $ya) {
                        $ya->id_user = $id;

                        $ya->saveRegulations();

                        if (! ($flag = $ya->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }

        }

        return $this->render('ya', [
            'models_ya' => $models_ya,
        ]);
    }

    public function actionAssistant()
    {
        $id = Yii::$app->user->identity->id;
        $model = User::find()->joinWith(['cars0'])->where(['user.id' => $id])->one();

        if(!empty($model->cars0)) {
            $models_car = $model->cars0;
        } else {
            $models_car = [new UserCars()];
        }


        if (Yii::$app->request->post()) {

            $path = '/personal/doc/' . $id . '/';

            $oldIDs = ArrayHelper::map($models_car, 'id', 'id');
            $models_car = Model::createMultiple(UserCars::class, $models_car);

            Model::loadMultiple($models_car, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($models_car, 'id', 'id')));

            if (Model::validateMultiple($models_car) && $model->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->saveRegulations();
                    $model->identifier = 3;
                    if (!($flag = $model->save(false))) {
                        $transaction->rollBack();
                    }

                    if (!empty($deletedIDs)) {
                        $model_delete = UserCars::find()->where(['id' => $deletedIDs])->all();
                        $files_delete = ArrayHelper::merge(ArrayHelper::map($model_delete, 'id', 'files_1'), ArrayHelper::map($model_delete, 'id', 'files_2'));

                        UserCars::deleteAll(['id' => $deletedIDs]);
                    }
                    foreach ($models_car as $index => $car) {
                        $car->id_user = $id;

                        $timestamp = microtime();

                        if (!empty(UploadedFile::getInstance($car, "[{$index}]files_1"))){
                            $name_file = 'СТС_' . $timestamp . '_1_сторона';
                            $file = UploadedFile::getInstances($car, "[{$index}]files_1")[0];
                            $files[$name_file] = $file;
                            $car->files_1 = $path . $name_file . '.' . $file->extension;

                            if ($car->getOldAttribute('files_1') != $car->files_1) {
                                $files_delete[] = $car->getOldAttribute('files_1');
                            }

                        } else {
                            $car->files_1 = $car->getOldAttribute('files_1');
                        }

                        if (!empty(UploadedFile::getInstance($car, "[{$index}]files_2"))){
                            $name_file = 'СТС_' . $timestamp . '_2_сторона';
                            $file = UploadedFile::getInstances($car, "[{$index}]files_2")[0];
                            $files[$name_file] = $file;
                            $car->files_2 = $path . $name_file . '.' . $file->extension;

                            if ($car->getOldAttribute('files_2') != $car->files_2) {
                                $files_delete[] = $car->getOldAttribute('files_2');
                            }
                        } else {
                            $car->files_2 = $car->getOldAttribute('files_2');
                        }

                        if (!empty(UploadedFile::getInstance($car, "[{$index}]os_file"))){
                            $name_file = 'Осаго_' . $timestamp;
                            $file = UploadedFile::getInstances($car, "[{$index}]os_file")[0];
                            $files[$name_file] = $file;
                            $car->os_file = $path . $name_file . '.' . $file->extension;

                            if ($car->getOldAttribute('os_file') != $car->os_file) {
                                $files_delete[] = $car->getOldAttribute('os_file');
                            }

                        } else {
                            $car->os_file = $car->getOldAttribute('os_file');
                        }

                        $car->saveRegulations();

                        if (!($flag = $car->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                    if ($flag) {
                        if (!empty($files))
                            $this->upload($files);

                        $transaction->commit();

                        if (!empty($files_delete)) {
                            $path = '/personal/doc/' . $id . '/';

                            $directory = Yii::getAlias('@backend/web/doc/') . $id . '/';

                            foreach ($files_delete as $del) {
                                $url = str_replace($path, $directory, $del);

                                if (file_exists($url))
                                    unlink($url);
                            }
                        }

                        return $this->redirect(['index']);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }

        }

        return $this->render('assistant', [
            'model' => $model,
            'models_car' => $models_car,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function upload($files)
    {
        $directory = Yii::getAlias('@backend/web/doc/') . Yii::$app->user->identity->id . '/';
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }
        $path = 'doc/' . Yii::$app->user->identity->id . '/';

        foreach ($files as $key => $file) {
            $file->saveAs($path . $key . '.' . $file->extension);
        }

        return true;
    }

    public function actionChangePassword()
    {
        $model = new ChangePassword();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model_user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();

            if (Yii::$app->security->validatePassword($model->last_password, $model_user->password_hash)) {
                $model_user->setPassword($model->new_password);
                if ($model_user->save()) {
                    Yii::$app->session->setFlash('success', 'Пароль успешно изменен.');
                    return $this->redirect(['index']);
                }
            } else {
                $model->addError('last_password', 'Пароль не верный');
            }
        }

        return $this->render('change_password', [
            'model' => $model,
        ]);
    }
}
