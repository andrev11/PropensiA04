<?php

namespace app\controllers;

use Yii;
use app\models\Pembelian;
use app\models\PembelianSearch;
use app\models\PembayaranOut;
use app\models\Lokasi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\SiteController;
use app\controllers\PembayaranOutController;
use yii\db\Query;
use mPDF;

/**
 * PembelianController implements the CRUD actions for Pembelian model.
 */
class PembelianController extends Controller
{
    public function beforeAction($action)
        {
		if (Yii::$app->user->isGuest){
			return $this->redirect(Yii::$app->user->loginUrl);
		} else if (Yii::$app->user->identity->role == 'purchasing' || Yii::$app->user->identity->role == 'admin inventori' || Yii::$app->user->identity->role == 'bod'){
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
     * Lists all Pembelian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembelianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider ->setSort([
            'defaultOrder' => ['tgl_beli'=>SORT_DESC],
            ]);

		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'purchasing'){
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

        $beli2 = Pembelian::find()
            ->where("status_del= 'Belum Diterima'")
            ->orderBy(['tgl_terima' => SORT_DESC])
            ->all();
        
		if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin inventori'){
			return $this->render('index2', [
				'beli2' => $beli2,
			]);
		} else {
			return $this->redirect(Yii::$app->user->loginUrl);
		}
    }

