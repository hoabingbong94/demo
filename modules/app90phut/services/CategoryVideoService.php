<?php

/**
 * Created by PhpStorm.
 * User: cau
 * Date: 6/1/2016
 * Time: 5:45 PM
 */

namespace app\modules\app90phut\services;

use app\modules\app90phut\models;
use app\modules\app90phut\models\CategoryVideo;
use Yii;

class CategoryVideoService {

    public function getAllCategoryActive(){
        $data = CategoryVideo::find()->orderBy("Active DESC, OrderNumber DESC ")->all();
        return $data;
    }

    
    public function FillRoot() {
        $array = array();

        $array[0] = "-Danh mục gốc-";
        $category = models\CategoryVideo::find()->where(['ExtendAllowGet'=>1])->all();
        foreach ($category as $k => $v) {
            if ($v->ParentID == 0) {
                $array[$v->CategoryID] = $v->CategoryName;
                $categoriesId = $v->CategoryID;
                $array = $this->getParent($category, $categoriesId, $array, "--");
            }
        }

        return $array;
    }

    public function getParent($category, $parentId, $array, $flag) {
        $rs = array();
        foreach ($category as $k => $cat) {
            if ($cat->ParentID == $parentId) {
                $rs[$k] = $cat;
            }
        }
        foreach ($rs as $k => $v) {
            $array[$v->CategoryID] = $flag . $v->CategoryName;
            $categoriesId = $v->CategoryID;
            $array = $this->getParent($category, $categoriesId, $array, $flag . "--");
        }

        return $array;
    }

        

}
