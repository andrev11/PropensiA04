<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengguna".
 *
 * @property string $username
 * @property string $nama
 * @property string $password
 * @property string $role
 */
class Pengguna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengguna';
    }
    public $repeatpassword;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','password', 'role','nama'], 'required'],
            [['username', 'password', 'role'], 'string', 'max' => 25],
            [['nama'], 'string', 'max' => 50],
            [['repeatpassword'], 'compare', 'compareAttribute' => 'password','message' => 'Your password doesnt match']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'nama' => Yii::t('app', 'Nama'),
            'password' => Yii::t('app', 'Password'),
            'role' => Yii::t('app', 'Role'),
            'repeatpassword'=>  'Repeat Password'
        ];
    }
}
