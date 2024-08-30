$(document).ready(function() {
    // Menu button click behavior
    $('.navbar-toggler').on('click', function() {
      // Toggle the 'open' class on the button when clicked
      $(this).toggleClass('open');

      // Optionally, you can change the button icon (fa-bars to fa-times)
      if ($(this).hasClass('open')) {
        $(this).find('.fa').removeClass('fa-bars').addClass('fa-times');
      } else {
        $(this).find('.fa').removeClass('fa-times').addClass('fa-bars');
      }
    });
  });