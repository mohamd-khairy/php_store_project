<script src="<?= HostName . DS . 'jQuery/jquery.min.js' ?>"></script>
<script src="<?= HostName . DS . 'jQuery/main.js' ?>"></script>
<div id="welcome">
    <input onkeypress="return go(event);"  type="password" name="pass" id="pass" placeholder="ادخل كلمه السر" class="form-control"/>
</div>
<style>
    #welcome{
        background-image: url("<?= HostName ?>/images/7.jpg");
          width: 100%;height: 100%;
    }
    #pass{
        text-align: center;
        width: 50%;
        height: 5%;
        margin-left: 25%;
       margin-top: 25%;
    }
</style>
<script>
    function go(e) {
        e = e || window.event;
        if (e.keyCode == 13)
        {
            var m = document.getElementById("pass").value;
            if (m == '') {
                alert("ادخل كلمه السر ");
            } else {
                $.post("?rt=HomePage/login", {pass: m}, function (res) {
                    if (res == 'yes') {
                        window.location.href = "?rt=HomePage/index";
                    } else {
                        alert(res + " كلمه السر  خطأ");
                    }
                });
            }
        }
    }

</script>