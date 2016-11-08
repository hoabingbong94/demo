<?php

namespace app\modules\app433\services;

use yii\data\Pagination;
use yii\db\Query;
use app\modules\app433\services\UploadService;
use app\modules\app433\models\Banner;
use yii\web\UploadedFile;

class BannerService {

    public function findAll() {
        $dateOff = [];
        $query = new Query();
        $queryEx = $query->select([
                    'a.ID',
                    'a.Title',
                    'a.Images',
                    'a.DateCreate',
                    'a.UserCreate',
                    'b.fullname'
                ])->from('Banner as a')
                ->leftJoin('Admin_Cms as b', 'b.id = a.UserCreate');
        $queryEx->orderBy("a.DateCreate DESC")
                ->limit(10);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $data = $queryEx->orderBy("a.DateCreate DESC")
                        ->offset($pagination->offset)->limit($pagination->limit)->all();

        return array('data' => $data, 'pagination' => $pagination);
    }

    public function save(Banner $model) {
        $path = date("Y/m/d");
        $date = date("Y-m-d H:i:s");
        $userId = \Yii::$app->user->id;
        $model->DateUpdate = $date;
        $model->UserUpdate = $userId;
        if ($model->ID == null) {
            $model->DateCreate = $date;
            $model->UserUpdate = $userId;
        }
        $uploadFile = new UploadService();
        $fileUpload = $uploadFile->uploadBase64("images/" . $path, $model->Images, 99999, 377);
        if ($fileUpload != false) {
            $model->Images = "/images/" . $path . "/" . $fileUpload;
        }
        $save = $model->save();
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function findById($id) {
        return Banner::find()->where(['ID' => $id])->one();
    }

    public function delete($id) {
        return Banner::deleteAll(['ID' => $id]);
    }

}
