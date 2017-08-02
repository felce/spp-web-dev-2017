$(document).ready(function () {
	$(window).scroll(
		function () {

			if ($(this).scrollTop() > 200) {
				$('#up').fadeIn();
			} else {
				$('#up').fadeOut();
			}
		}
	);
	$('#up').click(
		function () {
			$('body, html').animate({
				scrollTop: 0
			}, 1000);
		}
	);

	$('.menu-header').click(
		function () {
			var fromId = this.id;
			var toId = "#" + this.id + "-cnt";
			if ($(window).height() > $(toId).height()) {
				var to = $(toId).offset().top - ($(window).height() - $(toId).height()) / 2;
			} else {
				to = $(toId).offset().top;
			}
			$('body, html').animate({
				scrollTop: to
			}, 1000);
		}
	);
});