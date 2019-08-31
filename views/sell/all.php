<style>
    #sell {
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
    }
    #s{
        height: 500px;
        overflow: auto;
    }
    th{        text-align: center;
    }
    #th{
        background-color: #999999;
        text-align: center;

    }
    input{
        width: 80px;
        height: 50px;
        text-align: center;
    }
</style><center><table>
        <tr>
            <?php
            $datt=array();
            if (!empty($_SESSION['date'])) {
                $datt = explode('-', $_SESSION['date']);
            }
            ?>
            <td><input type="button" value="بحث" onclick="get_date()" /></td>
            <td  ><input type="number" id="y" value="<?= $datt[0] ?>" placeholder="..."/></td><td><h3>السنه</h3></td>
            <td ><input type="number" id="m"  value="<?= $datt[1] ?>" placeholder="..."/></td><td><h3>الشهر</h3></td>
            <td ><input type="number" id="d" value="<?= $datt[2] ?>" placeholder="..."/></td><td><h3>اليوم</h3></td>

        </tr></table></center><br>
<script>
    function get_date() {
        var d = $("#d").val(), m = $("#m").val(), y = $("#y").val();
        $.post("?rt=HomePage/get_date", {y: y, m: m, d: d}, function (res) {
            mido('?rt=HomePage/all_sells');
        });
    }
</script>
<?php
if (!empty($_SESSION['date'])) {
    $d = $_SESSION['date'];
    unset($_SESSION['date']);
} else {
    $d = 'Y-m-d';
}
$i1 = 1;
$i2 = 1;
$i = 1;
$f = strtotime(date("$d 00:00:00 "));
$s = strtotime(date("$d 24:00:00 "));
$card = SellProductModel::get_card_sells();
$charge = SellProductModel::get_charge_sells();
$pro = SellProductModel::get_product_sells();
?>
<div class="col-lg-4 col-xs-6 " ><table class="table" id="sell" border="1" id="s">
        <tr><td colspan="6" style="background-color: #efa10e"> المنتجات المباعه</td></tr>
        <tr id="th">
            <th>الوقت</th>
            <th>المبلغ</th>
            <th>القيمه</th>
            <th>العدد</th>
            <th>المنتج</th>
            <th>#</th>
        </tr>
        <?php
        foreach ($pro as $p) {
            if ((strtotime($p['sp_datetime']) >= $f && strtotime($p['sp_datetime']) <= $s)) {
                ?>
                <tr>
                    <td><?= date('d-m h:i', strtotime($p['sp_datetime'])) ?></td>
                    <td><?= $p['pro_price'] ?>جنيه</td>
                    <td><?= $p['pro_cost'] ?></td>
                    <td><?= $p['sp_num'] ?></td>
                    <td><?= $p['pro_name'] ?></td>
                    <td><?= $i++; ?></td>
                </tr>
                <?php
            }
        }
        ?>

    </table>
</div>
<div class="col-lg-4 col-xs-6 " id="s"><table class="table" id="sell" border="1">
        <tr><td colspan="6" style="background-color: #efa10e">بــيع كــــروت</td></tr>

        <tr id="th">
            <th>الوقت</th>      
            <th>المبلغ</th>     
            <th>العدد</th>
            <th>القيمه</th>
            <th>الشبكه</th>
            <th>#</th>

        </tr>
        <?php
        foreach ($card as $p) {
            if (strtotime($p['sc_datetime']) >= $f && strtotime($p['sc_datetime']) <= $s) {
                ?>
                <tr>
                    <td><?= date('d-m h:i ', strtotime($p['sc_datetime'])) ?></td>
                    <td>جنيه<?= $p['sc_mony'] ?></td>
                    <td><?= $p['sc_num'] ?></td>
                    <td><?= $p['sc_value'] ?></td>
                    <?php
                    if ($p['sc_net'] == 1) {
                        echo '<td style="background-color: #ef0d0d">Vodafone</td>';
                    } elseif ($p['sc_net'] == 2) {
                        echo '<td style="background-color: #ff9900">mobinil</td>';
                    } else {
                        echo '<td style="background-color: #00cc00">etisalat</td>';
                    }
                    ?>
                    <td><?= $i1++; ?></td>

                </tr>
                <?php
            }
        }
        ?>

    </table>
</div>
<div class="col-lg-4 col-xs-6" id="s"><table class="table" id="sell" border="1">
        <tr><td colspan="6" style="background-color: #efa10e">تحــويــل رصــيــد</td></tr>
        <tr id="th">
            <th>الوقت</th>
            <th>الرقم</th> 
            <th>المبلغ</th>
            <th>القيمه</th>
            <th>الشبكه</th>
            <th>#</th>

        </tr>
        <?php
        foreach ($charge as $p) {
            if (strtotime($p['sch_datetime']) >= $f && strtotime($p['sch_datetime']) <= $s) {
                ?>
                <tr>
                    <td><?= date('d-m h:i ', strtotime($p['sch_datetime'])) ?></td>
                    <td><?= $p['sch_mobile'] ?></td>
                    <td><?= $p['sch_mony'] ?>جنيه</td>
                    <td><?= $p['sch_value'] ?></td>
                    <?php
                    if ($p['sch_net'] == 1) {
                        echo '<td style="background-color: #ef0d0d">Vodafone</td>';
                    } elseif ($p['sch_net'] == 2) {
                        echo '<td style="background-color: #ff9900">mobinil</td>';
                    } else {
                        echo '<td style="background-color: #00cc00">etisalat</td>';
                    }
                    ?>                <td><?= $i2++; ?></td>

                </tr>

                <?php
            }
        }
        ?>
    </table>
</div>