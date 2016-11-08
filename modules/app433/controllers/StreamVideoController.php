<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\controllers;

use yii\web\Controller;
use app\modules\app433\models\Post;

class StreamVideoController extends Controller {

    public function actionIndex($key) {
        $data = Post::find()->where(['StreamKey' => $key])->one();
        if ($data != null) {
            header('Status: 404', TRUE, 200);
        } else {
            header('Status: 404', TRUE, 403);
        }
        die;
    }

}
