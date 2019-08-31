<?php

// home page
define("HOME_PAGE", 'Home');
require_once '../config.php';
session_start();
Router::loadController();
