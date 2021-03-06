<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $idcustomer
 * @property string $namacustomer
 * @property string $telponcustomer
 * @property string $alamatcustomer
 *
 * @property PembayaranIn[] $pembayaranIns
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propensi.customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcustomer','namacustomer','alamatcustomer','telponcustomer'], 'required'],
            [['idcustomer'], 'integer'],
            [['telponcustomer'],'string','max'=>50],
            [['telponcustomer'],'match', 'not' => true, 'pattern' => '/[^0-9]/', 'message' => 'Only number allowed'],
            [['namacustomer',  'alamatcustomer'], 'string', 'max' => 50],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcustomer' => Yii::t('app', 'Id'),
            'namacustomer' => Yii::t('app', 'Nama'),
            'telponcustomer' => Yii::t('app', 'Nomor Telepon'),
            'alamatcustomer' => Yii::t('app', 'Alamat'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembayaranIns()
    {
        return $this->hasMany(PembayaranIn::className(), ['customer' => 'namacustomer']);
    }
}
