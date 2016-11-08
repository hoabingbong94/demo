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
    $this->title = 'Trang ' . $_REQUEST['page'] . ' - Update chuyên mục tin';
} else
    $this->title = 'Update chuyên mục tin';
?>
<?=

$this->render('_form', [
    'model' => $model,
    'mes' => $mes
])
?>
