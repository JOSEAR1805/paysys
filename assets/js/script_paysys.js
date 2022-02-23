$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    redimension();
});

$(window).resize(function(){
    redimension();
});

function redimension() {
    let heightGlobal = $(window).height();
    let heightHeader = $('.div-header').height();
    let heightFooter = $('.div-footer').height()
    let heightContent = heightGlobal - ( heightHeader + heightFooter + 22 );
    $('.div-content').height(heightContent);
    $('.div-content').css({"maxHeight":heightContent+"px"});
};

$(".list-unstyled a").on("click", function() {
    $(".list-unstyled").find(".active").removeClass("active");
    $(this).parent().addClass("active");
});