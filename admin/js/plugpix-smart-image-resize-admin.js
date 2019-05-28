(function ($) {
	'use strict';

	$('.js-ppsir-faq').accordion({
		heightStyle: "content"
	});
	$('.js-ppsir-empty-space-color').wpColorPicker();
	$('.js-ppsir-tabs a').on('click', function () {
		$('.' + $(this).data('tab')).removeClass('hidden').siblings('.tab-content').addClass('hidden');
		$(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
		return false;
	});
	var handle = $("#js-ppsir-img-quality-slider-handle");
	$("#js-ppsir-img-quality-slider").slider({
		create: function () {
			$(this).slider('value', $('.js-ppsir-img-quality').val());
			handle.text($(this).slider('value') + '%');
		},
		slide: function (event, ui) {
			handle.text(ui.value + '%');
			$('.js-ppsir-img-quality').val(ui.value);
		},
		change: function (event, ui) {
			handle.text(ui.value + '%');
		}
	});
	$('#js-ppsir-reset-img-quality').on('click', function () {
		var defaultJPQQuality = $('.js-ppsir-img-quality').data('default');
		$("#js-ppsir-img-quality-slider").slider('value', defaultJPQQuality);
		$('.js-ppsir-img-quality').val(defaultJPQQuality);
		return false;
	})
})(jQuery);
