<?php

namespace backend\modules\driver\controllers;

use backend\modules\driver\models\ModelCopyWeek;
use backend\modules\driver\models\ModelScheduleAdjustment;
use common\models\AdditionalFunctions;
use Yii;
use backend\modules\driver\models\DriverWork;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DriverWorkController implements the CRUD actions for DriverWork model.
 */
class DriverWorkController extends Controller
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
     * Lists all DriverWork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new DriverWork();
        $model_copy_week = new ModelCopyWeek();
        $model_schedule_adjustment = new ModelScheduleAdjustment();

        if (Yii::$app->request->isPjax) {
            if ($model_copy_week->load(Yii::$app->request->post()) && $model_copy_week->validate()) {
                if (!$model_copy_week->copyWeek($model_copy_week->count_week)) {
                    Yii::$app->session->setFlash('error', 'Скопировать заполненное рабочее время не удалось');
                }
                return $this->refresh();
            }

            if ($model_schedule_adjustment->load(Yii::$app->request->post()) && $model_schedule_adjustment->validate()) {
                $model_check = DriverWork::find()->where(['id_user' => Yii::$app->user->identity->id, 'start_d' => AdditionalFunctions::inDateTimeDb($model_schedule_adjustment->date_output)])->one();

                if (!empty($model_check)) {
                    if (DriverWork::deleteAll(['id_user' => Yii::$app->user->identity->id, 'start_d' => AdditionalFunctions::inDateTimeDb($model_schedule_adjustment->date_output)])) {
                        Yii::$app->session->setFlash('success', 'Успешно сделан выходной ' . $model_schedule_adjustment->date_output);
                    } else {
                        Yii::$app->session->setFlash('error', $model_schedule_adjustment->date_output . ' сделать выходной не удалось');
                    }
                } else {
                    Yii::$app->session->setFlash('warning', $model_schedule_adjustment->date_output . ' не указано рабочее время');
                }
            }
            return $this->refresh();
        }


        return $this->render('index', [
            'model' => $model,
            'model_copy_week' => $model_copy_week,
            'model_schedule_adjustment' => $model_schedule_adjustment,
        ]);
    }

    /**
     * Displays a single DriverWork model.
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
     * Creates a new DriverWork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DriverWork();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DriverWork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DriverWork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DriverWork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DriverWork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DriverWork::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionSaveFormEvent()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $start_d = AdditionalFunctions::inDateTimeDb($data['start_d']);
            $stop_d = AdditionalFunctions::inDateTimeDb($data['stop_d']);

            $model_check = DriverWork::find()
                ->where(['id_user' => Yii::$app->user->identity->id])
                ->andWhere('
                (start_d <= "' . $start_d . '" and start_t < "' . $data['start_t'] . '" and stop_d >= "' . $start_d . '" and stop_t > "' . $data['start_t'] . '")
                or (start_d <= "' . $stop_d . '" and start_t < "' . $data['stop_t'] . '" and stop_d >= "' . $stop_d . '" and stop_t > "' . $data['stop_t'] . '")
                or (start_d >= "' . $start_d . '" and start_t > "' . $data['start_t'] . '" and stop_d <= "' . $stop_d . '" and stop_t < "' . $data['stop_t'] . '")
                 ');

                if (!empty($data['id'])) {
                    $model_check->andWhere(['!=', 'id', $data['id']]);
                }

            if (empty($model_check->one())) {
                if (empty($data['id'])) {
                    $model = new DriverWork();
                    $model->id_user = Yii::$app->user->identity->id;
                } else {
                    $model = DriverWork::find()->where(['id' => $data['id'], 'id_user' => Yii::$app->user->identity->id])->one();
                }

                $model->title = 'Работаю';
                $model->start_d = $start_d;
                $model->start_t = $data['start_t'];
                $model->stop_d = $stop_d;
                $model->stop_t = $data['stop_t'];
                $model->price = $data['price'];

                if ($model->save()) {
                    return ['model' => $model->attributes];
                }
            } else {
                return ['error' => 'Проверьте пожалуйста выбранный интервал, он не должен пересекаться с уже добавленными ранее.'];
            }
        }
        return ['error' => 'Интервал не сохранен по неизвесной причине.'];
    }

    public function actionCalendarEvent($start, $end)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        $models = DriverWork::find()
            ->asArray()
            ->where(['id_user' => Yii::$app->user->identity->id])
            ->andWhere(['between', 'start_d', AdditionalFunctions::inDateTimeDb($start), AdditionalFunctions::inDateTimeDb($end)])
            ->all();

        if (!empty($models)) {
            $i = 0;
            foreach ($models as $one) {
                $result[$i]['id'] = $one['id'];
                $result[$i]['title'] = $one['price'] . ' руб./час';
                $result[$i]['start'] = AdditionalFunctions::inDateTimeDb($one['start_d'], $one['start_t']);
                $result[$i]['end'] = AdditionalFunctions::inDateTimeDb($one['stop_d'], $one['stop_t']);
                $result[$i]['overlap'] = false;
                $result[$i]['editable'] = false;
                $i++;
            }
        }
        return $result;
    }

    public function actionSearchModal()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if(Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $model = DriverWork::find()
                ->where(['id_user' => Yii::$app->user->identity->id, 'id' => $data['id']])
                ->one();

            if (!empty($model)) {
                $model->start_d = Yii::$app->formatter->asDate($model->start_d, 'php:d.m.Y');
                $model->stop_d = Yii::$app->formatter->asDate($model->stop_d, 'php:d.m.Y');
                return ['model' => $model];
            }
        }
        return ['error' => 'Интервал не найден.'];
    }

    public function actionDeleteFormEvent()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();

            if (!empty($data['id'])) {
                $model = DriverWork::find()->where(['id' => $data['id'], 'id_user' => Yii::$app->user->identity->id])->one();
                $id = $model->id;
                if ($model->delete()) {
                    return ['id' => $id];
                }
            }
        }
        return ['error' => 'Интервал не сохранен по неизвесной причине.'];
    }
}
