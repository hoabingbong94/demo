<?php
$patch = Yii::$app->params['pathMedia'] . "/";
?>
<ul class="dropdown-menu" 
    data-video1="<?= $patch . $videoRoot ?>|<?= $patch . $thumbVideo ?>" 
    data-video2="<?= $patch . $video480p ?>|<?= $patch . $thumbVideo ?>"
    data-video3="<?= $patch . $video360p ?>|<?= $patch . $thumbVideo ?>"
    data-video4="<?= $patch . $video240p ?>|<?= $patch . $thumbVideo ?>"
    id="listVideo<?= $id ?>">
    <?php
    if ($video480p != "") {
        echo ' <li><a onClick="copyVideo(' . $id . ', 2)" href="javascript:void(0);">Video 480p</a></li>';
    }
    if ($video360p != "") {
        echo '<li><a onClick="copyVideo(' . $id . ', 3)" href="javascript:void(0);">Video 360p</a></li>';
    }
    if ($video240p != "") {
        echo '<li><a onClick="copyVideo(' . $id . ', 4)" href="javascript:void(0);">Video 240p</a></li>';
    }
    ?> 
</ul>