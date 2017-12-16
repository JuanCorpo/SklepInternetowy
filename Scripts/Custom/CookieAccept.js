function CookieAccept() {
    var oDate = new Date();
    oDate.setTime(oDate.getTime() + (366 * 3600 * 24000));
    var sExpires = "expires=" + oDate.toGMTString();
    document.cookie = ("Cookie = true;" + sExpires + "; path=/");
}
