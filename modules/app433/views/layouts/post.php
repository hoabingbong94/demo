<?php
/*
 * © Copyright 2016 - NetBeans IDE 8.1
 * @author Nhamtv 
 * @Date 06-09-2016 2:32:48 PM
 */
$controller = $this->context;
$route = $controller->route;
$this->beginContent('@app/views/layouts/main.php');
$listMenu = [
    ['name' => 'Bài tin', 'link' => 'app433/post', 'icon' => 'fa fa-file-text-o'],
    ['name' => 'Nhận định', 'link' => 'app433/tips', 'icon' => 'fa fa-bars'],
    ['name' => 'Chuyên mục', 'link' => 'app433/categories', 'icon' => 'fa fa-bars'],
    ['name' => 'Banner', 'link' => 'app433/banner', 'icon' => 'fa fa-clone'],
    ['name' => 'Từ khóa', 'link' => 'app433/keywords', 'icon' => 'fa fa-tags'],
    ['name' => 'Lịch truyền hình', 'link' => 'app433/broadcast', 'icon' => 'fa fa-television'],
    ['name' => 'Report', 'link' => 'app433/report/report-post', 'icon' => 'fa fa-area-chart'],
];
?>
<input type="hidden" id="checkImages" value="1"/>
<div class="col-md-3" id="left">
    <section class="menu-custom">
        <ul>
            <?php
            foreach ($listMenu as $k => $v) {
                $classActive = "";
                if (strpos($route, $v['link']) === 0) {
                    $classActive = 'active';
                }
                echo '<li class="' . $classActive . '"><a href="/' . $v['link'] . '"><i class="' . $v['icon'] . '" aria-hidden="true"></i> ' . $v['name'] . '</a></li>';
            }
            ?>
        </ul>
    </section>
</div>
<div class="col-md-9" id="right">
    <script src="/libs/ckeditor/ckeditor.js"></script>
    <?= $content ?>
    <?php echo $this->render('element/Notification'); ?>
</div>
<?php
$this->endContent();
