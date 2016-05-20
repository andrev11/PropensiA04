<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "caraterima".
 *
 * @property integer $id
 * @property string $caraterima
 */
class Caraterima extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propensi.caraterima';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['caraterima'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'caraterima' => Yii::t('app', 'Caraterima'),
        ];
    }
}
