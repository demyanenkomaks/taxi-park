<?php

namespace backend\modules\passenger\controllers;

use backend\models\Сalculations;
use backend\modules\driver\models\DriverWork;
use common\models\AdditionalFunctions;
use common\models\User;
use Yii;
use backend\modules\passenger\models\UserOrder;
use backend\modules\passenger\models\UserOrderSearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * OrderController implements the CRUD actions for UserOrder model.
 */
class OrderController extends Controller
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
     * Lists all UserOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserOrder model.
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
     * Creates a new UserOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model_driver = null;
        $model = new UserOrder();
        $model->date = date("d.m.Y");
        $model->duration = '00:00';

        if (empty(Yii::$app->user->identity->phone_driver)) {
            Yii::$app->session->setFlash('error', 'В Вашем профиле не указан номер телефона водителя такси! ' . Html::a('Ввести телефон водителя такси', ['/cabinet/update', 'id' => $model->id, 'form' => 'data'], ['class' => 'btn btn-primary', 'style' => 'text-decoration: none;']));
        } else {
            $model_driver = User::find()->where(['username' => Yii::$app->user->identity->phone_driver])->one();
            $model->driver = Yii::$app->user->identity->phone_driver;
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model->driver = Yii::$app->user->identity->phone_driver;
            $model->id_user = Yii::$app->user->identity->id;
            $model->cost = Сalculations::orderСost($model);

            $model->saveRegulations();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'model_driver' => $model_driver,
        ]);
    }

    /**
     * Updates an existing UserOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_driver = User::find()->where(['username' => $model->driver])->one();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model->saveRegulations();

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model_driver' => $model_driver,
        ]);
    }

    /**
     * Deletes an existing UserOrder model.
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
     * Finds the UserOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCalculationAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if(Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post()['UserOrder'];

            $result['sum'] = Сalculations::orderСost($data);
        }

        return $result;
    }

    public function actionCalendarEvent($driver, $start, $end)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];

        $driverWorks = User::find()
            ->joinWith([
                'driverWork0' => function ($q) use ($start, $end) {
                    $q->onCondition(['between', 'start_d', AdditionalFunctions::inDateTimeDb($start), AdditionalFunctions::inDateTimeDb($end)]);
                }
            ])
            ->where(['username' => $driver])
            ->asArray()
            ->one();

        if (!empty($driverWorks['driverWork0'])) {
            $i = 0;
            foreach ($driverWorks['driverWork0'] as $one) {
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
}
