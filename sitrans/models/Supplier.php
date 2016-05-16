<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $idsupplier
 * @property string $namasupplier
 * @property string $telponsupplier
 * @property string $alamatsupplier
 * @property string $no_rekening
 *
 * @property Merk[] $merks
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsupplier','namasupplier','telponsupplier','alamatsupplier'], 'required'],
            [['idsupplier'], 'integer'],
            [['namasupplier'], 'string', 'max' => 50],
            [['telponsupplier', 'no_rekening'],'string', 'max'=>50],
            [['telponsupplier','no_rekening'],'match', 'not' => true, 'pattern' => '/[^0-9]/', 'message' => 'Only number allowed'],
            [['namasupplier'], 'unique'],
            [['alamatsupplier'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsupplier' => Yii::t('app', 'Id Supplier'),
            'namasupplier' => Yii::t('app', 'Nama'),
            'telponsupplier' => Yii::t('app', 'Telpon'),
            'alamatsupplier' => Yii::t('app', 'Alamat'),
            'no_rekening' => Yii::t('app', 'No Rekening'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerks()
    {
        return $this->hasMany(Merk::className(), ['idsupplier' => 'idsupplier']);
    }
}
