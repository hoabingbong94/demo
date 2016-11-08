<?php

/**
 * Created by PhpStorm.
 * User: vuchien
 * Date: 5/16/16
 * Time: 12:53 PM
 */

namespace app\modules\app433\services;

use app\models\bongda433\Categories;
use app\models\bongda433\Post;
use app\modules\app433\services\UploadService;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\UploadedFile;

class PostService
{

    public function findAll($keyword)
    {
        $query = new Query();
        $query->select(['Post.ID', 'Post.Recommened', 'Post.DatePublic', 'Post.Type', 'Post.Title', 'Categories.CategoryName', 'Post.Content', 'Post.Thumbnails', 'Categories.LOGO'])
            ->from('Post')
            ->leftJoin('Categories', 'Post.CategoryID = Categories.CategoryID')
            ->where(['LIKE', 'Content', $keyword])
            ->orderBy(['ID' => SORT_DESC])
            ->limit(10);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $data = $query->orderBy(['ID' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return array('data' => $data, 'pagination' => $pagination);
    }

    public function findById($postId)
    {
        $data = Post::find()->where(['ID' => $postId])->one();
        return $data;
    }

    public function save(Post $model)
    {
        $path = date("Y/m/d");
        $model->ContentNone = strip_tags($model->Content);
        $model->ContentExtendNone = strip_tags($model->Content);
        $model->UserLiveEdit = 1;
        $model->PinVideo = 0;
        $date = date('Y-m-d H:i:s');
        $model->DateCreate = $date;
        $model->DateUpdate = $date;
        $upload = new UploadService();
        $uploadedThumbnails=$upload->uploadBase64("images/" . $path, $model->Thumbnails);
        if ($uploadedThumbnails!=false) {
            $model->Thumbnails = "/images/" . $path . "/" . $uploadedThumbnails;
        }
        //echo $model->Thumbnails; die;
        if ($model->Type == 1) {
            //Video
            $uploadedThumbVideo=$upload->uploadBase64("images/" . $path, $model->ThumbVideo);
            if ($uploadedThumbVideo!=false) {
                $model->ThumbVideo = "/images/" . $path . "/" . $uploadedThumbVideo;
            }
            //Upload video
            if (!is_dir(PathUpload . "videos/" . $path)) {
                mkdir(PathUpload . "videos/" . $path, 0777, true);
            }
             if (!is_dir(PathUpload . "videos/360/" . $path)) {
                mkdir(PathUpload . "videos/360/" . $path, 0777, true);
            }
            $file_video = UploadedFile::getInstance($model, 'UrlVideo');
            if($file_video!=null){
                $name_video = $file_video->baseName . time();
                $pathVideo = '/videos/' . $path . "/" . $name_video;
                $file_video->saveAs(PathUpload . $pathVideo . '.' . $file_video->extension);
                $video240=$upload->convertVideo(PathUpload . $pathVideo . '.' . $file_video->extension, PathUpload . '/videos/360/' . $path,$name_video, 240);
                if($video240){
                    $model->UrlVideo240p='/videos/360/' . $path."/".$name_video.".".$file_video->extension;
                }
                $model->UrlVideo = $pathVideo . '.' . $file_video->extension;
            }
            else{
                $model->UrlVideo=$model->oldAttributes['UrlVideo'];
            }

        }
        $insert = $model->save();
        if ($insert) {
            if($model->isNewRecord){
                return "Thêm mới tin nhanh thành công.";
            }
            else return "Cập nhật tin nhanh thành công";
        } else {
            return "Lỗi hệ thống.";
        }
    }

    public function minuteAgo($date)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $time_ago = strtotime($date);
        $cur_time = time();
        $time_elapsed = $cur_time - $time_ago;
        $seconds = $time_elapsed;
        $minutes = round($time_elapsed / 60);
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400);
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640);
        $years = round($time_elapsed / 31207680);
        $result = '';
        if ($date == null) {
            echo '';
        } else if ($time_elapsed <= 0) {
            echo 'Chưa xuất bản';
        } else if ($seconds <= 60) {
            $result = $seconds . " giây";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                echo "1 phút ";
            } else {
                $result = $minutes . " phút";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                echo " 1 giờ ";
            } else {
                $result = $hours . " giờ";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                echo " Ngày hôm qua ";

            } else {
                $result = date('d-m-Y', strtotime($date));
            }
        } else {
            $result = date('d-m-Y', strtotime($date));
        }
        return $result;
    }

}
