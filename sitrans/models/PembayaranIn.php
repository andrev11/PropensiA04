<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembayaran_in".
 *
 * @property integer $idbayar
 * @property string $customer
 * @property string $tgl_trans
 * @property string $tgl_bayar
 * @property string $jumlahbayar
 * @property string $status_bayar
 *
 * @property Penjualan[] $penjualans
 */
class PembayaranIn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pembayaran_in';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idbayar'], 'required'],
            [['idbayar'], 'integer'],
            [['tgl_trans', 'tgl_bayar'], 'safe'],
            [['jumlahbayar'], 'number'],
            [['customer'], 'string', 'max' => 50],
            [['status_bayar'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idbayar' => Yii::t('app', 'Idbayar'),
            'customer' => Yii::t('app', 'Customer'),
            'tgl_trans' => Yii::t('app', 'Tgl Trans'),
            'tgl_bayar' => Yii::t('app', 'Tgl Bayar'),
            'jumlahbayar' => Yii::t('app', 'Jumlahbayar'),
            'status_bayar' => Yii::t('app', 'Status Bayar'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenjualans()
    {
        return $this->hasMany(Penjualan::className(), ['idbayar' => 'idbayar']);
    }
}
