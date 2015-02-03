<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\Url;

/******Models we goona use in this controller*****/
use common\models\User;
use common\models\UserDetail;
use common\models\UserGroup;
use common\models\UserRole;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;


class UserController extends Controller{
    
    
    #################################### CONTROLLER BASE ####################################
    
    
    #################################### CONTROLLER BASE ####################################
    
    
    
    
    #################################### ADMIN FUNCTIONS ####################################
    
    /**
     * To get log in the user
     * @return : to home url (the logged in user)
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } 
        else {
            return $this->render('login', ['model' => $model]);
        }
    }
    
    /**
     * To get log out the user
     * return : to the home page
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
        if ($model->load(Yii::$app->request->post()) && $model->validate(true)) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
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
        return $this->render('resetPassword', ['model' => $model,]);
    }
    
    /*
     * To show all the records (Users) listing
     * return the view of listing of records (Users)
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest){
            $users = User::find();
            $pagination = new Pagination(['defaultPageSize'=>DEFAULT_PAGE_SIZE, 'totalCount'=> $users->count()]);
            $users = $users->offset($pagination->offset)->limit($pagination->limit)->orderBy('id')->all();
            return $this->render('index', ['results'=>$users, 'pagination'=>$pagination]);
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be logged in to perform any private operation', true);
            return $this->redirect(Url::to(['user/login']));
        }    
    }
    
    /**
     * To add a record into the model (User)
     * @return : view of add record (User) form
     */
    public function actionSave()
    {
        if(!Yii::$app->user->isGuest){
            $model = new User;
            $model->scenario = 'addUser';
            $modelUser = new UserDetail;
            if($model->load(Yii::$app->request->post())){
                if($model->validate()){
                    $model->auth_key = User::generateNewAuthKey();
                    $model->password_hash = User::setNewPassword($model->password);
                    if($model->save(false)){
                        $modelUser->user_id = $model->id;
                        $modelUser->save(false) ? Yii::$app->session->setFlash('success', 'You have been registered successfully', true) : Yii::$app->session->setFlash('danger', 'Your registration was not successful.', true);
                    }
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
            $model = User::find()->innerJoinWith('userDetail')->onCondition(['users.id'=>$id])->one();
            if(isset($model) && !empty($model)){
                $genderOptions = User::findGenderOptions();
                $maritalOptions = User::findMaritalStatusOptions();
                return $this->render('view', ['model'=>$model, 'genderOptions'=>$genderOptions, 'maritalOptions'=>$maritalOptions]);
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
            $model = User::find()->innerJoinWith(['userDetail', 'userRole'])->onCondition(['users.id'=>$id])->one();
            if(isset($model) && !empty($model)){
                $model->scenario = 'editUser';
                $model->userDetail->scenario = 'editUser';
                if($model->load(Yii::$app->request->post()) | $model->userDetail->load(Yii::$app->request->post())){
                    if($model->validate() | $model->userDetail->validate()){
                        if($model->update(false) | $model->userDetail->update(false)){
                            Yii::$app->session->setFlash("success", 'User profile has been updated successfully', true);
                            return $this->refresh();
                        }    
                    }
                }else{
                    $genderOptions = User::findGenderOptions();
                    $maritalOptions = User::findMaritalStatusOptions();
                    $userRoles = UserGroup::find()->onCondition(['type'=>'1'])->all();
                    foreach($userRoles as $userRole){
                        $roles[$userRole->name] = $userRole->name;
                    }
                    return $this->render('edit', ['model'=>$model, 'userRoles'=>$roles, 'genderOptions'=>$genderOptions, 'maritalOptions'=>$maritalOptions]);
                }    
            }else{
                Yii::$app->session->setFlash("danger", 'Invalid User', true);
                $this->redirect(Url::to(['user/index']));
            }
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be looged in to perform any private operation', true);
            $this->redirect(Url::to(['user/index']));
        }
    }
    
    public function actionChangeUserPassword($id = NULL)
    {
        if(!Yii::$app->user->isGuest){
            $model = User::find()->innerJoinWith('userDetail')->onCondition(['users.id'=>$id])->one();
            if(isset($model) && !empty($model)){
                $model->scenario = 'changeUserPassword';
                if($model->load(Yii::$app->request->post())){
                    if($model->validate()){
                        $model->auth_key = User::generateNewAuthKey();
                        $model->password_hash = User::setNewPassword($model->password);
                        $model->update() ? Yii::$app->session->setFlash('success', 'User password has been changed successfullly', true) :  Yii::$app->session->setFlash('danger', 'User password NOT changed successfullly', true);
                        return $this->refresh();
                    }
                }
            }else{
                Yii::$app->session->setFlash("danger", 'Invalid User', true);
            }    
            return $this->render('change-user-password', ['model'=>$model]);
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be looged in to perform any private operation', true);
            $this->redirect(Url::to(['user/index']));
        }
    }
    
    /**
     * To show the user dashboard
     * @return : view of user's dashboard 
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
     * To show the current logged in user profile information
     * @return : view of the current logged in user's profile details
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
     * @return : view of edit profile form for the current logged in user
     */
    public function actionEditProfile()
    {
        if(!Yii::$app->user->isGuest){
            $user_id = Yii::$app->user->getId();
            $model = User::find()->innerJoinWith(['userDetail', 'userRole'])->onCondition(['users.id'=>$user_id])->one();
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
            return $this->redirect(Url::to(['user/login']));
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
                    $model->update() ? Yii::$app->session->setFlash('success', 'Your password has been changed successfullly', true) : Yii::$app->session->setFlash('danger', 'Your password NOT changed successfullly', true);
                    return $this->refresh();
                }
            }
            return $this->render('change-password', ['model'=>$model]);
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be logged in to perform any private operation', true);
            $this->goHome();
        }    
    }
    
    public function actionSendVerificationEmail()
    {
        if(!Yii::$app->user->isGuest){
            $model = Yii::$app->user->getIdentity();
            return \Yii::$app->mailer->compose('verifyEmail', ['model' => $model])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Verify email for ' . \Yii::$app->name)
                    ->send();
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be logged in to perform any private operation', true);
            $this->goHome();
        }    
        
    }
    
    public function actionVerifyMyEmail($id = NULL, $token = NULL)
    {
        $model = User::find()->onCondition(['id'=>$id, 'auth_key'=>$token])->one();
        if($model->email_verified != VERIFIED){
            $model->scenario = 'emailVerification';
            $model->email_verified = VERIFIED;
            if($model->update()){
                Yii::$app->session->setFlash("success", 'Your email has been verified successfully', true);
            }
        }else{
            Yii::$app->session->setFlash("danger", 'Your email has been already verified. You don\'t need to do it again', true);
            
        }
        $this->goHome();
    }
    
    #################################### ADMIN FUNCTIONS ####################################
    
    
    
    
    
    #################################### AJAX FUNCTIONS ####################################
    
    public function actionStatus()
    {
        if(Yii::$app->request->isAjax){
            $model = User::findOne($_POST['id']);
            if(isset($model) && !empty($model)){
                $model->status = ($model->status == ACTIVE) ? INACTIVE : ACTIVE;
                $model->scenario = 'statusChange';
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $model->update() ? ['status'=>'success', 'recordStatus'=>$model->status] : ['status'=>'failure'];
                
            }    
        }
    }
    
    public function actionDelete()
    {
        if(Yii::$app->request->isAjax){
            $id = $_POST['id'];
            $model = User::find()->innerJoinWith('userDetail')->onCondition(['users.id'=>$id])->one();
            if(isset($model) && !empty($model)){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ($model->delete($id) && UserDetail::deleteAll(['user_id'=>$id])) ? ['status'=>'success', 'recordDeleted'=>DELETED] : ['status'=>'failure'];
            }    
        }
    }
    
    public function actionVerifyEmail($id = NULL)
    {
        if(Yii::$app->request->isAjax){
            $model = User::findOne($id);
            if(isset($model) && !empty($model)){
                $model->email_verified = ($model->email_verified == VERIFIED) ? NOT_VERIFIED : VERIFIED;
                $model->scenario = 'emailVerification';
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $model->update() ? ['status'=>'success', 'recordEmailVerified'=>$model->email_verified] : ['status'=>'failure']; 
            }    
        }
    }
    
    #################################### AJAX FUNCTIONS ####################################
    
    
    
    
    
    #################################### PROTECTED FUNCTIONS ###############################
    
    protected function uploadFile($model, $filePath)
    {
        $file = \yii\web\UploadedFile::getInstance($model, 'file');
        if(isset($file) && !empty($file)){
            $file->saveAs($filePath.$file->name);
            $model->userDetail->photo = $file->name;
        }    
    }
    
    #################################### PROTECTED FUNCTIONS ###############################
    
}

