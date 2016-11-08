<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\app433\controllers;

use yii\web\Controller;
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->layout='post';
       return $this->render('index');
    }
}
