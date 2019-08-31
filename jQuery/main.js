//window.setInterval('refresh()', 0.1);
//function refresh() {
//    document.getElementById("date").innerHTML = "<center>" + new Date().toLocaleString() + "</center>";
//}


function go(page) {
    $.post("?rt=HomePage/go", {page: page}, function (res) {
        window.location.href = '?rt=Charge/convert';
    });
}


function end() {
    $("#case").hide();
}

function mido(path) {
    $("#case").load(path);
}
function mizo(path) {
    $("#mizo").load(path);
}
function ChangeUrl(page, url) {
    if (typeof (history.pushState) != "undefined") {
        var obj = {Page: page, Url: url};
        history.pushState(obj, obj.Page, obj.Url);
    } else {
        window.location.href = "index.php";
        // alert("Browser does not support HTML5.");
    }
}
    