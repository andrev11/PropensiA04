<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carakirim".
 *
 * @property integer $id
 * @property string $carakirim
 */
class Carakirim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carakirim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['carakirim'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'carakirim' => Yii::t('app', 'Carakirim'),
        ];
    }
}
