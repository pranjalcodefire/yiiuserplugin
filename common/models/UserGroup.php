<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class UserGroup extends \yii\db\ActiveRecord{
    
    public static function tableName(){
        return '{{%auth_item}}';
    }
    
    public function rules(){
        return [
            [['name'], 'required', 'on'=>'userGroup'],
            ['name', 'unique', 'targetClass' => '\common\models\UserGroup', 'message' => 'Role name already exists', 'on'=>'userGroup'],
        ];
    }
    
    public function scenarios() {
        return [
            //'default'=> ['bday', 'marital_status', 'location', 'web_page', 'gender', 'cellphone'],
            'userGroup'=> ['name'],
            
            'register'=> ['user_id'],   //For Guest User registration
            
            
            'addUser'=>['user_id'],     //For Admin User registration
            'editUser'=>['bday', 'marital_status', 'location', 'web_page', 'gender', 'cellphone'],     //For Admin User registration
        ];
    }
    
    /**
     * To specify the behaviors to use for this model
     * @return : behaviors to use for this model 
     */
    public function behaviors() 
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    
}





