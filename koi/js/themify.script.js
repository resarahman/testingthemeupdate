if(navigator.userAgent.match(/iPhone/i)) {
	// Fix iPhone viewport scaling bug on orientation change
	// By @mathias, @cheeaun and @jdalton
	(function(doc) {
	
	var addEvent = 'addEventListener',
	type = 'gesturestart',
	qsa = 'querySelectorAll',
	scales = [1, 1],
	meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];
	
	function fix() {
	meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
	doc.removeEventListener(type, fix, true);
	}
	
	if ((meta = meta[meta.length - 1]) && addEvent in doc) {
	fix();
	scales = [.25, 1.6];
	doc[addEvent](type, fix, true);
	}
	
	}(document));
}

jQuery(document).ready(function($){

	/////////////////////////////////////////////
	// HTML5 placeholder fallback	 							
	/////////////////////////////////////////////
	$('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
	    input.val('');
	    input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
	    input.addClass('placeholder');
	    input.val(input.attr('placeholder'));
	  }
	}).blur();
	$('[placeholder]').parents('form').submit(function() {
	  $(this).find('[placeholder]').each(function() {
	    var input = $(this);
	    if (input.val() == input.attr('placeholder')) {
		 input.val('');
	    }
	  })
	});
	
	/////////////////////////////////////////////
	// Scroll to top 							
	/////////////////////////////////////////////
	$('.back-top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	/////////////////////////////////////////////
	// Prepend zoom icon to highlights 							
	/////////////////////////////////////////////
	$('.home-highlights .lightbox').prepend('<span class="zoom"></span>');

});
