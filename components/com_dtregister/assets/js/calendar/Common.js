try { document.execCommand("BackgroundImageCache", false, true); } catch (e) { }
var popUpWin;
function PopUpCenterWindow(URLStr, width, height, newWin, scrollbars) {
    var popUpWin = 0;
    if (typeof (newWin) == "undefined") {
        newWin = false;
    }
    if (typeof (scrollbars) == "undefined") {
        scrollbars = 0;
    }
    if (typeof (width) == "undefined") {
        width = 800;
    }
    if (typeof (height) == "undefined") {
        height = 600;
    }
    var left = 0;
    var top = 0;
    if (screen.width >= width) {
        left = Math.floor((screen.width - width) / 2);
    }
    if (screen.height >= height) {
        top = Math.floor((screen.height - height) / 2);
    }
    if (newWin) {
        open(URLStr, '', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=' + scrollbars + ',resizable=yes,copyhistory=yes,width=' + width + ',height=' + height + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        return;
    }

    if (popUpWin) {
        if (!popUpWin.closed) popUpWin.close();
    }
    popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=' + scrollbars + ',resizable=yes,copyhistory=yes,width=' + width + ',height=' + height + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
    popUpWin.focus();
}

function OpenModelWindow(url, option) {
    var fun;
    try {
        if (parent != null && parent.DTjQuery != null && parent.DTjQuery.ShowIfrmDailog != undefined) {
            fun = parent.DTjQuery.ShowIfrmDailog
        }
        else {
            fun = DTjQuery.ShowIfrmDailog;
        }
    }
    catch (e) {
        fun = DTjQuery.ShowIfrmDailog;
    }
    fun(url, option);
}
function CloseModelWindow(callback, dooptioncallback) {
    parent.DTjQuery.closeIfrm(callback, dooptioncallback);
}


function StrFormat(temp, dataarry) {
    return temp.replace(/\{([\d]+)\}/g, function(s1, s2) { var s = dataarry[s2]; if (typeof (s) != "undefined") { if (s instanceof (Date)) { return s.getTimezoneOffset() } else { return encodeURIComponent(s) } } else { return "" } });
}
function StrFormatNoEncode(temp, dataarry) {
    return temp.replace(/\{([\d]+)\}/g, function(s1, s2) { var s = dataarry[s2]; if (typeof (s) != "undefined") { if (s instanceof (Date)) { return s.getTimezoneOffset() } else { return (s); } } else { return ""; } });
}
function getiev() {
    var userAgent = window.navigator.userAgent.toLowerCase();
    DTjQuery.browser.msie8 = DTjQuery.browser.msie && /msie 8\.0/i.test(userAgent);
    DTjQuery.browser.msie7 = DTjQuery.browser.msie && /msie 7\.0/i.test(userAgent);
    DTjQuery.browser.msie6 = !DTjQuery.browser.msie8 && !DTjQuery.browser.msie7 && DTjQuery.browser.msie && /msie 6\.0/i.test(userAgent);
    var v;
    if (DTjQuery.browser.msie8) {
        v = 8;
    }
    else if (DTjQuery.browser.msie7) {
        v = 7;
    }
    else if (DTjQuery.browser.msie6) {
        v = 6;
    }
    else { v = -1; }
    return v;
}
DTjQuery(document).ready(function() {
    var v = getiev()
    if (v > 0) {
        DTjQuery(document.body).addClass("ie ie" + v);
    }

});
