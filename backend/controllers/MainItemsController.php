<?php

namespace backend\controllers;

use Yii;
use common\models\MainItems;
use backend\models\MainItemsSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MainItemsController implements the CRUD actions for MainItems model.
 */
class MainItemsController extends Controller
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
     * Lists all MainItems models.
     * @return mixed
     */
    public function actionIndex($identifier)
    {
        $searchModel = new MainItemsSearch();
        $searchModel->identifier = $identifier;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'identifier' => $identifier,
        ]);
    }

    /**
     * Displays a single MainItems model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MainItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($identifier)
    {
        $model = new MainItems();
        $model->identifier = $identifier;

        if ($model->load(Yii::$app->request->post())) {

            if (!empty(UploadedFile::getInstance($model, 'file'))){
                $directory = Yii::getAlias('@frontend/web/images/slide/');

                $file = UploadedFile::getInstances($model, 'file')[0];
                $model->img = $file->name;

                if (!is_dir($directory)) {
                    FileHelper::createDirectory($directory);
                }

                $file->saveAs($directory . $file->name);
            } else {
                $model->img = null;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MainItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if (!empty(UploadedFile::getInstance($model, 'file'))){
                $directory = Yii::getAlias('@frontend/web/images/slide/');

                $file = UploadedFile::getInstances($model, 'file')[0];
                $model->img = $file->name;

                if (!is_dir($directory)) {
                    FileHelper::createDirectory($directory);
                }

                $file->saveAs($directory . $file->name);

                if ($file->name != $model->getOldAttribute('img')) {
                    unlink($directory . $model->getOldAttribute('img'));
                }
            } else {
                $model->img = $model->getOldAttribute('img');
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MainItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $identifier = $model->identifier;

        $directory = Yii::getAlias('@frontend/web/images/slide/');
        unlink($directory . $model->img);

        $model->delete();
        return $this->redirect(['index', 'identifier' => $identifier]);
    }

    /**
     * Finds the MainItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MainItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MainItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
