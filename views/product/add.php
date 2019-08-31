
<center>  <a  href="#catt" style="margin-top: -1%" class="col-lg-offset-5  col-sm-2  btn btn-danger" onclick="">اضافه قسم </a>
</center>
<!-- Modal -->
<div id="catt" class="modalDialog">
    <div>
        <a href="#" type="button" id="c"  title="closelogin" class="closee">X</a>
        <button type="button" onclick="savecat()" style="margin-top: 2%;margin-left: 5%;" class="btn btn-primary  col-sm-2 " >حــفظ</button>
                <div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
                    <label class="control-label pull-right"> القسم </label>
                    <input type="text" id="cat_name" class="form-control"  placeholder="اكتب  اسم القسم ...">
                </div>
    </div>
</div>






<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%;">
    <?php
    $cats = CatModel::getAllData_by_order_id('cat_id');
    ?>
    <label class="control-label pull-right" style="margin-top: 3%"> القسم</label>
    <select  class="form-control" id="cat_id">
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

<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> المنتج </label>
    <input type="text" id="pro_name" class="form-control"  placeholder="اكتب  اسم المنتج ...">
</div>
<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">الكميه </label>
    <input type="number" value="1" id="pro_num"  class="form-control"  placeholder="ادخل  عدد المنتج ...">
</div>
<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> سعر المنتج  </label>
    <input type="text" id="pro_cost" class="form-control"  placeholder="ادخل المبلغ المدفوع ...">
</div>
<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> سعر البيع  </label>
    <input type="text" id="pro_price" class="form-control"  placeholder="ادخل سعر البيع ...">
</div>
<br>
<div>
    <button class="btn btn-success center-block" onclick="savepro()">حــفــظ</button>
</div>
<script>
  
    function savepro() {
        var cat_id = $("#cat_id").val(), pro_name = $("#pro_name").val(), pro_cost = $("#pro_cost").val()
                , pro_price = $("#pro_price").val(), pro_num = $("#pro_num").val();
        if (cat_id == null || pro_name == null || pro_cost == null || pro_price == null || pro_num == null) {
            alert("أدخل البيانات كامله !!");
        } else if (pro_price <= 0 || pro_cost <= 0 || pro_num <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else {
            $.post("?rt=Product/savepro", {cat_id: cat_id, pro_price: pro_price, pro_num: pro_num
                , pro_cost: pro_cost, pro_name: pro_name}, function (res) {
                if (res == 'true') {
                    pro_name = $("#pro_name").val(""), pro_cost = $("#pro_cost").val(""), pro_price = $("#pro_price").val("")
                            , pro_num = $("#pro_num").val("1");
                }
            });
        }
    }
    function savecat() {
        var cat_name = $("#cat_name").val();
        if (cat_name == "") {
            alert("أدخل البيانات كامله !!");
        } else {
            $.post("?rt=Category/savecat", {cat_name: cat_name}, function (res) {
                if (res == 'true') {
                    document.getElementById('c').click();
                        mido('?rt=Product/show');
                }
            });
        }
    }
</script>