<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produk".
 *
 * @property integer $idmerk
 * @property integer $idjenis
 * @property string $lokasi
 * @property string $namaproduk
 * @property integer $harga_beli
 * @property integer $harga_jual
 * @property string $kilo
 * @property string $karton
 *
 * @property Pembelian[] $pembelians
 * @property Penjualan[] $penjualans
 * @property Jenis $idjenis0
 * @property Merk $idmerk0
 */
class Produk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propensi.produk';
    }

    /**
     * @inheritdoc
     */
    public $newstokkilo;
    public $newstokkarton;
    public function rules()
    {
        return [
            [['idmerk', 'idjenis', 'lokasi', 'namaproduk','harga_beli'], 'required'],
	     [['idmerk', 'idjenis', 'lokasi', 'namaproduk'], 'unique', 'targetAttribute' => ['idmerk', 'idjenis', 'lokasi', 'namaproduk']],
            [['idmerk', 'idjenis', 'harga_beli', 'harga_jual'], 'integer'],
            [['newstokkilo', 'newstokkarton'], 'required', 'on' => 'update'], 
            [['kilo', 'karton'], 'number','min'=>0],
            [['lokasi'], 'string', 'max' => 25],
            [['namaproduk'], 'string', 'max' => 50],
            [['namaproduk'],'match', 'not' => true, 'pattern' => '/[^a-zA-Z_ .0-9]/', 'message' => 'Invalid characters in nama produk'],
            [['newstokkilo'], 'number','min'=>0],
	     [['newstokkarton'],'integer','min'=>0], 
            [['newstokkilo'],'compare', 'compareAttribute' => 'kilo', 'operator'=>'<', 'message' => 'Updated Stok Kilo must be less than current Stok Kilo'], 
            [['newstokkilo'],'setkilo'],
            [['newstokkarton'],'compare', 'compareAttribute' => 'karton', 'operator'=>'<', 'message' => 'Updated Stok Karton must be less than current Stok Karton'], 
            [['newstokkarton'],'setkarton'],
            [['harga_jual'], 'required', 'on'=>'update2'],
		[['harga_jual', 'harga_beli'], 'integer','min'=>0],

       ];
    }

    public function setkilo($insert){
        if(isset($this->newstokkilo)){ 
            if($this->kilo < $this->newstokkilo){
                echo 'Updated Stok Kilo must be less than current Stok Kilo';
            } else {
                $this->kilo=$this->newstokkilo;
            }
        }
        //return parent::setkilo($insert);
    }

     public function setkarton($insert){
        if(isset($this->newstokkarton)){
               if($this->karton < $this->newstokkarton){
                echo 'Updated Stok Karton must be less than current Stok Karton';
            } else {
                $this->karton=$this->newstokkarton;
            }
        }
        //return parent::setkarton($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmerk' => Yii::t('app', 'Merk'),
            'idjenis' => Yii::t('app', 'Jenis'),
            'lokasi' => Yii::t('app', 'Lokasi'),
            'namaproduk' => Yii::t('app', 'Nama Produk'),
            'harga_beli' => Yii::t('app', 'Harga Beli'),
            'harga_jual' => Yii::t('app', 'Harga Jual'),
            'kilo' => Yii::t('app', 'Stok Kilo'),
            'karton' => Yii::t('app', 'Stok Karton'),
            'newstokkilo'=> ('New Stok Kilo'),
            'newstokkarton'=> ('New Stok Karton'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelians()
    {
        return $this->hasMany(Pembelian::className(), ['produk' => 'namaproduk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenjualans()
    {
        return $this->hasMany(Penjualan::className(), ['produk' => 'namaproduk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdjenis0()
    {
        return $this->hasOne(Jenis::className(), ['idjenis' => 'idjenis']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdmerk0()
    {
        return $this->hasOne(Merk::className(), ['idmerk' => 'idmerk']);
    }
}
