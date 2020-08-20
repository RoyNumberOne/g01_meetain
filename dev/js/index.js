$(document).ready(function() {
    $('#fullpage').fullpage({

    //Navigation
    menu: true,//绑定菜单，设定的相关属性与 anchors 的值对应后，菜单可以控制滚动
    lockAnchors: true,//锁定锚链接不随页面滑动而改变
    anchors:['Page1', 'Page2', 'Page3', 'Page4'],//锚链接，数组中元素对应各个页面的锚链接
    navigation: true,//有无导航栏
    navigationPosition: 'left',//导航栏位置
    navigationTooltips: ['首頁', '揪團', '討論', '商品'],//导航栏提示文字，与页面一一对应
    showActiveTooltip: false,//是否显示当前页面提示文字
    slidesNavigation: true,//有无幻灯片（横向）导航栏
    slidesNavPosition: 'bottom',//幻灯片（横向）导航栏位置

    loopBottom: true,
    loopTop: true,

    sectionsColor: ['transparent', 'transparent', 'transparent', 'transparent'],
    });
});
// new fullpage('#fullpage', {
// });


function checkbg(){
        if($("#section1").hasClass("active")){
            $(".scene > img").attr("src","./images/index/morning/sky.png");
            $(".mountainmiddle > img").attr("src","./images/index/morning/s1_mountain2-2.png");
            $(".mountainfirst > img").attr("src","./images/index/morning/mountain1.png");
        };
        if($("#section2").hasClass("active")){
            $(".scene > img").attr("src","./images/index/noon/sky.png");
            $(".mountainmiddle > img").attr("src","./images/index/noon/mountain2.png");
            $(".mountainfirst > img").attr("src","./images/index/noon/mountain1.png");
        };
        if($("#section3").hasClass("active")){
            $(".scene > img").attr("src","./images/index/sunset/sky.png");
            $(".mountainmiddle > img").attr("src","./images/index/sunset/mountain2.png");
            $(".mountainfirst > img").attr("src","./images/index/sunset/mountain1.png");
        };
        if($("#section4").hasClass("active")){
            $(".scene > img").attr("src","./images/index/night/sky.png");
            $(".mountainmiddle > img").attr("src","./images/index/night/mountain2.png");
            $(".mountainfirst > img").attr("src","./images/index/night/mountain1.png");
        };
    }


$(document).ready(
    checkbg()
);

$(window).mousemove(function(evt){

var pagex =evt.pageX;
var pagey =evt.pageY;

$(".scene img").css("left",`calc(-1000px + 50vw + ${pagex/40}px)`)
$(".mountainmiddle img").css("left",`calc(-1000px + 50vw + ${pagex/60}px)`)
$(".mountainfirst img").css("left",`calc(-1000px + 50vw + ${pagex/80}px)`)

checkbg();
})

$(window).scroll(function() {
    alert(123);
});

$(document).scroll(function(){
    alert(123);
})

$(window).bind('mousewheel', function(e){
    if(e.originalEvent.wheelDelta /120 > 0) {
        checkbg();
        console.log('scrolling up');
    }
    else{
        checkbg();
        console.log('scrolling down');
    }
});

$(document).ready(
$("#fp-nav").click(function(){
    alert(123);
    checkbg();
})
);

$(document).ready(
$(document).on('keydown',function(e) {
    checkbg();
}));
