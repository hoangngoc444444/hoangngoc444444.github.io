$(function(){
    // khi click vào phần tử .uptop

    $('.uptop').click(function(){
        $('body').animate({scrollTop:0});
        return false;
    })
})  