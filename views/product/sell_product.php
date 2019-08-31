<center ><h1  >بيع منتجــات</h1></center>


<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%;">
    <?php
    $cats = CatModel::getAllData_by_order_id('cat_id');
    ?>
    <label class="control-label pull-right" style="margin-top: 3%"> القسم</label>
    <select  class="form-control" id="cat_id" onchange="get_cat_product()" >
        <?php if (empty($cats)) { ?>
            <option value="0">لا يوجد اقسام</option>
            <?php
        } else {
            foreach ($cats as $cat) {
                ?>
                <option value="<?= $cat['cat_id'] ?>"><?= $cat['cat_name'] ?></option>
                <?php
            }
        }
        ?>
    </select>
</div>

<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%;">
    <label class="control-label pull-right" style="margin-top: 3%">المنتجات</label>
    <select  class="form-control" id="pro_id">
        <?php foreach ($_SESSION['product'] as $pro) {
            ?>
            <option value="<?= $pro['pro_id'] ?>" ><?= $pro['pro_name'] ?></option>
        <?php } ?>
    </select>
</div>
<div id="cat" style="display: none"><?php
    if (empty($_SESSION['cat_id'])) {
        echo 0;
    } else {
        echo count($cats) - $_SESSION['cat_id'];
    } unset($_SESSION['cat_id']);
    unset($_SESSION['product']);
    ?></div>

<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> الكميه </label>
    <input type="number" value="1" onblur="checkpro()" id="sp_num" class="form-control"  placeholder="اكتب عدد المنتج ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> المبلغ المدفوع  </label>
    <input type="text" id="sp_mony" class="form-control"  placeholder="ادخل المبلغ المدفوع ...">
</div>
<br>
<div>
    <button class="btn btn-success center-block" onclick="charge()">احــفــظ</button>
</div>
<script>
     function checkpro() {
        var pro_id = $("#pro_id").val(),sp_num=$("#sp_num").val();
        $.post("?rt=Product/checkpro", {pro_id: pro_id,sp_num:sp_num}, function (res) {
            if (res != 'true') {
                alert(res);
                $("#sp_num").val("");
            }
        });
    }
    function get_cat_product() {
        var cat_id = $("#cat_id").val();
        $.post("?rt=Product/getcatproduct", {cat_id: cat_id}, function (res) {
            mido("?rt=Product/sell");
        });
    }
    document.getElementById('cat_id').getElementsByTagName('option')[$("#cat").html()].selected = 'selected';

    function charge() {
        var sp_num = $("#sp_num").val(), sp_mony = $("#sp_mony").val(), pro_id = $("#pro_id").val();
        if (sp_num == null || sp_mony == null || pro_id == null) {
            alert("أدخل البيانات كامله !!");
        } else if (sp_num <= 0 || sp_mony <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else {
            $.post("?rt=Product/sell", {sp_num: sp_num, sp_mony: sp_mony, pro_id: pro_id}, function (res) {
                if (res == 'true') {
                    sp_num = $("#sp_num").val("1"), sp_mony = $("#sp_mony").val(""), pro_id = $("#pro_id").val("");
                }
            });
        }
    }
</script>