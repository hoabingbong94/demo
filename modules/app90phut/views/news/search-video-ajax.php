<?php foreach ($data as $row) { ?>
    <div class="video-item" id="<?= $row["ID"] ?>" 
         data-avatar="/service/<?= $row["Avatar"] ?>" 
         data-video="/service/<?= $row["UrlVideo"] ?>" 
         data-title="<?= $row["EventName"] ?>" 
         onclick="insert_video(<?= $row["ID"] ?>)">  
        <img src="/service/<?= $row["Avatar"] ?>">  
        <p><?= $row["EventName"] ?> </p>
        <div style="clear:both;height:5px;"></div>       
    </div>
    <?php
}?>