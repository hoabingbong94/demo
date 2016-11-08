<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\app90phut\services;

class Utility {

    public static function formatDateTime($dateTime) {
        return date("d-m-Y H:s:i", strtotime($dateTime));
    }

}
