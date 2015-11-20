// Initialize your app
var myApp = new Framework7();

// Export selectors engine
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: true
});

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
//slide

var mySwiper = myApp.swiper('.swiper-tab', {
    pagination:'.swiper-pagination',
    paginationClickable: true,
    spaceBetween: 30,
    onlyExternal: true
});

// chuyển tab
$$(".tab_general").click(function(){
    $$(".bggg .add_border").removeClass("add_border");
    $$(this).addClass("add_border");
    $$(".swiper-tab  .swiper-wrapper").css({"transition-duration" : "0ms", "transform" : "translate3d(0px, 0px, 0px)"});
});

$$(".tab_list").click(function(){
    $$(".bggg .add_border").removeClass("add_border");
    $$(this).addClass("add_border");
    $$(".swiper-tab  .swiper-wrapper").css({"transition-duration" : "0ms", "transform" : "translate3d(-1177px, 0px, 0px)"});
});

$$(".tab_about").click(function(){
    $$(".bggg .add_border").removeClass("add_border");
    $$(this).addClass("add_border");
    $$(".swiper-tab  .swiper-wrapper").css({"transition-duration" : "0ms", "transform" : "translate3d(-2354px, 0px, 0px)"});
});

//float action button

$$(".button-floating").click(function() {
    var $wrapper = $$("#wrapper");

    if (!$wrapper.hasClass("button-floating-clicked"))
    {
        $wrapper.attr("class", "center");
        $wrapper.toggleClass("button-floating-clicked-out");
    }

    $wrapper.toggleClass("button-floating-clicked");

    $$(".button-sub").click(function() {
        var color = $$(this).data("color");

        $wrapper.attr("class", "center button-floating-clicked button-floating-clicked-out");
        $wrapper.addClass("button-sub-" + color + "-clicked");
    });
});
//float action button

$$('#login').click(function () {
    alert('dá');
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