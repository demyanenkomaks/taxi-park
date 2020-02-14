<?php

namespace backend\controllers;

use backend\models\FaqAuto;
use backend\models\FaqAutoSearch;
use backend\models\FaqPhone;
use backend\models\FaqPhoneSearch;
use backend\models\FaqQuestion;
use common\models\User;
use Yii;
use backend\models\Faq;
use backend\models\FaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaqController implements the CRUD actions for Faq model.
 */
class FaqController extends Controller
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
     * Lists all Faq models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModelFaq = new FaqSearch();
        $dataProviderFaq = $searchModelFaq->search(Yii::$app->request->queryParams);

        $searchModelAuto = new FaqAutoSearch();
        $dataProviderAuto = $searchModelAuto->search(Yii::$app->request->queryParams);

        $searchModelPhone = new FaqPhoneSearch();
        $dataProviderPhone = $searchModelPhone->search(Yii::$app->request->queryParams);

        $model = new FaqQuestion();

        if (Yii::$app->request->isPjax) {
            if ($model->load(Yii::$app->request->post())) {
                $model->user_ask = Yii::$app->user->identity->id;
                if ($model->save()) {
                    $model_user = User::find()->where(['id' => Yii::$app->user->identity->id])->asArray()->one();

                    $user = preg_replace("/^(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})$/", "+$1($2)-$3-$4-$5", $model_user['username']) . ' ' .
                        (!empty($model_user['p_f']) ? $model_user['p_f'] . ' ' : '') .
                        (!empty($model_user['p_i']) ? $model_user['p_i'] . ' ' : '') .
                        (!empty($model_user['p_o']) ? $model_user['p_o'] . ' ' : '') .
                        (!empty($model_user['email']) ? $model_user['email'] . ' ' : '');

                    $email_text = '
<p><b>Пользователь задавший вопрос: </b>' . $user . '</p>
<p><b>Вопрос: </b>' . $model->question . '</p>
';
                    Yii::$app->mailer->compose()
                        ->setFrom(['hr@mw.spb.ru' => 'Письмо с сайта mw.spb.ru'])
                        ->setTo('hr@mw.spb.ru')
//                        ->setTo('lugaluga2@mail.ru')
                        ->setSubject('Вопрос с формы FAQ')
                        ->setHtmlBody($email_text)
                        ->send();

                    Yii::$app->session->setFlash('success', 'Вопрос успешно отправлен.');
                    return $this->refresh();
                }
            }
        }

        return $this->render('index', [
            'searchModelFaq' => $searchModelFaq,
            'dataProviderFaq' => $dataProviderFaq,
            'searchModelAuto' => $searchModelAuto,
            'dataProviderAuto' => $dataProviderAuto,
            'searchModelPhone' => $searchModelPhone,
            'dataProviderPhone' => $dataProviderPhone,
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Faq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Faq();

        if ($model->load(Yii::$app->request->post())) {
            $model->user = Yii::$app->user->identity->id;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('faq/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Faq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->user = Yii::$app->user->identity->id;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('faq/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Faq model.
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
     * Finds the Faq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faq::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new FaqAuto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateAuto()
    {
        $model = new FaqAuto();

        if ($model->load(Yii::$app->request->post())) {
            $model->user = Yii::$app->user->identity->id;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('auto/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FaqAuto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateAuto($id)
    {
        $model = $this->findModelAuto($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->user = Yii::$app->user->identity->id;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('auto/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FaqAuto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteAuto($id)
    {
        $this->findModelAuto($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaqAuto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaqAuto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelAuto($id)
    {
        if (($model = FaqAuto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new FaqPhone model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePhone()
    {
        $model = new FaqPhone();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('phone/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FaqPhone model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdatePhone($id)
    {
        $model = $this->findModelPhone($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('phone/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FaqPhone model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeletePhone($id)
    {
        $this->findModelPhone($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaqPhone model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaqPhone the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelPhone($id)
    {
        if (($model = FaqPhone::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
