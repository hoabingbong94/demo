<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use app\services\Service;
use app\modules\app90phut\models\AlbumImageItem as AlbumItem;
use app\modules\app90phut\services\UploadService;

class AlbumItemService extends Service {

    public function save($albumId, $type) {
        $key = $this->getKeySession($type);
        $this->removeItem($albumId);
        $listItem = $this->getSession($key);
        $date = date("Y-m-d H:i:s");
        foreach ($listItem['items'] as $item) {
            $model = new AlbumItem();
            $model->ImageLink = $item['fileName'];
            $model->Active = 1;
            $model->ImageName = $item['title'];
            $model->DateCreate = $date;
            $model->DateUpdate = $date;
            $model->AlbumID = $albumId;
            $model->UserUpdate = \Yii::$app->user->id;
            if ($type == 1) {
                $model->Video = $item['fileVideo'];
                $model->Size = $item['fileSize'];
            }
            $model->save();
        }
    }

    public function removeItem($albumId) {
        $rowDelete = AlbumItem::deleteAll(['AlbumID' => $albumId]);
        return $rowDelete;
    }

    public function findByAlbumId($albumId, $type) {
        $key = $this->getKeySession($type);
        $this->unsetSession($key);
        $listData = AlbumItem::find()->where(['AlbumID' => $albumId])->all();
        foreach ($listData as $k => $item) {
            $data['title'] = $item->ImageName;
            $data['fileName'] = $item->ImageLink;
            if ($type == 1) {
                $data['fileVideo'] = $item->Video;
                $data['fileSize'] = $item->Size;
            }
            $this->addSession($key, $data);
        }
        return $this->getSession($key);
    }

    public function addItemImage($post, $files) {
        $title = $post['title'];
        $tmpName = $files['imageFile']['tmp_name'];
        $fileName = $files['imageFile']['name'];
        $fileUpload = $this->uploadCkE('images', $tmpName, $fileName, "90phut");
        $data['title'] = $title;
        $data['fileName'] = $fileUpload;
        $listData = $this->addSession('albumImage', $data);
        return $listData;
    }

    public function updateItemImage($post, $files, $key) {
        $listItem = $this->getSession("albumImage")['items'];
        $data = $listItem[$key];
        $title = $post['title'];
        if (isset($files['imageFile']) && $files['imageFile']['name'] != null) {
            $tmpName = $files['imageFile']['tmp_name'];
            $fileName = $files['imageFile']['name'];
            $fileUpload = $this->uploadCkE('images', $tmpName, $fileName, "90phut");
            $data['fileName'] = $fileUpload;
        }
        $data['title'] = $title;
        $listData = $this->editSession("albumImage", $data, $key);
        return $listData;
    }

    public function addItemVideo($post, $files) {
        $title = $post['title'];
        $image = $post['imageFile'];
        $uploadVideo = $this->uploadVideo($files);
        $data['title'] = $title;
        $data['fileName'] = $this->uploadImagesBase64($image, 480, 270);
        $data['fileVideo'] = $uploadVideo['name'];
        $data['fileSize'] = $uploadVideo['size'];
        $listData = $this->addSession('albumVideo', $data);
        return $listData;
    }

    public function updateItemVideo($post, $files, $key) {
        $title = $post['title'];
        $image = $post['imageFile'];
        $listItem = $this->getSession('albumVideo')['items'];
        $data = $listItem[$key];
        if (isset($files['videoFile']) && $files['videoFile']['name'] != null) {
            $uploadVideo = $this->uploadVideo($files);
            $data['fileVideo'] = $uploadVideo['name'];
            $data['fileSize'] = $uploadVideo['size'];
        }if ($post['imageFile'] != null) {
            $data['fileName'] = $this->uploadImagesBase64($image, 480, 270);
        }
        $data['title'] = $title;
        $listData = $this->editSession("albumVideo", $data, $key);
        return $listData;
    }

    private function uploadVideo($files) {
        $tmpName = $files['videoFile']['tmp_name'];
        $fileName = $files['videoFile']['name'];
        $fileSize = $files['videoFile']['size'];
        $fileUpload = $this->uploadCkE('videos', $tmpName, $fileName, "90phut");
        return ['name' => $fileUpload, 'size' => $fileSize];
    }

    private function uploadImagesBase64($image, $width, $height) {
        $uploadService = new UploadService();
        return $uploadService->uploadBase64("images/", $image, $width, $height);
    }

    public function removeItemImage($k,$type) {
        if($type==0){
        $this->removeSession('albumImage', $k);
        }else{
            $this->removeSession('albumVideo', $k);
        }
    }

    private function getKeySession($type) {
        $key = 'albumImage';
        if ($type == 1) {
            $key = 'albumVideo';
        }
        return $key;
    }

    public function findByKey($k, $type) {
        $key = $this->getKeySession($type);
        $listItem = $this->getSession($key)['items'];
        $item = $listItem[$k];
        return $item;
    }

}
