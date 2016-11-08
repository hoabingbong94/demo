<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\services;

use app\modules\app433\models\Keywords;
use yii\db\Query;

class KeywordsService {

    public function findAll() {
//        $data = Keywords::find()->orderBy("ID DESC")->limit(10)->all();
//        return $data;

        $query = new Query();
        $data = $query->select(['a.ID', 'a.Keywords', 'a.DateCreate', 'c.fullname'])
                ->from('Keywords as a')
                ->leftJoin('Admin_Cms as c', 'c.ID = a.UserCreate')
                ->orderBy("a.ID DESC")
                ->limit(10)
                ->all();

        return $data;
    }

    public function findById($id) {
        $data = Keywords::find()->where(['ID' => $id])->one();
        return $data;
    }

    public function save(Keywords $model) {
        try {
            $userId = \Yii::$app->user->id;
            $dateTime = date("Y-m-d H:i:s");
            $model->UserUpdate = $userId;
            $model->DateUpdate = $dateTime;
            if ($model->ID == null) {
                $model->UserCreate = $userId;
                $model->DateCreate = $dateTime;
            }
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
    }

}
