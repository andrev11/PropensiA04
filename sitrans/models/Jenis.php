<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis".
 *
 * @property integer $idjenis
 * @property string $namajenis
 * @property integer $rop
 * @property string $stok_kilo
 * @property string $stok_karton
 *
 * @property Produk[] $produks
 */
class Jenis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenis';
    }
    public $newrop;

    public function updateROP($insert){
       if(isset($this->newrop)){
           $this->rop = $this->newrop;
       }
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjenis','namajenis','rop'], 'required'],
            [['newrop'], 'required', 'on'=>'update'],
            [['idjenis', 'rop','newrop'], 'integer','min' => 0],
            [['stok_kilo', 'stok_karton'], 'number'],
            [['namajenis'], 'string', 'max' => 50],
            [['namajenis'], 'match', 'not' => true, 'pattern' => '/[^a-zA-Z ]/', 'message' => 'Only letters allowed'],
            [['namajenis'], 'unique'],
            [['newrop'], 'updateROP']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idjenis' => Yii::t('app', 'Id'),
            'namajenis' => Yii::t('app', 'Nama Jenis'),
            'rop' => Yii::t('app', 'ROP (kg)'),
            'stok_kilo' => Yii::t('app', 'Stok Kilo '),
            'stok_karton' => Yii::t('app', 'Stok Karton'),
            'newrop' => ('New ROP (kg)')        
            ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduks()
    {
        return $this->hasMany(Produk::className(), ['idjenis' => 'idjenis']);
    }
}
