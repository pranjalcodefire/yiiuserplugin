<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\Url;
use components\MessageComponent;
use common\models\AuthItem;



class GroupPermissionController extends Controller{
    
    
    #################################### CONTROLLER BASE ####################################
    
    
    #################################### CONTROLLER BASE ####################################
    
    
    
    
    #################################### ADMIN FUNCTIONS ####################################
    
    /**
     * To get log in the user
     * @return : to home url (the logged in user)
     */
    public function actionIndex()
    {
		$AuthItemAction = AuthItem::find()->where(['type' => 2])->andWhere('name like :name or name like :name1 or name like :name2',[':name'=>"common%", ':name1'=>"frontend%", ':name2'=>"backend%"])->asArray()->all();
		$AuthItemRole = AuthItem::find()->where(['type' => 1])->asArray()->all();
		$usersRole = array();
		foreach($AuthItemRole as $key=>$value){
			$usersRole[$value['name']] = $value['name'];
		}
		return $this->render('index', ['allAuthItem'=>$AuthItemAction, 'usersRole'=>$usersRole]);
    }
    
    public function actionLoad(){
		$base_path = 'C:\wamp\www\yii_feb\yiiuserplugin';
		$fileType = 'Controller.php';
		$baseController = 'yii\web\Controller';
		$dirName = array('common', 'backend', 'frontend');
		$cList = array();
		$allFunctionList = array();
		foreach($dirName as $key=>$value){
			if(file_exists($base_path.'\\'.$value.'\controllers')){
				$cList[$value] = scandir($base_path.'\\'.$value.'\controllers');
			}
		}
		$parentMethodList = get_class_methods($baseController);
		$actionList  = array();
		$i = 0;
		foreach($cList as $key=>$value){
			if($value){
				foreach($value as $key1=>$value1){
					if(substr($value1, -14) == $fileType){
						$value1 = substr($value1, 0, -4);
						$classFullName = $key.'\controllers\\'.$value1;
						$controllerName = substr($value1, 0, -10);
						$currentList = get_class_methods($classFullName);
						$newList = array_diff($currentList, $parentMethodList);
						$methodList = array();
						foreach($newList as $key2=>$value2){
							$methodList[] = substr($value2, 6);
							$allFunctionList[$i]['name'] = $key.':'.$controllerName.':'.substr($value2, 6);
							$allFunctionList[$i]['type'] = 2;
							$allFunctionList[$i]['description'] = 'Allow call to '.$controllerName.' '.substr($value2, 6).'';
							$i++;
						}
						$actionList[$key][$controllerName] = $methodList;
					}
				}
			}
		}
		foreach($allFunctionList as $key=>$value){
			$AuthItem = AuthItem::findOne(['name' => $value['name']]);
			if(!$AuthItem){
				$AuthItem = new AuthItem();
				$AuthItem->name = $value['name'];
				$AuthItem->type = 2;
				$AuthItem->description = $value['description'];
				$AuthItem->save();
			}
		}
		return $this->render('groupPermission', ['allFunctionList' => $allFunctionList]);
	}
}

