<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use app\services\Service;
use app\modules\app90phut\models\AlbumImage;
use yii\data\Pagination;
use yii\db\Query;
use app\modules\app90phut\services\UploadService;
use app\modules\app90phut\services\AlbumItemService;
use app\modules\app433\services\PostService;

class AlbumService extends Service {

    public function findAll($keyword, $public) {
        $query = new Query();
        $queryEx = $query->select(['ID', 'AlbumName', 'Avatar', 'Type', 'CategoryID', 'DateCreate', 'Author'])
                ->from('Extend_Album_Image')
                ->where(['LIKE', 'AlbumName', $keyword]);
        if ($public != "") {
            $queryEx->andWhere(['Active' => $public]);
        }
        $queryEx->orderBy("ID DESC")->limit(10);
        $query->createCommand(AlbumImage::getDb());
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count('*', AlbumImage::getDb()),
        ]);
        $data = $queryEx->orderBy("ID DESC")
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all(AlbumImage::getDb());
        return array('data' => $data, 'pagination' => $pagination);
    }

    public function findById($id) {
        return AlbumImage::find()->where(['ID' => $id])->one();
    }

    public function save(AlbumImage $model) {
        $date = date("Y-m-d H:i:s");
        $model->DateUpdate = $date;
        $model->UserUpdate = \Yii::$app->user->id;
        if ($model->ID == null) {
            $model->DateCreate = $date;
            $model->Author = \Yii::$app->user->identity->fullname;
        }
        $upload = new UploadService();
        $uploadFile = $upload->uploadBase64("images/", $model->Avatar, 670, 377);
        if ($uploadFile != false) {
            $model->Avatar = $uploadFile;
        }
        $postService = new PostService();
        if (!$postService->getRole('publish')) {
            $model->Active = 0;
        }
        if (!$model->isNewRecord) {
            $model->AllowEdit = $model->AllowEdit - 1;
        }
        $save = $model->save();
        if ($save) {
            $itemAlbum = new AlbumItemService();
            $itemAlbum->save($model->ID, $model->Type);
        }
        return $model->ID;
    }

    public function listCategoriesAlbum() {
        $data = [1 => 'Người đẹp châu Á',
            2 => 'Người đẹp châu Âu',
            3 => 'Wags',
            4 => 'Người đẹp Việt Nam',
            5 => 'Video châu Âu',
            6 => 'Video Châu Á'];
        return $data;
    }

    public function unsetSession($key) {
        parent::unsetSession($key);
    }

}
