<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\app433;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\app433\controllers';
    public function init()
    {
        $this->layout="main";
        $this->defaultRoute = "/post";
//        parent::init();
//        \Yii::configure($this, require(__DIR__ . '\config\web.php'));
    }
}
