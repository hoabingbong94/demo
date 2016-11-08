<?php

/**
 * Created by PhpStorm.
 * User: cau
 * Date: 6/3/2016
 * Time: 8:45 AM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if (isset($_REQUEST['page'])) {
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Thêm chuyên mục tin';
} else
    $this->title = 'Thêm chuyên mục tin';
?>
<?=

$this->render('_form', [
    'model' => $model,
    'listParent' => $listParent,
    'mes' => $mes
])
?>
