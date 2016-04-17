<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembelian".
 *
 * @property integer $idbeli
 * @property integer $idbayar
 * @property string $supplier
 * @property string $produk
 * @property string $tgl_beli
 * @property string $tgl_terima
 * @property string $cara_terima
 * @property string $cara_bayar
 * @property string $status_del
 * @property string $harga_total
 * @property string $karton
 * @property string $kilo
 *
 * @property PembayaranOut $idbayar0
 */
class Pembelian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pembelian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idbeli'], 'required'],
            [['idbeli', 'idbayar'], 'integer'],
            [['tgl_beli', 'tgl_terima'], 'safe'],
            [['harga_total'], 'number'],
            [[ 'kilo'],'number', 'min'=>0],
            [[ 'karton'],'integer', 'min'=>0],
            [['supplier', 'produk'], 'string', 'max' => 50],
            [['cara_terima', 'cara_bayar', 'status_del'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'idbeli' => 'Id beli',
            //'idbayar' => 'Id bayar',
            'produk' => 'Produk',
            'tgl_beli' => 'Tanggal Beli',
            'tgl_terima' => 'Tanggal Terima',
            'cara_terima' => 'Cara Terima',
            'cara_bayar' => 'Cara Bayar',
            'status_del' => 'Status Delivery',
            'harga_total' => 'Harga Total',
            'karton' => 'Jumlah Karton',
            'kilo' => 'Jumlah Kilo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdbayar0()
    {
        return $this->hasOne(PembayaranOut::className(), ['idbayar' => 'idbayar']);
    }
}
