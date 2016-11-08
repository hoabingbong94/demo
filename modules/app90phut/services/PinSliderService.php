<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

use app\modules\app90phut\models\PinSlider;

class PinSliderService {

    public function findAll() {
        $data = PinSlider::find()->all();
        return $data;
    }

    public function delete($id) {
        return PinSlider::deleteAll(['ID' => $id]);
    }

}
