<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app433\services;

use app\modules\app433\models\Categories;

class CategoriesService {

 function findAllCategory() {
        $array = array();
        $out = array();
        $array[''] = "--Chọn danh mục--";
        $array[0] = "Danh mục gốc";
        $resultRoot = Categories::find()->where(array('ParentID' => 0))->all();
        foreach ($resultRoot as $k => $v) {
            $array[$v->CategoryID] = $v->CategoryName;
            $categoriesId = $v->CategoryID;
            $array = $this->getParent($categoriesId, $array, "--",$resultRoot);
        }
        return $array;
    }

    public function getListAll() {

        $category = Categories::find()->orderBy('OrderIndex')->asArray()->all();
        // var_dump($category[0]); die;
        for ($i = 0; $i < count($category); $i++) {
            //  var_dump($category[$i]); die;
            $category[$i]["check"] = 0;

            for ($j = 0; $j < count($category); $j++) {
                if ($category[$j]["ParentID"] == $category[$i]["CategoryID"]) {
                    $category[$i]["check"] = 1;
                }
            }
        }
        // var_dump($category); die;
        return $category;
    }

    public function save($model) {

        $path = date("Y/m/d");
        $date = date('Y-m-d H:i:s');

        $upload = new UploadService();
        $image_tmp = $model->Logo;
        $uploadedLogoPC = $upload->uploadBase64("images/logo", $image_tmp, 160, 160);
        $uploadedLogo = $upload->uploadBase64("images/logo", $image_tmp, 80, 80);

        // echo $uploadedLogo; echo $uploadedLogoPC; die;

        if ($uploadedLogo != false) {
            $model->Logo = "media433/images/logo/" . $uploadedLogo;
        }

        if ($uploadedLogoPC != false) {
            $model->LogoPC = "media433/images/logo/" . $uploadedLogoPC;
        }

        $uploadedCover = $upload->uploadBase64("images/logo", $model->Image_Cover, 925, 320);
        if ($uploadedCover != false) {
            $model->Image_Cover = "media433/images/logo/" . $uploadedCover;
        }

        $insert = $model->save();

        if ($insert) {
            if ($model->isNewRecord) {
                return "Thêm mới chuyên mục thành công.";
            } else
                return "Cập nhật chuyên mục thành công";
        } else {
            return "Lỗi hệ thống.";
        }
    }

    public function findById($id) {
        return Categories::find()->where(['CategoryID' => $id])->one();
    }

    public function findAll() {

        $array = array();
        $out = array();
        $array[''] = "Chọn danh mục";
        $listDataObject = Categories::find()->where(array('Public' => 1))->all();
        $listData = array();
        foreach ($listDataObject as $k => $v) {
            $listData[$k]['CategoryID'] = $v->CategoryID;
            $listData[$k]['CategoryName'] = $v->CategoryName;
            $listData[$k]['ParentID'] = $v->ParentID;
        }
        foreach ($listData as $k => $v) {
            if ($v['ParentID'] == 0) {
                $array[$v['CategoryID']] = $v['CategoryName'];
                $categoriesId = $v['CategoryID'];
                $array = $this->getParent($categoriesId, $array, "--", $listData);
            }
        }
        return $array;
    }

    public function getParent($parentId, $array, $flag, $listData) {

        foreach ($listData as $k => $v) {
            if ($v['ParentID'] == $parentId) {
                $array[$v['CategoryID']] = $flag . $v['CategoryName'];
                $categoriesId = $v['CategoryID'];
                $array = $this->getParent($categoriesId, $array, $flag . "--", $listData);
            }
        }

        return $array;
    }

}
