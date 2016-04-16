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
            [['harga_total', 'karton', 'kilo'], 'number'],
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
            'idbeli' => Yii::t('app', 'Idbeli'),
            'idbayar' => Yii::t('app', 'Idbayar'),
            'supplier' => Yii::t('app', 'Supplier'),
            'produk' => Yii::t('app', 'Produk'),
            'tgl_beli' => Yii::t('app', 'Tgl Beli'),
            'tgl_terima' => Yii::t('app', 'Tgl Terima'),
            'cara_terima' => Yii::t('app', 'Cara Terima'),
            'cara_bayar' => Yii::t('app', 'Cara Bayar'),
            'status_del' => Yii::t('app', 'Status Del'),
            'harga_total' => Yii::t('app', 'Harga Total'),
            'karton' => Yii::t('app', 'Karton'),
            'kilo' => Yii::t('app', 'Kilo'),
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
