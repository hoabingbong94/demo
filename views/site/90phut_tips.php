<ul class="media-list">
    <?php
    //var_dump($data["post_short_433"]); die;
    foreach ($data["90phut_tips"] as $row) {
        ?>
        <li class="media">

            <div class="media-body">
                <div id="content-match-score">
                    <label class="home-name team-name"> <?= $row["HomeName"]?></label>
                    <label class="home-name-logo">
                        <img src="http://static.bongdaplus.vn/Assets/Soccer/teams/<?= $row["HomeID"] ?>.png">
                    </label>
                    <label class="score" style="width:45px">vs</label>
                    <label class="away-name-logo">
                        <img src="http://static.bongdaplus.vn/Assets/Soccer/teams/<?= $row["AwayID"] ?>.png">
                    </label>
                    <label class="away-name team-name"> <?= $row["AwayName"]?></label>
                </div>
                <div class="clear"></div>
                <div class="content">
                    <?= $row["Description"] ?>
                </div>
                <div style="width: 100%;position: relative;">
                    <span class="index-fullname" style="margin-top: 5px;">
                        <i class="fa fa-user" aria-hidden="true"></i> <?= $row["FullName"] ?> 
                        | <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= date('H:i:s d/m/Y', strtotime($row["CreateDate"])) ?>                                                                                                                                                          <br>
                    </span>
                </div>
            </div>
        </li>
<?php } ?>
</ul>


