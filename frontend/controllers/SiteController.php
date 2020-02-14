<?php
namespace frontend\controllers;

use backend\models\AuthAssignment;
use backend\models\StaticPage;
use common\models\MainItems;
use common\models\MainNames;
use common\models\User;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\SignupHrForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupDriverForm;
use frontend\models\SignupPassengerForm;
use frontend\models\ContactForm;
use yii\web\HttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model_driver_signup = new SignupDriverForm();
        $model_passenger_signup = new SignupPassengerForm();

        $model_main = MainNames::find()->asArray()->all();
        $model_items = MainItems::find()->asArray()->all();
        foreach ($model_items as $mass) {
            if ($mass['identifier'] == 1) {
                $slider[] = $mass;
            }
            if ($mass['identifier'] == 2) {
                $o_nas[] = $mass;
            }
            if ($mass['identifier'] == 3) {
                $working_conditions[] = $mass;
            }
            if ($mass['identifier'] == 4) {
                $finance[] = $mass;
            }
            if ($mass['identifier'] == 5) {
                $shutdown[] = $mass;
            }
        }

        if (Yii::$app->request->isAjax && $model_driver_signup->load(Yii::$app->request->post())) {

            if ($model_driver_signup->checkPolicy == 1) {
                if ($model_driver_signup->signup()) {
                    Yii::$app->session->setFlash('success', 'Пользователь зарегистирован.');

                    $post_user = Yii::$app->request->post()['SignupDriverForm'];
                    $model_login = new LoginForm();
                    $model_login->username = $post_user['username'];
                    $model_login->password = $post_user['password'];
                    $model_login->login();

                    return $this->redirect('/personal/cabinet/');
                } else {
                    $model_driver_signup->password = null;
                    $model_driver_signup->addError('username', 'Номер уже зарегестрирован');
                }
            } else {
                $model_driver_signup->addError('checkPolicy', '');
            }
        }

        if (Yii::$app->request->isAjax && $model_passenger_signup->load(Yii::$app->request->post())) {

            if ($model_passenger_signup->checkPolicy == 1) {
                $model_check = User::find()->where(['username' => preg_replace('/[^0-9a-zA-Z]/', '', $model_passenger_signup->phone_driver)])->one();
                if (!empty($model_check)) {
                    if ($model_passenger_signup->signup()) {
                        Yii::$app->session->setFlash('success', 'Пользователь зарегистирован.');

                        $post_user = Yii::$app->request->post()['SignupPassengerForm'];
                        $model_login = new LoginForm();
                        $model_login->username = $post_user['username'];
                        $model_login->password = $post_user['password'];
                        $model_login->login();

                        return $this->redirect('/personal/cabinet/');
                    } else {
                        $model_passenger_signup->password = null;
                        $model_passenger_signup->addError('username', 'Номер уже зарегестрирован');
                    }
                } else {
                    $model_passenger_signup->addError('phone_driver', 'Водитель не зарегестрирован в приложении');
                }
            } else {
                $model_passenger_signup->addError('checkPolicy', '');
            }
        }

        return $this->render('index', [
            'model_driver_signup' => $model_driver_signup,
            'model_passenger_signup' => $model_passenger_signup,
            'model_main' => $model_main,
            'slider' => $slider,
            'o_nas' => $o_nas,
            'working_conditions' => $working_conditions,
            'finance' => $finance,
            'shutdown' => $shutdown,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionRegistrationHr()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupHrForm();
        $model_page = StaticPage::find()->where(['url' => 'hr'])->one();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->checkPolicy == 1) {
                if ($model->signupHr()) {

                    Yii::$app->session->setFlash('success', 'Пользователь зарегистирован.');

                    $post_user = Yii::$app->request->post()['SignupHrForm'];

                    $model_login = new LoginForm();
                    $model_login->username = $post_user['username'];
                    $model_login->password = $post_user['password'];
                    $model_login->login();

                    return $this->redirect('/personal/cabinet/');
                } else {
                    $model->addError('username', 'Номер уже зарегестрирован');
                }
            } else {
                $model->addError('checkPolicy', '');
            }
        }
        $model->password = null;

        return $this->render('registration-hr', [
            'model' => $model,
            'model_page' => $model_page,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
//    public function actionContact()
//    {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
//                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
//            } else {
//                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
//            }
//
//            return $this->refresh();
//        } else {
//            return $this->render('contact', [
//                'model' => $model,
//            ]);
//        }
//    }


    public function actionStatic($url)
    {
        $model = StaticPage::find()->where(['url' => $url])->one();
        return $this->render('static', [
            'model' => $model,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
//    public function actionSignup()
//    {
//        $model = new SignupForm();
//        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
//            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
//            return $this->goHome();
//        }
//
//        return $this->render('signup', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
//    public function actionRequestPasswordReset()
//    {
//        $model = new PasswordResetRequestForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//
//                return $this->goHome();
//            } else {
//                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
//            }
//        }
//
//        return $this->render('requestPasswordResetToken', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
//    public function actionResetPassword($token)
//    {
//        try {
//            $model = new ResetPasswordForm($token);
//        } catch (InvalidArgumentException $e) {
//            throw new BadRequestHttpException($e->getMessage());
//        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
//            Yii::$app->session->setFlash('success', 'New password saved.');
//
//            return $this->goHome();
//        }
//
//        return $this->render('resetPassword', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
//    public function actionVerifyEmail($token)
//    {
//        try {
//            $model = new VerifyEmailForm($token);
//        } catch (InvalidArgumentException $e) {
//            throw new BadRequestHttpException($e->getMessage());
//        }
//        if ($user = $model->verifyEmail()) {
//            if (Yii::$app->user->login($user)) {
//                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
//                return $this->goHome();
//            }
//        }
//
//        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
//        return $this->goHome();
//    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
//    public function actionResendVerificationEmail()
//    {
//        $model = new ResendVerificationEmailForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//                return $this->goHome();
//            }
//            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
//        }
//
//        return $this->render('resendVerificationEmail', [
//            'model' => $model
//        ]);
//    }

    public function actionAjaxLogin() {
        if (Yii::$app->request->isAjax) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->login()) {
                    return $this->goBack();
                } else {
                    Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                    return \yii\widgets\ActiveForm::validate($model);
                }
            }
        } else {
            throw new HttpException(404 ,'Page not found');
        }
    }
}
