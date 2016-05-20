<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
        ];
    }

    public function connect(){

        $myHost = "localhost";
        $myUser = "a04";
        $myPassword = "hn;2016";
        $myPort = "5432";
        // Create connection
        $conn = "host = ".$myHost." user = ".$myUser." password = ".$myPassword." port = ".$myPort." dbname = a04";
	
        // Check connection
        if (!$database = pg_connect($conn)) {
            die("Connection failed");
        }
	pg_query("set search_path to propensi;");
        
    }
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

    /***
     public function actionLogin()
    {
        return $this->render('login');
    }
    public function actionConnect()
    {
        return $this->render('connect');
    }
    public function actionCeklogin()
    {
        return $this->render('ceklogin');
    }**/

    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'deactivated'){
			return $this->render('index');
		} else if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'deactivated'){
			return $this->render('tolak');
		} else {
			return $this->redirect(Yii::$app->user->loginUrl);
		}
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    } 
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Yii::$app->user->loginUrl);
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // change layout for error action
            if ($action->id=='login')
                 $this->layout = 'login';
            return true;
        } else {
            return false;
        }
    }

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
	
	public function actionCreatepembelian()
    {
        return $this->render('createpembelian');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
