<?php

namespace backend\controllers;

use backend\models\AddModerDriver;
use backend\models\AuthAssignment;
use backend\models\Model;
use backend\models\UserCars;
use Yii;
use common\models\User;
use backend\models\UserSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model_count_driver = new AddModerDriver();

        if (Yii::$app->user->can('Модератор HR')) {
            if (empty($model->hr_id) && $model->identifier == 0) {
                $model->hr_id = Yii::$app->user->identity->id;
                $model->save();
            }
            if ($model->hr_id != Yii::$app->user->identity->id) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->update_user = Yii::$app->user->identity->id;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        if ($model_count_driver->load(Yii::$app->request->post())) {
            $update_users = User::find()->asArray()->select(['id'])->where('hr_id is null')->andWhere(['identifier' => [0,1,3,4]])->limit($model_count_driver->count_driver)->all();
            if (!empty($update_users)) {
                $update_users = ArrayHelper::map($update_users, 'id', 'id');
                User::updateAll(['hr_id' => $id], ['id' => $update_users]);
            } else {
                Yii::$app->session->setFlash('error', 'Нет больше в базе водителей не подтвержденных и не прикрепленных к Модераторам HR.');
            }

            return $this->redirect(['index']);
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
            'model_count_driver' => $model_count_driver,
        ]);
    }

    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            $model->username = preg_replace('/[^0-9a-zA-Z]/', '', $model->username);
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            $model->status = 10;
            $model->identifier = 0;
            $model->create_user = Yii::$app->user->identity->id;
            $model->update_user = Yii::$app->user->identity->id;

            if (Yii::$app->user->can('Модератор HR')) {
                $model->hr_id = Yii::$app->user->identity->id;
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!($flag = $model->save())) {
                    $transaction->rollBack();
                }

                $authassignment = new AuthAssignment;
                $authassignment->item_name = 'Не подтвержденный';
                $authassignment->user_id = strval($model->id);

                if (!($flag = $authassignment->save())) {
                    $transaction->rollBack();
                }

                if ($flag) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Водитель зарегистирован.');
                    Yii::$app->session->setFlash('warning', 'Необходимо дозаполнить профиль водителя.');

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $model->addError('username', 'Номер не удалось зарегестрировать');
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('create', [
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
    public function actionUpdate($id, $form)
    {
        $model = $this->findModel($id);

        if ($model->hr_id != Yii::$app->user->identity->id && Yii::$app->user->identity->identifier == 5) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post())) {

            $model->saveRegulations();

            if (empty($model->getErrors())) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
                    return $this->redirect(['view', 'id' => $id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'form' => $form,
        ]);
    }

    public function actionCars($id)
    {
        $model = User::find()->with('cars0')->where(['id' => $id])->one();

        if ($model->hr_id != Yii::$app->user->identity->id && Yii::$app->user->identity->identifier == 5) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

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
                            $name_file = 'СТС_' .$timestamp . '_2_сторона';
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
                            $this->upload($files, $id);

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

                        return $this->redirect(['view', 'id' => $id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }

        }

        return $this->render('cars', [
            'model' => $model,
            'models_car' => $models_car,
        ]);
    }

//    public function actionAccess($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->create_user != Yii::$app->user->identity->id && Yii::$app->user->identity->identifier == 5) {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//
//        $authassignment = AuthAssignment::find()->where(['user_id' => strval($id)])->one();
//        if (empty($authassignment))
//            $authassignment = new AuthAssignment();
//
//        if ($model->load(Yii::$app->request->post()) && $authassignment->load(Yii::$app->request->post())) {
//            $authassignment->user_id = strval($id);
//            if ($model->save()) {
//                if (!empty($authassignment->item_name)) {
//                    $authassignment->save();
//                } else {
//                    if (!$authassignment->isNewRecord) {
//                        $authassignment->delete();
//                    }
//                }
//                Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
//                return $this->redirect(['view', 'id' => $id]);
//            }
//        }
//
//        return $this->render('access', [
//            'model' => $model,
//            'authassignment' => $authassignment,
//        ]);
//    }


    public function actionTested($id)
    {
        $model = $this->findModel($id);

        $model->message = null;
        $model->identifier = 4;
        $model->update_user = Yii::$app->user->identity->id;
        $model->t_moderator = Yii::$app->user->identity->id;
        $model->t_d_t_mod = date("Y-m-d H:i:s");
        $model->save();

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionConfirmation($id)
    {
        $model = $this->findModel($id);

        $model->message = null;
        $model->identifier = 1;
        $model->update_user = Yii::$app->user->identity->id;
        $model->t_admin = Yii::$app->user->identity->id;
        $model->t_d_t_adm = date("Y-m-d H:i:s");
        $model->mod_comment = null;
        $model->mod_ident = null;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!($flag = $model->save())) {
                $transaction->rollBack();
            }

            $authassignment = AuthAssignment::find()->where(['user_id' => $model->id])->one();
            $authassignment->item_name = 'Водитель';

            if (!($flag = $authassignment->save())) {
                $transaction->rollBack();
            }
            if ($flag) {
                $transaction->commit();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionConfirmationModeratorHr($id)
    {
        $model = $this->findModel($id);

        $model->message = null;
        $model->identifier = 5;
        $model->update_user = Yii::$app->user->identity->id;
        $model->t_admin = Yii::$app->user->identity->id;
        $model->t_d_t_adm = date("Y-m-d H:i:s");

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!($flag = $model->save())) {
                $transaction->rollBack();
            }

            $authassignment = AuthAssignment::find()->where(['user_id' => $model->id])->one();
            $authassignment->item_name = 'Модератор HR';


            if (!($flag = $authassignment->save())) {
                $transaction->rollBack();
            }
            if ($flag) {
                $update_users = User::find()->asArray()->select(['id'])->where('hr_id is null')->andWhere(['identifier' => [0,1,3,4], ])->limit(150)->all();
                if (!empty($update_users)) {
                    $update_users = ArrayHelper::map($update_users, 'id', 'id');
                    User::updateAll(['hr_id' => $id], ['id' => $update_users]);
                } else {
                    Yii::$app->session->setFlash('error', 'Нет больше в базе водителей не подтвержденных и не прикрепленных к Модераторам HR.');
                }

                $transaction->commit();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!($flag = AuthAssignment::deleteAll(['user_id' => $id]))) {
                $transaction->rollBack();
            }

            if (!($flag = $this->findModel($id)->delete())) {
                $transaction->rollBack();
            }

            if ($flag) {
                $transaction->commit();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect(['index']);
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
}
