<style>
    input,th{
        text-align: center;
    }
</style>
<div id="btncharge" >
    <table   class="table"  style="margin-top: 3%">
        <tr>
            <th style="width: 5%" rowspan="9"></th>
            <th style="background-color: #00cc00">Etisalat</th>
            <th style="width: 5%" rowspan="9"></th>
            <th style="background-color: #ff9900">Mobinil</th>
            <th style="width: 5%" rowspan="9"></th>
            <th style="background-color: #ff0000">Vodafone</th>
            <th style="width: 5%" rowspan="9"></th>
        </tr>

        <tr>
            <?php
            // error_reporting(0);
            $chargev = ChargeModel::get_charge_vodafone();
            $chargem = ChargeModel::get_charge_mobinil();
            $chargee = ChargeModel::get_charge_etisalat();
            if (!empty($chargev)) {
                $chargev = $chargev[0];
            } else {
                $chargev['ch_charge'] = 0;
                $chargev['ch_mony'] = 0;
                $chargev['ch_datetime'] = 0;
            }if (!empty($chargem)) {
                $chargem = $chargem[0];
            } else {
                $chargem['ch_charge'] = 0;
                $chargem['ch_mony'] = 0;
                $chargem['ch_datetime'] = 0;
            }if (!empty($chargee)) {
                $chargee = $chargee[0];
            } else {
                $chargee['ch_charge'] = 0;
                $chargee['ch_mony'] = 0;
                $chargee['ch_datetime'] = 0;
            }


            $sell_chargeDatav = SellchargeModel::get_sell_mony_charge_vodafone();
            $sell_chargeDatae = SellchargeModel::get_sell_mony_charge_etisalat();
            $sell_chargeDatam = SellchargeModel::get_sell_mony_charge_mobinil();


            $mony_gete = (($sell_chargeDatae['sum'] + $chargee['ch_charge']) - $chargee['ch_mony']);
            $mony_getm = (($sell_chargeDatam['sum'] + $chargem['ch_charge']) - $chargem['ch_mony']);
            $mony_getv = (($sell_chargeDatav['sum'] + $chargev['ch_charge']) - $chargev['ch_mony']);
            ?>
            <td style="background-color: #cccccc"><input  type="hidden" id="char_e_charge" value="<?= $chargee['ch_charge'] ?>"/> <?= $chargee['ch_charge'] ?> جنيه<span class="pull-right">اجمالي الرصيد</span></td>
            <td style="background-color: #cccccc"><input type="hidden" id="char_m_charge" value="<?= $chargem['ch_charge'] ?>"/> <?= $chargem['ch_charge'] ?> جنيه<span class="pull-right">اجمالي الرصيد</span></td>
            <td style="background-color: #cccccc"><input type="hidden" id="char_v_charge" value="<?= $chargev['ch_charge'] ?>"/> <?= $chargev['ch_charge'] ?> جنيه <span class="pull-right">اجمالي الرصيد</span></td>
        </tr>
        <tr>
            <td>        <input type="hidden" id="ch_e_mony" value="<?= $chargee['ch_mony'] ?>"/>
                <?= $chargee['ch_mony'] ?> جنيه <span class="pull-right">اجمالي المصاريف</span></td>
            <td>        <input type="hidden" id="ch_m_mony" value="<?= $chargem['ch_mony'] ?>"/>
                <?= $chargem['ch_mony'] ?> جنيه<span class="pull-right">اجمالي المصاريف</span></td>
            <td>        <input type="hidden" id="ch_v_mony" value="<?= $chargev['ch_mony'] ?>"/>
                <?= $chargev['ch_mony'] ?> جنيه <span class="pull-right">اجمالي المصاريف</span></td>

        </tr>
        <tr>
            <td>        
                <?= $sell_chargeDatae['sum'] ?> جنيه <span class="pull-right">اجمالي  الايرادات</span></td>
            <td>       
                <?= $sell_chargeDatam['sum'] ?> جنيه<span class="pull-right">اجمالي الايرادات</span></td>
            <td>        
                <?= $sell_chargeDatav['sum'] ?> جنيه <span class="pull-right">اجمالي الايرادات</span></td>

        </tr>

        <tr>
            <td>        
                <?= $mony_gete ?> جنيه <span class="pull-right">اجمالي  الارباح</span></td>
            <td>       
                <?= $mony_getm ?> جنيه<span class="pull-right">اجمالي الارباح</span></td>
            <td>        
                <?= $mony_getv ?> جنيه <span class="pull-right">اجمالي الارباح</span></td>

        </tr>
        <tr>
            <td><?= date("d-m-Y h:i:s A", strtotime($chargee['ch_datetime'])) ?>  <span class="pull-right">تاريخ اخر شحنه </span></td>
            <td><?= date("d-m-Y h:i:s A", strtotime($chargem['ch_datetime'])) ?> <span class="pull-right"> تاريخ اخر شحنه </span></td>
            <td><?= date("d-m-Y h:i:s A", strtotime($chargev['ch_datetime'])) ?>  <span class="pull-right"> تاريخ اخر شحنه </span></td>

        </tr>

        <tr>
            <td><input style="width: 100%;height: 100%" type="text" id="char_e_value" placeholder="ادخل قيمه الشحن..."/> </td>
            <td><input style="width: 100%;height: 100%" type="text" id="char_m_value" placeholder="ادخل قيمه الشحن..."/> </td>
            <td><input style="width: 100%;height: 100%" type="text" id="char_v_value" placeholder="ادخل قيمه الشحن..."/> </td>
        </tr>

        <tr>
            <td><input style="width: 100%;height: 100%" type="text" id="char_e_mony" placeholder="ادخل مصاريف الشحن..."/> </td>
            <td><input style="width: 100%;height: 100%" type="text" id="char_m_mony" placeholder="ادخل مصاريف الشحن..."/> </td>
            <td><input style="width: 100%;height: 100%" type="text" id="char_v_mony" placeholder="ادخل مصاريف الشحن..."/> </td>
        </tr>

        <tr>
            <td><button onclick="chargeE()"  style="width: 100%;height: 100%">حفظ </button></td>
            <td><button onclick="chargeM()"  style="width: 100%;height: 100%">حفظ </button></td>
            <td><button onclick="chargeV()"  style="width: 100%;height: 100%">حفظ </button></td>
        </tr>
    </table>

