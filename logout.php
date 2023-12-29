<?php
session_start();
$checklogin = false;

session_destroy();
header('Location:'.$_SERVER['HTTP_REFERER']);