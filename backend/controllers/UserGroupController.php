<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\Url;

/******Models we goona use in this controller*****/
use common\models\UserGroup;


class UserGroupController extends Controller{
    
    #################################### CONTROLLER BASE ####################################
    
    
    #################################### CONTROLLER BASE ####################################
    
    
    
    
    #################################### ADMIN FUNCTIONS ####################################
    
    /*
     * To show all the records (Users) listing
     * return the view of listing of records (Users)
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest){
            $results = UserGroup::find()->onCondition(['type'=>'1'])->orderBy('name')->all();   //Type 1 is for Role 
            //$pagination = new Pagination(['defaultPageSize'=>DEFAULT_PAGE_SIZE, 'totalCount'=> $results->count()]);
            //$results = $results->offset($pagination->offset)->limit($pagination->limit)->orderBy('name')->all();
            return $this->render('index', ['results'=>$results]); //'pagination'=>$pagination]
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be logged in to perform any private operation', true);
            $this->redirect(Url::to(['user/login']));
        }    
    }
    
    /**
     * To add a record into the model (User)
     * @return : view of add record (User) form
     */
    public function actionSave()
    {
        if(!Yii::$app->user->isGuest){
            $model = new \common\models\UserGroup;
            $model->scenario = 'userGroup';
            if($model->load(Yii::$app->request->post())){
                $model->type = 1; // type 1 is for Role
                if($model->validate()){
                    $model->save(false) ? Yii::$app->session->setFlash('success', 'You have been registered successfully', true) : Yii::$app->session->setFlash('danger', 'Your registration was not successful.', true);
                    return $this->refresh();
                }    
            }
            return $this->render('save', ['model'=>$model]);
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be logged in to perform any private operation', true);
            $this->redirect(Url::to(['user/login']));
        }    
    }
    
    /**
     * To see the particular record information (User Profile)
     * @param type $id : record id to fetch the particular user Profile Detail (user_id)
     * @return : view of record information (User Profile)
     */
    public function actionView($id = NULL)
    {
        if(!Yii::$app->user->isGuest){
            $model = UserGroup::findOne($id);
            if(isset($model) && !empty($model)){
                return $this->render('view', ['model'=>$model]);
            }else{
                Yii::$app->session->setFlash("danger", 'Invalid Group or group does not exist', true);
                return $this->redirect(Url::to(['user-group/index']));
            }
        }
    }
    
    /**
     * To edit the record information (User Profile)
     * @param long $id : To get the particular user's id
     * @return : the view of edit User form
     */
    public function actionEdit($id = NULL)
    {
        if(!Yii::$app->user->isGuest){
            $model = UserGroup::findOne($id);
            if(isset($model) && !empty($model)){
                $model->scenario = 'userGroup';
                if($model->load(Yii::$app->request->post()) && $model->update(true)){
                    Yii::$app->session->setFlash("success", 'User Group has been updated successfully', true);
                    return $this->refresh();
                }else{
                    return $this->render('edit', ['model'=>$model]);
                }    
            }else{
                Yii::$app->session->setFlash("danger", 'Invalid User', true);
                return $this->redirect(Url::to(['user/index']));
            }
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be looged in to perform any private operation', true);
            return $this->redirect(Url::to(['user/index']));
        }
    }
    
    #################################### ADMIN FUNCTIONS ####################################
    
    
    
    
    
    #################################### AJAX FUNCTIONS ####################################
    
    public function actionDelete()
    {
        if(Yii::$app->request->isAjax){
            $id = $_POST['id'];
            $model = UserGroup::findOne($_POST['id']);
            if(isset($model) && !empty($model)){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ($model->delete($id)) ? ['status'=>'success', 'recordDeleted'=>DELETED] : ['status'=>'failure'];
            }    
        }
    }
    
    
    #################################### AJAX FUNCTIONS ####################################
    
    
}
    

