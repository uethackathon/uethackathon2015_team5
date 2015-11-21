// Initialize your app
var myApp = new Framework7();

// Export selectors engine
var $$ = Dom7;
//current index slide
var index = 0;
// Add view
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: true
});

var canvas;
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
swiper.nextClick = true;
swiper.prevClick = true;

swiper.on('onSlideNextStart', function () {
    if(swiper.nextClick==true) 
    {
        index++;
        console.log('slide next at '+index);
        emitNext(index);
    }
});
swiper.on('onSlidePrevStart', function () {
    if(swiper.prevClick==true) 
    {
        index--;
        console.log('slide prev at '+index);
        emitPrev(index);
    }
});
// chuyển tab
$(document).on('click', '.sub_fab_btn', function(){
    console.log("dsa");
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
