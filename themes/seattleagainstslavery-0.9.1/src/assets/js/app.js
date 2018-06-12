import $ from 'jquery';

window.$ = $;

var slickOptions = {
  adaptiveHeight: true,
  arrows: false,
  dots: true,
  mobileFirst: true
};

$(document).foundation();
$('.sas-hero').slick(slickOptions);
$('.sas-donate-form').donate();
$('.flexible--events').events();

$(window).on('changed.zf.mediaquery', function () {
  $('.flexible--events').events();
});

