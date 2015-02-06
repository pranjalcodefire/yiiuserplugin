<?php 
namespace common\components;

class MyGlobalClass extends \yii\base\Component{
    public function init() {
        echo "<h3>Hi</h3>";
        parent::init();
    }
}
?>