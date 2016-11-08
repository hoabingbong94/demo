<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use yii\db\Query;
use yii\data\Pagination;
use app\modules\app90phut\models\Video;
use app\modules\app90phut\services\UploadService;
use yii\web\UploadedFile;
use app\modules\app433\services\PostService;

class VideoService {

    public function fillAll($param) {
        $keyword = $param['keyword'];
        $type = $param['type'];
        $category = $param['category'];

        $query = new Query();
        $queryEx = $query->select(['a.ID',
                    'a.EventName',
                    'a.Avatar',
                    'a.DateCreate',
                    'a.DateUpdate',
                    'a.IsPublic',
                    'a.Top',
                    'a.Tophot',
                    'b.Name',
                    'c.CategoryName',
                    'd.FullName'
                ])
                ->from('Extend_Video as a')
                ->leftJoin('Extend_Category_Video as b', 'a.LeagueID=b.LeagueID')
                ->leftJoin('Extend_Category as c', 'a.Category=c.ID')
                ->leftJoin('Extend_User as d', 'a.UserID=d.ID');
        $queryEx->where(['LIKE', 'a.EventName', $keyword]);

        if ($type == 1) {
            $queryEx->andWhere(['=', 'a.IsPublic', 0]);
        }
        if ($type == 2) {
            $queryEx->andWhere(['=', 'a.Top', 1]);
        }
        if ($type == 3) {
            $queryEx->andWhere(['=', 'a.TopHot', 1]);
        }
        if ($category != 0) {
            $queryEx->andWhere(['=', 'a.LeagueID', $category]);
        }

        $queryEx->orderBy("a.ID DESC")
                ->limit(10);

        $command = $query->createCommand(Video::getDb());
        $data = $command->queryAll();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count('*', Video::getDb()),
        ]);

        $data = $queryEx->orderBy("a.ID DESC")
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all(Video::getDb());

//        var_dump($data); die;
        return array('data' => $data, 'pagination' => $pagination);
    }

    public function findById($id) {
        $data = Video::find()->where(['ID' => $id])->one();
        return $data;
    }

    public function save($model, $post) {

        $type = isset($post["type"]) ? $post["type"] : 0;
        $iframe = isset($post["iframe"]) ? $post["iframe"] : "";

        $path = date("Y/m/d");
        $serviceUpload = new UploadService();
        //Upload Avatar
        $uploadedThumbnails = $serviceUpload->uploadBase64("images", $model->Avatar, 480, 270);

        if ($uploadedThumbnails != false) {
            $model->Avatar = $uploadedThumbnails;
        }

        if ($model->LeagueID == 96969 and $type == 1) {
            $model->UrlVideo = $iframe;
        } else {
//        //Upload Video
            if (!is_dir(Path_Upload_90phut . "videos/" . $path)) {
                $serviceUpload->mkdir(Path_Upload_90phut . "videos/");
            }
            $file_video = UploadedFile::getInstance($model, 'UrlVideo');

            if ($file_video != null) {
                $name_video = $file_video->baseName . time();
                $name_video = str_replace(" ", "-", $name_video);
                $pathVideo = 'videos/' . $path . "/" . $name_video;
                $ext = $file_video->extension;
                //            echo PathUpload . $pathVideo; die;
                $file_video->saveAs(Path_Upload_90phut . $pathVideo . '.' . $ext);
                $model->UrlVideo = 'cms_upload/' . $pathVideo . '.' . $ext;
            } else if (isset($model->oldAttributes['UrlVideo'])) {
                $model->UrlVideo = $model->oldAttributes['UrlVideo'];
            }
        }
        if ($model->ID == null) {
            $model->DateCreate = date("Y-m-d H:i:s");
            $model->UserID = \Yii::$app->user->id;
        }
        $postService = new PostService();
        $model->DateUpdate = date('Y-m-d H:i:s');
        if (!$postService->getRole('publish')) {
            $model->IsPublic = 0;
        }
        if (!$model->isNewRecord) {
            $model->AllowEdit = $model->AllowEdit - 1;
        }
        $save = $model->save();

        if ($save) {
            return true;
        } else {
            return false;
        }
    }

}
