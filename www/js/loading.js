//window.onload = function () { alert("It's loaded!") }

$(window).on("load",function(){
    //alert("It's loaded!");
    $(".loading-wrapper").fadeOut("slow");
    $("body").style.overflow = "auto";
    //$(".wrapper").fadeIn("slow");
});