<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="wrap-main">
    <div class="col-md-6">
       
         <div class="col-md-12" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tin dài 433</h3>
                </div>
                <div class="panel-body">
                    <?php require_once '433_post_long.php';?>
                </div>
            </div>
        </div>
        <div class="col-md-12" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Video 433</h3>
                </div>
                <div class="panel-body">
                    <?php require_once '433_video.php';?>
                </div>
            </div>
        </div>
         <div class="col-md-12" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tin ngắn 433</h3>
                </div>
                <div class="panel-body">
                    <?php require_once '433_post_short.php';?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-12" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tin tức 90phut</h3>
                </div>
                <div class="panel-body">
                    <?php require_once '90phut_news.php';?>
                </div>
            </div>
        </div>
        <div class="col-md-12" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Video 90phut</h3>
                </div>
                <div class="panel-body">
                    <?php require_once '90phut_video.php';?>
                </div>
            </div>
        </div>
        <div class="col-md-12" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Nhận định 90phut</h3>
                </div>
                <div class="panel-body">
                   <?php require_once '90phut_tips.php';?>
                </div>
            </div>
        </div>
    </div>
</div>