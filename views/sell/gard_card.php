<?php
if (!empty($_SESSION['date_day'])) {
    $d1 = $_SESSION['date_day'];
    $d2 = $_SESSION['date_day'];
    unset($_SESSION['date_day']);
} else if (!empty($_SESSION['date_2day1']) && !empty($_SESSION['date_2day2'])) {
    $d1 = $_SESSION['date_2day1'];
    $d2 = $_SESSION['date_2day2'];
    unset($_SESSION['date_2day1']);
    unset($_SESSION['date_2day2']);
} else {
    $d1 = 'Y-m-d';
    $d2 = 'Y-m-d';
}

$fd = strtotime(date("$d1 00:00:00 "));
$sd = strtotime(date("$d2 24:00:00 "));
$num = 0;
$mony = 0;
$allsellmony = 0;
$lose = 0;
$inmony = 0;
$res = 0;
$allmony = 0;
$allres = 0;
$cards = CardModel::getAllData();
foreach ($cards as $c) {
    if (strtotime($c['ca_datetime']) <= $sd) {
        $scards = SellcardModel::value_in_or_not($c['ca_net'], $c['ca_value']);
        foreach ($scards as $sc) {
            if (strtotime($sc['sc_datetime']) >= $fd && strtotime($sc['sc_datetime']) <= $sd) {
                $num+=$sc['sc_num'];
                $mony+=$sc['sc_mony'];
                $res+=($sc['sc_mony'] - ($sc['sc_num'] * $c['ca_cost']));
            }
        }
                $arr[$c['ca_id']] = $num;
        $allres+=$res;
        $allmony+=(($num + $c['ca_num']) * $c['ca_cost']);
        $allsellmony+=$mony;
        $inmony+=($c['ca_num'] * $c['ca_cost']);
    }
    $num = 0;
    $mony = 0;
}
$mostsell = '';
if (!empty($arr)) {
    $value = max($arr);
    $key = array_search($value, $arr);
    if (!empty(CardModel::getAllDataby_id($key)) && $value != 0) {
        $mostsell = CardModel::getAllDataby_id($key)[0]['ca_value'];
        unset($arr);
    }
}
$all = $allsellmony + $inmony;
if ($all < $allmony) {
    $lose = $all - $allmony;
}
?>
<center> <button id="btn_2day" class="btn btn-success " onclick="show_special_gard()">جرد معين</button></center>
<center> <button id="btn_day" class="btn btn-success" onclick="show_day_gard()" style="display: none" onclick="show_special_gard()">جرد يومي</button></center>

<center>
    <div style="display: none" id="2day">
        <?php
        $datt = explode('-', $d1);
        $datt2 = explode('-', $d2);
        ?>
        <table ><tr>
                <td ><input class="form-control" value="<?= $datt[0] ?>" type="number" id="yb" /></td><td><h3>السنه</h3></td>
                <td ><input  class="form-control" value="<?= $datt[1] ?>" type="number" id="mb" /></td><td><h3>الشهر</h3></td>
                <td ><input class="form-control" value="<?= $datt[2] ?>" type="number" id="db" /></td><td><h3>اليوم</h3></td>
                <td>
                    <label style="margin-left: 10px; font-weight:bold;color: chocolate" class="control-label h3" > تاريخ البدايه</label>
                </td>
            </tr>
            <tr>
                <td ><input class="form-control" value="<?= $datt2[0] ?>" type="number" id="yn" /></td><td><h3>السنه</h3></td>
                <td ><input  class="form-control" value="<?= $datt2[1] ?>" type="number" id="mn" /></td><td><h3>الشهر</h3></td>
                <td ><input class="form-control" value="<?= $datt2[2] ?>" type="number" id="dn" /></td><td><h3>اليوم</h3></td>
                <td >
                    <label style="margin-left: 10px; font-weight:bold;color: chocolate" class="control-label h3" >تاريخ النهايه</label>
                </td>                        
            </tr>
        </table>
    </div>

