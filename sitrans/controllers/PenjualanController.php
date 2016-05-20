<?php

namespace app\controllers;

use Yii;
use app\models\Penjualan;
use app\models\PenjualanSearch;
use yii\web\Controller;
use app\models\PembayaranIn;
use app\models\Lokasi;
use app\controllers\SiteController;
use app\controllers\PembayaranInController;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;

/**
 * PenjualanController implements the CRUD actions for Penjualan model.
 */
class PenjualanController extends Controller
{
    public function beforeAction($action)
        {
        if (Yii::$app->user->isGuest){
            return $this->redirect(Yii::$app->user->loginUrl);
        } else if (Yii::$app->user->identity->role == 'sales marketing' || Yii::$app->user->identity->role == 'admin inventori' || Yii::$app->user->identity->role == 'bod' || Yii::$app->user->identity->role =='finance') {
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
     * Lists all Penjualan models.
     * @return mixed
     */
    public function actionPrint()
    {  

        ini_set('memory_limit','3000M');//extending php memory
        $pdf=new mPDF('win-1252','A4-L','','',15,10,16,10,10,10);//A4 size page in landscape orientation
        date_default_timezone_set("Asia/Bangkok");
        $pdf->useOnlyCoreFonts = true;    // false is default
        $pdf->SetDisplayMode('fullpage');
       
        ob_start();

        if(Yii::$app->user->identity->role == 'finance'){
            include "../views/penjualan/_printFaktur.php";//The php page you want to convert to pdf
            $pdf->setFooter(date('H:i:s'));
        } else if (Yii::$app->user->identity->role == 'admin inventori'){
            include "../views/penjualan/_printSuratJalan.php";
            $pdf->setFooter(date('H:i:s'));
        } else if (Yii::$app->user->identity->role == 'sales marketing'){
			$pdf=new mPDF('win-1252','A4','','',15,10,16,10,10,10);
            include "../views/penjualan/_reportPenjualan.php";
            $pdf->SetHeader(date('H:i:s'));
            $pdf->setFooter('{PAGENO}');
        }

        $html = ob_get_contents();

        ob_end_clean();

        // send the captured HTML from the output buffer to the mPDF class for processing

        $pdf->WriteHTML($html);
        //$mpdf->SetProtection(array(), 'mawiahl', 'password');//for password protecting your pdf

            // return the pdf output as per the destination setting
             $pdf->Output(); 
    }

    public function actionIndex()
    {
        $searchModel = new PenjualanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider ->setSort([
            'defaultOrder' => ['tgl_jual'=>SORT_DESC],
            ]);


        if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'sales marketing'){
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

        $jual = Penjualan::find()
            ->where("status_del= 'Belum Dikirim'")
            ->orderBy(['tgl_kirim' => SORT_ASC])
            ->all();
        
        if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin inventori'){
            return $this->render('index2', [
                'jual' => $jual,
            ]);
        } else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }

    public function actionIndex3()
    {
        if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'bod'){
            return $this->render('index3');
        } else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }
    public function actionIndex4() {
    
        $searchModel = new PenjualanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider ->setSort([
            'defaultOrder' => ['tgl_jual'=>SORT_DESC],
            ]);

        if (!\Yii::$app->user->isGuest && ( Yii::$app->user->identity->role =='finance' || Yii::$app->user->identity->role == 'admin inventori')) {
            return $this->render('index4', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }
    public function actionIndex5()
    {

        $jual = Penjualan::find()
            ->where("status_del= 'Belum Dikirim'")
            ->orderBy(['tgl_kirim' => SORT_ASC])
            ->all();
        
        if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'sales marketing'){
            return $this->render('index5', [
                'jual' => $jual,
            ]);
        } else {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
    }
    public function actionConfirm($idbayar)
    { 
            echo SiteController::connect();
            $tglkirim = Yii::$app->request->get('tgl_kirim');
            $ubahStatus = "UPDATE PENJUALAN SET status_del = 'Dikirim' WHERE idbayar = '".$idbayar."' and tgl_kirim='".$tglkirim."';";
            $masukin = pg_query($ubahStatus);
            echo PenjualanController::actionIndex2();
                /***return $this->render('view', [
                        'model' => $this->findModel($idbayar,$tglkirim),
                    ]); **/
    }

    /**
     * Displays a single Penjualan model.
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
     * Creates a new Penjualan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penjualan();
        echo SiteController::connect(); 
        $increments = pg_fetch_array(pg_query("select max(idjual) from penjualan;"));
        $id=$increments[0] + 1 ;  
        $model->idjual=$id;
        $model->tgl_jual = date('Y-m-d');
        $model->status_del="Belum Dikirim";

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $customer=$model->customer;
            $tgljual=$model->tgl_jual;
            $idjual = $model->idjual;
            $lokasi = $model->lokasi;
            echo PenjualanController::insertIdBayar($customer, $tgljual,$idjual);           
            $jumlahkilo=$model->kilo;
            $jumlahkarton=$model->karton;
            $namaproduk=$model->produk;

            echo PembelianController::checkLokasiProduk($namaproduk,$lokasi);
            echo PenjualanController::insertTotalPrice($jumlahkilo, $namaproduk, $idjual);
            echo PenjualanController::updateStokProduk($namaproduk, $jumlahkilo, $jumlahkarton,$lokasi); //ga pake lokasi
            echo PenjualanController::updateStokJenis($namaproduk, $jumlahkilo, $jumlahkarton);
            return $this->redirect(['view', 'id' => $model->idjual]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
 
    public function updateStokProduk($namaproduk, $jumlahkilo, $jumlahkarton, $lokasi){
        $queryprodukkilo="select kilo from produk where namaproduk ='".$namaproduk."' and lokasi='".$lokasi."';";
        $queryprodukkarton="select karton from produk where namaproduk ='".$namaproduk."' and lokasi='".$lokasi."';";
        $kilo = pg_fetch_array(pg_query($queryprodukkilo))[0];
        $karton = pg_fetch_array(pg_query($queryprodukkarton))[0];
        $currentkilo = pg_fetch_array(pg_query($queryprodukkilo))[0];
        $currentkarton = pg_fetch_array(pg_query($queryprodukkarton))[0];
        $updateKilo=$currentkilo - $jumlahkilo;
        $updateKarton=$currentkarton - $jumlahkarton;
        $queryupdatekilo="Update produk set kilo=".$updateKilo." where namaproduk='".$namaproduk."' and lokasi='".$lokasi."';"; 
        $queryupdatekarton="Update produk set karton=".$updateKarton." where namaproduk='".$namaproduk."' and lokasi='".$lokasi."';";
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
        $updateKilo=$currentkilo - $jumlahkilo;
        $updateKarton=$currentkarton - $jumlahkarton;
        $queryupdatekilo="Update jenis set stok_kilo=".$updateKilo." where idjenis='".$idjenis."';";
        $queryupdatekarton="Update jenis set stok_karton=".$updateKarton." where idjenis='".$idjenis."';";
        pg_query($queryupdatekilo);
        pg_query($queryupdatekarton);
     }

    public function insertIdBayar($customer, $tanggaljual, $idjual){
        $querypembayaranin = "select idbayar from pembayaran_in where customer='".$customer."' AND tgl_trans = '".$tanggaljual."';";
        $ambilIdBayar = pg_fetch_array(pg_query($querypembayaranin));
        $IdBayar;
        if(pg_num_rows(pg_query($querypembayaranin)) ==0){
            $increments = pg_fetch_array(pg_query("select max(idbayar) from pembayaran_in;"));
            $IdBayar =$increments[0] +1;
            $masukan = "INSERT INTO PEMBAYARAN_IN VALUES ('".$IdBayar."', '".$customer."', '".$tanggaljual."', null, null, 'Piutang');";
            pg_query($masukan); 

        }   else {

            $IdBayar = $ambilIdBayar[0];
        }

        $querypenjualan="Update Penjualan set idbayar='".$IdBayar."' where idjual='".$idjual."';";
        pg_query($querypenjualan);
    }

    // untuk total harga pembelian
    public function insertTotalPrice($jumlahkilo, $namaproduk, $idjual){
        $queryproduk="select harga_jual from produk where namaproduk='".$namaproduk."';";
        $hargajual = pg_fetch_array(pg_query($queryproduk))[0];
        $hargatotal= $jumlahkilo * $hargajual;
        $queryhargatotal ="Update penjualan set harga_total=".$hargatotal." where idjual=".$idjual.";";
        pg_query($queryhargatotal); 
    }

    public function insertJumlahBayar($tanggalJual){
        $queryTotalBayar = pg_query(("SELECT idbayar, SUM(harga_total) FROM PENJUALAN WHERE tgl_jual = '".$tanggalJual."' GROUP BY idbayar;"));
        //echo pg_num_rows($queryTotalBayar);
            
        while ($row = pg_fetch_row($queryTotalBayar)) {
            //echo $row[0];
            //echo $row[1];
            $update = "UPDATE PEMBAYARAN_IN SET JumlahBayar = '".$row[1]."' WHERE IdBayar ='".$row[0]."';";
            $todb = pg_query($update);
        }
    }

    public function actionRecap(){
        $model = PembayaranIn::find()->all();
        echo SiteController::connect(); 
        $tgl_jual = date('Y-m-d');
               
        echo PenjualanController::insertJumlahBayar($tgl_jual);

        $searchModel = new PenjualanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
            
    }

    /**
     * Updates an existing Penjualan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idjual]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Penjualan model.
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
     * Finds the Penjualan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penjualan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penjualan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
