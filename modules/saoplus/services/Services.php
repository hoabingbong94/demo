<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\saoplus\services;

use yii\imagine;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

class Services {
    /*
     * Get Alias
     */

    public function getAlias($cs, $tolower = false) {
        $marTViet = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
            "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ",
            "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ",
            "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ",
            "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À",
            "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ",
            "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
            "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ",
            "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư",
            "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "-", ":", " - ",
            "/", "(", ")", " ");
        $marKoDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
            "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e",
            "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o",
            "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u",
            "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d",
            "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A",
            "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
            "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O",
            "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U",
            "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", " ", "", " ", " ", "#", "#", "#");
        if ($tolower) {
            return strtolower(str_replace($marTViet, $marKoDau, $cs));
        }
        $chuyendoirs = str_replace($marTViet, $marKoDau, $cs);
        $chuyendoirs = strtolower($chuyendoirs);
        $st = str_replace(' ', '#', $chuyendoirs);
        $strs = preg_replace('([^a-zA-Z0-9#])', '#', $st);
        $strs = preg_replace('([^a-zA-Z0-9#])', '', $strs);
        $strs = str_replace('###', '#', $strs);
        $strs = str_replace('##', '#', $strs);
        return rtrim(preg_replace('([^a-zA-Z0-9])', '-', $strs), "-");
    }

}