</div>
<script>
    var ch_e_mony = $("#ch_e_mony").val(), ch_m_mony = $("#ch_m_mony").val(), ch_v_mony = $("#ch_v_mony").val(),
            char_e_charge = $("#char_e_charge").val(), char_m_charge = $("#char_m_charge").val(), char_v_charge = $("#char_v_charge").val();
    function chargeE() {

        var char_e_value = $("#char_e_value").val(),
                char_e_mony = $("#char_e_mony").val();
        if (char_e_value == null || char_e_mony == null) {
            alert("أدخل البيانات كامله !!");
        } else if (char_e_value <= 0 || char_e_mony <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else {
            $.post("?rt=Charge/new", {ch_net: 3, ch_mony1: char_e_mony, ch_mony2: ch_e_mony, ch_charge1: char_e_value, ch_charge2: char_e_charge}, function (res) {
                mido("?rt=Charge/charge");
            });
        }
    }
    function chargeM() {

        var char_m_value = $("#char_m_value").val(),
                char_m_mony = $("#char_m_mony").val();
        if (char_m_value == null || char_m_mony == null) {
            alert("أدخل البيانات كامله !!");
        } else if (char_m_value <= 0 || char_m_mony <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else {
            $.post("?rt=Charge/new", {ch_net: 2, ch_mony1: char_m_mony, ch_mony2: ch_m_mony, ch_charge1: char_m_value, ch_charge2: char_m_charge}, function (res) {
                mido("?rt=Charge/charge");
            });
        }
    }
    function chargeV() {

        var char_v_value = $("#char_v_value").val(),
                char_v_mony = $("#char_v_mony").val();
        if (char_v_value == null || char_v_mony == null) {
            alert("أدخل البيانات كامله !!");
        } else if (char_v_value <= 0 || char_v_mony <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else {
            $.post("?rt=Charge/new", {ch_net: 1, ch_mony1: char_v_mony, ch_mony2: ch_v_mony, ch_charge1: char_v_value, ch_charge2: char_v_charge}, function (res) {
                mido("?rt=Charge/charge");
            });
        }
    }
</script>