    public function actionIndex3()
    {
        $searchModel = new PembelianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider ->setSort([
            'defaultOrder' => ['tgl_beli'=>SORT_DESC],
            ]);

        if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'bod'){
            return $this->render('index3', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
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

    public function actionPrint()
    {  

        ini_set('memory_limit','3000M');//extending php memory
        $pdf=new mPDF('win-1252','A4','','',15,10,16,10,10,10);//A4 size page in landscape orientation
        date_default_timezone_set("Asia/Bangkok");
        $pdf->SetHeader(date('H:i:s'));
        $pdf->setFooter('{PAGENO}');
        $pdf->useOnlyCoreFonts = true;    // false is default
        $pdf->SetDisplayMode('fullpage');
       
        ob_start();
 
        include "../views/pembelian/_reportPembelian.php";//The php page you want to convert to pdf
        
        $html = ob_get_contents();

        ob_end_clean();

        // send the captured HTML from the output buffer to the mPDF class for processing

        $pdf->WriteHTML($html);
        //$mpdf->SetProtection(array(), 'mawiahl', 'password');//for password protecting your pdf

            // return the pdf output as per the destination setting
             $pdf->Output(); 
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
        $model->status_del="Belum Diterima"; 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $supplier=$model->supplier;
            $tglbeli=$model->tgl_beli;
            $idbeli = $model->idbeli;
            $lokasi = $model->lokasi;
            echo PembelianController::insertIdBayar($supplier, $tglbeli,$idbeli);           
            $jumlahkilo=$model->kilo;
            $jumlahkarton=$model->karton;
            $namaproduk=$model->produk;
            echo PembelianController::checkLokasiProduk($namaproduk,$lokasi);
            echo PembelianController::insertTotalPrice($jumlahkilo, $namaproduk, $idbeli);
            echo PembelianController::updateStokProduk($namaproduk, $jumlahkilo, $jumlahkarton,$lokasi);
            echo PembelianController::updateStokJenis($namaproduk, $jumlahkilo, $jumlahkarton);
            return $this->redirect(['view', 'id' => $model->idbeli]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function checkLokasiProduk($namaproduk,$lokasi){
        $query="Select * from produk where namaproduk='".$namaproduk."' AND lokasi='".$lokasi."';";
        if(pg_num_rows(pg_query($query)) == 0){
            $queryidmerk="Select idmerk from produk where namaproduk='".$namaproduk."';";
            $queryidjenis="Select idjenis from produk where namaproduk='".$namaproduk."';";
            $queryhargabeli="Select harga_beli from produk where namaproduk='".$namaproduk."';";
            $queryhargajual="Select harga_jual from produk where namaproduk='".$namaproduk."';";
            $idjenis=pg_fetch_array(pg_query($queryidjenis))[0];
            $idmerk=pg_fetch_array(pg_query($queryidmerk))[0];
            $hargabeli=pg_fetch_array(pg_query($queryhargabeli))[0];
            $hargajual=pg_fetch_array(pg_query($queryhargajual))[0];
            $queryinsert="insert into produk values (".$idmerk.", ".$idjenis.", '".$lokasi."','".$namaproduk."',".$hargabeli.", ".$hargajual.",0,0);";
            pg_query($queryinsert);
        }

    }
     public function updateStokProduk($namaproduk, $jumlahkilo, $jumlahkarton, $lokasi){
        $queryprodukkilo="select kilo from produk where namaproduk ='".$namaproduk."'AND lokasi='".$lokasi."';";
        $queryprodukkarton="select karton from produk where namaproduk ='".$namaproduk."'AND lokasi='".$lokasi."';";
        $kilo = pg_fetch_array(pg_query($queryprodukkilo))[0];
        $karton = pg_fetch_array(pg_query($queryprodukkarton))[0];
        $currentkilo = pg_fetch_array(pg_query($queryprodukkilo))[0];
        $currentkarton = pg_fetch_array(pg_query($queryprodukkarton))[0];
        $updateKilo=$currentkilo + $jumlahkilo;
        $updateKarton=$currentkarton + $jumlahkarton;
        $queryupdatekilo="Update produk set kilo=".$updateKilo." where namaproduk='".$namaproduk."' AND lokasi='".$lokasi."';";
        $queryupdatekarton="Update produk set karton=".$updateKarton." where namaproduk='".$namaproduk."' AND lokasi='".$lokasi."';";
         pg_query($queryupdatekilo);
         pg_query($queryupdatekarton);
       }
    public function updateStokJenis($namaproduk, $jumlahkilo, $jumlahkarton){
        $queryidjenis="select idjenis from produk where namaproduk='".$namaproduk."';";
        $idjenis =pg_fetch_array(pg_query($queryidjenis))[0];
        $queryjeniskilo="select stok_kilo from jenis where idjenis ='".$idjenis."';";
        $queryjeniskarton="select stok_karton from jenis where idjenis ='".$idjenis."';";
        $currentkilo = pg_fetch_array(pg_query($queryjeniskilo))[0];
        $currentkarton = pg_fetch_array(pg_query($queryjeniskarton))[0];
        $updateKilo=$currentkilo + $jumlahkilo;
        $updateKarton=$currentkarton + $jumlahkarton;
        $queryupdatekilo="Update jenis set stok_kilo=".$updateKilo." where idjenis='".$idjenis."';";
        $queryupdatekarton="Update jenis set stok_karton=".$updateKarton." where idjenis='".$idjenis."';";
        pg_query($queryupdatekilo);
        pg_query($queryupdatekarton);
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
            $masukan = "INSERT INTO PEMBAYARAN_OUT VALUES ('".$IdBayar."', '".$supplier."', '".$tanggalbeli."', null, null, 'Hutang');";
            pg_query($masukan); 

        }   else {

            $IdBayar = $ambilIdBayar[0];
        }

        $querypembelian="Update Pembelian set idbayar='".$IdBayar."' where idbeli='".$idbeli."';";
        pg_query($querypembelian);
    }

    public function actionRecap(){
        $model = PembayaranOut::find()->all();
        echo SiteController::connect(); 
        $tgl_beli = date('Y-m-d');
               
        echo PembelianController::insertJumlahBayar($tgl_beli);

        $searchModel = new PembelianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
            
    }
    public function insertJumlahBayar($tanggalBeli){
        $queryTotalBayar = pg_query(("SELECT idbayar, SUM(harga_total) FROM PEMBELIAN WHERE tgl_beli = '".$tanggalBeli."' GROUP BY idbayar;"));
        //echo pg_num_rows($queryTotalBayar);
            
        while ($row = pg_fetch_row($queryTotalBayar)) {
            //echo $row[0];
            //echo $row[1];
            $update = "UPDATE PEMBAYARAN_OUT SET JumlahBayar = '".$row[1]."' WHERE IdBayar ='".$row[0]."';";
            $todb = pg_query($update);
        }
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

    public function actionConfirm($id)
    {
        //$model = $this->findModel($id);

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->idbeli]);
      
           echo SiteController::connect();
            
            //$ambilStatus = "SELECT status_del FROM pembelian WHERE idbeli = '".$id."';";
            $ubahStatus = "UPDATE PEMBELIAN SET status_del = 'Diterima' WHERE idbeli = '".$id."';";
            $masukin = pg_query($ubahStatus);


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
