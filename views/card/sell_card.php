
<center ><h1 >بيع كروت</h1></center>

<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%;">
    <label class="control-label pull-right" style="margin-top: 3%"> الــشبكــه</label>
    <select id="sc_net" onchange="getcardnumber()"  class="form-control" >
        <option value="0">اختر شبكه</option>
        <option value="1" style="background-color: #ff0000">Vodafone</option>
        <option value="2" style="background-color: #ff9900">Mobinil</option>
        <option value="3" style="background-color: #339900">Etisalat</option>
    </select>
</div>

<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%;">
    <label class="control-label pull-right"> الـكـارت</label>


    <select  class="form-control" id="sc_value">
        <?php foreach ($_SESSION['data'] as $c) { ?>
            <option value="<?= $c ?>"><?= $c ?></option>
        <?php }unset($_SESSION['data']); ?>

    </select>
    <div id="net" style="display: none"><?php
        if (empty($_SESSION['net'])) {
            echo 0;
        } else {
            echo $_SESSION['net'];
        } unset($_SESSION['net']);
        ?></div>
</div>
<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">عدد الكروت </label>
    <input type="text" id="sc_num"  onblur="checkCard()" class="form-control"  value="1" placeholder="ادحل عدد الكروت ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> المبلغ المدفوع  </label>
    <input type="text" id="sc_mony" class="form-control"  placeholder="ادخل المبلغ المدفوع ...">
</div>
<br>
<div>
    <button class="btn btn-success center-block" onclick="sellCard()">احــفــظ</button>
</div>
<script>
    function checkCard() {
        var sc_net = $("#sc_net").val(), sc_value = $("#sc_value").val(), sc_num = $("#sc_num").val();
        $.post("?rt=Card/checkcard", {sc_net: sc_net, sc_value: sc_value, sc_num: sc_num}, function (res) {
            if (res != 'true') {
                alert(res);
                $("#sc_num").val("");
            }
        });
    }

    function sellCard() {
        var sc_net = $("#sc_net").val(), sc_mony = $("#sc_mony").val(), sc_value = $("#sc_value").val()
                , sc_num = $("#sc_num").val();
        if (sc_net == null || sc_mony == null || sc_value == null || sc_num == null) {
            alert("أدخل البيانات كامله !!");
        } else if (sc_num <= 0 || sc_net <= 0 || sc_value <= 0 || sc_mony <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else {
            $.post("?rt=Card/sell", {sc_net: sc_net, sc_mony: sc_mony, sc_value: sc_value, sc_num: sc_num}, function (res) {
                sc_mony = $("#sc_mony").val("");
            });
        }
    }
    function getcardnumber() {
        var sc_net = $("#sc_net").val();
        $.post("?rt=Card/getcardnum", {sc_net: sc_net}, function (res) {
            mido("?rt=Card/sell");
        });
    }
    document.getElementById('sc_net').getElementsByTagName('option')[$("#net").html()].selected = 'selected';
</script>