<ul class="media-list">
    <?php 
    //var_dump($data["post_short_433"]); die;
    foreach($data["433_post_short"] as $row){?>
    <li class="media">
        <div class="media-left">
            <a href="#">
                <?php
                    if($row["Thumbnails"]!= null && $row["Thumbnails"]!=""){
                        $image = $row["Thumbnails"];
                    }else{
                        $image = $row["Logo"];
                    }
                ?>
                <img class="index-image" src="http://posts.media.profile.bongda433.com/<?=$image?>" data-holder-rendered="true"> 
            </a>
        </div>
        <div class="media-body">
            <div class="head">
                <h4 class="media-heading post-index-h4">
                    <?=$row["CategoryName"]?>                                                 
                </h4>
 
            </div>
            <div class="clear"></div>
            <div class="content">
               <?=  str_replace("[tag]", "", str_replace("[/tag]", "", $row["ContentNone"]))?> 
            </div>
            <div style="width: 100%;position: relative;">
                <span class="index-fullname" style="margin-top: 5px;">
                    <i class="fa fa-user" aria-hidden="true"></i> <?=$row["FullName"]?> 
                    | <i class="fa fa-file-text-o" aria-hidden="true"></i> <?= date('H:i:s d/m/Y',strtotime($row["DateCreate"]))?>                                                                                                                                                          <br>
                </span>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>
