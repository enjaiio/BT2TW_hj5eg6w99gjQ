$(document).ready(function(){
    //按按鈕有反應
    $("input").click(function(){
        //alert("Hi");
        //$("H1").text($("li").eq(1).text());
        let numberOfListItem = $("li").length;
        let randomChildNumber =
        Math.floor(Math.random()*numberOfListItem);
        $("H1").text($("li").eq(randomChildNumber).text());
        $('img').attr('src',images[randomChildNumber]);
    });
});