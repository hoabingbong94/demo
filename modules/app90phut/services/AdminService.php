<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use app\modules\app433\models\AdminCms;

class AdminService {

    public function getListAdmin() {
        $data = AdminCms::find()->all();
        $listAdmin = array();
        foreach ($data as $v) {
            $listAdmin[$v->id] = $v->fullname;
        }
        return $listAdmin;
    }

}
