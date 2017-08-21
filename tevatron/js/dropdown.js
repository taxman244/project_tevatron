function main() {

	$('nav li ul').hide().removeClass('fallback');
	$('nav li').hover(
	  function () {
	    $('ul', this).stop().slideDown(400);
	  },
	  function () {
	    $('ul', this).stop().slideUp(400);
	  }
	);

}


$(document).ready(main);