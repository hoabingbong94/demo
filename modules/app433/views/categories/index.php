<?php
$imagePath = Yii::$app->params['imagePath'];
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="col-md-8 remove-padding">
            <h3 class="panel-title">Danh chuyên mục</h3>
        </div>
        <div class="col-md-4 remove-padding">
            <a href="/app433/categories/create" class="btn btn-sm btn-success pull-right">
                <span class="glyphicon glyphicon-plus"></span>Thêm mới</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">

        <div class="css-treeview">
            <ul>
                <?php $i = 0; ?>
                <?php foreach ($listCategories as $row) { ?>
                    <?php if ($row["ParentID"] == 0) { ?>
                        <?php if($row["check"] ==1){ ?>
                            <li><input type="checkbox" id="item-<?=$i?>"/>
                                <label for="item-<?=$i?>">
                                    <img src="<?= $imagePath . $row["Logo"] ?>" class="img-categories-logo"/>
                                    <a class="title-category"
                                       href="/app433/categories/update?id=<?= $row['CategoryID']?>"
                                       title="Sửa"><?= $row["CategoryName"] ?></a>

                                   <?php if($row["Public"]==1){?>
                                    <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                                    <?php }else {?>
                                        <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                                    <?php }?>     
                                    <span style="font-size: 14px;font-weight: bold">__<?=$row["OrderIndex"]?></span>

                                </label>
                                <ul>       
                                    <?php $j = 0; ?>
                                    <?php foreach ($listCategories as $row1) { ?>
                                        <?php if ($row1["ParentID"] == $row["CategoryID"]) { ?>
                                            <?php if($row1["check"] ==1){ ?>
                                                <li><input type="checkbox" id="item-<?=$i."-".$j?>"/>
                                                    <label for="item-<?=$i."-".$j?>">
                                                        <img src="<?= $imagePath . $row1["Logo"] ?>" class="img-categories-logo"/>
                                                        <a class="title-category"
                                                           href="/app433/categories/update?id=<?= $row1['CategoryID']?>"
                                                           title="Sửa"><?= $row1["CategoryName"] ?></a>
                                                        <?php if($row1["Public"]==1){?>
                                                            <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                                                        <?php }else {?>
                                                            <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                                                        <?php }?>
                                                        <span style="font-size: 14px;font-weight: bold">__<?=$row1["OrderIndex"]?></span>
                                                    </label>
                                                    <ul> 
                                                        <?php foreach ($listCategories as $row2) { ?>
                                                            <?php if ($row2["ParentID"] == $row1["CategoryID"]) { ?>
                                                            <li class="list-item title-category">
                                                                <img src="<?= $imagePath . $row2["Logo"] ?>"
                                                                                                      class="img-categories-logo"/>
                                                                <a class="title-category"
                                                                   href="/app433/categories/update?id=<?= $row2['CategoryID']?>"
                                                                   title="Sửa"><?= $row2["CategoryName"] ?></a>

                                                                <?php if($row2["Public"]==1){?>
                                                                    <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                                                                <?php }else {?>
                                                                    <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                                                                <?php }?>
                                                                <span style="font-size: 14px;font-weight: bold">__<?=$row2["OrderIndex"]?></span>
                                                            </li>
                                                         <?php
                                                            }
                                                        }?>
                                                    </ul>
                                                </li>  
                                    <?php }else{?>
                                        <li class="list-item title-category">
                                            <img src="<?= $imagePath . $row1["Logo"] ?>"
                                                                                  class="img-categories-logo"/>
                                            <a class="title-category"
                                               href="/app433/categories/update?id=<?= $row1['CategoryID']?>"
                                               title="Sửa"><?= $row1["CategoryName"] ?></a>

                                            <?php if($row1["Public"]==1){?>
                                                <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                                            <?php }else {?>
                                                <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                                            <?php }?>
                                            <span style="font-size: 14px;font-weight: bold">__<?=$row1["OrderIndex"]?></span>
                                        </li>
                                    <?php }
                                        }
                                    }
                                    ?> 
     
                                </ul>
                            </li>  
                        <?php }else{?>

                            <li class="list-item title-category">
                                <img src="<?= $imagePath . $row["Logo"] ?>"
                                                                      class="img-categories-logo"/>
                                <a class="title-category"
                                   href="/app433/categories/update?id=<?= $row['CategoryID']?>"
                                   title="Sửa"><?= $row["CategoryName"] ?></a>

                                <?php if($row["Public"]==1){?>
                                    <span title="Đang hiển thị" class="glyphicon fa fa-circle show-color"></span>
                                <?php }else {?>
                                    <span title="Đang hiển thị" class="glyphicon fa fa-circle hide-color"></span>
                                <?php }?>     
                                    <span style="font-size: 14px;font-weight: bold">__<?=$row["OrderIndex"]?></span>
                            </li>
                             <?php }?>

                     <?php  } ?>
                <?php  $i++; } ?>
            </ul>
        </div>
    </div>
</div>