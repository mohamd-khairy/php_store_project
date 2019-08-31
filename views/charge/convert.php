<center   ><h1  > تحويــل رصيد</h1></center>

<?php
$chargev = ChargeModel::get_charge_vodafone();
$chargem = ChargeModel::get_charge_mobinil();
$chargee = ChargeModel::get_charge_etisalat();
if (!empty($chargev)) {
    $chargev = $chargev[0];
} else {
    $chargev['ch_charge'] = 0;
}if (!empty($chargem)) {
    $chargem = $chargem[0];
} else {
    $chargem['ch_charge'] = 0;
}if (!empty($chargee)) {
    $chargee = $chargee[0];
} else {
    $chargee['ch_charge'] = 0;
}
?>
<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%;">
    <label class="control-label pull-right" style="margin-top: 3%"> الــشبكــه</label>
    <select  class="form-control" id="sch_net">
        <?php if ($chargev['ch_charge'] != 0) { ?>
            <option value="1" style="background-color: #ff0000">Vodafone</option>
        <?php }if ($chargem['ch_charge'] != 0) { ?>
            <option value="2" style="background-color: #ff9900">Mobinil</option>
        <?php }if ($chargee['ch_charge'] != 0) { ?>
            <option value="3" style="background-color: #339900">Etisalat</option>
        <?php } ?>
    </select>
</div>

<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">رقم الموبايل </label>
    <input type="number" id="sch_mobile" class="form-control"  placeholder="اكتب رقم الموبايل ...">
</div>
<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> قيمه الشحن </label>
    <input type="number" id="sch_value" onblur="checkCharge()" class="form-control"  placeholder="ادخل قيمه الشحن ...">
</div>
<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> المبلغ المدفوع  </label>
    <input type="text" id="sch_mony" class="form-control"  placeholder="ادخل المبلغ المدفوع ...">
</div>
<br>
<div>
    <button class="btn btn-success center-block" onclick="charge()">احــفــظ</button>
</div>
<script>
      function checkCharge() {
        var sch_net = $("#sch_net").val(), sch_value = $("#sch_value").val();
        $.post("?rt=Charge/checkcharge", {sch_net: sch_net, sch_value: sch_value}, function (res) {
            if (res != 'true') {
                $("#sch_value").val("");
            }
        });
    }
    function charge() {
        var sch_net = $("#sch_net").val(), sch_mobile = $("#sch_mobile").val(), sch_value = $("#sch_value").val()
                , sch_mony = $("#sch_mony").val();
        var mobile_net = sch_mobile.substr(0, 3);
        if (sch_net == null || sch_mobile == null || sch_value == null || sch_mony == null) {
            alert("أدخل البيانات كامله !!");
        } else if (sch_mony <= 0 || sch_value <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else if (sch_mobile.length != 11) {
            alert("الموبايل الذي ادخلته غير صحيح !!");
        } else if (sch_net == 1 && mobile_net != '010') {
            alert("هذا الرقم لا ينتمي لشبكه فودافون !!");
        } else if (sch_net == 2 && mobile_net != '012') {
            alert("هذا الرقم لا ينتمي لشبكه موبينيل !!");
        } else if (sch_net == 3 && mobile_net != '011') {
            alert("هذا الرقم لا ينتمي لشبكه اتصالات !!");
        } else {
            $.post("?rt=Charge/convert", {sch_net: sch_net, sch_mobile: sch_mobile, sch_value: sch_value
                , sch_mony: sch_mony}, function (res) {
                if (res == 'true') {
                    sch_mobile = $("#sch_mobile").val(""), sch_value = $("#sch_value").val("")
                            , sch_mony = $("#sch_mony").val("");
                }
            });
        }
    }
</script>