<html>
    <head>
        <title>Mobileader</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
        <script src="<?=HostName.DS.'jQuery/jquery.min.js'?>"></script>
        <link href="<?=HostName.DS.'css/bootstrap.css'?>" rel="stylesheet"/>
        <script src="<?=HostName.DS.'jQuery/main.js'?>"></script>

    </head>
    <body  id='img2' style="background-image: url( '<?= HostName ?>./images/pattern.jpg')">

  
        <div id="mizo">
            <div  id="case" style="display: block">
                <table border="0" style="width: 100%;height: 100%">
                    <tr style="height: 2%" id="head">
                        <td colspan="2" id="menubar">
                            <ul id="menu">
                                <li><a href="?rt=HomePage/logout"> الخروج</a></li>
                                <li><a href="#" onclick="mido('?rt=HomePage/index')"> بحث</a></li>
                                <li><a href="#" onclick="mido('?rt=HomePage/gard')"> الجرد</a></li>
                                <li><a href="#" onclick="mido('?rt=Product/show')" >المنتجات</a></li>
                                <li><a href="#"onclick="mido('?rt=Card/show')"> الكروت</a></li>
                                <li><a href="#" onclick="mido('?rt=Charge/charge')"> الرصيد</a></li>
                            </ul>
                        </td>
                        <td style="background-color: #cccccc"><center><?=  date("d-m-Y",time()); ?></center></td>
                    </tr>
                    <tr>
                        
