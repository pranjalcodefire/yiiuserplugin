<?php 
namespace common\components;
use Yii;
include_once '/../config/constants.php';

class MyGlobalClass extends \yii\base\Component{
    public function init() {
		parent::init();
		//echo '<pre>'; print_r(Yii::$app); exit;
		// if (Yii::$app->user->can('backend:User:Index')) {
			// echo 'hi';
		// }else{
			// echo 'hello';
		// }
    }
}
?>