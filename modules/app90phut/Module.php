<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\app90phut;
//use Yii;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\app90phut\controllers';
    public function init()
    {
        parent::init();
        $this->layout = "main";

        //Yii::configure($this, require(__DIR__ . '\config\web.php'));
    }
}
