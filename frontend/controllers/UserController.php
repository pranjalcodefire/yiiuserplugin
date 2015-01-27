<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
//use yii\data\Pagination;
use yii\helpers\Url;

######## Model we gonna use for this controller #########
use common\models\User;
use common\models\UserDetail;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\web\UploadedFile;

class UserController extends Controller{
    
    #################################### CONTROLLER BASE ####################################
    
    //public $defaultAction = 'dashboard';
    
    
    /**
     * To specify the behaviors to use for this model
     * @return : behaviors to use for this controller
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=> \yii\filters\AccessControl::className(),
                'only'=>['logout', 'register', 'index'],
                'rules'=>[
                    [
                        'actions'=>['register'],
                        'allow'=>true,
                        'roles'=>['?'],
                    ],
                    [
                        'actions'=>['logout', 'dashboard', 'index'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ],
            ],
            
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    #################################### CONTROLLER BASE ####################################
    
    
    
    
    #################################### USER FUNCTIONS ####################################
    
    /**
     * To get log in the user
     * 
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * To get log out the user
     * 
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        $model->scenario = 'requestPasswordReset';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', ['model' => $model,]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    public function actionIndex()
    {
        Yii::$app->user->isGuest ? $this->redirect(Url::to(['user/login'])) : $this->redirect(Url::to(['user/dashboard']));
    }
    
    /**
     * To register a guest
     * @return : view of registration form
     */
    public function actionRegister()
    {
        $model = new User;
        $modelUser = new UserDetail;
        $model->scenario = 'register';
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $model->auth_key = User::generateNewAuthKey();
                $model->password_hash = User::setNewPassword($model->password);
                if($model->save(false)){
                    $modelUser->user_id = $model->id;
                    $modelUser->save(false) ? Yii::$app->session->setFlash('success', 'You have been registered successfully') : Yii::$app->session->setFlash('success', 'Your registration was not successful.');
                    return $this->refresh();
                }
            }
        }
        return $this->render('register', ['model'=>$model]);
    }
    
    /**
     * To show the dashboard options for the currently logged in user
     * @return : view for the dashboard of the currently logged in user
     */
    public function actionDashboard()
    {
        if(!Yii::$app->user->isGuest){
                $model = Yii::$app->user->getIdentity();
                return $this->render('dashboard', ['model'=>$model]);
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be logged in to perform any private operation', true);
            $this->redirect(Url::to(['user/login']));
        }  
    }
    
    /**
     * To show the currently logged in user's profile view
     * @return : view for the currently logged in user profile
     */
    public function actionMyProfile()
    {
        if(!Yii::$app->user->isGuest){
            $user_id = Yii::$app->user->getId();
            $model = User::find()->innerJoinWith('userDetail')->onCondition(['users.id'=>$user_id])->one();
            if(isset($model) && !empty($model)){
                $genderOptions = User::findGenderOptions();
                $maritalOptions = User::findMaritalStatusOptions();
                return $this->render('my-profile', ['model'=>$model, 'genderOptions'=>$genderOptions, 'maritalOptions'=>$maritalOptions]);
            }
        }
    }
    
    /**
     * To show the edit profile form to the currently logged in user
     * @return : view for the edit form to edit the profile information (of the currently logged in user)
     */
    public function actionEditProfile()
    {
        if(!Yii::$app->user->isGuest){
            $user_id = Yii::$app->user->getId();
            $model = User::find()->innerJoinWith('userDetail')->onCondition(['users.id'=>$user_id])->one();
            if(isset($model) && !empty($model)){
                $model->scenario = 'editProfile';
                $model->userDetail->scenario = 'editProfile';
                if($model->load(Yii::$app->request->post()) | $model->userDetail->load(Yii::$app->request->post())){
                    $filePath = 'images/'.USER_PROFILE_IMAGES_DIRECTORY.'/';
                    $this->uploadFile($model, $filePath);
                    if($model->update(true) | $model->userDetail->update(true)){
                        Yii::$app->session->setFlash("success", 'Your profile has been updated successfully', true);
                        return $this->refresh();
                    } 
                }  
                else{
                    $genderOptions = User::findGenderOptions();
                    $maritalOptions = User::findMaritalStatusOptions();
                    return $this->render('edit-profile', ['model'=>$model, 'genderOptions'=>$genderOptions, 'maritalOptions'=>$maritalOptions]);
                }
            }    
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be logged in to perform any private operation', true);
            $this->redirect(Url::to(['user/login']));
        }
    }
    
    /**
     * To show the Change Password for the currently logged in user
     * @return : view for the change password (For the currently logged in user)
     */
    public function actionChangePassword()
    {
        if(!Yii::$app->user->isGuest){
            $model = Yii::$app->user->getIdentity();
            $model->scenario = 'changePassword';
            if($model->load(Yii::$app->request->post())){
                if($model->validate()){
                    $model->auth_key = User::generateNewAuthKey();
                    $model->password_hash = User::setNewPassword($model->password);
                    if($model->update()){
                        Yii::$app->session->setFlash('success', 'You password has been changed successfully', true);
                    }else{
                        Yii::$app->session->setFlash('danger', 'Your password NOT changed successfullly', true);
                    }
                }
            }
            return $this->render('change-password', ['model'=>$model]);
        }else{
            $this->goHome();
        }    
    }
    
    public function actionUpload(){
        $model = new User;
        if($model->load(Yii::$app->request->post())){
            $filePath = 'images/'.USER_PROFILE_IMAGES_DIRECTORY.'/';
            $this->uploadFile($model, $filePath);
            echo "<pre>";print_r(Yii::$app->request->post());die;
        }else{
            return $this->render('abc', ['model'=>$model]);
        }
    }
    
    protected function uploadFile($model, $filePath){
        $file = \yii\web\UploadedFile::getInstance($model, 'file');
        if(isset($file) && !empty($file)){
            $file->saveAs($filePath.$file->name);
            $model->userDetail->photo = $file->name;
        }    
    }
    
    #################################### USER FUNCTIONS ####################################
    
    


    #################################### AJAX FUNCTIONS ####################################
    
    #################################### AJAX FUNCTIONS ####################################
    
}

