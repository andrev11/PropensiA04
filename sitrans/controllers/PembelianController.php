<?php

namespace app\controllers;

use Yii;
use app\models\Pembelian;
use app\models\PembelianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\SiteController;

/**
 * PembelianController implements the CRUD actions for Pembelian model.
 */
class PembelianController extends Controller
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
     * Lists all Pembelian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembelianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pembelian model.
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
     * Creates a new Pembelian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pembelian();
        echo SiteController::connect(); 
        $increments = pg_fetch_array(pg_query("select max(idbeli) from pembelian ;"));
        $id=$increments[0] + 1 ;  
        $model->idbeli=$id;
        $model->tgl_beli = date('Y-m-d');
        $model->status_del="Belum Diterim"; 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $supplier=$model->supplier;
            $tglbeli=$model->tgl_beli;
             $idbeli = $model->idbeli;
            echo PembelianController::insertIdBayar($supplier, $tglbeli,$idbeli);
           
            $jumlahkilo=$model->kilo;
            $namaproduk=$model->produk;
            echo PembelianController::insertTotalPrice($jumlahkilo, $namaproduk, $idbeli);
            return $this->redirect(['view', 'id' => $model->idbeli]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function updateProduk($namaproduk){
        $queryprodukkilo="select kilo from produk where namaproduk ='".$namaproduk."';";
        $queryprodukkarton="select karton from produk where namaproduk ='".$namaproduk."';";
        $kilo = pg_fetch_array(pg_query($queryprodukkilo))[0];
        $karton = pg_fetch_array(pg_query($queryprodukkarton))[0];
        
    }
    public function insertTotalPrice($jumlahkilo, $namaproduk, $idbeli){
        $queryproduk="select harga_beli from produk where namaproduk='".$namaproduk."';";
        $hargabeli = pg_fetch_array(pg_query($queryproduk))[0];
        $hargatotal= $jumlahkilo * $hargabeli;
        $queryhargatotal ="Update pembelian set harga_total=".$hargatotal." where idbeli=".$idbeli.";";
        pg_query($queryhargatotal); 
    }
    
    public function insertIdBayar($supplier, $tanggalbeli, $idbeli){
        $querypembayaranout = "select idbayar from pembayaran_out where supplier='".$supplier."' AND tgl_trans = '".$tanggalbeli."';";
        $ambilIdBayar = pg_fetch_array(pg_query($querypembayaranout));
        $IdBayar;
        if(pg_num_rows(pg_query($querypembayaranout)) ==0){
            $increments = pg_fetch_array(pg_query("select max(idbayar) from pembayaran_out;"));
            $IdBayar =$increments[0] +1;
            $masukan = "INSERT INTO PEMBAYARAN_OUT VALUES ('".$IdBayar."', '".$supplier."', '".$tanggalbeli."', null, null, null);";
            pg_query($masukan); 

        }   else {

            $IdBayar = $ambilIdBayar[0];
        }

        $querypembelian="Update Pembelian set idbayar='".$IdBayar."' where idbeli='".$idbeli."';";
        pg_query($querypembelian);
    }
    public function updateProduk(){

    }
    /**
     * Updates an existing Pembelian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idbeli]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pembelian model.
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
     * Finds the Pembelian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pembelian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pembelian::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
