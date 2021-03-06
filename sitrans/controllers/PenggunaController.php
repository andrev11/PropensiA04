<?php

namespace app\controllers;

use Yii;
use app\models\Pengguna;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\SiteController; 

/**
 * PenggunaController implements the CRUD actions for Pengguna model.
 */
class PenggunaController extends Controller
{
    public function beforeAction($action)
        {
		if (Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->user->loginUrl);
		} else if (Yii::$app->user->identity->role == 'deactivated'){
			return $this->redirect('../index');
		} else {
			return true;
		}
    }
	
	public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pengguna models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pengguna::find(),
        ]);
         $dataProvider ->setSort([
            'defaultOrder' => ['nama'=>SORT_ASC],
            ]);

		
		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'){
			return $this->render('index', [
				'dataProvider' => $dataProvider,
			]);
		} else {
			return $this->redirect(Yii::$app->user->loginUrl);
		}
    }
    public function actionListuser()
    {
        $user = Pengguna::find()->all();
            return $this->render('listuser', [
                'user' => $user,
            ]);
    }
    public function actionResetpassadmin($username){

            echo SiteController::connect();
            $password = Yii::$app->getSecurity()->generatePasswordHash('password123');
            $ubahpassword = "UPDATE PENGGUNA SET password = '".$password."' WHERE username = '".$username."';";
            $ubah = pg_query($ubahpassword);
            $dataProvider = new ActiveDataProvider([
            'query' => Pengguna::find(),
            ]);

            return $this->render('view', [
				'model' => $this->findModel($username),
            ]);

                /***return $this->render('view', [
                        'model' => $this->findModel($username),
                    ]);
                **/
    }


    /**
     * Displays a single Pengguna model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pengguna model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pengguna();
		$model->scenario = 'create';
		$post = Yii::$app->request->post();

		if ($model->load($post)) {
			if ($model->save()) {
				return $this->redirect(['view', 'id' => $model->username]);
			}
		}
		
		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'){
			return $this->render('create', [
				'model' => $model,
			]);
		} else {
			return $this->redirect(Yii::$app->user->loginUrl);
		}
    }

    /**
     * Updates an existing Pengguna model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role != 'admin'){
			$model = $this->findModel($id);
			
			$model->scenario = 'update';

			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->username]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		} else if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin'){
			return $this->redirect(['update-admin', 'id' => $id]);
		}
    }
	
	public function actionUpdateAdmin($id)
    {
        //echo SiteController::connect();
		$model = $this->findModel($id);
		
		if(Yii::$app->getRequest()->getQueryParam('id') == Yii::$app->user->identity->username){
			$model->scenario = 'update';
		}

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->username]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pengguna model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pengguna model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pengguna the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengguna::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
