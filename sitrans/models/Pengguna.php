<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

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
	
	public $passwordlama;
    public $repeatpassword;
	public $password_field;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {	
        return [
			[['username'], 'unique'],
            [['username', 'role','nama'], 'required'],
			[['password_field', 'repeatpassword'], 'required', 'on' => 'update'],
			[['password_field', 'repeatpassword'], 'required', 'on' => 'create'],
            [['username', 'role'], 'string', 'max' => 25],
            [['username'],'match', 'not' => true, 'pattern' => '/[^a-zA-Z_0-9]/', 'message' => 'Invalid characters in username'],
            [['password_field'],'match', 'not' => true, 'pattern' => '/[^a-zA-Z_0-9]/', 'message' => 'Invalid characters in password'],
            [['password_field'], 'string', 'min' => 6],
            [['nama'], 'string', 'max' => 50],
            [['nama'],'match', 'not' => true, 'pattern' => '/[^a-zA-Z ]/', 'message' => 'Only letters allowed'],
            [['repeatpassword'], 'compare', 'compareAttribute' => 'password_field', 'message' => 'Your password doesnt match'],
			[['passwordlama'], 'findPasswords', 'on' => 'update'],
			[['passwordlama'], 'required', 'on' => 'update'],
			['password_field', 'compare', 'compareAttribute' => 'passwordlama', 'operator' => '!=']
        ];
    }
	
	public function findPasswords($attribute, $params){
		
		$this->scenario = 'update';
		
        $user = Pengguna::find()->where(['username'=>Yii::$app->user->identity->username])->one();
		$password = $user->password;
		//$user->password == Yii::$app->getSecurity()->validatePassword($password, $this->password);

        if(!Yii::$app->getSecurity()->validatePassword($this->passwordlama, $user->password))
            $this->addError($attribute,'Your old password doesnt match');
    }
	
	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function beforeSave($insert) { 
		if(isset($this->password_field)) {
			$hash = Yii::$app->getSecurity()->generatePasswordHash($this->password_field);
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
            'repeatpassword'=>  'Repeat Password',
			'passwordlama' => ('Old Password')
        ];
    }
}
