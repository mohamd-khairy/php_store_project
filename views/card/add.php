<style>
    input,th{
        text-align: center;
    }
</style>
<div id="btncharge"  >
    <table   class="table" style="margin-top: 3%">
        <tr>
            <th style="width: 5%" rowspan="6"></th>
            <th style="background-color: #00cc00">Etisalat</th>
            <th style="width: 5%" rowspan="6"></th>
            <th style="background-color: #ff9900">Mobinil</th>
            <th style="width: 5%" rowspan="6"></th>
            <th style="background-color: #ff0000">Vodafone</th>
            <th style="width: 5%" rowspan="6"></th>
        </tr>

        <tr>
            <td><input style="width: 100%;height: 100%" type="number" id="card_e_value" placeholder="ادخل قيمه الكارت..."/> </td>
            <td><input style="width: 100%;height: 100%" type="number" id="card_m_value" placeholder="ادخل قيمه الكارت  ..."/> </td>
            <td><input style="width: 100%;height: 100%" type="number" id="card_v_value" placeholder="ادخل قيمه الكارت ..."/> </td>

        </tr>

        <tr>
            <td><input style="width: 100%;height: 100%"  type="number" id="card_e_num" placeholder="ادخل عدد الكروت..."/> </td>
            <td><input style="width: 100%;height: 100%" type="number" id="card_m_num" placeholder="ادخل عدد الكروت..."/> </td>
            <td><input style="width: 100%;height: 100%" type="number" id="card_v_num" placeholder="ادخل عدد الكروت..."/> </td>
        </tr>

        <tr>
            <td><input style="width: 100%;height: 100%" type="number" id="card_e_price" placeholder="ادخل سعر البيع ..."/> </td>
            <td><input style="width: 100%;height: 100%" type="number" id="card_m_price" placeholder="ادخل سعر البيع ..."/> </td>
            <td><input style="width: 100%;height: 100%" type="number" id="card_v_price" placeholder="ادخل سعر البيع  ..."/> </td>
        </tr>
        <tr>
            <td><input style="width: 100%;height: 100%" type="number" id="card_e_cost" placeholder="ادخل المبلغ المدفوع ..."/> </td>
            <td><input style="width: 100%;height: 100%" type="number" id="card_m_cost" placeholder="ادخل المبلغ المدفوع ..."/> </td>
            <td><input style="width: 100%;height: 100%" type="number" id="card_v_cost" placeholder="ادخل المبلغ المدفوع  ..."/> </td>
        </tr>

        <tr>
            <td><button onclick="cardE()"  style="width: 100%;height: 100%">حفظ </button></td>
            <td><button onclick="cardM()"  style="width: 100%;height: 100%">حفظ </button></td>
            <td><button onclick="cardV()"  style="width: 100%;height: 100%">حفظ </button></td>
        </tr>
    </table>

</div>

<script>
    function cardE() {

        var card_e_num = $("#card_e_num").val(),
                card_e_price = $("#card_e_price").val(), card_e_cost = $("#card_e_cost").val(), card_e_value = $("#card_e_value").val();
        if (card_e_num == null || card_e_price == null || card_e_cost == null || card_e_value == null) {
            alert("أدخل البيانات كامله !!");
        } else if (card_e_num <= 0 || card_e_price <= 0 || card_e_cost <= 0 || card_e_value <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else {
            $.post("?rt=Card/new", {ca_net: 3, ca_value: card_e_value, ca_price1: card_e_price, ca_cost1: card_e_cost, ca_num1: card_e_num}, function (res) {
                $("#card_e_num").val("");
                $("#card_e_cost").val("");
                $("#card_e_price").val("");
                $("#card_e_value").val("");

            });
        }
    }
    function cardM() {

        var card_m_num = $("#card_m_num").val(),
                card_m_price = $("#card_m_price").val(), card_m_cost = $("#card_m_cost").val(), card_m_value = $("#card_m_value").val();
        if (card_m_num == null || card_m_cost == null || card_m_price == null || card_m_value == null) {
            alert("أدخل البيانات كامله !!");
        } else if (card_m_num <= 0 || card_m_cost <= 0 || card_m_price <= 0 || card_m_value <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else {
            $.post("?rt=Card/new", {ca_net: 2, ca_value: card_m_value, ca_cost1: card_m_cost, ca_price1: card_m_price, ca_num1: card_m_num}, function (res) {
                $("#card_m_num").val("");
                $("#card_m_price").val("");
                $("#card_m_cost").val("");
                $("#card_m_value").val("");

            });
        }
    }
    function cardV() {

        var card_v_num = $("#card_v_num").val(),
                card_v_cost = $("#card_v_cost").val(), card_v_price = $("#card_v_price").val(),
                card_v_value = $("#card_v_value").val();
        if (card_v_num == null || card_v_cost == null || card_v_price == null || card_v_value == null) {
            alert("أدخل البيانات كامله !!");
        } else if (card_v_num <= 0 || card_v_cost <= 0 || card_v_price <= 0 || card_v_value <= 0) {
            alert("أدخل البيانات صحيحه !!");
        } else {
            $.post("?rt=Card/new", {ca_net: 1, ca_value: card_v_value, ca_cost1: card_v_cost, ca_price1: card_v_price, ca_num1: card_v_num}, function (res) {
                $("#card_v_num").val("");
                $("#card_v_cost").val("");
                $("#card_v_price").val("");
                $("#card_v_value").val("");
            });
        }
    }
</script>