// $(function(){
//     var $li = $('ul.tab-title li');
//         $($li. eq(0) .addClass('active').find('a').attr('href')).siblings('.tab-inner').hide();
    
//         $li.click(function(){
//             $($(this).find('a'). attr ('href')).show().siblings ('.tab-inner').hide();
//             $(this).addClass('active'). siblings ('.active').removeClass('active');
//         });
//     });

// =========================收藏頁頁簽======================
function openClass(evt, className) {
    var i, x, tablinks;
    x = document.getElementsByClassName("class");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
       tablinks[i].classList.remove("red");
    }
    document.getElementById(className).style.display = "block";
    evt.currentTarget.classList.add("red");
  }
// =========================收藏頁頁簽======================
// =========================手機板按鈕======================

var mySwiper = new Swiper(".swiper-container", {
   pagination: ".pagination",
   paginationClickable: true,
   slidesPerView: 4,
   loop: true
 });
 mySwiper.on("slideChangeStart", function() {
   console.log("slide change start");
   $(".swiper-slide-next").addClass("swiper-slide-active");
 });
 /* Trick to fix clickable links in Slides */
 $(".swiper-container .swiper-slide a").bind("click", function() {
   window.open($(this).attr("href"), "_blank");
 });



// =======================手機板按鈕========================
// =======================收藏頁頁簽========================

var mybtn = document.getElementsByClassName("btn")[0];
mybtn.click();

// 我也不知道為甚麼放在這裡才不會衝突
// =======================收藏頁頁簽========================