<?php

namespace app\controllers;

use Yii;
use app\models\PembayaranOut;
use app\models\PembayaranOutSearch;
use app\models\PembelianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\controllers\SiteController;

/**
 * PembayaranOutController implements the CRUD actions for PembayaranOut model.
 */
class PembayaranOutController extends Controller
{
    public function beforeAction($action)
        {
		if (Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->user->loginUrl);
		} else if (Yii::$app->user->identity->role == 'finance' || Yii::$app->user->identity->role == 'bod'){
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
     * Lists all PembayaranOut models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembayaranOutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider ->setSort([
            'defaultOrder' => ['tgl_trans'=>SORT_DESC],
            ]);
		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'finance'){
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		} else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }

    public function actionIndex2()
    {        
            $hutang = PembayaranOut::find()
                ->where("status_bayar= 'Hutang'")
                ->andWhere(['not', ['jumlahbayar' => null]])
                ->orderBy(['tgl_trans' => SORT_ASC])
                ->all();
		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'finance'){
            return $this->render('index2', [
                'hutang' => $hutang,
            ]);
		} else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }

    public function actionIndex3()
    {
        /**
        $dataProvider = new ActiveDataProvider([
            'query' => PembayaranOut::find(),
        ]);

        return $this->render('index2', [
            'dataProvider' => $dataProvider,
        ]);
        **/
        
            $rekap = PembayaranOut::find()
                ->where("status_bayar= 'Lunas'")
                ->andWhere("EXTRACT(MONTH FROM tgl_bayar) = 4")
                ->andWhere("EXTRACT(YEAR FROM tgl_bayar) = 2016")
                ->orderBy(['tgl_bayar' => SORT_ASC])
                ->all();
		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'bod'){
            return $this->render('index3', [
                'rekap' => $rekap,
            ]);
		} else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }

    /**
     * Displays a single PembayaranOut model.
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
     * Creates a new PembayaranOut model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PembayaranOut();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idbayar]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PembayaranOut model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idbayar]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PembayaranOut model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionConfirm($id)
    {
                 echo SiteController::connect();
             $tglBayar = date('Y-m-d'); 
            //$ambilStatus = "SELECT status_del FROM pembelian WHERE idbeli = '".$id."';";
            $ubahStatus = "UPDATE PEMBAYARAN_OUT SET status_bayar = 'Lunas' WHERE idbayar = '".$id."';";
            $ubahTanggal = "UPDATE PEMBAYARAN_OUT SET tgl_bayar = '".$tglBayar."' WHERE idbayar = '".$id."';";
            $masukin = pg_query($ubahStatus);
            $masukin2 = pg_query($ubahTanggal);


                return $this->render('view', [
                        'model' => $this->findModel($id),
                    ]);
    }

    public function actionCreateProduk(){
        
    }

    /**
     * Finds the PembayaranOut model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PembayaranOut the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PembayaranOut::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
