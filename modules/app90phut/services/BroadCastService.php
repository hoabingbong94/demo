<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use app\services\Service;
use app\modules\app90phut\models\BroadCast;

class BroadCastService extends Service {

    public function findAll($date, $keyword) {
        $data = BroadCast::find()->where(['LIKE', 'AwayName', $keyword])
                ->orWhere(['LIKE', 'HomeName', $keyword])
                ->andWhere(['Date_BroadCast' => $date])
                ->andWhere(['Delete' => 1])
                ->all();
        return $data;
    }

    public function findById($id) {
        $data = BroadCast::find()->where(['ID' => $id])->one();
        return $data;
    }

    public function save(BroadCast $model) {
        $date = date("Y-m-d H:i:s");
        $userId = \Yii::$app->user->id;
        if ($model->ID == null) {
            $model->UserCreate = $userId;
            $model->DateCreate = $date;
        }
        $model->UserUpdate = $userId;
        $model->DateUpdate = $date;
        if ($model->save()) {
            return $model->ID;
        } else {
            return false;
        }
    }

}