<?php $datt = explode('-', $d1); ?>
    <table id="day">
        <tr>
            <td ><input class="form-control" value="<?= $datt[0] ?>" type="number" id="yd" /></td><td><h3>السنه</h3></td>
            <td ><input  class="form-control" value="<?= $datt[1] ?>" type="number" id="md" /></td><td><h3>الشهر</h3></td>
            <td ><input class="form-control" value="<?= $datt[2] ?>" type="number" id="dd" /></td><td><h3>اليوم</h3></td>
        </tr>
    </table>

    <br>
    <label>نوع البضاعه </label>
    <select class="field size1 form-control" id="pro" style="width: 200px;">
        <?php if ($_SESSION['pro'] == 'pro') { ?>
            <option value="pro" selected>المنتجات</option>
        <?php } else { ?>
            <option value="pro" >المنتجات</option>
        <?php } if ($_SESSION['pro'] == 'ch') { ?>
            <option value="ch" selected >الرصيد</option>
        <?php } else { ?>
            <option value="ch" >الرصيد</option>
        <?php } if ($_SESSION['pro'] == 'ca') { ?>
            <option value="ca" selected>الكروت</option>
        <?php } else { ?>
            <option value="ca" >الكروت</option>
<?php } ?>
    </select>
    <br>

    <input class="btn btn-primary" style="display: none" id="btn_search_2day" type="button" value="بحث" onclick="search_gard_2day()" />
    <input class="btn btn-primary" type="button" value="بحث"id="btn_search_day" onclick="search_gard()" />

</center>
<br>



<section>
    <center>
        <table class="">
            <tr>
                <td> <a class="btn btn-default" href="#goods"> شاهد</a></td>
                <td><input class="form-control" value="<?= $allmony ?>" type="number" style="width: 200px"  /></td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >: اجمالي البضائع قبل البيع</label></td>
            </tr>
            <tr>
                <td> <a class="btn btn-default" href="#sells"> شاهد</a></td>
                <td><input class="form-control" type="number" value="<?= $allsellmony ?>" style="width: 200px"  /></td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >: المبيعات</label></td>
            </tr>
            <tr>
                <td> <a class="btn btn-default" href="#in"> شاهد</a></td>
                <td><input class="form-control" type="number" value="<?= $inmony ?>" style="width: 200px"  /></td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >: باقي البضائع بعد البيع</label></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="form-control" type="number" value="<?= $allres ?>" style="width: 200px"  /></td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >: الارباح</label></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="form-control" type="number" value="<?= $lose ?>" style="width: 200px"  /></td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >: الخسائر</label></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="form-control" type="text" value="<?= $mostsell ?>" style="width: 200px"  /></td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >: الاكثر مبيعا</label></td>
            </tr>
        </table>   
    </center>
</section>




<div id="goods" class="modalDialog">
    <div>
        <a href="#" type="button" id="c"  title="closelogin" class="closee">X</a>
        <table class="table">
            <tr>
                <th>تاريخ ادخال الكارت </th>
                <th> المبلغ المدفوع</th>
                <th>الكميه</th>
                <th> قيمه الكارت</th>
                <th>  الشبكه</th>
                <th>#</th>
            </tr>
            <?php
            $i = 1;
            foreach ($cards as $c) {
                if (strtotime($c['ca_datetime']) <= $sd) {
                    $scards = SellcardModel::value_in_or_not($c['ca_net'], $c['ca_value']);
                    foreach ($scards as $sc) {
                        if (strtotime($sc['sc_datetime']) >= $fd && strtotime($sc['sc_datetime']) <= $sd) {
                            $num+=$sc['sc_num'];
                        }
                    }
                    ?>
                    <tr>
                        <td><?= $c['ca_datetime'] ?></td>
                        <td><?= $c['ca_cost'] ?></td>
                        <td><?= ($num + $c['ca_num']) ?></td>
                        <td><?= $c['ca_value'] ?></td>
                        <?php if ($c['ca_net'] == 1) { ?>
                            <td><label class="control-label" style="background-color: #ff0000">Vodafone</label></td>
                        <?php } elseif ($c['ca_net'] == 2) {
                            ?>
                            <td><label class="control-label" style="background-color: #ff9900">Orange</label></td>
                        <?php } elseif ($c['ca_net'] == 3) {
                            ?>
                            <td><label class="control-label" style="background-color: #339900">Etisalat</label></td>
                    <?php } ?>
                        <td><?= $i++ ?></td></tr>
                    <?php
                }
                $num = 0;
            }
            ?>
        </table>

    </div>
