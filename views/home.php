
<center>

    <table id="product" class="table"   style="width: 70%">
        <!--            product-->
        <td ><input class="form-control" placeholder="ادخل اسم المنتج ...."  type="text" id="s_name" />
        </td>
        <td><label>اسم المنتج</label></td>
    </table>


    <input class="btn btn-primary" onclick="search_pro()" type="button" value="بحث"id="btn_search_pro" style="width: 20%" />

</center>
<br>
<script>

    function search_pro() {
        var s_name = $("#s_name").val();
        if (s_name == '' || !isNaN(s_name)) {
            alert("ادخل البيانات كامله ..")
        } else {
            $.post("?rt=HomePage/search", {s_name: s_name}, function (res) {
                mido("?rt=HomePage/search");
                setTimeout(function () {
                    $("#res_pro").show();
                }, 100);

            });
        }
    }

</script>


<style>
    td{
        background-color: #888;
    }
</style>
<center>
    <table class="table" style="width: 70%;font-weight: bold;display: none" id="res_pro">
        <?php
        if (!empty($_SESSION['data'])) {
            $res = $_SESSION['data'][0];
            ?>
            <tr>
                <th>تاريخ ادخال المنتج </th>
                <th>سعر البيع</th>
                <th>تكلفه المنتج</th>
                <th>الكميه</th>
                <th>اسم المنتج</th>
            </tr>

            <tr>
                <td><?= date('Y-m-d h:i', strtotime($res['pro_datetime'])) ?></td>
                <td><?= $res['pro_price'] ?>جنيه</td>
                <td><?= $res['pro_cost'] ?></td>
                <td><?= ($res['pro_num']) ?></td>
                <td><?= $res['pro_name'] ?></td>
            </tr>
<?php } ?>
    </table>

</center>