// Initialize your app
var myApp = new Framework7();

// Export selectors engine
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: true,
     swipePanel: 'left'
});
// myApp.onPageBeforeInit('index', function (page) {
//   console.log('About page initialized');
//   console.log(page);
// });

// $(".submenu").click(function(){
//     alert('dá');
//     if($(".submenu").hasClass('acti')){
//         $(".submenu i").css({"-ms-transform" : "rotate(0deg)", "-webkit-transform" : "rotate(0deg)", "transform": "rotate(0deg)"});
//         $(".submenu").removeClass("acti");
//         $(".submenu1").hide();
//         $(".submenu2").hide();
//         $(".submenu3").hide();
//     }else{
//         $(".submenu i").css({"-ms-transform" : "rotate(45deg)", "-webkit-transform" : "rotate(45deg)", "transform": "rotate(45deg)"});
//         $(".submenu").addClass("acti");
//         $(".submenu1").show();
//         $(".submenu1").addClass("animated slideInUp");
//         $(".submenu2").show();
//         $(".submenu2").addClass("animated slideInUp");
//         $(".submenu3").show();
//         $(".submenu3").addClass("animated slideInUp");
//     }
// });

//slide
var swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    paginationClickable: true,
    paginationHide: true,
    onlyExternal: true,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    spaceBetween: 30
});

swiper.on('slideChangeStart', function () {
    console.log('slide change start 2');
});


// Generate dynamic page
var dynamicPageIndex = 0;
function createContentPage() {
	mainView.router.loadContent(
        '<!-- Top Navbar-->' +
        '<div class="navbar">' +
        '  <div class="navbar-inner">' +
        '    <div class="left"><a href="#" class="back link"><i class="icon icon-back"></i><span>Back</span></a></div>' +
        '    <div class="center sliding">Dynamic Page ' + (++dynamicPageIndex) + '</div>' +
        '  </div>' +
        '</div>' +
        '<div class="pages">' +
        '  <!-- Page, data-page contains page name-->' +
        '  <div data-page="dynamic-pages" class="page">' +
        '    <!-- Scrollable page content-->' +
        '    <div class="page-content">' +
        '      <div class="content-block">' +
        '        <div class="content-block-inner">' +
        '          <p>Here is a dynamic page created on ' + new Date() + ' !</p>' +
        '          <p>Go <a href="#" class="back">back</a> or go to <a href="services.html">Services</a>.</p>' +
        '        </div>' +
        '      </div>' +
        '    </div>' +
        '  </div>' +
        '</div>'
    );
	return;
}
//popup
$$('.create_class').on('click', function () {
    myApp.prompt('Tên lớp học', function (value) {
        myApp.prompt('Mã học phần', function (value) {    
        
        });
    });
});


function createCanvas(index){
    count = index.length;
    for (i = 0; i < count; i++) {
        $$(".swiper-wrapper").append()
    };
}