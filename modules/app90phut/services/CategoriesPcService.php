<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use app\modules\app90phut\models\CategoryPc;

class CategoriesPcService {

    public function findAll($public, $keyword) {
        $data = CategoryPc::find()->where(['Public' => $public])
                ->andWhere(['LIKE', 'CategoryName', $keyword])
                ->all();
        return $data;
    }

    public function findById($id) {
        $data = CategoryPc::find()->where(['ID' => $id])->one();
        return $data;
    }

    public function save(CategoryPc $model) {
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    
    public function getAllCategories() {
        $array = array();

        $array[0] = "Chọn danh mục";
        $listAll = CategoryPc::find()->where(['ShowVideo' => 1])->all();
        foreach ($listAll as $k => $v) {
            if ($v->ParentID == 0) {
                $array[$v->ID] = $v->CategoryName;
                $categoriesId = $v->ID;
                $array = $this->getParent($listAll, $categoriesId, $array, "--");
            }
        }

        return $array;
    }

    public function getParent($listAll, $parentId, $array, $flag) {
        $rs = array();
        foreach ($listAll as $k => $cat) {
            if ($cat->ParentID == $parentId) {
                $rs[$k] = $cat;
            }
        }
        foreach ($rs as $k => $v) {
            $array[$v->ID] = $flag . $v->CategoryName;
            $categoriesId = $v->ID;
            $array = $this->getParent($listAll, $categoriesId, $array, $flag . "--");
        }
        return $array;
    }

}
