<?php

define("HOME_PAGE", 'HomePage');
session_start();
require_once './config.php';
//if (strtotime(date('Y-m-d')) <= strtotime('2017-04-22')) {
//    echo '<div style="height: 40%;width: 50%; margin-left: 25%;margin-top: 15%;background-color: #ff0000;text-align: center;">
//    
//    <h2 style="padding-top: 10%;font-weight: bold">عفوا, النسخه المجانيه انتهت <br> لشراء البرنامج اطلب هذا الرقم <br>
//        01021952160<br><br> Developer:<a href="https://www.facebook.com/Mo7md.5airY"> Mohamed Khairy</a></h2>
//</div>';
//} else {
router::loadcontroller();


//}
?>