</div>
<div id="sells" class="modalDialog">
    <div>
        <a href="#" type="button" id="c"  title="closelogin" class="closee">X</a>
        <table class="table">
            <tr>
                <th>تاريخ ادخال الكارت </th>
                <th> المبلغ المدفوع</th>
                <th>الكميه</th>
                <th> قيمه الكارت</th>
                <th>  الشبكه</th>
                <th>#</th>
            </tr>
            <?php
            $i = 1;
            foreach ($cards as $c) {
                if (strtotime($c['ca_datetime']) <= $sd) {
                    $scards = SellcardModel::value_in_or_not($c['ca_net'], $c['ca_value']);
                    foreach ($scards as $sc) {
                        if (strtotime($sc['sc_datetime']) >= $fd && strtotime($sc['sc_datetime']) <= $sd) {
                            ?>
                            <tr>
                                <td><?= $sc['sc_datetime'] ?></td>
                                <td><?= $sc['sc_mony'] ?></td>
                                <td><?= ( $sc['sc_num']) ?></td>
                                <td><?= $sc['sc_value'] ?></td>
                                <?php if ($sc['sc_net'] == 1) { ?>
                                    <td><label class="control-label" style="background-color: #ff0000">Vodafone</label></td>
                                <?php } elseif ($sc['sc_net'] == 2) {
                                    ?>
                                    <td><label class="control-label" style="background-color: #ff9900">Orange</label></td>
                                <?php } elseif ($sc['sc_net'] == 3) {
                                    ?>
                                    <td><label class="control-label" style="background-color: #339900">Etisalat</label></td>
                            <?php } ?>
                                <td><?= $i++ ?></td></tr>
                            </tr>
                            <?php
                        }
                    }
                }
            }
            ?>
        </table>
    </div>
</div>

<div id="in" class="modalDialog">
    <div>
        <a href="#" type="button" id="c"  title="closelogin" class="closee">X</a>
        <table class="table">
            <tr>
                <th>تاريخ ادخال الكارت </th>
                <th> المبلغ المدفوع</th>
                <th>الكميه</th>
                <th> قيمه الكارت</th>
                <th>  الشبكه</th>
                <th>#</th>
            </tr>
            <?php
            $i = 1;
            foreach ($cards as $c) {
               
                    ?>
                    <tr>
                        <td><?= $c['ca_datetime'] ?></td>
                        <td><?= $c['ca_cost'] ?></td>
                        <td><?= ( $c['ca_num']) ?></td>
                        <td><?= $c['ca_value'] ?></td>
                        <?php if ($c['ca_net'] == 1) { ?>
                            <td><label class="control-label" style="background-color: #ff0000">Vodafone</label></td>
                        <?php } elseif ($c['ca_net'] == 2) {
                            ?>
                            <td><label class="control-label" style="background-color: #ff9900">Orange</label></td>
                        <?php } elseif ($c['ca_net'] == 3) {
                            ?>
                            <td><label class="control-label" style="background-color: #339900">Etisalat</label></td>
                    <?php } ?>
                        <td><?= $i++ ?></td></tr>
                    <?php
              
            }
            ?>
        </table>

    </div>
</div>








<script>
    function search_gard() {
        var yd = $("#yd").val(), md = $("#md").val(), dd = $("#dd").val();
        var pro = $("#pro").val();
        if (yd == "" || md == "" || dd == "") {
            alert("day null");
        } else {
            $.post("?rt=HomePage/gard", {yd: yd, md: md, dd: dd, pro: pro}, function (res) {
                if (res == 'ch') {
                    mido("?rt=HomePage/gard_charge");
                } else if (res == 'pro') {
                    mido("?rt=HomePage/gard");
                } else if (res == 'ca') {
                    mido("?rt=HomePage/gard_card");
                }
            });
        }
    }
    function search_gard_2day() {
        var yb = $("#yb").val(), mb = $("#mb").val(), db = $("#db").val();
        var yn = $("#yn").val(), mn = $("#mn").val(), dn = $("#dn").val();
        var pro = $("#pro").val();
        if ((yb == "" || mb == "" || db == "") || (yn == "" || mn == "" || dn == "")) {
            alert("2 day null");
        } else {
            $.post("?rt=HomePage/gard_2day", {yb: yb, mb: mb, db: db, yn: yn, mn: mn, dn: dn, pro: pro}, function (res) {
                if (res == 'ch') {
                    mido("?rt=HomePage/gard_charge");
                } else if (res == 'pro') {
                    mido("?rt=HomePage/gard");
                } else if (res == 'ca') {
                    mido("?rt=HomePage/gard_card");
                }
                setTimeout(function () {
                    show_special_gard();
                }, 100);
            });
        }
    }
    function show_special_gard() {
        $("#day").hide();
        $("#2day").show();
        $("#btn_search_day").hide();
        $("#btn_search_2day").show();
        $("#btn_2day").hide();
        $("#btn_day").show();
    }
    function show_day_gard() {
        $("#2day").hide();
        $("#day").show();
        $("#btn_search_day").show();
        $("#btn_search_2day").hide();
        $("#btn_day").hide();
        $("#btn_2day").show();
    }
</script>