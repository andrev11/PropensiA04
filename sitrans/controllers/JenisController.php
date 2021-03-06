<?php

namespace app\controllers;

use Yii;
use app\models\Jenis;
use app\models\JenisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\SiteController; 


/**
 * JenisController implements the CRUD actions for Jenis model.
 */
class JenisController extends Controller
{
    public function beforeAction($action)
        {
		if (Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->user->loginUrl);
		} else if (Yii::$app->user->identity->role == 'purchasing' || Yii::$app->user->identity->role == 'sales marketing'){
			return true;
		} else {
			return $this->redirect(Yii::$app->user->loginUrl);
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
     * Lists all Jenis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JenisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider ->setSort([
            'defaultOrder' => ['namajenis'=>SORT_ASC],
            ]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSetrop()
    {
        $jenis2 = Jenis::find()->all();
            return $this->render('setrop', [
                'jenis2' => $jenis2,
            ]);
    }
    /**
     * Displays a single Jenis model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Jenis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {	
		
		echo SiteController::connect(); 
		$increments = pg_fetch_array(pg_query("select max(idjenis) from jenis ;"));
		$id=$increments[0] + 1 ;		
        $model = new Jenis();
		$model->idjenis=$id;
		$model->stok_kilo=0;
		$model->stok_karton=0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idjenis]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Jenis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'sales marketing'){
            $model = $this->findModel($id);
            $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idjenis]);
        } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'purchasing'){
                return $this->redirect(['update-purchasing', 'id' => $id]);
        }
    }

    public function actionUpdatePurchasing($id)
    {
        //echo SiteController::connect();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idjenis]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing Jenis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jenis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jenis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jenis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
