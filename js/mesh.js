jQuery(document).ready(function($){

  //Are we loaded?
  console.log('New theme loaded!');

  //Let's do something awesome!

  var divWidth = jQuery('.content-third').width();
  jQuery('.content-third').height(divWidth);

  jQuery(window).resize(function() {
    var divWidth = jQuery('.content-third').width();
    jQuery('.content-third').height(divWidth);
  });

  var divWidth = jQuery('.content-fourth').width();
  jQuery('.content-fourth').height(divWidth);

  jQuery(window).resize(function() {
    var divWidth = jQuery('.content-fourth').width();
    jQuery('.content-fourth').height(divWidth);
  });

  $(function() {
    $('a[href*=#]:not([href=#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });
  });

});
