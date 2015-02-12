<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class UserRole extends \yii\db\ActiveRecord{
    
    
    public static function tableName(){
        return '{{%auth_assignment}}';
    }
    
    public function rules(){
        return [
            [['cellphone', 'gender'], 'required', 'on'=>'editProfile'],
        ];
    }
    
    public function scenarios() {
        return [
            'default'=> ['bday', 'marital_status', 'location', 'web_page', 'gender', 'cellphone'],
        ];
    }
    
    
    
    
    
}





