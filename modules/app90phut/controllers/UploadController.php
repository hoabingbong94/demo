<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class UploadController extends Controller {

    public function actionUploadImg() {
        $upload = new \app\modules\app433\services\UploadService();
        $view = "";
        foreach ($_FILES['file_up']['name'] as $k => $v) {
            $fileName = $v;
            $tmpName = $_FILES['file_up']['tmp_name'][$k];
            $file = $upload->uploadCkE("images", $tmpName, $fileName);
            $path = \Yii::$app->params['pathMedia'] . $file;
            $view.= '<img width="100%" src="' . $path . '"/><br/>';
        }
        echo $view;
        die;
    }

    public function actionUploadVideo() {
        $upload = new \app\modules\app90phut\services\UploadService();
        $tmpName = $_FILES['file_up']['tmp_name'];
        $fileName = $_FILES['file_up']['name'];
        $file = $upload->uploadCkE("videos", $tmpName, $fileName);
        if ($file == "") {
            echo "loi";
            die;
        }
        $path = $file;
        echo '<center><video width="100%" src="' . $path . '" controls="true"/></center>';
        die;
    }

}
