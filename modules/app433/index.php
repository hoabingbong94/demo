<?php
/**
 * Created by PhpStorm.
 * User: Hoàng
 * Date: 18/07/2016
 * Time: 5:23 CH
 */
session_start();
include_once 'autoload.php';
$config= require_once('config.php');
$ViettelConnect=new ViettelConnect($config);
$ViettelConnect->onCheckisdn();

