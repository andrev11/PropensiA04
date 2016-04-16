<?php

namespace app\controllers;

use Yii;
use app\models\PembayaranOut;
use app\models\PembelianOutSearch;
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
        $searchModel = new PembelianOutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex2()
    {
        /**
        $dataProvider = new ActiveDataProvider([
            'query' => PembayaranOut::find(),
        ]);

        return $this->render('index2', [
            'dataProvider' => $dataProvider,
        ]);
        **/

        $hutang = PembayaranOut::find()
          ->where("status_bayar= 'Hutang'")
          ->all();
        return $this->render('index2', [
            'hutang' => $hutang,
        ]);
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
        //$model = $this->findModel($id);

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->idbeli]);
      
            /***$myHost = "localhost";
            $myUser = "postgres";
            $myPassword = "1234";
            $myPort = "5432";
            $tglBayar = date('Y-m-d');
            // Create connection
            $conn = "host = ".$myHost." user = ".$myUser." password = ".$myPassword." port = ".$myPort." dbname = sitrans";
            // Check connection
            if (!$database = pg_connect($conn)) {
                die("Connection failed");
            }
            **/
             echo SiteController::connect(); 
            //$ambilStatus = "SELECT status_del FROM pembelian WHERE idbeli = '".$id."';";
            $ubahStatus = "UPDATE PEMBAYARAN_OUT SET status_bayar = 'Lunas' WHERE idbayar = '".$id."';";
            $ubahTanggal = "UPDATE PEMBAYARAN_OUT SET tgl_bayar = '".$tglBayar."' WHERE idbayar = '".$id."';";
            $masukin = pg_query($ubahStatus);
            $masukin2 = pg_query($ubahTanggal);


                return $this->render('view', [
                        'model' => $this->findModel($id),
                    ]);




       // } else {
        //    return $this->render('confirm', [
                //'model' => $model,
        //    ]);
        //}
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
