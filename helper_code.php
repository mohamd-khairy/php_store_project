<meta  name="_token" content="{!!csrf_token()!!}" />
$.ajaxSetup({
	headers:{
            'X-CSRF-TOKEN':$('meta[name="_token"]').attr("content")
	}
})



//moadal
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Basic Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>
//////////////////////////////////////////////////




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
            error_reporting(0);

<style type="text/css">

    .modalDialog {
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

<div id="absent" class="modalDialog">
    <div>
        <a href="#" title="closelogin" class="closee">X</a>
        <!--              ##code-->
    </div>
</div>



<script type="text/javascript">
    
        document.getElementById('sc_net').getElementsByTagName('option')[<?= $_SESSION['net'] ?>].selected = 'selected';
<?php unset($_SESSION['net']); ?>

    
     setTimeout(function () {
                    show_special_gard();
                }, 100);
                
                
                
    
     SelectElement(<?= $_SESSION['net'] ?>);
<?php unset($_SESSION['net']); ?>
    function SelectElement(valueToSelect)
    {
        var element = document.getElementById('sc_net');
        element.value = valueToSelect;
    }
    
    var arr = new Array();
    arr[arr.length] = input;

    function include(arr, obj) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i] == obj)
                return true;
        }
    }
    window.localStorage.setItem("contact_id", JSON.stringify(arr));
var cart = JSON.parse(localStorage.getItem('cart'));


    function ChangeUrl(page, url) {
        if (typeof (history.pushState) != "undefined") {
            var obj = {Page: page, Url: url};
            history.pushState(obj, obj.Page, obj.Url);
        } else {
            window.location.href = "index.php";
            // alert("Browser does not support HTML5.");
        }
    }
    function mido_get(true_path, fake_path) {
        $("#mizo").load(true_path);
        ChangeUrl('Page1', fake_path);
    }

    function mido(path) {
        $("#mizo").load(path);
        ChangeUrl('Page1', path);
    }

    function onReady(callback) {
        var intervalID = window.setInterval(checkReady, 500);
        function checkReady() {
            if (document.getElementsByTagName('body')[0] !== undefined) {
                window.clearInterval(intervalID);
                callback.call(this);
            }
        }
    }

    function show(id, value) {
        document.getElementById(id).style.display = value ? 'block' : 'none';
    }

    onReady(function () {
        show('mizo', true);
        show('loading', false);
    });
</script>





<!--spinner-->
<style type="text/css">
    #mizo {
        display: none;
    }
    #loading {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100vw;
        height: 100vh;
        background-color: rgba(192, 192, 192, 0.5);
        background-image: url("http://i.stack.imgur.com/MnyxU.gif");
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
<div id="loading"></div>




