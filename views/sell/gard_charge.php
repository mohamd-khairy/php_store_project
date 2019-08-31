<style>
    .title {
        clear: both;
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
        padding: 10px;
        width: 70px;
        font-weight: bold;
        color: black;
    }
</style>
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
$sum = 0;

function calc($net, $fd, $sd, $sum) {
    $charge = ChargeModel::value_in_or_not($net);
    $charge_v = SellchargeModel::value_in_or_not($net);
    foreach ($charge_v as $chv) {
        if (strtotime($chv['sch_datetime']) >= $fd && strtotime($chv['sch_datetime']) <= $sd) {
            $sum+=$chv['sch_value'];
        }
    }
    echo ($sum + $charge[0]['ch_charge']);
}

function calc_sells($net, $fd, $sd, $sum) {
    $charge_v = SellchargeModel::value_in_or_not($net);
    foreach ($charge_v as $chv) {
        if (strtotime($chv['sch_datetime']) >= $fd && strtotime($chv['sch_datetime']) <= $sd) {
            $sum+=$chv['sch_value'];
        }
    }
    echo ($sum );
}

function calc_mony($net, $fd, $sd, $sum) {
    $charge_v = SellchargeModel::value_in_or_not($net);
    foreach ($charge_v as $chv) {
        if (strtotime($chv['sch_datetime']) >= $fd && strtotime($chv['sch_datetime']) <= $sd) {
            $sum+=$chv['sch_mony'] - $chv['sch_value'];
        }
    }
    echo ($sum );
}

function calc_in($net) {
    echo ChargeModel::value_in_or_not($net)[0]['ch_charge'];
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
        <table>
               <tr>
                <?php
                $chargev = ChargeModel::get_charge_vodafone();
                $chargem = ChargeModel::get_charge_mobinil();
                $chargee = ChargeModel::get_charge_etisalat();
                ?>
                <td><input class="form-control title" value="<?= $chargev[0]['ch_mony'] ?>" type="number" style="background-color: #ff0000;"  />
                    <input class="form-control title" value="<?= $chargem[0]['ch_mony'] ?>" type="number" style="background-color: #ff9900;"  />
                    <input class="form-control title" value="<?= $chargee[0]['ch_mony'] ?>" type="number" style="background-color: #339900;"  />
                </td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >:اجمالي المصاريف</label></td>
            </tr>
            <tr >
                <td><input class="form-control title" value="<?= calc(1, $fd, $sd, $sum) ?>" type="number" style="background-color: #ff0000;"  />
                    <input class="form-control title" value="<?= calc(2, $fd, $sd, $sum) ?>" type="number" style="background-color: #ff9900;"  />
                    <input class="form-control title" value="<?= calc(3, $fd, $sd, $sum) ?>" type="number" style="background-color: #339900;"  />
                </td>
                <td>  <label style=" font-weight:bold;color: #2b542c;" class="control-label h4" >: اجمالي البضائع قبل البيع</label></td>
            </tr>
            <tr>
                <td><input class="form-control title" value="<?= calc_sells(1, $fd, $sd, $sum) ?>" type="number" style="background-color: #ff0000;"  />
                    <input class="form-control title" value="<?= calc_sells(2, $fd, $sd, $sum) ?>" type="number" style="background-color: #ff9900;"  />
                    <input class="form-control title" value="<?= calc_sells(3, $fd, $sd, $sum) ?>" type="number" style="background-color: #339900;"  />
                </td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >: المبيعات</label></td>
            </tr>
            <tr>
                <td><input class="form-control title" value="<?= calc_in(1) ?>" type="number" style="background-color: #ff0000;"  />
                    <input class="form-control title" value="<?= calc_in(2) ?>" type="number" style="background-color: #ff9900;"  />
                    <input class="form-control title" value="<?= calc_in(3) ?>" type="number" style="background-color: #339900;"  />
                </td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >: باقي البضائع بعد البيع</label></td>
            </tr>
         
            <tr>
                <td><input class="form-control title" value="<?= calc_mony(1, $fd, $sd, $sum) ?>" type="number" style="background-color: #ff0000;"  />
                    <input class="form-control title" value="<?= calc_mony(2, $fd, $sd, $sum) ?>" type="number" style="background-color: #ff9900;"  />
                    <input class="form-control title" value="<?= calc_mony(3, $fd, $sd, $sum) ?>" type="number" style="background-color: #339900;"  />
                </td>
                <td>  <label style=" font-weight:bold;color: #2b542c" class="control-label h4" >: الارباح</label></td>
            </tr>
           
        </table>   
    </center>
</section>

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