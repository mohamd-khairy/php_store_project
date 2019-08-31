<style>.modalDialog {
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.8);
        z-index: 99999;
        opacity:0;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        pointer-events: none;
    }
    .modalDialog:target {
        opacity:1;
        pointer-events: auto;
    }

    .modalDialog > div {
        width: 400px;
        position: relative;
        margin:10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        background: #fff;
        background: -moz-linear-gradient(#fff, #999);
        background: -webkit-linear-gradient(#fff, #999);
        background: -o-linear-gradient(#fff, #999);
    }
    .closee {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        right: -12px;
        text-align: center;
        top: -10px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }

    .closee:hover { background: #00d9ff; }
    /*    -webkit-transition: opacity 400ms ease-in;*/
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
</style>

<th  rowspan="3" style="width: 5%;">
    <button onclick="mido('?rt=HomePage/all_sells')"  style="width: 100%;height: 25%"> المبيعات </button>
    <button onclick="mido('?rt=Charge/convert')"  style="width: 100%;height: 25%">تحويل رصيد </button>
    <button onclick="mido('?rt=Card/sell')" style="width: 100%;height: 25%">بيع كروت</button>
    <button onclick="mido('?rt=Product/sell')"  style="width: 100%;height: 24.8%">بيع منتجات</button>
</th>
