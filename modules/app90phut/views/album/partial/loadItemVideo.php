<?php
foreach ($listItems as $k => $item) {
    echo '<li id="itemAlbum' . $k . '">' .
    '<div class="controlListVideo">' .
    '<span onClick="removeItemAlbumImage(' . $k . ',1);"><i class="glyphicon glyphicon-trash"></i></span>' .
    '<span onClick="loadItemAlbumVideo(' . $k . ',1);"><i class="glyphicon glyphicon-pencil"></i></span>' .
    '</div>' .
    '<video src="' . \Yii::$app->params['media90phut'] . $item['fileVideo'] . '" controls="true" poster="' . \Yii::$app->params['media90phut'] . $item['fileName'] . '"/>' .
    '</li>';
}
?>
<li onClick="addAlbumVideo();">
    <i class="glyphicon glyphicon-film"></i>
    <span class="flag">Thêm video</span>
</li>

