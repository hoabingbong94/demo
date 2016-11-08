<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use app\modules\app90phut\models\CategoryVideo;

class CategoriesVideoService {

    public function findAll() {
        
        $data = CategoryVideo::find()->orderBy(" OrderNumber DESC")->all();
        $dropdownData = array();
        $dropdownData[0] = "Chọn danh mục";
        foreach ($data as $k => $v) {
            $dropdownData[$v->LeagueID] = $v->Name;
        }
        return $dropdownData;
    }

}
