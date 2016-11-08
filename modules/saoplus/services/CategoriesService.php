<?php

namespace app\modules\saoplus\services;

use app\modules\saoplus\models;
use app\modules\saoplus\models\Categories;
use yii\data\Pagination;
use yii\db\Query;
use Yii;
use yii\web\Application;
use app\modules\saoplus\services\UploadService;
use app\modules\saoplus\services\Services;

class CategoriesService {

    public function findAll() {
        $query = new Query();
        $queryEx = $query->select(['a.ID',
                    'a.Title',
                    'a.Description',
                    'a.Alias',
                    'a.Background',
                    'a.Icon',
                    'a.ParentId',
                    'a.Order',
                    'a.Status',
                    'a.DateCreate',
                    'a.DateUpdate',
                    'a.UserCreate',
                    'a.UserUpdate',
                ])
                ->from('Categories as a');
        $queryEx->orderBy("a.Order DESC");
        $command = $query->createCommand(models\Categories::getDB());
        $data = $command->queryAll();
        return array('data' => $data);
    }

    public function getListAll() {

        $category = models\Categories::find()->orderBy('Order')->asArray()->all();
        for ($i = 0; $i < count($category); $i++) {
            $category[$i]["check"] = 0;

            for ($j = 0; $j < count($category); $j++) {
                if ($category[$j]["ParentId"] == $category[$i]["ID"]) {
                    $category[$i]["check"] = 1;
                }
            }
        }
// var_dump($category); die;
        return $category;
    }

    public function FillRoot() {
        $array = array();
        $array[0] = "-Danh mục gốc-";
        $category = models\Categories::find()->all();
        foreach ($category as $k => $v) {
            if ($v->ParentId == 0) {

                $array[$v->ID] = $v->Title;
                $categoriesId = $v->ID;
                $array = $this->getParent($category, $categoriesId, $array, "--");
            }
        }
        return $array;
    }

    public function getParent($category, $parentId, $array, $flag) {
        $rs = array();
        foreach ($category as $k => $cat) {
            if ($cat->ParentId == $parentId) {
                $rs[$k] = $cat;
            }
        }
        foreach ($rs as $k => $v) {
            $array[$v->ID] = $flag . $v->Title;
            $categoriesId = $v->ID;
            $array = $this->getParent($category, $categoriesId, $array, $flag . "--");
        }
        return $array;
    }

    public function SearchVideoAjax($keyword) {
        $sql = "SELECT ID,Avatar,UrlVideo,EventName FROM Extend_Video WHERE EventName LIKE :keyword ORDER BY ID DESC limit 10";
        $data = Yii::$app->db2->createCommand($sql)
                ->bindValue(':keyword', "%$keyword%")
                ->queryAll();
        return $data;
    }

    public function saveData($model, $post) {

        $uploadServie = new UploadService();
        if ($model->Icon != null && $model->Icon != "") {
            $string_img = $post["Categories"]["Icon"];
            $filename = $uploadServie->uploadBase64("icon", $string_img, 100, 100);
            if ($filename) {
                $model->Icon = $filename;
            }
        }
        if ($model->UserCreate == null) {
            $model->DateCreate = date("Y-m-d H:i:s");
            $model->UserCreate = \Yii::$app->user->id;
        } else {
            $model->UserUpdate = \Yii::$app->user->id;
            $model->DateUpdate = date("Y-m-d H:i:s");
        }
        if ($model->Order == NULL) {
            $model->Order = 1;
        }
        $model->Alias = $this->getAlias($model);
        if ($model->save()) {
            return 1;
        }
        return 0;
    }

    public function getAlias(Categories $model) {
        $title = $model->Title;
        $services = new Services();
        $alias = $data = "";
        //kiểm tra 
        if ($model->isNewRecord) {
            $data = Categories::find()->where(['Title' => $title])
                            ->orderBy(['ID' => SORT_DESC])->one();
        } else {
            $data = Categories::find()
                            ->where(['Title' => $title])
                            ->andWhere(['<>', 'ID', $model->ID])
                            ->orderBy(['ID' => SORT_DESC])->one();
        }
        if ($data != NULL) {
            //xử lý
            $slug = $data->Alias;
            $number = (int) substr($slug, strripos($slug, "-") + 1);
            if (is_numeric($number)) {
                //nếu là số thì + thêm 1
                $alias = $services->getAlias($title) . "-" . ($number + 1);
            } else {
                //không phải là số thì -1
                $alias = $services->getAlias($title) . "-1";
            }
        } else {
            $alias = $services->getAlias($title);
        }

        return $alias;
    }

}
