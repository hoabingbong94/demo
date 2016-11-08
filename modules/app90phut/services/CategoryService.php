<?php

/**
 * Created by PhpStorm.
 * User: cau
 * Date: 6/1/2016
 * Time: 5:45 PM
 */

namespace app\modules\app90phut\services;

use app\modules\app90phut\models;
use app\modules\app90phut\models\Category;
use Yii;

class CategoryService {

    public function getAllCategoryActive(){
        $data = Category::find()->where(['ExtendAllowGet' => 1])->orderBy(" OrderIndex")->all();
        return $data;
    }

    public function getListCategoryById($id) {
        $category = models\Category::find()->where(['ExtendAllowGet' => 1, 'CategoryID' => $id])->asArray();
        $comand = $category->createCommand();
        $result = $comand->queryAll();
        $output = 0;
        foreach ($result as $re) {
            $output = $re['CategoryName'];
        }
        return $output;
    }

    public function Fillall() {
        
        $category = models\Category::find()->all();
        
        return $category;
    }

    public function FillRoot() {
        $array = array();

        $array[0] = "-Danh mục gốc-";
        $category = models\Category::find()->where(['ExtendAllowGet'=>1])->all();
        
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

    public function findById($ID) {
        $category = models\Category::findOne(['ExtendAllowGet' => 1, 'CategoryID' => $ID]);

        return $category;
    }
    

}
