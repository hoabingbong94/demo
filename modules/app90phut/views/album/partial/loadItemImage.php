<?php
foreach ($listItems as $k => $item) {
    echo '<li id="itemAlbum' . $k . '">' .
    '<div class="controlListVideo">' .
    '<span onClick="removeItemAlbumImage(' . $k . ',0);"><i class="glyphicon glyphicon-trash"></i></span>' .
    '<span onClick="loadItemAlbumVideo(' . $k . ',0);"><i class="glyphicon glyphicon-pencil"></i></span>' .
    '</div>' .
    '<img src="' . \Yii::$app->params['media90phut'] . $item['fileName'] . '"/>' .
    '</li>';
}
?>
<li onClick="addAlbumVideo();">
    <i class="glyphicon glyphicon-plus flag"></i>
    <span class="flag">Thêm ảnh</span>
</li>

