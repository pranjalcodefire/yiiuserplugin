<?php

define('DEFAULT_PAGE_SIZE', 10);
define('ACTIVE', 1);
define('INACTIVE', 0);
define('DELETED', 1);      // For now its used for sending DELETED status (in ajax) , (later can be used to make a record as deleted in database(for now records are actually get deleted from database on request))
define('VERIFIED', 1);
define('NOT_VERIFIED', 0);
define('BY_ADMIN', 1);
define('NOT_FOUND_TEXT', '<span style="color:red;">Not Found<span>');
define('DATE_FORMAT', 'F jS, Y');
define('USER_PROFILE_IMAGES_DIRECTORY', 'user_photos');
define('USER_PROFILE_DEFAULT_IMAGE', 'user-default.jpg');
define('APP_IMAGES_DIRECTORY', 'app_images');
define('AJAX_LOADING_BIG_IMAGE', 'circle-loading-animation.gif');


#Need to configure:
//define('LOGIN_URL_FOR_USER', 'user/login');     //Used in /var/www/yii-plugin/vendor/yiisoft/yii2/web/User.php
//define('LOGIN_URL_FOR_ADMIN', 'user/login');
define('LOGIN_URL', 'user/login');




