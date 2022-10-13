<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\NewUser;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegister()
    {
        $db = \Yii::$app->db;
        $model = new NewUser;
        $domains = array('42wolfsburg.de');
        $pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]*(" . implode('|', $domains) . ")$/i";

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                // form inputs are valid, do something here
                $username = $_POST['NewUser']['username'];
                $model->username = $username;
                $email1 = $_POST['NewUser']['email'];
                $model->email = $email1;
                $model->password = password_hash($_POST['NewUser']['password'], PASSWORD_ARGON2I);
                $received_code = $_POST['NewUser']['authKey'];
                $model->authKey = md5(random_bytes(5));
                $model->accessToken = password_hash(random_bytes(10), PASSWORD_DEFAULT);
                $val = preg_match($pattern, $model->email);
                if (!ctype_digit($received_code)) {
                    return $this->render('sorry');;
                }
                $ac_code = $db->createCommand("SELECT * FROM activation_code WHERE sent_code=$received_code")->queryOne();
                if ($val && $received_code && $ac_code && $ac_code['sent_code'] == $received_code
                    && $ac_code['email'] == $email1  && $ac_code['intraname'] == $username && $model->save()) {
                    return $this->redirect(['login']);
                } else
                    return $this->render('sorry');
                return;
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }


    public function actionActivation()
    {
        $subject = 'Activation code form 42 Bike Sharing (RIDE IT)';
        $headers = 'From: mjafari@students.42wolfsburg.de'       . "\r\n" .
            'Reply-To: mjafari@students.42wolfsburg.de' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $domains = array('42wolfsburg.de');
        $pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]*(" . implode('|', $domains) . ")$/i";

        $model = new \app\models\ActivationCode();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->email = $_POST['ActivationCode']['email'];
                $model->sent_code = random_int(100000, 999999);
                $message = 'Hello Dear User'. "\r\n". "\r\n". 'Please use the following code to register on bike sharing system!' ."\r\n"."\r\n".'Activation code: ' .
                    $model->sent_code .
                "\r\n"."\r\n".'Thanks for using our website!'."\r\n";
                $val = preg_match($pattern, $model->email);
                // form inputs are valid, do something here
                if ($val && $model->save()) {
                    mail($model->email, $subject, $message, $headers);
                    return $this->redirect(['register']);
                } else
                    return $this->render('sorry');
            }
        }

        return $this->render('activation', [
            'model' => $model,
        ]);
    }


    public function actionAvailable()
    {
        $model = new \app\models\BorrowedBike();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('available', [
            'model' => $model,
        ]);
    }
}
