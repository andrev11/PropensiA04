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
	public $password_field;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['username'], 'unique'],
            [['username','password_field', 'repeatpassword', 'role','nama'], 'required'],
            [['username', 'role'], 'string', 'max' => 25],
            [['password_field'], 'string', 'min' => 6],
            [['nama'], 'string', 'max' => 50],
            [['repeatpassword'], 'compare', 'compareAttribute' => 'password_field', 'message' => 'Your password doesnt match']
			
        ];
    }
	
	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function beforeSave($insert) {
		if(isset($this->password_field)) {
			$hash = Yii::$app->getSecurity()::generatePasswordHash($this->password_field);
			$this->password = $hash;
		} 
		
		return parent::beforeSave($insert);
	}
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'nama' => Yii::t('app', 'Nama'),
            'password_field' => Yii::t('app', 'Password'),
            'role' => Yii::t('app', 'Role'),
            'repeatpassword'=>  'Repeat Password'
        ];
    }
}
