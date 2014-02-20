$(document).ready(function(){
	$nav = $('#nav');
	map = {
		'/': 'nav-home',
		'/music': 'nav-music',
		'/events': 'nav-events',
		'/videos': 'nav-videos',
		'/pics': 'nav-pictures',
		'/bio': 'nav-biography'
	}
	$(document.getElementById(map[document.location.pathname])).addClass('active');
});