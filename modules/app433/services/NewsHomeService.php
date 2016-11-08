<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\services;

use app\modules\app433\models\NewsHome;
use yii\db\Query;
use app\modules\app433\services\PostService;

class NewsHomeService {

    public function findAll($keyword, $public) {
        $query = new Query();
        $queryEx = $query->select([
                    'a.ID',
                    'a.Title',
                    'a.DateCreate',
                    'a.OrderNumber',
                    'd.fullname',
                    'c.CategoryName',
                    'c.Logo',
                    'b.Thumbnails'
                ])
                ->from('News_Home as a')
                ->leftJoin('Post as b', 'a.PostID=b.ID')
                ->leftJoin('Categories as c', 'b.CategoryID=c.CategoryID')
                ->leftJoin('Admin_Cms as d', 'a.UserCreate=d.id')
                ->where(['LIKE', 'a.Title', $keyword]);
        if ($public != "") {
            $queryEx->andWhere(['a.Status' => 0]);
        } else {
            $queryEx->andWhere(['a.Status' => 1]);
        }
        $data = $queryEx->orderBy("a.OrderNumber ASC,a.DateCreate DESC")->limit(10)->all();
        return $data;
    }

    public function findById($id) {
        return NewsHome::find()->where(['ID' => $id])->one();
    }

    public function findPostByID($postId) {
        $query = new Query();
        $queryEx = $query->select(['a.Title', 'a.Content', 'a.Thumbnails', 'b.CategoryName'])
                ->from('Post as a')
                ->leftJoin('Categories as b', 'a.CategoryID=b.CategoryID')
                ->where(['a.ID' => $postId]);
        $data = $queryEx->one();
        return $data;
    }

    public function save(NewsHome $model) {
        $date = date("Y-m-d H:i:s");
        $userId = \Yii::$app->user->id;
        $model->UserUpdate = $userId;
        $model->DateUpdate = $date;
        if ($model->ID == null) {
            $model->UserCreate = $userId;
            $model->DateCreate = $date;
        }
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

}
