<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "merk".
 *
 * @property integer $idmerk
 * @property integer $idsupplier
 * @property string $namasupplier
 * @property string $status
 *
 * @property Supplier $idsupplier0
 * @property Produk[] $produks
 */
class Merk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propensi.merk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idmerk', 'idsupplier','namasupplier'], 'required'],
            [['idmerk', 'idsupplier'], 'integer'],
            [['namasupplier'], 'string', 'max' => 50],
            [['namasupplier'],'match', 'not' => true, 'pattern' => '/[^a-zA-Z_ .0-9]/', 'message' => 'Invalid characters in nama merk'],
            [['status'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmerk' => Yii::t('app', 'Id Merk'),
            'idsupplier' => Yii::t('app', 'Supplier'),
            'namasupplier' => Yii::t('app', 'Nama Merk'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getSupplierName() {
        return $this->supplier->name;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdsupplier0()
    {
        return $this->hasOne(Supplier::className(), ['idsupplier' => 'idsupplier']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduks()
    {
        return $this->hasMany(Produk::className(), ['idmerk' => 'idmerk', 'idsupplier' => 'idsupplier']);
    }
}