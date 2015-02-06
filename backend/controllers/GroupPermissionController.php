<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\Url;
use components\MessageComponent;
use common\models\AuthItem;
use common\models\AuthItemChild;



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
		if(!empty($_POST['permission'])){
			echo '<pre>';
			print_r($_POST);
			
			$mainChild = array();
			$mainChild = $_POST['permission_child'];
			$mainChildarray = array();
			if($mainChild){
				$i = 0;
				foreach($mainChild as $key=>$value){
						$mainChildarray[$i]['parent'] = $_POST['permission'];
						$mainChildarray[$i]['child'] = $value;
						$i++;
				}
			}
			$queryData2 = AuthItemChild::find()->where(['parent'=>$_POST['permission_child']])->asArray()->all();
			$childchildAction = array();
			if($queryData2){
				foreach($queryData2 as $key=>$value){
					$childchildAction[] = $value['child'];
				}
			}
			$possibleChild = array_keys($_POST);
			$mainChildAction = array();
			$j = 0;
			foreach($possibleChild as $key=>$value){
				if (strpos($value,':') !== false) {
					if(!in_array($value, $childchildAction)){
						$mainChildAction[$j]['parent'] = $_POST['permission'];
						$mainChildAction[$j]['child'] = $value;
						$j++;
					}
				}
			}
			AuthItemChild::deleteAll('parent = :parent', [':parent' => $_POST['permission']]);
			Yii::$app->db->createCommand()->batchInsert('auth_item_child', ['parent', 'child'], $mainChildarray)->execute();
			Yii::$app->db->createCommand()->batchInsert('auth_item_child', ['parent', 'child'], $mainChildAction)->execute();
			$this->redirect(Url::to(['group-permission/index']));
		}
		$AuthItemAction = AuthItem::find()->where(['type' => 2])->andWhere('name like :name or name like :name1 or name like :name2',[':name'=>"common%", ':name1'=>"frontend%", ':name2'=>"backend%"])->asArray()->all();
		$AuthItemRole = AuthItem::find()->where(['type' => 1])->asArray()->all();
		$usersRole = array();
		$usersRole[0] = 'Please Select';
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
	
	#################################### AJAX FUNCTIONS ####################################
	
	public function actionGetChildRole(){
		$this->layout = false;
		if(Yii::$app->request->isAjax){
            $queryData = AuthItem::find()->where(['type' => 1])->andWhere('name != :name', ['name'=>$_POST['id']])->asArray()->all();
			$queryData1 = AuthItemChild::find()->where(['parent' => $_POST['id']])->asArray()->all();
			$roleChild = array();
			if($queryData){
				$AuthItemRole = array();
				foreach($queryData as $key=>$value){
					$AuthItemRole[$value['name']] = $value['name'];
				}
				if($queryData1){
					foreach($queryData1 as $key=>$value){
						if(in_array($value['child'], $AuthItemRole)){
							$roleChild[] = $value['child'];
						}
					}
				}
				return $this->render('role-selected', ['AuthItemRole' => $AuthItemRole, 'roleChild'=>$roleChild]);
			}
        }
	}
	
	public function actionGetRolePermission(){
		$this->layout = false;
		if(Yii::$app->request->isAjax){
            $AuthItemAction = AuthItem::find()->where(['type' => 2])->andWhere('name like :name or name like :name1 or name like :name2',[':name'=>"common%", ':name1'=>"frontend%", ':name2'=>"backend%"])->asArray()->all();
			$queryData = AuthItem::find()->where(['type' => 1])->andWhere('name != :name', ['name'=>$_POST['id']])->asArray()->all();
			$queryData1 = AuthItemChild::find()->where(['parent' => $_POST['id']])->asArray()->all();
			$roleChild = array();
			$mainChildAction = array();
			$childChildAction = array();
			if($queryData){
				$AuthItemRole = array();
				foreach($queryData as $key=>$value){
					$AuthItemRole[$value['name']] = $value['name'];
				}
				if($queryData1){
					foreach($queryData1 as $key=>$value){
						if(in_array($value['child'], $AuthItemRole)){
							$roleChild[] = $value['child'];
						}else{
							$mainChildAction[] = $value['child'];
						}
					}
				}
			}
			if($roleChild || !empty($_POST['child'])){
				if(!empty($_POST['child'])){
					$roleChild = explode(',', $_POST['child']);
				}
				$queryData2 = AuthItemChild::find()->where(['parent'=>$roleChild])->asArray()->all();
				if($queryData2){
					foreach($queryData2 as $key=>$value){
						// if (strpos($value['child'],':') !== false) {
							// $newVal = explode(':', $value['child']);
							// $value['child'] = $newVal[2];
						// }
						$childChildAction[] = $value['child'];
					}
				}
			}
			return $this->render('role-permission', ['allAuthItem' => $AuthItemAction, 'childChildAction'=>$childChildAction, 'mainChildAction'=>$mainChildAction]);
        }
	}
}

