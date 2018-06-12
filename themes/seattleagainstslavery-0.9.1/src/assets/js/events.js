import $ from 'jquery';
import Foundation from 'foundation-sites';

const Events = {
  init: function (elem) {
    var $events = elem;

    if ($events.length) {
      var $prev = $events.prev(),
        $next = $events.next(),
        isLargeScreen = Foundation.MediaQuery.atLeast('large'),
        isNextSlider = !!$next.find('.sas-hero').length,
        isPrevSlider = !!$prev.find('.sas-hero').length,
        eventsMargin = 0,
        nextMargin = 5 * 16,
        prevMargin = 5 * 16;

      if (isNextSlider) {
        $next = $next.find('.orbit-figure');
        nextMargin = 0;
      }

      if (isPrevSlider) {
        $prev = $prev.find('.sas-hero-slide');
        prevMargin = 0;
      }

      if (isLargeScreen) {
        var height = $events.height();

        eventsMargin = -1;
        nextMargin = (5 * 16) + (height / 2);
        prevMargin = (5 * 16) + (height / 2);
      }

      if ($next.length) {
        $next.css('padding-top', nextMargin).toggleClass('sas-hero-slide-large', isLargeScreen && isNextSlider);
        $events.css('margin-bottom', eventsMargin * nextMargin).toggleClass('flexible--events--after', isLargeScreen);
      }

      if ($prev.length) {
        $prev.css('padding-bottom', prevMargin).toggleClass('sas-hero-slide-large', isLargeScreen && isPrevSlider);
        $events.css('margin-top', eventsMargin * prevMargin).toggleClass('flexible--events--before', isLargeScreen);
      }
    }
  }
};

$.fn.events = function () {
  return Events.init(this);
};
