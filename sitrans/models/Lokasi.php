<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lokasi".
 *
 * @property integer $id
 * @property string $lokasi
 */
class Lokasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propensi.lokasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['lokasi'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lokasi' => Yii::t('app', 'Lokasi'),
        ];
    }
}
