<?php

namespace app\modules\saoplus\services;

require_once(__DIR__ . '/lib/getid3.lib.php');
require_once(__DIR__ . '/lib/getid3.php');
require_once(__DIR__ . '/lib/module.tag.id3v2.php');

use Yii;
use yii\db\Query;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\imagine\Image;
use app\modules\saoplus\models;
use app\modules\saoplus\models\Videos;
use app\modules\saoplus\models\Categories;
use app\modules\saoplus\services\UploadService;
//use app\modules\saoplus\services\getID3;
use app\modules\app433\models\AdminCms;

//use app\modules\app\models\Categories;

class VideosService {

    public function getCategory() {
        $data = array();
        $data = Categories::find()->where(array('Status' => 1))->all();
        return $data;
    }

    public function getFullname() {
        $arr = array();
        $data = AdminCms::find()->where('status = 1')->all();
        foreach ($data as $key => $value) {
            $userID = $value->id;
            $fullname = $value->fullname;
            $arr[$userID] = $fullname;
        }
        return $arr;
    }

    public function findAll($param) {
        $query = new Query();
        $keyword = $param['keyword'];
        $page = $param['page'];
        $CategoriesID = $param['CategoriesID'];
        $status = $param['status'];
        $queryEx = $query->select(['a.ID',
                    'a.Title',
                    'a.Description',
                    'a.Alias',
                    'a.Thumbnail',
                    'a.Time',
                    'a.VideoFile',
                    'a.Status',
                    'a.DateCreate',
                    'a.View',
                    'a.Keywords',
                    'a.DateUpdate',
                    'a.UserCreate',
                    'a.UserUpdate',
                    'a.CategoriesID',
                    'a.Pin_Slider',
                    'b.Title as CategoiresName',
                ])
                ->from('Videos as a')
                ->leftJoin('Categories as b', 'b.ID=a.CategoriesID');
        $queryEx->where(['LIKE', 'a.Title', [$keyword]]);
//        $queryEx->andWhere(['LIKE', 'a.Keywords', [$keyword]]);
        if ($CategoriesID != 0) {
            $queryEx->andWhere(['=', 'a.CategoriesID', $CategoriesID]);
        }
        if ($status == "") {
            $queryEx->andWhere('a.Status =1');
        } else {
            $queryEx->andWhere(['a.Status' => $status]);
        }
        $queryEx->orderBy("a.ID DESC");
        $command = $query->createCommand(models\Videos::getDb());
        $data = $command->queryAll();
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count('*', models\Videos::getDb()),
        ]);

        $data = $queryEx->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all(models\Videos::getDb());
        return array('data' => $data, 'pagination' => $pagination);
    }

    public function getListAll() {
        $category = Categories::find()->orderBy('Order')->asArray()->all();
        for ($i = 0; $i < count($category); $i++) {
            $category[$i]["check"] = 0;
            for ($j = 0; $j < count($category); $j++) {
                if ($category[$j]["ParentId"] == $category[$i]["ID"]) {
                    $category[$i]["check"] = 1;
                }
            }
        }
        return $category;
    }

    public function saveData(Videos $model, $post) {
        $uploadserive = new UploadService();
        $images_path = $model->Thumbnail_Hq;
        if ($model->Thumbnail_Hq != null && $model->Thumbnail_Hq != "") {
            $filename = $uploadserive->uploadBase64("images", $images_path, 640, 352);
            if ($filename) {
                $model->Thumbnail_Hq = $filename;
            }
            $filename = $uploadserive->uploadBase64("images", $images_path, 364, 204);
            if ($filename) {
                $model->Thumbnail = $filename;
            }
        }
        if ($model->UserCreate == null) {
            $model->DateCreate = date("Y-m-d H:i:s");
            $model->UserCreate = \Yii::$app->user->id;
        } else {
            $model->UserUpdate = \Yii::$app->user->id;
            $model->DateUpdate = date("Y-m-d H:i:s");
        }
        if ($model->Status != 0) {
            $model->Status = 1;
        }
        $model->Alias = $this->getAlias($model);
        $this->getVideo($model);
        if ($model->save()) {
            return 1;
        }
        return 0;
    }

    /**
     * 
     * @param type $title
     * Title categories
     * HÀm này trả về slug đã dược check trùng
     */
    public function getAlias(Videos $model) {
        /*
         * Kiểm tra xem trong database tiêu đề này đã tồn tại hay chưa.
         * Nếu tồn tại rồi lấy dữ liệu bạn ghi gần đây nhất.
         */
        $title = $model->Title;
        $service = new Services();
        $alias = $data = "";
        if ($model->isNewRecord) {
            $data = Videos::find()->where(['Title' => $title])->orderBy(['ID' => SORT_DESC])->one();
        } else {
            $data = Videos::find()->where(['Title' => $title])->andWhere(['NOT IN', 'ID', [$model->ID]])->orderBy(['ID' => SORT_DESC])->one();
        }
        if ($data != null) {
            //Xử lý
            $slug = $data->Alias;
            $number = (int) substr($slug, strrpos($slug, "-") + 1);
            if (is_numeric($number)) {
                $alias = $service->getAlias($title) . "-" . ($number + 1);
            } else {
                $alias = $service->getAlias($title) . "-1";
            }
        } else {
            //Chưa tồn tại thì lấy slug với tiêu đề truyền vào.
            $alias = $service->getAlias($title);
        }
        return $alias;
    }

    public function getVideo(Videos $model) {
        $path = date('Y/m/d');
        $uploadServies = new UploadService();
        $service = new Services();
        $getID3 = new \getID3;
        $nameVideo = '';
        $ext = '';
        $Url = Path_Upload_Saoplus . 'videos/' . $path;
        if (!is_dir($Url)) {
            $uploadServies->mkdir(Path_Upload_Saoplus . 'videos/');
        }
        $model->VideoFile = UploadedFile::getInstance($model, 'VideoFile');
        if ($model->VideoFile != null) {
            $name = $model->VideoFile->baseName;
            $str = $service->getAlias($name);
            $nameVideo = $str . time();
            $ext = substr($model->VideoFile, strrpos($model->VideoFile, '.') + 1);
            $infor = Path_Upload_Saoplus . 'videos/' . $path . "/" . $nameVideo . '.' . $ext;
            $model->VideoFile->saveAs($infor);
            $ThisFileInfo = $getID3->analyze($infor);
            $model->Time = $ThisFileInfo['playtime_string'];
            $model->VideoFile = 'videos/' . $path . "/" . $nameVideo . '.' . $ext;
        } else if (isset($model->oldAttributes['VideoFile'])) {
            $model->VideoFile = $model->oldAttributes['VideoFile'];
        }
        return $model;
    }

}
