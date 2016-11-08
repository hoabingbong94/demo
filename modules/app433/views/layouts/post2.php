<?php
/**
 * Created by PhpStorm.
 * User: Hoàng
 * Date: 25/05/2016
 * Time: 4:10 CH
 */
?>

<?php
$controller = $this->context;
$route = $controller->route;
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<input type="hidden" id="checkImages" value="1"/>
<div class="col-md-3" id="left">
    <div class="list-group" id="contentMenu">
        <a href="/app433/post" class="list-group-item <?= (strpos($route, 'app433/post') === 0) ? 'active' : '' ?>">Bài tin
            <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <a href="/app433/tips" class="list-group-item <?= (strpos($route, 'app433/tips') === 0) ? 'active' : '' ?>">Nhận định
            <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <a href="/app433/categories" class="list-group-item <?= (strpos($route, 'app433/categories') === 0) ? 'active' : '' ?>">
            Chuyên mục
            <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <a href="/app433/banner" class="list-group-item <?= (strpos($route, 'app433/banner') === 0) ? 'active' : '' ?>">
            Banner
            <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <a href="/app433/report/report-post" class="list-group-item <?= (strpos($route, 'app433/report') === 0) ? 'active' : '' ?>">
            Report
            <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <a href="/app433/keywords" class="list-group-item <?= (strpos($route, 'app433/keywords') === 0) ? 'active' : '' ?>">
            Từ khóa
            <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
        <a href="/app433/broadcast" class="list-group-item <?= (strpos($route, 'app433/broadcast') === 0) ? 'active' : '' ?>">
            Lịch truyền hình
            <i class="glyphicon glyphicon-chevron-right pull-right"></i>
        </a>
    </div>
</div>
<div class="col-md-9" id="right">
    <script src="/libs/ckeditor/ckeditor.js"></script>
    <?= $content ?>
    <?php echo $this->render('element/Notification'); ?>
</div>
<?php
$this->endContent();
